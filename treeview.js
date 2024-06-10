
$(document).ready(function() {
   //$('#treeview-pan').panner({control: $('#pan-5-control')});
    var $section = $('.pan-container').first();
    $section.find('#treeview-pan').panzoom();

    $("#tree-loading").hide();
    $(".pan-container").show();
});


function get_child(id)
{
	var msg = "";
	$.ajax({
		type: "POST",
		url: "getchildtree.php",
		data: "id="+id,
		cache: false,
		beforeSend: function(){ $("#loading").show();},
		success: function(msg)
		{
			//$('p.loadingtext').remove();
			$('#genealogy_id').empty().append(msg);
			return false;
			
		}
	});
	return false;
}


