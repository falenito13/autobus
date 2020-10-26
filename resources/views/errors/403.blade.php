
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>AutoBus • Welcome</title>
    <style type="text/css">
        
body{
    margin: 0;
    padding: 0;
    background-color: white;
    height: 100vh;
    overflow: hidden;
}

::selection {
    background: #ededed;
}

.main{
    width: 100%;
    margin: 0;
    padding: 0;
    height: 100%;
}

.hidden_images img{
    position: absolute;
    top: 100%;
    right: 100%;
    opacity: 0;
    width: 1px;
}

.left_side{
    width: 40%;
    height: 100%;
    float: left;
    padding-left: 10%;
    padding-top: 8vh;
    padding-right: 6%;
}
.right_side{
    float: right;
    width: 44%;
    height: 100vh;
    background: #ededed url("bg_img.jpg") no-repeat center;
    background-size: cover;
}
.header{
    width: 163px;
    height: 54px;
    background: url("logo.svg") no-repeat;
    background-size: contain;
}
.content{
    margin-top: 10vh;
}
.content_title{
    font-family: FiraGO-ExtraBold;
    font-size: 3vw;
    color: #8ec544;
    text-transform: uppercase;
    -moz-font-feature-settings: 'case';
    -webkit-font-feature-settings: 'case';
    font-feature-settings: 'case' on;
}
.underline{
    margin-top: 4vh;
    width: 100px;
    height: 3px;
    background-color: #8ec544;
}
.subscribe{
    margin-top: 8vh;
    width: 100%;
}
.subscribe_title{
    font-family: FiraGO-SemiBold;
    font-size: 18px;
    color: #757575;
    text-transform: uppercase;
    -moz-font-feature-settings: 'case';
    -webkit-font-feature-settings: 'case';
    font-feature-settings: 'case' on;
}
.subscribe_box{
    width: 80%;
    height: 60px;
    margin-top: 2.4vh;
    border-bottom: 2px solid rgba(225,225,225,0.6);
    display: flex;
    justify-content: left;
    align-items: center;
}

.subscribe_box:hover{
    border-bottom: 2px solid rgba(142,219,68,1);
    transition: border-bottom 0.3s;
}

.subscribe_form{
    width: 100%;
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
}
.subscribe_form>input{
    width: calc(100% - 130px);
    font-family: FiraGO-Regular;
    font-size: 14px;
    color: #8ec544;
    border: none;
    outline: none;
    margin-left: 20px;
}
.subscribe_form>input::placeholder{
    font-family: FiraGO-Regular;
    font-size: 14px;
    color: #757575;
}
.subscribe_button_link{
cursor: pointer;
}
.submit_button{
    margin-right: 20px;
    display: flex;
    justify-content: left;
    align-items: center;
    float: right;
    overflow: hidden;
    font-family: FiraGO-Regular;
    font-size: 10px;
    line-height: 2px;
    color: #757575;

}
.submit_button_icon{
    margin-left: 10px;
    float: right;
    padding: 0;
    width: 28px;
    height: 28px;
    border: 1px solid rgb(165, 165, 165);
    border-radius: 14px;
    background: url("next_arrow.svg") no-repeat;
    background-size: 8px 8px;
    background-position: 11px center;
    opacity: 0.6;
}

.subscribe_button_link:hover .submit_button_icon{
    -webkit-animation-name: arrow;
    -webkit-animation-duration: 1s;
    animation-name: arrow;
    animation-duration: 1s;
}

@-webkit-keyframes arrow {
    0%   {background-position: 11px center;}
    25%  {background-position: 30px center;}
    26%  {background-position: -20px center;}
    50%  {background-position: -20px center;}
    80% {background-position: 11px center;}
    100% {background-position: 11px center;}
}

@keyframes arrow {
    0%   {background-position: 11px center;}
    25%  {background-position: 30px center;}
    26%  {background-position: -20px center;}
    50%  {background-position: -20px center;}
    80% {background-position: 11px center;}
    100% {background-position: 11px center;}
}

.contact{
    margin-top: 8vh;
    width: 100%;
}
.contact_addres{
    font-family: FiraGO-Medium;
    font-size: 18px;
}

.contact_addres>a{
    text-decoration: none;
    color: rgba(49,49,49,0.6);
}

.contact_addres>a:hover{
    color: rgba(142,219,68,1);
    transition: color 0.2s;
}

.contact_info{
    width: 100%;
    margin-top: 14px;
}
.contact_information{
    font-family: FiraGO-Regular;
    font-size: 14px;
    display: inline;
    margin-right: 15px;
}
.contact_information>a{
    text-decoration: none;
    color: #454545;
}

.contact_information>a:hover{
    text-decoration: none;
    color: #8ec544;
    transition: color 0.2s;
}

.contact_socials{
    width: 100%;
    margin-top: 4vh;
}
.contact_socials>a{
    text-decoration: none;
    width: 50px;
}
.contact_social_media{
    display: inline-block;
    margin-right: 10px;
    width: 50px;
    height: 50px;
    border: 1px solid rgba(0,0,0,0.2);
    box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.0);
    border-radius: 25px;
    transition: box-shadow 0.3s;
}

.contact_social_media:hover{
    border: 1px solid rgba(142,219,68,1);
    box-shadow: 0px 0px 0px 1px rgba(142,219,68,1);
}

#facebook{
    background-image: url("facebook.svg");
    background-position: center;
    background-size: 16px 16px;
    background-repeat: no-repeat;
    opacity: 1;
}

#facebook:hover{
    -webkit-animation-name: facebook;
    -webkit-animation-duration: 0.3s;
    animation-name: facebook;
    animation-fill-mode: forwards;
    animation-duration: 0.3s;
}

@-webkit-keyframes facebook {
    0%   {background-image: url("facebook.svg"); opacity: 1;}
    100%   {background-image: url("facebook_hover.svg"); opacity: 1;}
}

@keyframes facebook {
    0%   {background-image: url("facebook.svg"); opacity: 1;}
    100%   {background-image: url("facebook_hover.svg"); opacity: 1;}
}

#instagram{
    background-image: url("instagram.svg");
    background-position: center;
    background-size: 16px 16px;
    background-repeat: no-repeat;
}

#instagram:hover{
    -webkit-animation-name: instagram;
    -webkit-animation-duration: 0.3s;
    animation-name: instagram;
    animation-fill-mode: forwards;
    animation-duration: 0.3s;
}

@-webkit-keyframes instagram {
    0%   {background-image: url("instagram.svg"); opacity: 1;}
    100%   {background-image: url("instagram_hover.svg"); opacity: 1;}
}

@keyframes instagram {
    0%   {background-image: url("instagram.svg"); opacity: 1;}
    100%   {background-image: url("instagram_hover.svg"); opacity: 1;}
}

#twitter{
    background-image: url("twitter.svg");
    background-position: center;
    background-size: 16px 16px;
    background-repeat: no-repeat;
}

#twitter:hover{
    -webkit-animation-name: twitter;
    -webkit-animation-duration: 0.3s;
    animation-name: twitter;
    animation-fill-mode: forwards;
    animation-duration: 0.3s;
}

@-webkit-keyframes twitter {
    0%   {background-image: url("twitter.svg"); opacity: 1;}
    100%   {background-image: url("twitter_hover.svg"); opacity: 1;}
}

@keyframes twitter {
    0%   {background-image: url("twitter.svg"); opacity: 1;}
    100%   {background-image: url("twitter_hover.svg"); opacity: 1;}
}

@media only screen and (max-height: 700px) {
    .left_side{
        padding-left: 8%;
        padding-top: 6vh;
        padding-right: 6%;
        height: 94%;
    }
    .content{
        margin-top: 8vh;
    }
    .content_title{
        font-size: 2.8vw;
    }
}

@media only screen and (max-width: 1023px){

    body{
        margin: 0;
        padding: 0;
        background-color: white;
        height: auto;
        width: 100%;
        overflow: scroll;
    }

    .main{
        width: 100%;
        margin: 0;
        padding: 0;
        height: auto;
    }

    .left_side{
        position: absolute;
        top: 50vw;
        width: 80%;
        height: auto;
        float: none;
        padding-left: 10%;
        padding-top: 8vh;
        padding-right: 10%;
        padding-bottom: 8vh;
    }

    .right_side{
        float: none;
        width: 100%;
        height: 50vw;
    }

    .content_title{
        font-size: 50px;
    }
}

@media only screen and (max-width: 767px){

    body{
        margin: 0;
        padding: 0;
        background-color: white;
        height: auto;
        width: 100%;
        overflow: scroll;
    }

    .main{
        width: 100%;
        margin: 0;
        padding: 0;
        height: auto;
    }

    .right_side{
        background-size: 100% !important;
    }

    .left_side{
        width: 90%;
        padding-left: 5%;
        padding-right: 5%;
    }

    .content_title{
        font-size: 30px;
    }

    .subscribe{
        margin-top: 10vh;
    }

    .subscribe_box{
        width: 100%;
    }

    .subscribe_title{
        font-size: 14px;
    }

    .subscribe_form>input{
        width: calc(100% - 90px);
        font-size: 12px;
        margin-left: 0;
    }

    .subscribe_form>input::placeholder{
        font-size: 12px;
    }

    .submit_button{
        margin-right: 0;
    }

    .contact{
        margin-top: 10vh;
    }

    .contact_addres {
        font-size: 14px;
    }

    .contact_info {
        margin-top: 40px;
    }

    .contact_information {
        margin-top: 20px;
        display: block;
    }
    .contact_socials {
        width: 100%;
        margin-top: 8vh;
    }
}

    </style>

    <link rel="icon" href="http://autobus.ge/favicon.ico" type="image" sizes="16x16">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-13185057-26"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-13185057-26');
    </script>

    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date(); a = s.createElement(o),
                m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-13185057-26', 'auto');
        ga('send', 'pageview');
    </script>

    <meta property="og:title" content="https://www.facebook.com/autobus.georgia/">
    <meta property="og:description" content="Stay tuned, Our website is coming soon..">
    <meta property="og:url" content="http://autobus.ge">

</head>
<body>

<div class="main">
    <div class="left_side">
        <div class="header"></div>
        <div class="content">
            <div class="content_title">
                Stay Tuned our website is coming Soon...
                <div class="underline"></div>
            </div>
        </div>
        <div class="contact">
            <div class="contact_addres">
                <a href="#" target="_blank">139 Nutsubidze Street 0186, Tbilisi, Georgia</a>
            </div>
            <div class="contact_info">
                <div class="contact_information">
                    <a href="tel:+995322999222" target="_blank">+995 322 999 222</a>
                </div>
                <div class="contact_information">
                    <a href="tel:+995597999222" target="_blank">+995 597 999 222</a>
                </div>
            </div>
            <div class="contact_socials">
                <a href="https://www.facebook.com/autobus.georgia" target="_blank">
                    <div class="contact_social_media" id="facebook"></div>
                </a>
                <a href="https://www.instagram.com/autobus.geogia" target="_blank">
                    <div class="contact_social_media" id="instagram"></div>
                </a>
            </div>
        </div>
    </div>
    <div class="right_side" style="background-image: url('cover.jpg')">
        <div class="hidden_images">
            <img src="http://autobus.ge/facebook_hover.svg">
            <img src="http://autobus.ge/instagram_hover.svg">
        </div>
    </div>
</div>

</html>