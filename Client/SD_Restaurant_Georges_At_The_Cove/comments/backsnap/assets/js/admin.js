// Timestamp: [[ 2012-09-26 05:02:56 +0000 by Mike Yrabedra (mikeyrab) ]]
$(function() {

	$(".color").colorpicker();
	
// changes the preview color if hand entered
	$(document).on("change", "div.color",  function() {
		var $this = $(this);
		var color = $this.find('input').val();
		$this.data('color', color);// woohoo!
		$this.colorpicker('update');
		$this.find('span.add-on i').css('background-color', color);
		
		//updatePreview();
		
	});
	
});