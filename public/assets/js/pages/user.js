$( document ).ready(function() {
// parPermission  permissions  roles
	$('#parPermission').on("change", function(){

		if($(this).is(":checked")) {
		    $('#permissions').attr("disabled", false);
		    $('#roles').attr("disabled", true);
	   	}else{
	   		$('#permissions').attr("disabled", true);
		    $('#roles').attr("disabled", false);
   		}

	});

	});