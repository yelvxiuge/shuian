<?php
$this->context->layout=false;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="location" content="">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link rel="stylesheet" href="css/reset.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/page.min.css">
    <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
    <script>
        wx.config({
            debug: true,
            appId: '<?= $jsAr['appid']?>',
            timestamp: '<?= $jsAr['timestamp'] ?>',
            nonceStr: '<?= $jsAr['nonceStr']?>',
            signature: '<?= $jsAr['signature']?>',
            //jsApiList: ["showMenuItems","playVoice","downloadVoice","translateVoice","startRecord","stopRecord","stopVoice","uploadVoice","pauseVoice"]
            jsApiList: ["showMenuItems",'downloadVoice','translateVoice', 'startRecord', 'stopRecord', 'playVoice', 'stopVoice', 'uploadVoice', 'pauseVoice']
        });
        wx.ready(function(){
            wx.showMenuItems({menuList: [
                "menuItem:share:appMessage",
                "menuItem:share:timeline",
                "menuItem:share:qq",
                "menuItem:share:QZone",
                "menuItem:share:weiboApp",
                "menuItem:share:facebook",
                "menuItem:share:QZone"
            ]});
        });

    </script>
</head>
<body style="background-color: #330051;">
<article class="page-wrap" id="pageContent">
    <img src="images/i_1.png" >
    <img src="images/i_2.png" >
    <a href="javascript:;" id="playSound"><img src="images/i_3.png" ></a>
    <a href="javascript:;" id="shareBtn" style="display:none;"><img src="images/i_4.png" ></a>
    <a href="/index.php?r=shui/records" id="goSound"  style="display:none;"><img src="images/ii_4.png" ></a>
    <img src="images/i_5.png" >
</article>
<script type="text/javascript">
    if(sessionStorage.getItem("voice")){
        document.getElementById('shareBtn').style.display="block";
    }else{
        document.getElementById('goSound').style.display="block";
    };
</script>

<div class="share-layer hide"></div>
<div class="layer-mask hide"></div>


<script type="text/javascript" src="js/zepto.js"></script>
<script type="text/javascript" src="js/lazyload.js"></script>
<script type="text/javascript">
    $(function() {
        var src = '',
            $subjectContent = $('#pageContent'),
            $shareBtn = $('#shareBtn');
        window.scrollTo(0, 1);
        $subjectContent.find('img').lazyload();

        $shareBtn.on('click',function(){
            $('.share-layer').show();
            $('.layer-mask').show();
        });

        $('.layer-mask').on('click',function(){
            $('.share-layer').hide();
            $('.layer-mask').hide();
        });

        var shareData = {
//            title : 'asddasssdsdsdsdsdsd',
//            link : 'http://www.baidu.com',
//            imgUrl : 'http://shuian.md5crack.cn/images/i_1.png'
            title : '用声音温暖心得角落 ',
            link : 'http://www.baidu.com',
            imgUrl : 'http://shuian.md5crack.cn/images/lpic.png'
        };

        wx.ready(function(){
            wx.onMenuShareTimeline({
                title: shareData.title, 
                link:  shareData.link, 
                imgUrl: shareData.imgUrl, 
                success: function () {
                    wx.closeWindow();
                },
                cancel: function () {
                }
            });
            wx.onMenuShareAppMessage({
                title: shareData.title, 
                link:  shareData.link, 
                imgUrl: shareData.imgUrl, 
                success: function () {
                    wx.closeWindow();
                },
                cancel: function () {
                }
            });
            wx.onMenuShareQQ({
                title: shareData.title, 
                link:  shareData.link, 
                imgUrl: shareData.imgUrl, 
                success: function () {
                    wx.closeWindow();
                },
                cancel: function () {
                }
            });
			
			
			function getUrlParam(url) {
				url = url || window.location.href;
				var objRequest = new Object();
				if (url.indexOf("?") != -1) {
					url = url.split("?")[1];
					var strArr = url.split("&");
					for (var i = 0; i < strArr.length; i ++) {
						objRequest[strArr[i].split("=")[0]] = decodeURI((strArr[i].split("=")[1]));
					}
				}
				return objRequest;
			};
			

			
			//点击播放
			$('#playSound').on('click',function(){
				wx.downloadVoice({
					serverId: getUrlParam()["voice"], // 需要下载的音频的服务器端ID，由uploadVoice接口获得
					isShowProgressTips: 1, // 默认为1，显示进度提示
					success: function (res) {
						var localId = res.localId; // 返回音频的本地ID
						wx.playVoice({
							localId: localId // 需要播放的音频的本地ID，由stopRecord接口获得
						});
					}
				});
			});
			
			
			
        });  

    });
</script>

</body>
</html>
