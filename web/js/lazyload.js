/**
 * @file    图片lazyload功能，集成在 Zepto.prototype 对象上
 * @exports
        $.fn.lazyload(options)
        ===========options==========
            threshold       : 0,        //图片提前加载阈值，单位为px，调用时不要引入单位
            dataAttribute   : "src",    //存放图片src的属性，默认为 data-src
            supportAsync    : false,    //是否支持异步数据，默认不支持
 * @author  zhuyaqiu
 * @date    2014/03/19 
 */

// var $ = require("common:widget/lib/gmu/zepto/zepto.js");
var $window = $(window);

/** 
 * @desc    更新文档在视口中的位置
 * @return  {Array}     文档顶部滚动偏移和底部偏移
 */
function _updateScrollRect() {
    // window.innerHeight changes when the browser zooms, 
    // it means how many css pixels it can contain.
    var scrollTop = window.scrollY,
        scrollBtm = scrollTop + window.innerHeight;
    
    return [scrollTop, scrollBtm];
}

/** 
 * @desc    函数节流，短时间内重复触发时，只触发最后一次行为
 * @param   {number}    delay   延迟时间
 * @param   {Function}  fn      被节流的函数
 * @return  {Function}  wrapper 高阶函数，重复调用时只触发最后一次
 */
function _throttle(delay, fn) {
    var timeId;

    function wrapper() {
        var that = this,
            args = [].slice.call(arguments);

        function exec() {fn.apply(that, args);}

        timeId && clearTimeout(timeId);
        timeId = setTimeout(exec, delay);
    }
    
    wrapper._zid = fn._zid = fn._zid || $.proxy(fn)._zid;
    
    return wrapper;
}

$.fn.lazyload = function (options) {
    var defaultOpt = {
        threshold       : 0,                
        dataAttribute   : "src",        
        supportAsync    : false
    };
    
    options = $.extend({}, defaultOpt, options);
    
    $window.on("scrollStop orientationchange", _loadImages);
    
    // if supprotAsync is true. 
    // retrieve elements with selector everytime event fires
    var $elements   = this,
        selector    = this.selector,
        scrollTop, 
        scrollBtm;                      

    // invoke when the viewport changes
    function _loadImages () {
        var scrollRect = _updateScrollRect();
        
        scrollTop = scrollRect[0];
        scrollBtm = scrollRect[1];
    
        if (options.supportAsync) {
            $elements = $(selector);
        }
        
        $elements = $($.map($elements, function(element) {
            return (element["lazyload"] || !$(element).data(options.dataAttribute)) ? null : element;   
        }));
        
        $elements.each(_loadImage);
    }
    
    // @this     the element itself
    function _loadImage() {
        var self    = this,
            $self   = $(this);
            
        if (self["lazyload"]) return; 

        var imageSrc    = $self.data(options.dataAttribute),
            threshold   = options.threshold,
            offset      = $self.offset(),
            elemTop     = offset.top - threshold,
            elemBottom  = offset.top + offset.height + threshold;

        if ((scrollTop <= elemTop && elemTop <= scrollBtm) 
            || (scrollTop <= elemBottom && elemBottom <= scrollBtm) 
            || (elemTop <= scrollTop && elemBottom >= scrollBtm)
        ) {
            $self.attr("src", imageSrc).css("visibility", "hidden");
            
            self["lazyload"] = "loading";
            
            // notice: 由于当前img可能已触发过 onload/onerror。这里会再次触发
            self.onload = function () {
                self["lazyload"] = "loaded";
                $self.css("visibility", "visible");
            };
            
            // self.addEventListener("error", function() {});
            
        } else if (elemTop > scrollBtm) {
            return false;
        }
    }
    
    $(document).ready(function() {
        _loadImages();
    });
    
    /* With IOS5 force loading images when navigating with back button. */  
    /* Non optimal workaround. */
    if ((/iphone|ipad/gi).test(navigator.appVersion)) {
        $window.bind("pageshow", function(event) {
            if (event.originalEvent && event.originalEvent.persisted) {
                _loadImages(); 
            }
        });
    }
};

$(window).on("scroll", _throttle(80, function() {
    $(window).trigger("scrollStop");
}));

