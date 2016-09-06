<?php $this->context->layout=false;?>

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

        <link rel="stylesheet" href="css/weui.min.css">
        <link rel="stylesheet" href="js/weui/css/jquery-weui-0.8.min.css">

        <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>

        <script>
            wx.config({
                debug: false,
                appId: "<?= $jsAr['appid']?>",
                timestamp: "<?= $jsAr['timestamp'] ?>",
                nonceStr: "<?= $jsAr['nonceStr']?>",
                signature: "<?= $jsAr['signature']?>",
                jsApiList: ['showMenuItems','translateVoice', 'startRecord', 'stopRecord', 'playVoice', 'stopVoice', 'uploadVoice', 'pauseVoice']
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
        <style type="text/css">
             [v-cloak] {
              display: none;
            }
            .record-wrap dl dd div {
                width: 0%;
            }
            
            .record-wrap dl dd {
                overflow: hidden;
            }
        </style>
    </head>

    <body style="background: url(images/r_6.png) repeat-y 0 0;" v-cloak>
        <img src="images/lpic.png" style="position:fixed; left:-999px; top:-999px;" />
        <article class="page-wrap" id="pageContent">
            <img src="images/r_1.png">
            <img src="images/r_2.png">
            <img src="images/r_3.png">
            <img src="images/r_4.png">
            <div class="record-wrap">
                <img src="images/r_5.png">
                <a href="javascript:;" @tap="rerecord" class="r">&nbsp;</a>
                <a href="index.php?r=shui/" class="h">&nbsp;</a>
                <dl class="clearfix">
                    <dt>{{playing?playerTime:time|timeformat}}</dt>
                    <dd>
                        <div :style="'width:'+ww + '%'"><em v-show="playing"></em></div>
                    </dd>
                </dl>
                <div class="play">
                    <a href="javascript:void(0)" id="record" @tap="record">{{recording?'停止':'录音'}}</a>
                    <a href="javascript:void(0)" @tap="play">{{pause?'播放':'暂停'}}</a>
                    <a href="javascript:;" @tap="build">制成</a>
                </div>
            </div>

            <img src="images/r_6.png">
        </article>

        <script type="text/javascript" src="js/zepto.js"></script>
        <script type="text/javascript" src="js/weui/js/jquery-weui-0.8.min.js"></script>
        <script type="text/javascript" src="js/vue.min.js"></script>



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


                    //分享到朋友圈
                    wx.onMenuShareTimeline({
                        title: sata.title, // 分享标题
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
        

        <script type="text/javascript">
            $(function() {
                Vue.filter('timeformat', function(val) {
                    if(val) {
                        var m = parseInt(val / 60) + "";
                        var s = val - (60 * m) + '';
                        m.length == 1 ? m = "0" + m : m;
                        s.length == 1 ? s = "0" + s : s;
                        return(m + ":" + s);
                    } else {
                        return "00:00";
                    }
                });

                ttt = new Vue({
                    el: "body",
                    data: {
                        voice: {},
                        recording: false,
                        playing: false,
                        pause: true,
                        time: 0,
                        playerTime: 0,
                    },
                    computed: {
                        ww: function() {
                            var tmp = (100 / this.time) * this.playerTime;
                            return tmp >= 100 ? 100 : tmp;
                        }
                    },
                    methods: {
                        restore: function() {
                            this.voice = {};
                            this.recording = false;
                            this.playing = false;
                            this.pause = true;
                            this.time = 0
                            this.playerTime = 0;
                        },
                        build: function() {
                            var _this = this;
                            if(this.recording) {
                                this.record(function() {
                                    sessionStorage.setItem("voice", _this.serverId);
                                    _this.restore();
                                    window.location.href = "index.php?r=shui/share&voice="+_this.serverId;
                                });
                            } else if(_this.serverId) {
                                wx.stopVoice({
                                    localId: _this.voice.localId
                                });
                                sessionStorage.setItem("voice", _this.serverId);
                                _this.restore();
                                window.location.href = "index.php?r=shui/share&voice="+_this.serverId;
                            } else {
                                $.toast("请先录音", "cancel");

                            }
                        },
                        play: function() {
                            this.recording ? null : this.pause ? this.playCtrl() : this.pauseCtrl();
                        },
                        pauseCtrl: function() {
                            var _this = this;
                            wx.pauseVoice({
                                localId: _this.voice.localId
                            });
                            clearTimeout(_this.timerId);
                            this.pause = true;
                        },
                        playCtrl: function(localId) {
                            if((!this.playing || this.pause)&&this.voice.localId) {
                                this.pause = false;
                                var _this = this;
                                this.playing = true;
                                this.startTimer("playerTime");
                                wx.playVoice({
                                    localId: _this.voice.localId
                                });
                                wx.onVoicePlayEnd({
                                    success: function(res) {
                                        _this.pause = true;
                                        _this.playing = false;
                                        _this.playerTime = 0;
                                        clearTimeout(_this.timerId);
                                    }
                                });
                            }
                        },
                        rerecord: function() {
                            var _this = this;

                            clearTimeout(this.timerId);
                            this.playing = false;
                            this.recording = false;
                            this.pause = false;
                            this.time = 0;
                            this.playerTime = 0;
                            this.voice = {};
                            wx.stopRecord();
                            wx.stopVoice({
                                localId: _this.voice.localId
                            });
                        },
                        upload: function(fn) {
                            var _this = this;
                            wx.uploadVoice({
                                localId: _this.voice.localId,
                                success: function(res) {
                                    //console.log(res);
                                    $.hideLoading();
                                    _this.serverId = res.serverId;
                                    try{
                                    if(fn){
                                        fn();
                                    }
                                    }catch(e){}
                                    //_this.playCtrl(_this.voice.localId);
                                }
                            });
                        },
                        record: function(fn) {
                            if(!this.voice.localId) {
                                var _this = this;

                                if(!this.recording) {
                                    this.recording = true;
                                    wx.startRecord({
                                        cancel: function() {}
                                    });
                                    this.startTimer("time");
                                    wx.onVoiceRecordEnd({
                                        complete: function(res) {
                                            $.showLoading();
                                            _this.voice.localId = res.localId;
                                            _this.upload();
                                        }
                                    });
                                } else {
                                    this.recording = false;
                                    clearTimeout(this.timerId);
                                    $.showLoading();
                                    wx.stopRecord({
                                        success: function(res) {
                                            _this.stop = new Date();
                                            _this.voice.localId = res.localId;
                                            _this.upload(fn);
                                        },
                                        fail: function(res) {
                                            $.hideLoading();
                                            alert(JSON.stringify(res));
                                        }
                                    });
                                }
                            }
                        },
                        startTimer: function($key) {
                            var _this = this;
                            (function() {
                                if(_this[$key] >= 0) {
                                    m = _this[$key];
                                    _this.timerId = setTimeout(arguments.callee, 1000);
                                    _this[$key] = _this[$key] + 1;
                                }
                            })();
                        }
                    }
                });

            });
        </script>
    </body>

</html>