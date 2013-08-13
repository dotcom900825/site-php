//saving the card may not need ajax call?
function save($par){
    console.log($par);
}
//TODO: validate the form
function validator(name, value){
    switch(name){
        case "logoText":

        default:
    }
}
function push(){
    console.log("push");
    var cardId = $('form>select').val();
    $.ajax({
        type : 'POST',
        url : "./../../lib/ws/push.php",
        data: {'cardId' : cardId},
        beforeSend : function() {
        },
        success : function(result) {
            alert(result);
        },
        error : function() {
        }
    });
}
//TODO: maybe this is not needed? or add a button to do this?
function saveAndPush(){
    console.log("save and push");
    save();
    push();
}

function discardChange(){
    console.log("abandon change");
    var cardId = $('form>select').val();
    console.log(cardId);
    $.ajax({
        type : 'POST',
        url : "./../../push_panel_new.php",
        data: {'cardId':cardId},
        beforeSend : function() {
        },
        success : function(result) {
            $('#main-form').replaceWith($(result).find('#main-form'));
            console.log($(result).find('div.wrapper'));
        },
        error : function() {
        }
    });
}

function loadCardContent(sel){
    var cardId = sel.value;
    console.log(cardId);
    $.ajax({
        type : 'POST',
        url : "./../../push_panel_new.php",
        data: {'cardId':cardId},
        beforeSend : function() {
        },
        success : function(result) {
            $('#main-form').replaceWith($(result).find('#main-form'));
            console.log($(result).find('div.wrapper'));
        },
        error : function() {
        }
    });
}