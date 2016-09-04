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
</head>
<body style="background-color: #330051;">
<article class="page-wrap" id="pageContent">
    <img src="images/i_1.png" >
    <img src="images/i_2.png" >
    <a href="javascript:;"><img src="images/i_3.png" ></a>
    <a href="javascript:;" id="shareBtn"><img src="images/i_4.png" ></a>
    <img src="images/i_5.png" >
</article>

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


    });
</script>

</body>
</html>
