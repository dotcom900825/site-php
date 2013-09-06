<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "In") {
    header("Location: login.php");
}
require_once (dirname(__file__) . "/../lib/class/DataInterface.php");
require_once (dirname(__file__) . "/../lib/class/JsonInterface.php");
require_once (dirname(__file__) . "/../lib/class/Utils.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title></title>
    <script type="text/javascript" src="src/scripts/jquery.min.js"></script>
    <script type="text/javascript" src="src/bootstrap/js/bootstrap-fileupload.min.js"></script>
    <script type="text/javascript" src="src/scripts/colorpicker.min.js"></script>
    <script type="text/javascript" src="src/scripts/admin_panel.js"></script>
    <!-- include BlockUI -->
    <script src="src/scripts/jquery.blockUI.js"></script>
    <link rel="stylesheet" href="src/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="src/bootstrap/css/bootstrap-fileupload.min.css"/>
    <link rel="stylesheet" href="src/style/colorpicker.css"/>
    <link rel="stylesheet" href="src/style/admin_panel.css"/>

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
<form id="main_form" action="/lib/ws/save.php" method="post">

<div id="top_wrapper">
    <div id="select_card_wrapper">
        <div id="select_card">
            <label class="lengend-label">My cards:</label>
            <?php
            $options = DataInterface::getCardNamesAndIdByUsername($_SESSION['username']);
            $cardType = "storeCard";
            $cardDistributionType = "universal";
            $jsonContent = array();
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
    <div id="change_message_wrapper">
        <label class="lengend-label">Push Message</label>
        <?php
        $changeMessage = substr($jsonContent[$cardType]["headerFields"][0]["changeMessage"], 0, -2);
        print "<input id=\"change_message_input\" type=\"text\" name=\"json_" . $cardType
            . "_headerFields_0_changeMessage\" value=\"" . $changeMessage . "\"/>";
        ?>
    </div>
</div>
<div id="operation_panel" class="panel">
    <button type="button" class="btn btn-info" id="flip_card_button">Flip Card</button>
    <input type="button" value="Discard Change" class="btn btn-warning" onClick="discardChange()"/>
    <input id="push_button" type="button" value="Push" class="btn btn-primary" onClick="push()"/>
    <input id="save_button" type="submit" value="Save" class="btn btn-primary"/>
    <label class="lengend-label">Remeber to save before push :)</label>
</div>
<div class="absolute-wrapper-outer">
    <?php echo "<input name=\"cardType\" type=\"hidden\" value=\"" . $cardType . "\" />";?>
    <div id="storecard_front_lengend_wrapper" class="absolute-wrapper-inner">
        <div id="logo_wrapper">
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
        <div id="logoText_wrapper">
            <label class="lengend-label" for="">Logo Text</label>
            <?php
            $logoText = $jsonContent["logoText"];
            print " <input class=\"content-input\" type=\"text\" name=\"json_logoText\" value=\"$logoText\"/>";
            ?>
        </div>
        <div id="foreground_color_picker_wrapper">
            <label class="lengend-label color-picker-label">Foreground color:</label>
            <?php
            $foregroundColorStr = $jsonContent["foregroundColor"];
            $fColor = Utils::rgb2Html(Utils::extractRgbFromString($foregroundColorStr));
            print "<input id=\"json_foregroundColor_input\" type=\"hidden\" name=\"json_foregroundColor\" value=\"" . $fColor . "\"/>";
            print "<div id=\"foreground_color_picker_placeholder\" class=\"color-picker\" style=\"background-color: " . $fColor . ";\">";
            ?>
            <div></div>
        </div>
    </div>
    <div id="background_color_picker_wrapper">
        <label class="lengend-label color-picker-label">Background color:</label>
        <?php
        $backgroundColor = $jsonContent["backgroundColor"];
        $bColor = Utils::rgb2Html(Utils::extractRgbFromString($backgroundColor));
        print "<input id=\"json_backgroundColor_input\" type=\"hidden\" name=\"json_backgroundColor\" value=\"" . $bColor . "\"/>";
        print "<div id=\"background_color_picker_placeholder\" class=\"color-picker\" style=\"background-color: " . $bColor . ";\">";
        ?>
        <div></div>
    </div>
</div>
<div id="headerFields_label_wrapper">
    <label class="lengend-label" for="">Title Label</label>
    <?php
    $headerFields_label = $jsonContent["$cardType"]["headerFields"][0]["label"];
    print " <input class=\"content-input\" type=\"text\" name=\"json_"
        . $cardType . "_headerFields_0_label\" value=\"$headerFields_label\"/>";
    ?>
</div>
<div id="headerFields_value_wrapper">
    <label class="lengend-label" for="">Title Content</label>
    <?php
    $headerFields_value = $jsonContent["$cardType"]["headerFields"][0]["value"];
    print " <input class=\"content-input\" type=\"text\" name=\"json_"
        . $cardType . "_headerFields_0_value\" value=\"$headerFields_value\"/>";
    ?>
</div>
<div id="strip_wrapper">
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
<div id="auxiliaryField0_label_wrapper">
    <label class="lengend-label" for="">Section 1 Label</label>
    <?php
    $auxiliaryFields_0_label = $jsonContent["$cardType"]["auxiliaryFields"][$startIndex]["label"];
    print " <input class=\"content-input\" type=\"text\" name=\"json_"
        . $cardType . "_auxiliaryFields_" . $startIndex . "_label\" value=\"$auxiliaryFields_0_label\"/>";
    ?>
</div>
<div id="auxiliaryField0_value_wrapper">
    <label class="lengend-label" for="">Section 1 Content</label>
    <?php
    $auxiliaryFields_0_value = $jsonContent["$cardType"]["auxiliaryFields"][$startIndex]["value"];
    print " <input class=\"content-input\" type=\"text\" name=\"json_"
        . $cardType . "_auxiliaryFields_" . $startIndex . "_value\" value=\"$auxiliaryFields_0_value\"/>";
    ?>
</div>
<div id="auxiliaryField1_label_wrapper">
    <label class="lengend-label" for="">Section 2 Label</label>
    <?php
    $auxiliaryFields_1_label = $jsonContent["$cardType"]["auxiliaryFields"][$startIndex + 1]["label"];
    print " <input class=\"content-input\" type=\"text\" name=\"json_"
        . $cardType . "_auxiliaryFields_" . ($startIndex + 1) . "_label\" value=\"$auxiliaryFields_1_label\"/>";
    ?>
</div>
<div id="auxiliaryField1_value_wrapper">
    <label class="lengend-label" for="">Section 2 Content</label>
    <?php
    $auxiliaryFields_1_value = $jsonContent["$cardType"]["auxiliaryFields"][$startIndex + 1]["value"];
    print " <input class=\"content-input\" type=\"text\" name=\"json_"
        . $cardType . "_auxiliaryFields_" . ($startIndex + 1) . "_value\" value=\"$auxiliaryFields_1_value\"/>";
    ?>
</div>
<div id="barcode_message_wrapper">
    <label class="lengend-label" for="">Barcode Content</label>
    <?php
    $barcode_message = $jsonContent["barcode"]["message"];
    print " <input class=\"content-input\" type=\"text\" name=\"json_barcode_message\" value=\"$barcode_message\"/>";
    ?>
</div>
<div id="barcode_format_wrapper">
    <label class="lengend-label" for="">Barcode format</label>
    <select id="barcode_select" name="json_barcode_format" onChange="save(this.value)">
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
<div id="barcode_altText_wrapper">
    <label class="lengend-label" for="">Info</label>
    <?php
    $barcode_altText = $jsonContent["barcode"]["altText"];
    print " <input class=\"content-input\" type=\"text\" name=\"json_barcode_altText\" value=\"$barcode_altText\"/>";
    ?>
</div>
<img class="lengend-sample-picture" src="resource/image/storecard-front-lengend.png" alt=""
     style="width:800px;"/>

<div id="sample_label"><label>Sample</label></div>
</div>
<div id="storecard_back_wrapper" class="form-horizontal" style="display:none;">
    <?php
    if (isset($jsonContent[$cardType]["backFields"])) {
        $backFields = $jsonContent[$cardType]["backFields"];
        $numOfBackContentGroups = count($backFields);
        print "<input name=\"back_max_counter\" id=\"back_max_counter\" type=\"hidden\" value=\""
            . $numOfBackContentGroups . "\"/>";
        $counter = 0;
        foreach ($backFields as $contentGroup) {
            print "<div class=\"item\">";
            print "    <div class=\"content-wrapper\">";
            print "        <div class=\"control-group\">";
            print "            <label class=\"control-label lengend-label\">Item Label</label>";
            print "            <div class=\"controls\">";
            print "                <input class=\"item-label-input\" type=\"text\" name=\"backjson_"
                . $cardType . "_backFields_" . $counter . "_label\" value=\""
                . $contentGroup["label"] . "\"/>";
            print "            </div>";
            print "        </div>";
            print "        <div class=\"control-group\">";
            print "            <label class=\"control-label lengend-label\">Content</label>";
            print "            <div class=\"controls\">";
            print "               <textarea class=\"item-content-input\" name=\"backjson_"
                . $cardType . "_backFields_" . $counter . "_value\" rows=\"2\" cols=\"30\">"
                . $contentGroup["value"] . "</textarea>";
            print "            </div>";
            print "        </div>";
            print "    </div>";
            print "<button class=\"btn btn-danger content-delete\" type=\"button\" onclick=\"deleteContentGroup(this)\">Delete</button>";
            print "</div>";
            $counter++;
        }
    }
    ?>
    <div class="item" id="hidden_item" style="display:none;">
        <div class="content-wrapper">
            <div class="control-group">
                <label for="" class="control-label lengend-label">Item Label</label>

                <div class="controls">
                    <?php
                    print "<input class=\"item-label-input\" type=\"text\" name=\""
                        . $cardType . "_backFields_:_label\" value=\"\"/>"
                    ?>
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label lengend-label">Content</label>

                <div class="controls">
                    <?php
                    print "<textarea class=\"item-content-input\" name=\""
                        . $cardType . "_backFields_:_value\" rows=\"2\" cols=\"30\"></textarea>"
                    ?>
                </div>
            </div>
        </div>
        <button class="btn btn-danger content-delete" type="button" onclick="deleteContentGroup(this)">Delete
        </button>
    </div>

    <hr/>
    <button class="btn btn-primary form-operation" type="button" id="add_content_group"
            onclick="addContentGroup()">
        Add Content Group
    </button>
</div>
</div>
</form>
</div>
</body>
</html>
