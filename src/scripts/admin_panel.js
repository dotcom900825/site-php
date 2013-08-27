$(document).ready(function () {
        bindSubmit()
    }
);

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
    // this is the id of the submit button
    $("#main-form").submit(function () {
        var url = "/lib/ws/save.php"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            url: url,
            data: $("#main-form").serialize(), // serializes the form's elements.
            beforeSend: function(){
                blockUI();
            },
            success: function (data) {
                $.unblockUI();
            },
            error: function(message){
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
        url: "./../../admin_panel.php",
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
        url: "./../../admin_panel.php",
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