<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "In") {
    header("Location: secret_new.php");
}
require_once (dirname(__file__) . "/../lib/class/DataInterface.php");
require_once (dirname(__file__) . "/../lib/class/JsonInterface.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="src/style/push_panel.css" />
    <script type="text/javascript" src="src/scripts/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="src/scripts/push_panel.js"></script>
</head>
<body>
<?php
if (isset($_GET['message'])){
    $message = $_GET['message'];
    echo "<h3 class=\"warning-message\">$message</h3>";
}
?>
<div class="wrapper">
    <form action="/lib/ws/save.php" method="post">
	 <?php
            $options = DataInterface::getCardNamesAndIdByUsername($_SESSION['username']);
            $cardType = "storeCard";
            if ($options == null) {
                print "<p style=\"text-align:center;\"><strong class=\"warning-message\">No cards created yet!</strong></p>";
            } else {
                $defaultCardId = -1;
                if(isset($_REQUEST['cardId']) && $_REQUEST['cardId'] != "" && in_array($_REQUEST['cardId'], $options))
                    $defaultCardId = $_REQUEST['cardId'];
                print "<select name='cardId' onChange=\"loadCardContent(this)\">";
                foreach ($options as $cardName => $cardId) {
					if($defaultCardId == -1){
						$defaultCardId = $cardId;
					}
                    if($cardId == $defaultCardId)
                        print "<option value='$cardId' selected>$cardName</option>";
                    else
                        print "<option value='$cardId'>$cardName</option>";
                }
                print "</select>";
                $cardType = DataInterface::getCardType($defaultCardId);
				$jsonObject = new JsonInterface();
				$jsonContent = $jsonObject->getJsonArray($defaultCardId);
                
            }
            ?>
        <div class="absolute-wrapper-outer">
            <div id="storecard-front-lengend-wrapper" class="absolute-wrapper-inner">
                <div id="logo-wrapper">
                    <label class="lengend-label" for="">Logo</label>
                    <input type="file" name="pic_logo" disabled />
                </div>
                <div id="logoText-wrapper">
                    <label class="lengend-label" for="">Logo Text</label>
                    <?php
                        $logoText = $jsonContent["logoText"];
                        print " <input type=\"\" name=\"json_logoText\" value=\"$logoText\"/>";
                    ?>                   
                </div>
                <div id="headerFields_label-wrapper">
                    <label class="lengend-label" for="">Title Label</label>
                    <?php
                        $headerFields_label = $jsonContent["$cardType"]["headerFields"][0]["label"];
                        print " <input type=\"text\" name=\"json_".$cardType."_headerFields_0_label\" value=\"$headerFields_label\"/>";
                    ?>   
                </div>
                <div id="headerFields_value-wrapper">
                    <label class="lengend-label" for="">Title Content</label>
                    <?php
                        $headerFields_value = $jsonContent["$cardType"]["headerFields"][0]["value"];
                        print " <input type=\"\" name=\"json_".$cardType."_headerFields_0_value\" value=\"$headerFields_value\"/>";
                    ?>  
                </div>
                <div id="strip-wrapper">
                    <label class="lengend-label" for="">Main Picture</label>
                    <input type="file" name="pic_strip" disabled />
                </div>
                <div id="auxiliaryField0_label-wrapper">
                    <label class="lengend-label" for="">Section 1 Label</label>
                    <?php
                        $auxiliaryFields_0_label = $jsonContent["$cardType"]["auxiliaryFields"][0]["label"];
                        print " <input type=\"\" name=\"json_".$cardType."_auxiliaryFields_0_label\" value=\"$auxiliaryFields_0_label\"/>";
                    ?>      
                </div>
                <div id="auxiliaryField0_value-wrapper">
                    <label class="lengend-label" for="">Section 1 Content</label>
                    <?php
                        $auxiliaryFields_0_value = $jsonContent["$cardType"]["auxiliaryFields"][0]["value"];
                        print " <input type=\"\" name=\"json_".$cardType."_auxiliaryFields_0_value\" value=\"$auxiliaryFields_0_value\"/>";
                    ?>  
                </div>
                <div id="auxiliaryField1_label-wrapper">
                    <label class="lengend-label" for="">Section 2 Label</label>
                    <?php
                        $auxiliaryFields_1_label = $jsonContent["$cardType"]["auxiliaryFields"][1]["label"];
                        print " <input type=\"\" name=\"json_".$cardType."_auxiliaryFields_1_label\" value=\"$auxiliaryFields_1_label\"/>";
                    ?>  
                </div>
                <div id="auxiliaryField1_value-wrapper">
                    <label class="lengend-label" for="">Section 2 Content</label>
                    <?php
                        $auxiliaryFields_1_value = $jsonContent["$cardType"]["auxiliaryFields"][1]["value"];
                        print " <input type=\"\" name=\"json_".$cardType."_auxiliaryFields_1_value\" value=\"$auxiliaryFields_1_value\"/>";
                    ?>
                </div>
                <div id="barcode_message-wrapper">
                    <label class="lengend-label" for="">Barcode Content</label>
                    <?php
                        $barcode_message = $jsonContent["barcode"]["message"];
                        print " <input type=\"\" name=\"json_barcode_message\" value=\"$barcode_message\"/>";
                    ?>
                </div>
                <div id="barcode_format-wrapper">
                    <label class="lengend-label" for="">Barcode format</label>
                    <select id="" name="json_barcode_format" onChange="save(this.value)">
                    <?php
                        $tmpVar = $jsonContent["barcode"]["format"];
                        
                        $barcode_format_map = array("PKBarcodeFormatQR"=>"",
                                                    "PKBarcodeFormatPDF417"=>"",
                                                    "PKBarcodeFormatAztec"=>"",
                                                    "None"=>"");
                        if(array_key_exists($tmpVar, $barcode_format_map)){
                            $barcode_format_map[$tmpVar] = "selected";
                        }else{
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
                        print " <input type=\"\" name=\"json_barcode_altText\" value=\"$barcode_altText\"/>";
                    ?>
                </div>
                <img class="lengend-sample-picture" src="resource/image/storecard-front-lengend.png" alt="" style="width:800px;" />
            </div>
        </div>
        <div id="operation-panel" class="panel">
            <input type="submit" value="Save" />
            <input type="button" value="Discard Change" onClick="discardChange()"/>
            <input id="push-button" type="button" value="Push" onClick="push()"/>
        </div>
    </form>
</div>
</body>
</html>