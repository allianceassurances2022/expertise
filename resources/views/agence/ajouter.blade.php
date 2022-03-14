@extends('default')

@section('head_title')
	Ajouter Une Agence
@endsection

@section('title')
	Ajouter Une Agence
@endsection

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h4 class="header-title"> <span class="fa fa-home"></span> Formulaire D'ajout D'une Agence</h4>
				</div>

				<form name="ajout_user" action="{{route('store.agence')}}" method="POST">
					@csrf
					<div class="card-body">
						<h4 class="header-title">Formulaire D'ajout D'Une Agence</h4>
						<div class="form-group row">
									<label for="code_agence" class="col-sm-2 col-form-label">Code Agence <samp class="float-right text-danger" >*</samp></label>
									<div class="col-sm-10"><input class="form-control" name="code_agence" type="text" id="code_agence"></div>
						</div>

						<div class="form-group row">
									<label for="email_agence" class="col-sm-2 col-form-label">Adresse Email Agence <samp class="float-right text-danger">*</samp></label>
									<div class="col-sm-10"><input class="form-control" name="email_agence" type="text" id="email_agence"></div>
						</div>
						<div class="form-group row">
									<label for="chef_agence" class="col-sm-2 col-form-label">Chef d'Agence <samp class="float-right text-danger">*</samp></label>
									<div class="col-sm-10"><input class="form-control" name="chef_agence" type="text" id="chef_agence"></div>
						</div>
						
						
						<div class="form-group row">
							<label  class="col-sm-2 col-form-label" for="type_agence">Type d'Agence <samp class="float-right text-danger">*</samp></label>
							<div class="col-sm-10">
								<select class="form-control" name="type_agence" id="type_agence">
									<option value="">Choisir...</option>
									@foreach($type_agence as $type)
				        					<option value='{{$type->id}}' >{{$type->type}}</option>
				        			@endforeach 
									
								</select>
							</div>
						</div>
						

						<div class="form-group row">
							<label for="direction" class="col-sm-2 col-form-label">Direction <samp class="float-right text-danger">*</samp></label>
							<div class="col-sm-10">
								<select class="form-control" name="direction" id="direction">
									<option value="">Choisir...</option>
									@foreach($directions as $data)
			        					<option value='{{$data->code}}' >{{$data->libelle}}</option>
			        				@endforeach 
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label for="statut_agence" class="col-sm-2 col-form-label">Statut de l'Agence <samp class="float-right text-danger">*</samp></label>
							<div class="col-sm-10">
								<select class="form-control" name="statut" id="statut_agence">
									<option value="1">Actif</option>
									<option value="0">Innactif</option>
								</select>
							</div>
						</div>

						<div class="text-right"><a href="{{ URL::previous() }}" type="reset" class="btn btn-secondary waves-effect m-l-5">Annuler</a > <button type="submit" class="btn btn-primary waves-effect waves-light">Ajouter</button></div>
						
					</div>
				</form>
			</div>
		</div><!-- end col -->
	</div>
@endsection