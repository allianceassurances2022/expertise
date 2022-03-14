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
				<p style="margin-top: 9px; margin-bottom: 9px;"> ODS N°: {{ $ods->num_ods }} </p>
			</div>	
			<div class="col-sm-6">
				<p style="margin-top: 9px; margin-bottom: 9px;"> Dossier N°: {{ $ods->ref_sinistre }} </p>
			</div>	
		</div>
	</div>
</div>

</br>

<div class="card">
	<div class="card-body">
		<form name="ajout_honoraire" action="{{route('expertise.store_honoraire')}}" method="POST">
				@csrf
		<div class="row">
			
				<div class="col-sm-6" style="margin-top:-6px;">
					<label for="lieu" class="col-form-label">Frais:  <samp class="float-right text-danger" >*</samp></label>
					<select class="form-control" id="frais" name="frais">
						@foreach ($frais as $frai)
						<option value="{{$frai->id}}">{{$frai->libelle}}</option>
						@endforeach
					</select>
				</div>

				<div class="col-sm-2" style="margin-top:-6px;">
					<label for="lieu" class="col-form-label" id="libnbr">Nombre :  <samp class="float-right text-danger" >*</samp></label>
					<div class="">
						<input type="number" id="nombre" name="nombre" class="form-control"  value="0" min="0" step=".5" disabled>
					</div>
				</div>

				<div class="col-sm-4 text-right">
					<div class="form-group">
						<br>
						<input type="hidden" name="id" value="{{$expertise->id}}">
						<input id="btn_ajouter" class="btn btn-success btn-block text-center" type="submit" value="Ajouter"  style="margin-top: 8px;">
					</div>
				</div>
			

		</div>
		</form>
	</div>
</div>

</br>

<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-responsive table-hover display responsive nowrap">
					<thead>
						<tr>
							<th>Libellé</th>
							<th>Nombre</th>
							<th>Montant</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($honoraires as $honoraire)
						<tr>
							<td>{{$honoraire->libelle}}</td>
							<td>{{$honoraire->nombre}}</td>
							<td>{{number_format($honoraire->montant, 2, ',', ' ')}} DA</td>
							<td>
								@if($honoraire->libelle != 'honoraire')
								<form name="supression_honoraire" action="{{route('expertise.delete_honoraire',$honoraire->id)}}" method="POST">
									@csrf
									<button type="submit" title="Supprimer" class="btn btn-sm btn-danger">
										<i class="typcn typcn-trash"></i>
									</button>
								</form>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 text-right">
					Montant Total honoraire : <label style="font-size: large;"> {{number_format($somme, 2, ',', ' ')}} DA</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 text-right ">
				<a href="{{route('expertise.show',$expertise->id)}}" class="col-sm-2 btn btn-default btn-block btn-secondary text-center" id="btnChocRetour">Retour</a>
			</div>
		</div>
	</div>
</div>



@endsection

@section('js')

<script>

$( document ).ready(function() {

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

</script>

@endsection