//saving the card may not need ajax call?
function save($par){
    console.log($par);
//    var logoText = $("#logoText-wrapper>input").val()




    //$.ajax({

    //});
}
//TODO: validate the form
function validator(name, value){
    switch(name){
        case "logoText":

        default:
    }
}
// TODO: need add cardId param to send to push.php
function push(){
    console.log("push");

    $.ajax({
        type : 'POST',
        url : "./../../lib/ws/push.php",
        beforeSend : function() {
        },
        success : function(result) {
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

//TODO: this is not good, since refreshing the page will load the default first card
function discardChange(){
    console.log("abandon change");
    location.reload();

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
            $('form').replaceWith($(result).find('form'));
            console.log($(result).find('div.wrapper'));
        },
        error : function() {
        }
    });
}