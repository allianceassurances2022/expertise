@extends('default')

@section('head_title')
Honoraire
@endsection

@section('title')
Honoraire
@endsection
@section('head')
	<style>
		img.illustration{
			width: 25%;
			margin: auto; 
			margin-bottom: 15px;
		}
		button{
			font-size: 15px;
			text-transform: uppercase;
			font-weight: bold;
		}
	</style>
@endsection

@section('content')

<div class="card">
	<div class="card-body">
		<div class="row">
				
			<div class="col-sm-6">
				<p style="margin-top: 9px; margin-bottom: 9px;"> Dossier N°:{{$expertid}} </p>
			</div>	
		</div>
	</div>
</div>

</br>

<input type="hidden" nom="previllage" id="previllage" value="{{$expertprevillege}}">
</br>

	
<br>
<div class="card">
	<div class="card-body">
    <form action="{{route('pdfhonorairreport')}}" method="post">
			@csrf

			<div class="row">
				<div class="col-md-3">
					<h6><i class="ion-information-circled"></i> periode</h6>
					<div class="form-group">
						<label>Date debut</label>
						<input type="date" class="form-control" required onfocusout="verif_champ_date();" name="date_debut"  id="date_debut">
					</div>
                    <div class="form-group">
						<label>Date fin</label>
						<input type="date" class="form-control" required onfocusout="verif_champ_date();" name="date_fin" id="date_fin">
					</div>
                   
				</div>
				<div class="container box" id='Selectionner'>
   <h3 align="center">Selectionner expert:</h3><br />
   <div class="form-group">
    <select name="directions" id="directions" class="form-control input-lg dynamic" data-dependent="agence">
     <option value="">Selectionner la direction</option>
     @foreach($directions_list as $directions_list)
     <option value="{{ $directions_list->code}}">{{ $directions_list->libelle }}</option>
     @endforeach
    </select>
   </div>
   <br />
   <div class="form-group">
    <select name="agence" id="agence" class="form-control input-lg dynamic" data-dependent="expert">
     <option value="">selectionner l'agence </option>
    </select>
   </div>
   <br />
   <div class="form-group">
    <select name="expert" id="expert" class="form-control input-lg">
     <option value="">selectionner l'expert</option>
    </select>
   </div>
   {{ csrf_field() }}
   <br />
   <br />
  </div>
  
			 <div  class="container box" align=center>
        <button type="submit" class="btn btn-primary waves-effect waves-light" formtarget="_blank">affichier</button>
                  
      
                 
                  </div>
		</form>
	
	</div>
</div>



@endsection

@section('js')

<script>


  
$( document ).ready(function() {
  var input = document.getElementById("previllage").value;
  if(input=="expert"){document.getElementById("Selectionner").style.display= 'none'
    }else{
      document.getElementById("Selectionner").style.display= 'block'

    }


	$("#frais").change(function(){
        var frai = $(this).children("option:selected").val();
        if(frai == 1 || frai == 4){
        	$('#nombre').prop("disabled", true);
        }else{
        	$('#nombre').prop("disabled", false);
        }
        if(frai == 2){
        $("#libnbr").text("Nombre kilomètres");
        }
        if(frai == 3){
        $("#libnbr").text("Nombre Photos");
        //$('#nombre').toFixed(2);
        }
        if(frai == 5){
        $("#libnbr").text("Nombre repas");
        //$('#nombre').toFixed(2);
        }
        if(frai == 6){
        $("#libnbr").text("Nombre nuitées");
        //$('#nombre').toFixed(2);
        }
      });

});

//$('select').on('change', function() {



  //alert( this.value );
//});

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
$(document).ready(function(){

 $('.dynamic').change(function(){
  if($(this).val() != '')
  {
   var select = $(this).attr("id");
   
   var value = $(this).val();
   
   var dependent = $(this).data('dependent');
   //alter(dependent);
 
   var _token = $('input[name="_token"]').val();
   //alert( _token );
   $.ajax({
   
    //alert(value);
    url:"{{ route('report.raporthonoraire.fetch') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result);
    //alert(value);
   
    }

   })
  }
 });

 $('#directions').change(function(){
  $('#agence').val('');
  $('#expert').val('');
 });

 $('#agence').change(function(){
  $('#expert').val('');
 });
 

});
</script>
@endsection