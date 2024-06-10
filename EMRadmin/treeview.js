
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

function get_child1(id)
{
//	alert(111);
//	alert(id);
	
	var msg = "";
	 $.ajax({
	 type: "POST",
	 url: "../assets/genealogy/getchildtree",
	 data: "id="+id,
	 cache: false,
	 success: function(msg)
		{
		   $('#genealogy_id').empty().append(msg);
			return false;
		}

	});
	return false;
}

$('#SearchID').on('click', function(e)
{
	var sid = $('#sponserid').val();
	if(sid != '')
	{
        $elm=$(".btn-submit");
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        $.ajax({
            type: "POST",
            url: "../includes/commonfunction",
            data: "id="+sid+"&CheckSponser=1",
            cache: false,
            success: function(resp)
            {
                resp=JSON.parse(resp);
                if(resp.valid)
                {
                    $.ajax({
                        type: "POST",
                        url: "../genealogy/getchildtree",
                        data: "id="+resp.id,
                        cache: false,
                        success: function(msg)
                        {
                            $('#genealogy_id').empty().append(msg);
                            return false;
                        }

                    });
                }
                else{
                    _toastr(resp.message,"bottom-right","info",false);
                }
                $(".submit-loading").remove();
                $elm.show();

            },
            error: function(data) {
            }

        });
	}
	else
	{
        _toastr("Enter Sponser ID","bottom-right","info",false);
	}


});