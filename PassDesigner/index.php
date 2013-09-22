<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "In") {
    header("Location: ../login.php");
}
?>
<!DOCTYPE html>

<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta content="width=1000, maximum-scale=1.0, user-scalable=yes" name=
    "viewport">

    <title>iPassStore Online Pass Designer</title>
    <link href="favicon.ico url" rel="icon" type="image/ico">
    <link href="" rel="apple-touch-icon">
    <link href="pass_designer.css" media="screen" rel="stylesheet" type=
    "text/css">
    <script src=
    "https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type=
    "text/javascript"></script>
    <script src=
    "https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>
    <script src="pass_designer.js" type="text/javascript"></script>

    <style type="text/css">
@media(-o-transform-3d),(-moz-transform-3d),(-webkit-transform-3d),(-ms-transform-3d),(transform-3d){#back.backPass{display:inline}#pass,#back,details,.animate{-webkit-transition:-webkit-transform .7s linear;-moz-transition:-moz-transform .7s linear;-o-transition:-o-transform .7s linear;transition:transform .7s linear}.backPass{-webkit-transform:rotateY(180deg);-moz-transform:rotateY(180deg);-ms-transform:rotateY(180deg);transform:rotateY(180deg)}#back,#pass{-webkit-backface-visibility:hidden!important;-moz-backface-visibility:hidden;-o-backface-visibility:hidden;-ms-backface-visibility:hidden!important;backface-visibility:hidden!important}}
    </style>
</head>

<body class="coupon simg ht" id="index">
    <!-- Start Lightbox -->

    <div id="alertbox">
        <div id="alerticon"></div>

        <div id="alertTitle"></div>

        <div id="alert"></div>
    </div><!-- End Lightbox -->
    <!-- Pre loader  -->
    <img class="preloader" src="images/preloader.gif"> <!-- Start Wrapper -->

    <div id="page_wrapper">
        <!-- Start Header -->

        <header>
            <div class="container">
                <!-- Home Logo -->
                <a class="logo" href="https://www.iPassStore.com" title=
                "iPassStore"><!--[if !IE]>-->
                <img height="20" src=
                "https://www.iPassStore.com/resource/image/logo.png"> 
                <!--<![endif]-->
                 <!--[if lt IE 9]>
                <img src="https://www.iPassStore.com/resource/image/logo.png" height="20" />
            <![endif]--></a> <!-- End Home Logo -->

                <nav>
                    <ul>
                        <li id="logMenu">
                            <a href="" id="navLogin" title=
                            "login">Developer Login</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header><!-- Start Navigation -->

        <div class="container">
            <nav>
                <ul id='progress_bar'>
                    <li class="active" data-show="config" id="sConfig">Pass
                    Types</li>

                    <li data-show="colour" id="sColour">Colors &amp;
                    Images</li>

                    <li data-show="content" id="sFront">Front Content</li>

                    <li data-show="bcontent" id="sBack">Back Content</li>  

                </ul>
                
                <button>Save</button>
                <button>Publish</button>
            </nav>
        </div><!-- End Navigation -->
        <!-- End Header -->

        <section class="interface">
            <!-- Start Simulator -->

            <div id="simulator">
                <div id="preloader"></div><!-- iPhone Container -->

                <div id="ipc">
                    <!-- Shine Overlay -->

                    <div class="sov">
                        <!-- Buttons -->

                        <div class="lb"></div>

                        <div class="rb" data-function="login"></div>

                        <div class="titleText">
                            Coupon
                        </div><!-- Screen Container -->

                        <div class="sc">
                            <!--  Pass Container -->

                            <div id="pc">
                                <div class="pass" id="pass">
                                    <!-- Masks -->

                                    <div class="couponTop"></div>

                                    <div class="couponBottom"></div>

                                    <div class="eventTicketTop"></div>

                                    <div class="storeTop"></div>

                                    <div class="boardingTop"></div>

                                    <div class="genericTop"></div><img alt=
                                    "Background" class="eventImage" src=
                                    "images/mask/event_background.png"> 
                                    <!-- Graphics -->

                                    <div class="passLogo">
                                        <img alt="Logo" id="logoImage" src=
                                        "images/mask/logo.png"> 
                                        <!-- <img src="images/z50.gif" alt="" class="z" /> -->

                                        <p id="logoText"></p>
                                    </div>

                                    <div class="transport gen" id="transport">
                                    </div>

                                    <div class="back" style=
                                    "background-image: url('images/mask/strip.png');">
                                    </div>

                                    <div class="stripShine"></div>

                                    <div class="thumbnail">
                                        <div class="tinner"><img alt=
                                        "Thumbnail" id="thumbnail" src=
                                        "images/mask/thumbnail.png"></div>
                                    </div><span class="info"></span> 
                                    <!-- Pass Fields -->
                                     <!-- Header Row -->

                                    <div class="header" data-m="10" data-s="11"
                                    id="header">
                                        <div class="labels">
                                            <div class="label h1" id="h1L">
                                            </div>

                                            <div class="label h2" id="h2L">
                                            </div>

                                            <div class="label h3" id="h3L">
                                            </div>
                                        </div>

                                        <div class="values">
                                            <span class="foreground h1" id=
                                            "h1V"></span><span class=
                                            "foreground h2" id=
                                            "h2V"></span><span class=
                                            "foreground h3" id="h3V"></span>
                                        </div>
                                    </div>

                                    <div class="primary" data-m="0" data-s="58"
                                    id="primary">
                                        <div class="labels">
                                            <div class="label p1" id="p1L">
                                            </div>

                                            <div class="label p2" id="p2L">
                                            </div>
                                        </div>

                                        <div class="values">
                                            <span class="foreground p1" id=
                                            "p1V"></span><span class=
                                            "foreground p2" id="p2V"></span>
                                        </div>
                                    </div>

                                    <div class="secondary" data-m="14" data-s=
                                    "10" id="secondary">
                                        <div class="labels">
                                            <div class="label s1" id="s1L">
                                            </div>

                                            <div class="label s2" id="s2L">
                                            </div>

                                            <div class="label s3" id="s3L">
                                            </div>

                                            <div class="label s4" id="s4L">
                                            </div>
                                        </div>

                                        <div class="values">
                                            <span class="foreground s1" id=
                                            "s1V"></span><span class=
                                            "foreground s2" id=
                                            "s2V"></span><span class=
                                            "foreground s3" id=
                                            "s3V"></span><span class=
                                            "foreground s4" id="s4V"></span>
                                        </div>
                                    </div>

                                    <div class="auxiliary" data-m="14" data-s=
                                    "9" id="auxiliary">
                                        <div class="labels">
                                            <div class="label a1" id="a1L">
                                            </div>

                                            <div class="label a2" id="a2L">
                                            </div>

                                            <div class="label a3" id="a3L">
                                            </div>

                                            <div class="label a4" id="a4L">
                                            </div>

                                            <div class="label a5" id="a5L">
                                            </div>
                                        </div>

                                        <div class="values">
                                            <span class="foreground a1" id=
                                            "a1V"></span><span class=
                                            "foreground a2" id=
                                            "a2V"></span><span class=
                                            "foreground a3" id=
                                            "a3V"></span><span class=
                                            "foreground a4" id=
                                            "a4V"></span><span class=
                                            "foreground a5" id="a5V"></span>
                                        </div>
                                    </div><!-- Barcode -->

                                    <div class="barcodeOuter">
                                        <div class="barcodeHack">
                                            <div class="pdf417" id=
                                            "barcodeContainer">
                                                <div id="barcode"><img alt=
                                                "Barcode" src=
                                                "images/barcode.png"></div>

                                                <p id="barcodeText">
                                                iPassStore.com</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pass backPass animate" id="back">
                                    <!-- Masks -->

                                    <div class="couponTop"></div>

                                    <div class="storeTop"></div><img alt=
                                    "Background" class="eventImage" src=
                                    "images/mask/event_background.png">

                                    <p class="update label">never
                                    updated</p><button class=
                                    "done label">Done</button>

                                    <div class="backOuter">
                                        <div class="backHack">
                                            <div class="notify">
                                                <div class="backInner">
                                                    <fieldset class="toggle">
                                                        <input checked=
                                                        "checked" id="tog1"
                                                        type="checkbox">
                                                        <label for=
                                                        "tog1">Automatic
                                                        Updates</label>
                                                        <span class=
                                                        "toggle-button"></span>
                                                    </fieldset>
                                                </div>

                                                <p class="backNotice"></p>
                                            </div>

                                            <div class="lockScreen">
                                                <div class="backInner">
                                                    <fieldset class="toggle">
                                                        <input checked=
                                                        "checked" id="tog2"
                                                        type="checkbox">
                                                        <label for="tog2">Show
                                                        On Lock Screen</label>
                                                        <span class=
                                                        "toggle-button"></span>
                                                    </fieldset>
                                                </div>

                                                <p class="backNotice">Show
                                                based on time or location.</p>
                                            </div>

                                            <div class="backInner" id=
                                            "backContent">
                                                <div id="b1">
                                                    <div class="label first b1"
                                                    id="b1L"></div>

                                                    <div class="foreground b1"
                                                    id="b1V"></div>
                                                </div>

                                                <div id="b2">
                                                    <div class="label b2" id=
                                                    "b2L"></div>

                                                    <div class="foreground b2"
                                                    id="b2V"></div>
                                                </div>

                                                <div id="b3">
                                                    <div class="label b3" id=
                                                    "b3L"></div>

                                                    <div class="foreground b3"
                                                    id="b3V"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End Pass Back Face -->
                                </div><!-- End Pass Container -->
                            </div><!-- End Screen Container -->
                        </div><!-- End iPhone Container -->
                    </div><!-- Image Preloaders -->
                    <img alt="" class="preloader" src="images/info.svg">

                    <!-- End Container -->
                </div><!-- End Simulator -->
            </div><!-- Start Pass Navigation -->

            <div id="passNav">
                <ul class="pointers">
                    <li class="hEdit active"></li>

                    <li class="pEdit"></li>

                    <li class="sEdit"></li>

                    <li class="aEdit"></li>

                    <li class="bEdit"></li>
                </ul><!-- End Pass Navigation -->
            </div><!-- Start Pages -->

            <div class="wideEditor" id="editor">
                <!-- Start Home -->

                <div class="page" id="home">
                    <form id="afr" name="afr">
                        <div class="pane show" id="config">
                            <div class="face">
                                <p class="title">Choose a pass type</p>

                                <div class="passTypes">
                                    <div class="passType">
                                        <p><input checked="checked" class=
                                        "passT" id="couponType" name="pt" type=
                                        "radio" value="coupon"> <label for=
                                        "couponType">Coupon<br>
                                        <img alt="Coupon" class=
                                        "passTypeImg selected" data-pass=
                                        "coupon" height="125" src=
                                        "images/sample/coupon.png" width=
                                        "100"></label></p>
                                    </div>

                                    <div class="passType">
                                        <p><input class="passT" id=
                                        "storeCardType" name="pt" type="radio"
                                        value="storeCard"> <label for=
                                        "storeCardType">Store Card<br>
                                        <img alt="Store Card" class=
                                        "passTypeImg" data-pass="storeCard"
                                        height="125" src=
                                        "images/sample/store.png" width=
                                        "100"></label></p>
                                    </div>

                                    <div class="passType">
                                        <p><input class="passT" id="eventType"
                                        name="pt" type="radio" value=
                                        "eventTicket"> <label for=
                                        "eventType">Event Ticket<br>
                                        <img alt="Event Ticket" class=
                                        "passTypeImg" data-pass="eventTicket"
                                        height="125" src=
                                        "images/sample/ticket.png" width=
                                        "100"></label></p>
                                    </div>

                                    <div class="passType">
                                        <p><input class="passT" id=
                                        "genericType" name="pt" type="radio"
                                        value="generic"> <label for=
                                        "genericType">Generic<br>
                                        <img alt="Generic Pass" class=
                                        "passTypeImg" data-pass="generic"
                                        height="125" src=
                                        "images/sample/generic.png" width=
                                        "100"></label></p>
                                    </div>
                                </div>

                                <div class="clear"></div><br>

                                <fieldset id="ettCont">
                                    <p class="fieldLabel fieldStrip">
                                    <a data-tip=
                                    "Please select the type of Event Ticket you would like to create">
                                    Event Ticket Type</a><span class=
                                    "rqd">*</span></p>

                                    <div class="serialCont">
                                        <div class="serial" style=
                                        "position:relative;">
                                            <p><input checked="checked" class=
                                            "iStat" id="ettb" name="et" type=
                                            "radio" value="blur"><label for=
                                            "ettb">&nbsp;Blurred Background
                                            Image</label></p>
                                        </div>

                                        <div class="serial" style=
                                        "position:relative;">
                                            <p><input class="iStat" id="etts"
                                            name="et" type="radio" value=
                                            "strip"><label for=
                                            "etts">&nbsp;Strip
                                            Image</label></p>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="break"></div>
                            </div>
                        </div>

                        <div class="pane" id="content">
                            <div id="contentFront">
                                <div class="faceField show" id="hEdit">
                                    <div class="formSection">
                                        <label class="fieldLabel" for=
                                        "logoTxt">Logo Text</label><input class=
                                        "fieldFull" id="logoTxt" maxlength="30"
                                        name="lg" placeholder="Logo Text" type=
                                        "text" value="">
                                    </div>

                                    <div id="hEditFields">
                                        <div class="fieldsetHolder"
                                        data-cstatus="false" id="h1fsH">
                                            <fieldset id="h1fields" name="h1">

                                                <div class="fieldLabel">
                                                    <p><input class=
                                                    "iCheckbox factive" id=
                                                    "h1Active" name="h1" type=
                                                    "checkbox" value="1"></p>
                                                </div>

                                                <div id="h1labelF">
                                                    <div class="fieldLabel">
                                                        <p>Item Label</p>
                                                    </div>

                                                    <div class="staticDynamic">
                                                        <p><input checked=
                                                        "checked" class="iStat"
                                                        data-sid="h1L" id=
                                                        "h1StaticLs" name=
                                                        "h1DynL" type="radio"
                                                        value="0"><label for=
                                                        "h1StaticLs">&nbsp;<span class="rqd"></span></label></p>
                                                    </div>

                                                    <div class=
                                                    "staticDynamicD">
                                                        <p class="stath1l">
                                                        Value<span class=
                                                        "rqd">*</span></p>
                                                    </div>

                                                    <div class=
                                                    "staticDynamicI">
                                                        <input class=
                                                        "iLabel stath1l"
                                                        data-op="h1Labeld"
                                                        data-sid="h1L" id=
                                                        "h1Labels" name="h1l"
                                                        type="text" value="">
                                                    </div>

                                                    <div class="fieldLabel">
                                                        &nbsp;
                                                    </div>

                                                    <div class="fieldBreak">
                                                    </div>
                                                </div>

                                                <div class="fieldLabel">
                                                    <p>Item Data</p>
                                                </div>

                                                <div class="staticDynamic">
                                                    <p><input checked="checked"
                                                    class="iStat" data-sid=
                                                    "h1V" id="h1StaticDs" name=
                                                    "h1DynD" type="radio"
                                                    value="1"><label for=
                                                    "h1StaticDs">&nbsp;<span class="rqd"></span></label></p>
                                                </div>

                                                <div class="staticDynamicD">
                                                    <p class="stath1v">
                                                    Value<span class=
                                                    "rqd">*</span></p>
                                                </div>

                                                <div class="staticDynamicI">
                                                    <input class=
                                                    "iValue stath1v" data-op=
                                                    "h1Datad" data-ov=""
                                                    data-sid="h1V" id="h1Datas"
                                                    name="h1v" type="text"
                                                    value=""><span class=
                                                    "remove iVr"><a class=
                                                    "removeDate" data-tip=
                                                    "Clear date and time">X</a></span>
                                                </div>

                                                <div class="fieldLabel">
                                                    &nbsp;
                                                </div>                                              

                                               

                                                <details>
                                                    <summary>
                                                        Formatting
                                                    </summary>

                                                    <div>
                                                        <div class="inline">
                                                            <p>Data Type</p>

                                                            <div class=
                                                            "styled-select">
                                                                <select class=
                                                                "sType"
                                                                data-sid="h1V"
                                                                id="h1Type"
                                                                name="h1t">
                                                                    <option selected="selected"
                                                                    value=
                                                                    "text">
                                                                        Text
                                                                    </option>
                            
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </details>
                                            </fieldset>
                                        </div>                              
                                    </div>
                                </div>

                                <div class="faceField" id="pEdit">

                                    <div id="pEditFields">
                                        <div class="fieldsetHolder"
                                        data-cstatus="false" id="p1fsH">
                                            <fieldset id="p1fields" name="p1">
                                            
                                                <div class="fieldLabel">
                                                    <p><input class=
                                                    "iCheckbox factive" id=
                                                    "p1Active" name="p1" type=
                                                    "checkbox" value="1">
                                                    </p>
                                                </div>
                                                
                                                <div id="p1labelF">
                                                    <div class="fieldLabel">
                                                        <p>
                                                        Item Label</p>
                                                    </div>

                                                    <div class="staticDynamic">
                                                        <p><input checked=
                                                        "checked" class="iStat"
                                                        data-sid="p1L" id=
                                                        "p1StaticLs" name=
                                                        "p1DynL" type="radio"
                                                        value="0"><label for=
                                                        "p1StaticLs">&nbsp;<span class="rqd"></span></label></p>
                                                    </div>

                                                    <div class=
                                                    "staticDynamicD">
                                                        <p class="statp1l">
                                                        Value<span class=
                                                        "rqd">*</span></p>
                                                    </div>

                                                    <div class=
                                                    "staticDynamicI">
                                                        <input class=
                                                        "iLabel statp1l"
                                                        data-op="p1Labeld"
                                                        data-sid="p1L" id=
                                                        "p1Labels" name="p1l"
                                                        type="text" value="">
                                                    </div>

                                                    <div class="fieldLabel">
                                                        &nbsp;
                                                    </div>


                                                    <div class="fieldBreak">
                                                    </div>
                                                </div>

                                                <div class="fieldLabel">
                                                    <p>Item Data</p>
                                                </div>

                                                <div class="staticDynamic">
                                                    <p><input class="iStat"
                                                    data-sid="p1V" id=
                                                    "p1StaticDs" name="p1DynD"
                                                    type="radio" value=
                                                    "1"><label for=
                                                    "p1StaticDs">&nbsp;<span class="rqd"></span></label></p>
                                                </div>

                                                <div class="staticDynamicD">
                                                    <p class=
                                                    "statp1v">
                                                    Value<span class=
                                                    "rqd">*</span></p>
                                                </div>

                                                <div class="staticDynamicI">
                                                    <input class=
                                                    "iValue statp1v"
                                                    data-op="p1Datad" data-ov=
                                                    "" data-sid="p1V" id="p1Datas"
                                                    name="p1v" type="text"
                                                    value=""><span class=
                                                    "remove iVr"><a class=
                                                    "removeDate" data-tip=
                                                    "Clear date and time">X</a></span>
                                                </div>      

                                                <details>
                                                    <summary>
                                                        Formatting
                                                    </summary>

                                                    <div>

                                                        <div class="inline">
                                                            <p>Data Type</p>

                                                            <div class=
                                                            "styled-select">
                                                                <select class=
                                                                "sType"
                                                                data-sid="p1V"
                                                                id="p1Type"
                                                                name="p1t">
                                                                    <option selected="selected"
                                                                    value=
                                                                    "text">
                                                                        Text
                                                                    </option>                                                      
                                                                </select>
                                                            </div>
                                                        </div>
                                          
                                                    </div>
                                                </details>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                <div class="faceField" id="aEdit">
                                    <div id="aEditFields">
                                        <div class="fieldsetHolder"
                                        data-cstatus="false" id="a1fsH">
                                            <fieldset id="a1fields" name="a1">

                                                <div class="fieldLabel">
                                                    <p><input class=
                                                    "iCheckbox factive" id=
                                                    "a1Active" name="a1" type=
                                                    "checkbox" value="1">
                                                    </p>
                                                </div>
                                                
                                                <div id="a1labelF">
                                                    <div class="fieldLabel">
                                                        <p>Item Label</p>
                                                    </div>

                                                    <div class="staticDynamic">
                                                        <p><input checked=
                                                        "checked" class="iStat"
                                                        data-sid="a1L" id=
                                                        "a1StaticLs" name=
                                                        "a1DynL" type="radio"
                                                        value="0"><label for=
                                                        "a1StaticLs">&nbsp;<span class="rqd"></span></label></p>
                                                    </div>

                                                    <div class=
                                                    "staticDynamicD">
                                                        <p class="stata1l">
                                                        Value<span class=
                                                        "rqd">*</span></p>
                                                    </div>

                                                    <div class=
                                                    "staticDynamicI">
                                                        <input class=
                                                        "iLabel stata1l"
                                                        data-op="a1Labeld"
                                                        data-sid="a1L" id=
                                                        "a1Labels" name="a1l"
                                                        type="text" value="">
                                                    </div>

                                                    <div class="fieldBreak">
                                                    </div>
                                                </div>

                                                <div class="fieldLabel">
                                                    <p>Item Data</p>
                                                </div>

                                                <div class="staticDynamic">
                                                    <p><input class="iStat"
                                                    data-sid="a1V" id=
                                                    "a1StaticDs" name="a1DynD"
                                                    type="radio" value=
                                                    "1"><label for=
                                                    "a1StaticDs">&nbsp;<span class="rqd"></span></label></p>
                                                </div>

                                                <div class="staticDynamicD">
                                                    <p class=
                                                    "stata1v">
                                                    Value<span class=
                                                    "rqd">*</span></p>
                                                </div>

                                                <div class="staticDynamicI">
                                                    <input class=
                                                    "iValue stata1v"
                                                    data-op="a1Datad" data-ov=
                                                    "" data-sid="a1V" id="a1Datas"
                                                    name="a1v" type="text"
                                                    value=""><span class=
                                                    "remove iVr"><a class=
                                                    "removeDate" data-tip=
                                                    "Clear date and time">X</a></span>
                                                </div>


                                                <details>
                                                    <summary>
                                                        Formatting
                                                    </summary>

                                                    <div>
                                                        <div class="inline" id=
                                                        "a1A">
                                                            <p><a data-tip=
                                                            "">Text
                                                            Alignment</a></p>

                                                            <div class=
                                                            "styled-select">
                                                                <select class=
                                                                "sAlign" id=
                                                                "a1Align" name=
                                                                "a1a">
                                                                    <option selected="selected"
                                                                    value=
                                                                    "left">
                                                                        Left
                                                                    </option>
																</select>
                                                            </div>
                                                        </div>

                                                        <div class="inline">
                                                            <p>Data Type</p>

                                                            <div class=
                                                            "styled-select">
                                                                <select class=
                                                                "sType"
                                                                data-sid="a1V"
                                                                id="a1Type"
                                                                name="a1t">
                                                                    <option selected="selected"
                                                                    value=
                                                                    "text">
                                                                        Text
                                                                    </option>    
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </details>
                                            </fieldset>
                                        </div>                      
                                    </div>
                                </div>

                                <div class="faceField" id="sEdit">
                                    <div id="sEditFields">
                                        <div class="fieldsetHolder"
                                        data-cstatus="false" id="s1fsH">
                                            <fieldset id="s1fields" name="s1">

                                                <div class="fieldLabel">
                                                    <p><input class=
                                                    "iCheckbox factive" id=
                                                    "s1Active" name="s1" type=
                                                    "checkbox" value="1">
                                                    </p>
                                                </div>

                                                <div id="s1labelF">
                                                    <div class="fieldLabel">
                                                        <p>Item Label</p>
                                                    </div>

                                                    <div class="staticDynamic">
                                                        <p><input checked=
                                                        "checked" class="iStat"
                                                        data-sid="s1L" id=
                                                        "s1StaticLs" name=
                                                        "s1DynL" type="radio"
                                                        value="0"><label for=
                                                        "s1StaticLs">&nbsp;<span class="rqd"></span></label></p>
                                                    </div>

                                                    <div class=
                                                    "staticDynamicD">
                                                        <p class="stats1l">
                                                        Value<span class=
                                                        "rqd">*</span></p>
                                                    </div>

                                                    <div class=
                                                    "staticDynamicI">
                                                        <input class=
                                                        "iLabel stats1l"
                                                        data-op="s1Labeld"
                                                        data-sid="s1L" id=
                                                        "s1Labels" name="s1l"
                                                        type="text" value="">
                                                    </div>

                                                    <div class="fieldBreak">
                                                    </div>
                                                </div>

                                                <div class="fieldLabel">
                                                    <p>Item Data</p>
                                                </div>

                                                <div class="staticDynamic">
                                                    <p><input class="iStat"
                                                    data-sid="s1V" id=
                                                    "s1StaticDs" name="s1DynD"
                                                    type="radio" value=
                                                    "1"><label for=
                                                    "s1StaticDs">&nbsp;<span class="rqd"></span></label></p>
                                                </div>

                                                <div class="staticDynamicD">
                                                    <p class=
                                                    "stats1v">
                                                    Value<span class=
                                                    "rqd">*</span></p>
                                                </div>

                                                <div class="staticDynamicI">
                                                    <input class=
                                                    "iValue stats1v"
                                                    data-op="s1Datad" data-ov=
                                                    "" data-sid="s1V" id="s1Datas"
                                                    name="s1v" type="text"
                                                    value=""><span class=
                                                    "remove iVr"><a class=
                                                    "removeDate" data-tip=
                                                    "Clear date and time">X</a></span>
                                                </div>

                                                <details>
                                                    <summary>
                                                        Formatting
                                                    </summary>

                                                    <div>
                                                        <div class="inline" id=
                                                        "s1A">
                                                            <p><a data-tip=
                                                            "">Text
                                                            Alignment</a></p>

                                                            <div class=
                                                            "styled-select">
                                                                <select class=
                                                                "sAlign" id=
                                                                "s1Align" name=
                                                                "s1a">
                                                                    <option selected="selected"
                                                                    value=
                                                                    "left">
                                                                        Left
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="inline">
                                                            <p>Data Type</p>

                                                            <div class=
                                                            "styled-select">
                                                                <select class=
                                                                "sType"
                                                                data-sid="s1V"
                                                                id="s1Type"
                                                                name="s1t">
                                                                    <option selected="selected"
                                                                    value=
                                                                    "text">
                                                                        Text
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>                                                    
                                                    </div>
                                                </details>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="contentBarcode">
                                <div class="faceField" id="bEdit">

                                    <fieldset>
                                        <div class="inline">
                                            <p>Barcode Type</p>

                                            <div class="styled-select">
                                                <select id="barcodeType" name=
                                                "bct">

                                                    <option selected="selected"
                                                    value="pdf417">
                                                        PDF417 Code
                                                    </option>

                                                    <option value="none">
                                                        Do not display a
                                                        barcode
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="inline">
                                            <p>Encoded Message</p>

                                            <div class="styled-select">
                                                <select id="barcodeAction"
                                                name="bca">
                                                    <option value="serial">
                                                        Encode the pass serial
                                                        number
                                                    </option>

                                                    <option value="pid">
                                                        Encode the pass unique
                                                        ID
                                                    </option>

                                                    <option value="custom">
                                                        Encode the same message
                                                        on all passes
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="inline" id="fixedBarcode">
                                            <p><a data-tip=
                                            "This text will be encoded into the barcode, if you want the barcode to link to a webpage, enter a URL starting with http:// or https:// &lt;br /&gt;">
                                            Text to Encode</a></p>
                                            <textarea class="fieldFull" id=
                                            "barcodeMessage" maxlength="600"
                                            name="bcm" placeholder=
                                            "Enter the text to encode.">
                                            </textarea>
                                        </div>

                                        <div class="inline">
                                            <p><a data-tip=
                                            "Select what text to display under the barcode.">
                                            Alternative Text</a></p>

                                            <div class="styled-select">
                                                <select id="barcodeAltText"
                                                name="bcx">
                                                    <option value="mirror">
                                                        Display the barcode
                                                        contents
                                                    </option>

                                                    <option value="pid">
                                                        Display the pass unique
                                                        ID
                                                    </option>

                                                    <option value="custom">
                                                        Display the same
                                                        message on all passes
                                                    </option>

                                                    <option value="none">
                                                        Do not display any
                                                        alternate text
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="inline" id=
                                        "fixedBarcodeAlt">
                                            <p><a data-tip=
                                            "This field may also be used to provide additional information to the passholder such as 'Admits one only'">
                                            Text to
                                            Display</a></p><input class="fieldFull"
                                            id="barcodeAlt" maxlength="50"
                                            name="bcxm" placeholder=
                                            "Enter the text to display."
                                            type="text">
                                        </div>

                                        <details>
                                            <summary>
                                                Advanced Options
                                            </summary>

                                            <div class="inline">
                                                <p><a data-tip=
                                                "Only required if your encoded message is not compatible with&lt;BR /&gt;ISO_8859-1. Ensure scanner or software support before changing">
                                                Encoding Format</a></p>

                                                <div class="styled-select">
                                                    <select class="encoding"
                                                    id="encoding" name="bce">
                                                        <option selected=
                                                        "selected" value=
                                                        "UTF-8">
                                                            UTF-8
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </details>
                                    </fieldset>
                                </div>
                            </div>
                        </div>

                        <div class="pane" id="bcontent">
                            <div class="faceField" id="backFields">

                                <div id="backField">

                                    <div class="fieldsetHolder" data-cstatus=
                                    "false" id="b1fsH">
                                        <fieldset id="b1fields" name="b1">

                                            <div class="fieldLabel">
                                                <p><input class="iCheckbox" id=
                                                "b1Active" name="b1" type=
                                                "checkbox" value="1">
                                                </p>
                                            </div>

                                            <div id="b1labelF">
                                                <div class="fieldLabel">
                                                    <p>Item Label</p>
                                                </div>

                                                <div class="staticDynamic">
                                                    <p><input checked="checked"
                                                    class="iStat" data-sid=
                                                    "b1L" id="b1StaticLs" name=
                                                    "b1DynL" type="radio"
                                                    value="0"><label for=
                                                    "b1StaticLs">&nbsp;<span class="rqd"></span></label></p>
                                                </div>

                                                <div class="staticDynamicD">
                                                    <p class="statb1l">
                                                    Value<span class=
                                                    "rqd">*</span></p>
                                                </div>

                                                <div class="staticDynamicI">
                                                    <input class=
                                                    "iLabel statb1l" data-op=
                                                    "b1Labeld" data-sid="b1L"
                                                    id="b1Labels" name="b1l"
                                                    placeholder="Required"
                                                    type="text" value="">
                                                </div>

                                                <div class="fieldBreak"></div>
                                            </div>

                                            <div class="fieldLabel">
                                                <p>Item Data</p>
                                            </div>

                                            <div class="staticDynamic">
                                                <p><input class="iStat"
                                                data-sid="b1V" id="b1StaticDs"
                                                name="b1DynD" type="radio"
                                                value="1"><label for=
                                                "b1StaticDs">&nbsp;<span class="rqd"></span></label></p>
                                            </div>

                                            <div class="staticDynamicD">
                                                <p class="statb1v">
                                                Value<span class=
                                                "rqd">*</span></p>
                                            </div>

                                            <div class="staticDynamicI">
                                                <textarea class=
                                                "iValue statb1v"
                                                data-op="b1Datad" data-ov=""
                                                data-sid="b1V" id="b1Datas" name=
                                                "b1v">
</textarea><span class="remove iVr"><a class="removeDate"
                                                data-tip=
                                                "Clear date and time">X</a></span>
                                            </div>

                                            <div class="fieldLabel">
                                                &nbsp;
                                            </div>

                                            <details>
                                                <summary>
                                                    Formatting
                                                </summary>

                                                <div>
                                                    <div class="inline">
                                                        <p>Data Type</p>

                                                        <div class=
                                                        "styled-select">
                                                            <select class=
                                                            "sType" data-sid=
                                                            "b1V" id="b1Type"
                                                            name="b1t">
                                                                <option selected="selected"
                                                                value="text">
                                                                    Text
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>  
                                                </div>
                                            </details>
                                        </fieldset>
                                    </div>

                                    <div class="fieldsetHolder" data-cstatus=
                                    "false" id="b2fsH">
                                        <fieldset id="b2fields" name="b2">

                                            <div class="fieldLabel">
                                                <p><input class="iCheckbox" id=
                                                "b2Active" name="b2" type=
                                                "checkbox" value="1">
                                                </p>
                                            </div>

                                            <div id="b2labelF">
                                                <div class="fieldLabel">
                                                    <p>Item Label</p>
                                                </div>

                                                <div class="staticDynamic">
                                                    <p><input checked="checked"
                                                    class="iStat" data-sid=
                                                    "b2L" id="b2StaticLs" name=
                                                    "b2DynL" type="radio"
                                                    value="0"><label for=
                                                    "b2StaticLs">&nbsp;<span class="rqd"></span></label></p>
                                                </div>

                                                <div class="staticDynamicD">
                                                    <p class="statb2l">
                                                    Value<span class=
                                                    "rqd">*</span></p>
                                                </div>

                                                <div class="staticDynamicI">
                                                    <input class=
                                                    "iLabel statb2l" data-op=
                                                    "b2Labeld" data-sid="b2L"
                                                    id="b2Labels" name="b2l"
                                                    placeholder="Required"
                                                    type="text" value="">
                                                </div>

                                                <div class="fieldBreak"></div>
                                            </div>

                                            <div class="fieldLabel">
                                                <p>Item Data</p>
                                            </div>

                                            <div class="staticDynamic">
                                                <p><input class="iStat"
                                                data-sid="b2V" id="b2StaticDs"
                                                name="b2DynD" type="radio"
                                                value="1"><label for=
                                                "b2StaticDs">&nbsp;<span class="rqd"></span></label></p>
                                            </div>

                                            <div class="staticDynamicD">
                                                <p class="statb2v">
                                                Value<span class=
                                                "rqd">*</span></p>
                                            </div>

                                            <div class="staticDynamicI">
                                                <textarea class=
                                                "iValue statb2v"
                                                data-op="b2Datad" data-ov=""
                                                data-sid="b2V" id="b2Datas" name=
                                                "b2v">
</textarea><span class="remove iVr"><a class="removeDate"
                                                data-tip=
                                                "Clear date and time">X</a></span>
                                            </div>

                                            <div class="fieldLabel">
                                                &nbsp;
                                            </div>

                                            <details>
                                                <summary>
                                                    Formatting
                                                </summary>

                                                <div>
                                                    <div class="inline">
                                                        <p>Data Type</p>

                                                        <div class=
                                                        "styled-select">
                                                            <select class=
                                                            "sType" data-sid=
                                                            "b2V" id="b2Type"
                                                            name="b2t">
                                                                <option selected="selected"
                                                                value="text">
                                                                    Text
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>  
                                                </div>
                                            </details>
                                        </fieldset>
                                    </div>

                                    <div class="fieldsetHolder" data-cstatus=
                                    "false" id="b3fsH">
                                        <fieldset id="b3fields" name="b3">

                                            <div class="fieldLabel">
                                                <p><input class="iCheckbox" id=
                                                "b3Active" name="b3" type=
                                                "checkbox" value="1">
                                                </p>
                                            </div>

                                            <div id="b3labelF">
                                                <div class="fieldLabel">
                                                    <p>Item Label</p>
                                                </div>

                                                <div class="staticDynamic">
                                                    <p><input checked="checked"
                                                    class="iStat" data-sid=
                                                    "b3L" id="b3StaticLs" name=
                                                    "b3DynL" type="radio"
                                                    value="0"><label for=
                                                    "b3StaticLs">&nbsp;<span class="rqd"></span></label></p>
                                                </div>

                                                <div class="staticDynamicD">
                                                    <p class="statb3l">
                                                    Value<span class=
                                                    "rqd">*</span></p>
                                                </div>

                                                <div class="staticDynamicI">
                                                    <input class=
                                                    "iLabel statb3l" data-op=
                                                    "b3Labeld" data-sid="b3L"
                                                    id="b3Labels" name="b3l"
                                                    placeholder="Required"
                                                    type="text" value="">
                                                </div>

                                                <div class="fieldBreak"></div>
                                            </div>

                                            <div class="fieldLabel">
                                                <p>Item Data</p>
                                            </div>

                                            <div class="staticDynamic">
                                                <p><input class="iStat"
                                                data-sid="b3V" id="b3StaticDs"
                                                name="b3DynD" type="radio"
                                                value="1"><label for=
                                                "b3StaticDs">&nbsp;<span class="rqd"></span></label></p>
                                            </div>

                                            <div class="staticDynamicD">
                                                <p class="statb3v">
                                                Value<span class=
                                                "rqd">*</span></p>
                                            </div>

                                            <div class="staticDynamicI">
                                                <textarea class=
                                                "iValue statb3v"
                                                data-op="b3Datad" data-ov=""
                                                data-sid="b3V" id="b3Datas" name=
                                                "b3v">
</textarea><span class="remove iVr"><a class="removeDate"
                                                data-tip=
                                                "Clear date and time">X</a></span>
                                            </div>

                                            <div class="fieldLabel">
                                                &nbsp;
                                            </div>

                                            <details>
                                                <summary>
                                                    Formatting
                                                </summary>

                                                <div>
                                                    <div class="inline">
                                                        <p>Data Type</p>

                                                        <div class=
                                                        "styled-select">
                                                            <select class=
                                                            "sType" data-sid=
                                                            "b3V" id="b3Type"
                                                            name="b3t">
                                                                <option selected="selected"
                                                                value="text">
                                                                    Text
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>  
                                                </div>
                                            </details>
                                        </fieldset>
                                    </div>

                                </div>
                                
                                <p>You can add as many fields as you want later.</p>

                                <div class="clear"></div>
                            </div>
                        </div>

                        <div class="pane" id="colour">
                            <div id="colours">

                                <div class="colourBlock">
                                    <div class="inline clrs">
                                        <p><a data-tip=
                                        "Select a background color, or enter a hex color value. Passbook automatically appies a gradient.">
                                        Background Color</a><span class=
                                        "rqd">*</span></p><input class=
                                        "cpk {onImmediateChange:'bg_colour_change(this);'} fieldFull"
                                        id="bg" maxlength="6" name="bg"
                                        placeholder="Hex colour value" size="6"
                                        type="text" value="F6F6F6">
                                    </div>

                                    <div class="colourBlock">
                                        <div class="inline clrs">
                                            <p><a data-tip=
                                            "Select a color or enter a hex value for field labels.">
                                            Label Text Color</a><span class=
                                            "rqd">*</span></p><input class=
                                            "cpk {onImmediateChange:'lb_colour_change(this);'} fieldFull"
                                            id="lb" maxlength="6" name="lb"
                                            placeholder="Hex colour value"
                                            size="6" type="text" value=
                                            "6D6E71">
                                        </div>

                                        <div class="inline clrs">
                                            <p><a data-tip=
                                            "Select a color or enter a hex value for data values.">
                                            Value Text Color</a><span class=
                                            "rqd">*</span></p><input class=
                                            "cpk {onImmediateChange:'fg_colour_change(this);'} fieldFull"
                                            id="fg" maxlength="6" name="fg"
                                            placeholder="Hex colour value"
                                            size="6" type="text" value=
                                            "00BF8F">
                                        </div>
                                    </div>
                                </div>

                                <div class="break"></div>

                                <div class="inline">
                                    <p class="title">Icon Image</p>

                                    <div class="dragdrop">
										<img src="imageBucket/3AbpE50S1V5E0EVoRcoH3Ei.png" width="60" height="70">
                                        <p>116 × 116 square png image (Icon image will be used as the icon when user receives push notification)</p>
                                    </div>
                                </div>

                                <div class="break"></div>

                                <div class="inline">
                                    <p class="title">Logo Image</p>

                                    <div class="dragdrop">
										<img src="images/mask/icon.png" width="60" height="70">

                                        <p>80 × 80 square png image (Logo image will be placed at the upper left corner of the Pass)</p>
                                    </div>
                                </div>

                                <div class="stripImg">
                                    <div class="break"></div>

                                    <div class="inline">
                                        <p class="title">Strip Image</p>

                                        <div class="dragdrop">
                                            <img src="images/mask/strip.png" width="312" height="123">

                                            <p class="stcsc">624 × 246 png format for Coupon and Store Card templates. 624 × 168 png format for Event Ticket Strip template.</p>

                                        </div>
                                    </div>
                                </div>

                                <div class="backgroundImg">
                                    <div class="break"></div>

                                    <div class="inline">
                                        <p class="title">Background Image</p>

                                        <div class="dragdrop">
											<img src="images/mask/event_background.png" width="135" height="170">

                                            <p class="bget">Background Image
                                            for event tickets should be 360 x 440. Passbook will apply blur effect to the image automatically.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="thumbnailImg">
                                    <div class="break"></div>

                                    <div class="inline">
                                        <p class="title">Thumbnail Image</p>

                                        <div class="dragdrop">
											<img src="images/mask/thumbnail.png" width="67" height="85">
                                            <p>Thumbnail images should be 110px by 140px.</p>
                                        </div>
                                    </div>
                                </div>

                                
                                <input id="il" name="il" type="hidden"
                                value="5vCyfESECbNMX9rNk5ToXE"><input id="it"
                                name="it" type="hidden" value=
                                "1t3DuFYq0FVjmSDdc83fGq"><input id="ib" name=
                                "ib" type="hidden" value=
                                "1jJzJtZh9zIoSgCdVTi83m"><input id="is" name=
                                "is" type="hidden" value=
                                "1e4VXgUd6Lmp1ZnY63knGM"><input id="if" name=
                                "if" type="hidden" value=
                                "7c2OttrZjK8Sq5ijLZW3nF"><input id="ii" name=
                                "ii" type="hidden" value=
                                "3AbpE50S1V5E0EVoRcoH3E">
                            </div>
                        </div>

                <!-- End Home -->
                
                <div class="bottom_shadow"></div>
            </div><!-- End Pages -->

            <div class="clear"></div>
        </section>
        
        <!-- Start Footer -->

		<footer>
			<div class="gf-sosumi">
				<p>Copyright © 2013 iPassStore.com. All rights reserved.</p>
			</div>										
		</footer>
        
    </div><!-- End Wrapper -->

    
    <script>
$(window).load(function() {init();});
    </script>
     
</body>
</html>
