@extends('default')

@section('head_title')
	Ajouter Un Utilisateur
@endsection

@section('title')
	Ajouter Un Utilisateur
@endsection

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h4 class="header-title"> <span class="typcn typcn-user-add"></span> Formulaire d'ajout D'un Utilisateur</h4>
				</div>

				<form name="ajout_user" action="{{route('utilisateur.store')}}" method="post">
				@csrf
				<div class="card-body">
					<h4 class="header-title">Formulaire D'ajout Utilisateur</h4>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Nom <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="nom" type="text" id="example-text-input"></div></div>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Prenom <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="prenom" type="text" id="example-search-input"></div></div>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Adresse Email <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="email" type="text" id="example-email-input"></div></div>
					<div class="form-group row"><label for="customCheck1" class="col-sm-2 col-form-label">Etat <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="etat" type="checkbox" id="customCheck1"></div></div>

					<h4 class="header-title">Informations de Connecxion</h4>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Nom d'utilisateur <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="username" type="text" id="example-text-input"></div></div>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Mot de passe <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="password" type="password"  id="example-password-input"></div></div>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Confirmation mot de passe <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="conf-password" type="password"  id="example-password-input"></div></div>
					<div class="form-group row">
						<label for="example-email-input" class="col-sm-2 col-form-label">Role de l'utilisateur <samp class="float-right text-danger">*</samp></label>
						<div class="col-sm-10">
							<select class="form-control" name="previllege">
								@foreach ($roles as $role)
								  <option value="{{ $role->name }}" >{{ $role->name }}</option>
								@endforeach
							</select>
						</div>
					</div>


					<div class="text-right"><a href="{{ URL::previous() }}" class="btn btn-secondary waves-effect m-l-5">Cancel</a> <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button></div>
					
				</div>
				</form>
			</div>
		</div><!-- end col -->
	</div>
@endsection