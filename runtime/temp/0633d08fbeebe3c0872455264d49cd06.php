<?php /*a:1:{s:51:"D:\mf\pcnfc\application\admin\view\public\jump.html";i:1541756597;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!--[if IE 8]><style>.ie8 .alert-circle,.ie8 .alert-footer{display:none}.ie8 .alert-box{padding-top:75px}.ie8 .alert-sec-text{top:45px}</style><![endif]-->
    <title>跳转提示</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #E6EAEB;
            font-family: Arial, '微软雅黑', '宋体', sans-serif
        }
        .alert-box {
            display: none;
            position: relative;
            margin: 96px auto 0;
            padding: 180px 85px 22px;
            border-radius: 10px 10px 0 0;
            background: #FFF;
            box-shadow: 5px 9px 17px rgba(102,102,102,0.75);
            width: 286px;
            color: #FFF;
            text-align: center
        }
        .alert-box p {
            margin: 0
        }
        .alert-circle {
            position: absolute;
            top: -50px;
            left: 111px
        }
        .alert-sec-circle {
            stroke-dashoffset: 0;
            stroke-dasharray: 735;
            transition: stroke-dashoffset 1s linear
        }
        .alert-sec-text {
            position: absolute;
            top: 24px;
            left: 190px;
            width: 76px;
            color: #000;
            font-size: 68px
        }
        .alert-sec-unit {
            font-size: 34px
        }
        .alert-body {
            margin: 35px 0
        }
        .alert-head {
            color: #242424;
            font-size: 28px
        }
        .alert-concent {
            margin: 25px 0 14px;
            color: #7B7B7B;
            font-size: 18px
        }
        .alert-concent p {
            line-height: 27px
        }
        .alert-btn {
            display: block;
            border-radius: 10px;
            background-color: #4AB0F7;
            height: 55px;
            line-height: 55px;
            width: 286px;
            color: #FFF;
            font-size: 20px;
            text-decoration: none;
            letter-spacing: 2px
        }
        .alert-btn:hover {
            background-color: #6BC2FF
        }
        .alert-footer {
            margin: 0 auto;
            height: 42px;
            width: 120px
        }
        .alert-footer-icon {
            float: left
        }
        .alert-footer-text {
            float: left;
            border-left: 2px solid #EEE;
            padding: 3px 0 0 5px;
            height: 40px;
            color: #0B85CC;
            font-size: 12px;
            text-align: left
        }
        .alert-footer-text p {
            color: #7A7A7A;
            font-size: 22px;
            line-height: 18px
        }
    </style>
</head>
<body class="ie8">

<div id="js-alert-box" class="alert-box">
    <svg class="alert-circle" width="234" height="234">
        <circle cx="117" cy="117" r="108" fill="#FFF" stroke="#43AEFA" stroke-width="17"></circle>
        <circle id="js-sec-circle" class="alert-sec-circle" cx="117" cy="117" r="108" fill="transparent" stroke="#F4F1F1" stroke-width="18" transform="rotate(-90 117 117)"></circle>
        <text class="alert-sec-unit" x="82" y="172" fill="#BDBDBD"></text>
    </svg>
    <div id="js-sec-text" class="alert-sec-text"></div>
    <div class="alert-body">
        <div id="js-alert-head" class="alert-head"></div>
        <div class="alert-concent">
            <p>
                <?php switch ($code) {case 1:?>
                <?php echo(strip_tags($msg));break;case 0:?>
                <?php echo(strip_tags($msg));break;} ?>
            </p>
        </div>
        <a id="js-alert-btn" class="alert-btn" href="<?php echo($url);?>">立即跳转</a>
    </div>
    <div class="alert-footer clearfix">
        <svg width="46px" height="42px">

        </svg>
    </div>
</div>


<script type="text/javascript">
    function alertSet(e) {
        document.getElementById("js-alert-box").style.display = "block",
            document.getElementById("js-alert-head").innerHTML = e;
        var t = 3,
            n = document.getElementById("js-sec-circle");
        document.getElementById("js-sec-text").innerHTML = t,
            setInterval(function() {
                    if (0 == t){
                        location.href="<?php echo($url);?>";
                    }else {
                        t -= 1,
                            document.getElementById("js-sec-text").innerHTML = t;
                        var e = Math.round(t / 10 * 735);
                        n.style.strokeDashoffset = e - 735
                    }
                },
                970);
    }
</script>

<script>
    alertSet('');
</script>

</body>
</html>
