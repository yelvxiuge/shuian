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


<body style="background-color: #1F0D36;">
<article class="page-wrap" id="pageContent">
    <img src="images/s_1.png" >
    <img src="images/s_2.png" >
    <img src="images/s_3.png" >
    <img src="images/s_4.png" >
    <img src="images/s_5.png" >
    <img src="images/s_6.png" >
    <div class="index-btns">
        <img src="images/s_7.png" >
        <a href="javascript:;" id="sm"></a>
        <a href="record.html"></a>
    </div>
</article>

<div class="sm-layer hide"><img src="images/sm.png" width="272" height="349" /></div>
<div class="layer-mask hide"></div>

<script type="text/javascript" src="js/zepto.js"></script>
<script type="text/javascript">
    $(function() {
        var $bths = $('.index-btns');
        //console.log($bths.height());
        $bths.css('height',$bths.height());


        $('#sm').on('click',function(){
            $('.sm-layer').show();
            $('.layer-mask').show();
        });

        $('.layer-mask').on('click',function(){
            $('.sm-layer').hide();
            $('.layer-mask').hide();
        });
    });
</script>

</body>
</html>
