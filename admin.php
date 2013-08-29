<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "In") {
    header("Location: login.php");
}
require_once (dirname(__file__) . "/../lib/class/DataInterface.php");
require_once (dirname(__file__) . "/../lib/class/JsonInterface.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="src/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="src/bootstrap/css/bootstrap-fileupload.min.css"/>
    <script type="text/javascript" src="src/scripts/jquery.min.js"></script>
    <script type="text/javascript" src="src/bootstrap/js/bootstrap-fileupload.min.js"></script>
    <script type="text/javascript" src="src/scripts/admin_panel.js"></script>
    <!-- include BlockUI -->
    <script src="src/scripts/jquery.blockUI.js"></script>
    <link rel="stylesheet" href="src/style/push_panel.css"/>
</head>
<body>

<div class="wrapper">
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <div class="container">

                <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <!-- Be sure to leave the brand out there if you want it shown -->
                <ul class="nav">
                    <li class="active"><a class="brand" href="index.html">iPassStore</a></li>
                </ul>
                <ul class="nav">
                    <li><a href="./PassDesigner/index.php">PassDesigner</a></li>
                </ul>
                <ul class="pull-right">
                    <form action="lib/ws/login.php" class="navbar-form" method="post">
                        <input name="action" value="Logout" type="submit" class="btn btn-primary"/>
                    </form>
                </ul>
                <ul class="pull-right nav">
                    <li class="active"><a>Beta</a></li>
                </ul>
                <!-- Everything you want hidden at 940px or less, place within here -->
                <div class="nav-collapse collapse">
                    <!-- .nav, .navbar-search, .navbar-form, etc -->
                </div>

            </div>
        </div>
    </div>
    <?php
    //TODO: add reset password panel
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        echo "<h4 class=\"warning-message\">$message</h4>";
    }
    ?>
    <form id="main-form" action="/lib/ws/save.php" method="post">
        <div id="select-card-wrapper">
            <div id="select-card">
                <label class="lengend-label">My cards:</label>
                <?php
                $options = DataInterface::getCardNamesAndIdByUsername($_SESSION['username']);
                $cardType = "storeCard";
                $cardDistributionType = "universal";
                if ($options == null) {
                    print "<p style=\"text-align:center;\"><strong class=\"warning-message\">No cards created yet!</strong></p>";
                } else {
                    $defaultCardId = -1;
                    if (isset($_REQUEST['cardId']) && $_REQUEST['cardId'] != "" && in_array($_REQUEST['cardId'], $options))
                        $defaultCardId = $_REQUEST['cardId'];
                    print "<select id='selectCardId' name='cardId' onChange=\"loadCardContent(this)\">";
                    foreach ($options as $cardName => $cardId) {
                        if ($defaultCardId == -1) {
                            $defaultCardId = $cardId;
                        }
                        if ($cardId == $defaultCardId)
                            print "<option value='$cardId' selected>$cardName</option>";
                        else
                            print "<option value='$cardId'>$cardName</option>";
                    }
                    print "</select>";
                    $cardType = DataInterface::getCardType($defaultCardId);
                    $cardDistributionType = DataInterface::getCardDistributionType($defaultCardId);
                    $jsonObject = new JsonInterface();
                    $jsonContent = $jsonObject->getJsonArray($defaultCardId);

                }
                $startIndex = 0;
                if ($cardDistributionType == "unique") {
                    $startIndex = 1;
                }
                ?>
            </div>
        </div>
        <div class="absolute-wrapper-outer">
            <?php echo "<p style=\"display:none\">$cardType </p>";?>
            <div id="storecard-front-lengend-wrapper" class="absolute-wrapper-inner">
                <div id="logo-wrapper">
                    <label class="lengend-label" for="">Logo</label>
                    <!--                    <input type="file" name="pic_logo" disabled />-->
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <span class="btn btn-file disabled">
                            <span class="fileupload-new">Select file</span>
                            <span class="fileupload-exists">Change</span>
                            <input type="file" disabled/></span>
                        <span class="fileupload-preview"></span>
                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                    </div>
                </div>
                <div id="logoText-wrapper">
                    <label class="lengend-label" for="">Logo Text</label>
                    <?php
                    $logoText = $jsonContent["logoText"];
                    print " <input class=\"content-input\" type=\"text\" name=\"json_logoText\" value=\"$logoText\"/>";
                    ?>
                </div>
                <div id="headerFields_label-wrapper">
                    <label class="lengend-label" for="">Title Label</label>
                    <?php
                    $headerFields_label = $jsonContent["$cardType"]["headerFields"][0]["label"];
                    print " <input class=\"content-input\" type=\"text\" name=\"json_" . $cardType . "_headerFields_0_label\" value=\"$headerFields_label\"/>";
                    ?>
                </div>
                <div id="headerFields_value-wrapper">
                    <label class="lengend-label" for="">Title Content</label>
                    <?php
                    $headerFields_value = $jsonContent["$cardType"]["headerFields"][0]["value"];
                    print " <input class=\"content-input\" type=\"text\" name=\"json_" . $cardType . "_headerFields_0_value\" value=\"$headerFields_value\"/>";
                    ?>
                </div>
                <div id="strip-wrapper">
                    <label class="lengend-label" for="">Main Picture</label>

                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <span class="btn btn-file disabled">
                            <span class="fileupload-new">Select file</span>
                            <span class="fileupload-exists">Change</span>
                            <input type="file" disabled/></span>
                        <span class="fileupload-preview"></span>
                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                    </div>
                </div>
                <div id="auxiliaryField0_label-wrapper">
                    <label class="lengend-label" for="">Section 1 Label</label>
                    <?php
                    $auxiliaryFields_0_label = $jsonContent["$cardType"]["auxiliaryFields"][$startIndex]["label"];
                    print " <input class=\"content-input\" type=\"text\" name=\"json_" . $cardType . "_auxiliaryFields_" . $startIndex . "_label\" value=\"$auxiliaryFields_0_label\"/>";
                    ?>
                </div>
                <div id="auxiliaryField0_value-wrapper">
                    <label class="lengend-label" for="">Section 1 Content</label>
                    <?php
                    $auxiliaryFields_0_value = $jsonContent["$cardType"]["auxiliaryFields"][$startIndex]["value"];
                    print " <input class=\"content-input\" type=\"text\" name=\"json_" . $cardType . "_auxiliaryFields_" . $startIndex . "_value\" value=\"$auxiliaryFields_0_value\"/>";
                    ?>
                </div>
                <div id="auxiliaryField1_label-wrapper">
                    <label class="lengend-label" for="">Section 2 Label</label>
                    <?php
                    $auxiliaryFields_1_label = $jsonContent["$cardType"]["auxiliaryFields"][$startIndex + 1]["label"];
                    print " <input class=\"content-input\" type=\"text\" name=\"json_" . $cardType . "_auxiliaryFields_" . ($startIndex + 1) . "_label\" value=\"$auxiliaryFields_1_label\"/>";
                    ?>
                </div>
                <div id="auxiliaryField1_value-wrapper">
                    <label class="lengend-label" for="">Section 2 Content</label>
                    <?php
                    $auxiliaryFields_1_value = $jsonContent["$cardType"]["auxiliaryFields"][$startIndex + 1]["value"];
                    print " <input class=\"content-input\" type=\"text\" name=\"json_" . $cardType . "_auxiliaryFields_" . ($startIndex + 1) . "_value\" value=\"$auxiliaryFields_1_value\"/>";
                    ?>
                </div>
                <div id="barcode_message-wrapper">
                    <label class="lengend-label" for="">Barcode Content</label>
                    <?php
                    $barcode_message = $jsonContent["barcode"]["message"];
                    print " <input class=\"content-input\" type=\"text\" name=\"json_barcode_message\" value=\"$barcode_message\"/>";
                    ?>
                </div>
                <div id="barcode_format-wrapper">
                    <label class="lengend-label" for="">Barcode format</label>
                    <select id="barcode-select" name="json_barcode_format" onChange="save(this.value)">
                        <?php
                        $tmpVar = $jsonContent["barcode"]["format"];

                        $barcode_format_map = array("PKBarcodeFormatQR" => "",
                            "PKBarcodeFormatPDF417" => "",
                            "PKBarcodeFormatAztec" => "",
                            "None" => "");
                        if (array_key_exists($tmpVar, $barcode_format_map)) {
                            $barcode_format_map[$tmpVar] = "selected";
                        } else {
                            $barcode_format_map["None"] = "selected";
                        }
                        $qr = $barcode_format_map["PKBarcodeFormatQR"];
                        print "<option value=\"PKBarcodeFormatQR\" $qr>QR</option>";
                        $PDF417 = $barcode_format_map["PKBarcodeFormatPDF417"];
                        print "<option value=\"PKBarcodeFormatPDF417\" $PDF417>PDF417</option>";
                        $Aztec = $barcode_format_map["PKBarcodeFormatAztec"];
                        print "<option value=\"PKBarcodeFormatAztec\" $Aztec>Aztec</option>";
                        $None = $barcode_format_map["None"];
                        print "<option value=\"None\" $None>None</option>";
                        ?>
                    </select>
                </div>
                <div id="barcode_altText-wrapper">
                    <label class="lengend-label" for="">Info</label>
                    <?php
                    $barcode_altText = $jsonContent["barcode"]["altText"];
                    print " <input class=\"content-input\" type=\"text\" name=\"json_barcode_altText\" value=\"$barcode_altText\"/>";
                    ?>
                </div>
                <img class="lengend-sample-picture" src="resource/image/storecard-front-lengend.png" alt=""
                     style="width:800px;"/>

                <div id="SampleLabel"><label>Sample</label></div>
            </div>
        </div>
        <div id="operation-panel" class="panel">
            <input type="submit" value="Save" class="btn btn-primary"/>
            <input type="button" value="Discard Change" class="btn btn-warning" onClick="discardChange()"/>
            <input id="push-button" type="button" value="Push" class="btn btn-primary" onClick="push()"/>
        </div>
    </form>
</div>
</body>
</html>