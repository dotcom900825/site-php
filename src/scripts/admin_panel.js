$(document).ready(function () {
    bindColorPicker($('div#foreground_color_picker_placeholder'),$("input#json_foregroundColor_input"));
    bindColorPicker($('div#background_color_picker_placeholder'),$("input#json_backgroundColor_input"));
    bindSubmit();
});

function bindColorPicker(placeholder,target) {
    placeholder.ColorPicker({
        color: '#EFEFEF',
        onShow: function (colpkr) {
            $(colpkr).fadeIn(300);
            return false;
        },
        onHide: function (colpkr) {
            $(colpkr).fadeOut(300);
            return false;
        },
        onChange: function (hsb, hex, rgb) {
            target.val('#' + hex);
            placeholder.css('backgroundColor', '#' + hex);
        }
    });
}

function bindFlip() {
    $("div.absolute-wrapper-outer").attr("style", "overflow:hidden;");
    $("button#flip_card_button").bind("click", function () {
        var front = $("div#storecard-front-lengend-wrapper");
        var back = $("div#storecard-back-wrapper");
        if (front.css('display') == 'none' && back.css('display') != 'none') {
            $("div.absolute-wrapper-outer").attr("style", "overflow:hidden;");
        } else if (front.css('display') != 'none' && back.css('display') == 'none') {
            $("div.absolute-wrapper-outer").attr("style", "overflow-y:scroll;");
        } else {
            $("div.absolute-wrapper-outer").attr("style", "overflow:hidden;");
        }
        front.toggle();
        back.toggle();
    });
}

function blockUI() {
    $.blockUI({ css: {
        border: 'none',
        padding: '15px',
        backgroundColor: '#000',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
        opacity: .5,
        color: '#fff'
    } });
}

function bindSubmit() {
    bindFlip();
    // this is the id of the submit button
    $("#main-form").submit(function () {
        var url = "/lib/ws/save.php"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            url: url,
            data: $("#main-form").serialize(), // serializes the form's elements.
            beforeSend: function () {
                blockUI();
            },
            success: function (data) {
                $.unblockUI();
            },
            error: function (message) {
                $.unblockUI();
                alert(message);
            }
        });
        return false; // avoid to execute the actual submit of the form.
    });
}

//saving the card may not need ajax call?
function save($par) {
    console.log($par);
}
//TODO: validate the form
function validator(name, value) {
    switch (name) {
        case "logoText":

        default:
    }
}
function push() {
    var cardId = $('#selectCardId').val();
    console.log("push:" + cardId);
    $.ajax({
        type: 'POST',
        url: "./../../lib/ws/push.php",
        data: {'cardId': cardId},
        beforeSend: function () {
            blockUI();
        },
        success: function (result) {
            $.unblockUI();
            alert(result)
        },
        error: function (message) {
            $.unblockUI();
            alert(message)
        }
    });
}
//TODO: maybe this is not needed? or add a button to do this?
function saveAndPush() {
    console.log("save and push");
    save();
    push();
}

function discardChange() {
    console.log("abandon change");
    var cardId = $('form>select').val();
    console.log(cardId);
    $.ajax({
        type: 'POST',
        url: "./../../admin.php",
        data: {'cardId': cardId},
        beforeSend: function () {
            blockUI();
        },
        success: function (result) {
            $('#main-form').replaceWith($(result).find('#main-form'));
            bindSubmit();
            $.unblockUI();
        },
        error: function (message) {
            $.unblockUI();
            alert(message)
        }
    });
}
//TODO: add progress icon
//TODO: handel session expiration problem!
function loadCardContent(sel) {
    var cardId = sel.value;
    console.log(cardId);
    $.ajax({
        type: 'POST',
        url: "./../../admin.php",
        data: {'cardId': cardId},
        beforeSend: function () {
            blockUI();
        },
        success: function (result) {
            $('#main-form').replaceWith($(result).find('#main-form'));
            bindSubmit();
            $.unblockUI();
        },
        error: function (message) {
            $.unblockUI();
            alert(message);
        }
    });
}


function addContentGroup() {
    var maxCounter = $("#back_max_counter").val();
    var newItem = $("#hidden_item").clone();
    console.log(newItem);

    $(newItem).attr('style', '');
    $(newItem).attr('id', '');

    var labelName = $(newItem).find("input.item-label-input").attr("name");
    var newLabelName = labelName.split(":").join(maxCounter);
    $(newItem).find("input.item-label-input").attr("name", "backjson_" + newLabelName);

    var contentName = $(newItem).find("textarea.item-content-input").attr("name");
    var newContentName = contentName.split(":").join(maxCounter);
    $(newItem).find("textarea.item-content-input").attr("name", "backjson_" + newContentName);

    $("#hidden_item").before(newItem);
    $("#back_max_counter").val(++maxCounter);
}

function deleteContentGroup(self) {
    $(self).parent().remove();
}