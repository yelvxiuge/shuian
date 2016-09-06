<?php
$this->context->layout=false;
?>

    <!DOCTYPE html>
    <html lang="zh-CN">

    <head>
        <meta charset="utf-8" />
        <title>用声音温暖心的角落</title>
        <meta name="location" content="">
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="keywords" content="小时候，父母陪我过中秋；现在，我陪父母过中秋......" />
        <meta name="description" content="小时候，父母陪我过中秋；现在，我陪父母过中秋......" />
        <link rel="stylesheet" href="css/reset.min.css">
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/page.min.css">
        <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
        <style type="text/css">
            .index-btns>a {
                height: 38px;
            }
            
            .fixbackground {
                z-index: 999998;
                width: 100%;
                height: 100%;
                position: fixed;
                left: 0;
                top: 0;
                background-color: #000;
                opacity: .7;
                filter: alpha(opacity=70);
            }
            
            .nav_div {
                top: 50%;
                margin-top: -43%;
                width: calc(100% - 100px);
                width: -webkit-calc(100% - 100px);
                height: 0;
                left: 50%;
                margin-left: -40%;
                position: fixed;
                box-sizing: border-box;
                z-index: 9999999;
                width: -webkit-calc(100% - 20%);
                padding-bottom: 86%;
                background: url(images/qrcode.jpg) no-repeat top center;
                background-size: 100%;
            }
            
            .nav_div .mic_icon {
                width: 100%;
                height: 24px;
                line-height: 36px;
                position: absolute;
                bottom: 0;
                text-align: center;
                color: #fff;
            }
        </style>

        <script>
            wx.config({
                debug: true,
                appId: "<?= $jsAr['appid']?>",
                timestamp: "<?= $jsAr['timestamp'] ?>",
                nonceStr: "<?= $jsAr['nonceStr']?>",
                signature: "<?= $jsAr['signature']?>"
                //jsApiList: ['showMenuItems','onMenuShareTimeline','onMenuShareAppMessage','translateVoice', 'startRecord', 'stopRecord', 'playVoice', 'stopVoice', 'uploadVoice', 'pauseVoice'],
               // jsApiList :[]
            });


             wx.ready(function() {
                wx.showMenuItems({
                    menuList: [
                        "menuItem:share:appMessage",
                        "menuItem:share:timeline",
                        "menuItem:share:qq",
                        "menuItem:share:QZone",
                        "menuItem:share:weiboApp",
                        "menuItem:share:facebook",
                        "menuItem:share:QZone"
                    ]
                });
            });
        </script>

    </head>

    <body style="background-color: #1F0D36;">
        <img src="images/lpic.png" style="position:fixed; left:-999px; top:-999px;" />
        <article class="page-wrap" id="pageContent">
            <img src="images/s_1.png">
            <img src="images/s_2.png">
            <img src="images/s_3.png">
            <img src="images/s_4.png">
            <img src="images/s_5.png">
            <img src="images/s_6.png">
            <div class="index-btns">
                <img src="images/s_7.png">
                <a href="javascript:;" id="sm"></a>
                <a href="/index.php?r=shui/records"></a>
            </div>
        </article>

        <div class="sm-layer hide"><img src="images/sm.png" width="272" height="349" /></div>
        <div class="layer-mask hide"></div>

        <script type="text/javascript" src="js/zepto.js"></script>
        <script type="text/javascript">
            $(function() {
                var t = [];
                t.push('<div class="fixbackground hide"></div>');
                t.push('<div class="nav_div hide">');
                t.push('<img src="images/qrcode.jpg" style="display:block;width:100%" />');
                t.push('<div class="mic_icon">');
                t.push('关注天恒•水岸壹号，获取更多精彩资讯</div>');
                t.push('</div>');
                $("body").append(t.join("\n"));
                $(".fixbackground").removeClass("hide").css("height", document.body.scrollHeight);
                $(".nav_div").removeClass("hide");
                $(".fixbackground").tap(function(){
                    $(".nav_div").addClass("hide");
                    $(".fixbackground").addClass("hide");
                });
                var $bths = $('.index-btns');
                //console.log($bths.height());
                $bths.css('height', $bths.height());

                $('#sm').on('click', function() {
                    $('.sm-layer').show();
                    $('.layer-mask').show();
                });

                $('.layer-mask').on('click', function() {
                    $('.sm-layer').hide();
                    $('.layer-mask').hide();
                });
            });
        </script>

        <script type="text/javascript">
            $(function() {

                var sata = {
                    //            title : 'asddasssdsdsdsdsdsd',
                    //            link : 'http://www.baidu.com',
                    //            imgUrl : 'http://shuian.md5crack.cn/images/i_1.png'
                    title: '用声音温暖心的角落 ',
                    link: 'http://shuian.md5crack.cn/index.php?r=shui',
                    imgUrl: 'http://shuian.md5crack.cn/images/lpic.png',
		            desc: '小时候，父母陪我过中秋；现在，我陪父母过中秋......'
                };




                wx.ready(function() {




        	       /*var imgUrl = "http://shuian.md5crack.cn/images/lpic.png";  //图片LOGO注意必须是绝对路径
			       var lineLink = "http://shuian.md5crack.cn/index.php?r=shui";   //网站网址，必须是绝对路径
			       var descContent = '小时候，父母陪我过中秋；现在，我陪父母过中秋......'; //分享给朋友或朋友圈时的文字简介
			       var shareTitle = '用声音温暖心的角落';  //分享title
			       var appid = '<?= $jsAr['appid']?>'; //apiID，可留空
			        
			       function shareFriend() {
			           WeixinJSBridge.invoke('sendAppMessage',{
			               "appid": appid,
			               "img_url": imgUrl,
			               "img_width": "200",
			               "img_height": "200",
			               "link": lineLink,
			               "desc": descContent,
			               "title": shareTitle
			           }, function(res) {
			               //_report('send_msg', res.err_msg);
			           })
			       }
			       function shareTimeline() {
			           WeixinJSBridge.invoke('shareTimeline',{
			               "img_url": imgUrl,
			               "img_width": "200",
			               "img_height": "200",
			               "link": lineLink,
			               "desc": descContent,
			               "title": shareTitle
			           }, function(res) {
			                  //_report('timeline', res.err_msg);
			           });
			       }
			       function shareWeibo() {
			           WeixinJSBridge.invoke('shareWeibo',{
			               "content": descContent,
			               "url": lineLink,
			           }, function(res) {
			               //_report('weibo', res.err_msg);
			           });
			       }
			       // 当微信内置浏览器完成内部初始化后会触发WeixinJSBridgeReady事件。
			       document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
			           // 发送给好友
			           WeixinJSBridge.on('menu:share:appmessage', function(argv){
			               shareFriend();
			           });
			           // 分享到朋友圈
			           WeixinJSBridge.on('menu:share:timeline', function(argv){
			               shareTimeline();
			           });
			           // 分享到微博
			           WeixinJSBridge.on('menu:share:weibo', function(argv){
			               shareWeibo();
			           });
			       }, false);*/


                    //分享到朋友圈
                   wx.onMenuShareTimeline({
                        title: sata.title, // 分享标题
                        desc: sata.desc, // 分享描述
                        link: sata.link, // 分享链接
                        imgUrl: sata.imgUrl, // 分享图标
                        success: function () {
                            // 用户确认分享后执行的回调函数
                        },
                        cancel: function () {
                            // 用户取消分享后执行的回调函数
                        }
                    });


                    //分享给朋友
                    wx.onMenuShareAppMessage({
                        title: sata.title, // 分享标题
                        desc: sata.desc, // 分享描述
                        link: sata.link, // 分享链接
                        imgUrl: sata.imgUrl, // 分享图标
                        //type: '', // 分享类型,music、video或link，不填默认为link
                        //dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                        success: function () {
                            // 用户确认分享后执行的回调函数
                        },
                        cancel: function () {
                            // 用户取消分享后执行的回调函数
                        }
                    });


                });

            });
        </script>


    </body>

    </html>