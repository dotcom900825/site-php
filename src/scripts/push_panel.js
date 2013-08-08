function save($par){
    console.log($par);
//    var logoText = $("#logoText-wrapper>input").val()




    //$.ajax({

    //});
}

function validator(name, value){
    switch(name){
        case "logoText":

        default:
    }
}

function push(){
    console.log("push");

    $.ajax({
        type : 'POST',
        url : "./../../lib/ws/push.php?test=true",
        beforeSend : function() {
        },
        success : function(result) {
        },
        error : function() {
        }
    });


}

function saveAndPush(){
    console.log("save and push");
    save();
    push();
}

function discardChange(){
    console.log("abandon change");

}
