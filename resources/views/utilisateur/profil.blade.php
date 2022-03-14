@extends('default')

@section('head_title')
Profil Utilisateur
@endsection

@section('title')
Profil Utilisateur
@endsection

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card m-b-30">
			<div class="card-header">
				<h4 class="header-title"> <span class="typcn typcn-user-add"></span> Information de mon profil</h4>
			</div>

			<form name="ajout_user" action="{{route('utilisateur.update_profil',$user->id)}}" method="post">
				@csrf
				<div class="card-body">
					<h4 class="header-title">Formulaire De modification Utilisateur</h4>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Nom <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="nom" value="{{ $user->nom }}" type="text" id="example-text-input"></div></div>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Prenom <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="prenom" type="text" value="{{ $user->prenom }}" id="example-search-input"></div></div>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Adresse Email <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="email" type="text" value="{{ $user->email }}" id="example-email-input"></div></div>

                    @if(auth()->user()->previllege == 'expert')
                    <div class="form-group row">
                    	<label for="example-text-input" class="col-sm-2 col-form-label">Spécialité : </label>
                    	<div class="row">
                    		<div class="col-md-4">
                    			<div class="custom-control custom-checkbox">
                    				<input type="checkbox" class="custom-control-input" id="customCheck1" data-parsley-multiple="groups"
                    				data-parsley-mincheck="2" name="auto" @if ($expert->auto) checked @endif">
                    				<label class="custom-control-label" for="customCheck1">Automobile</label>
                    			</div>
                    		</div>
                    		<div class="col-md-4">
                    			<div class="custom-control custom-checkbox">
                    				<input type="checkbox" class="custom-control-input" id="customCheck2" data-parsley-multiple="groups"
                    				data-parsley-mincheck="2" name="risque" @if ($expert->risque_indu) checked @endif">
                    				<label class="custom-control-label" for="customCheck2">Risque industriel</label>
                    			</div>
                    		</div>
                    		<div class="col-md-4">
                    			<div class="custom-control custom-checkbox">
                    				<input type="checkbox" class="custom-control-input" id="customCheck3" data-parsley-multiple="groups"
                    				data-parsley-mincheck="2" name="transport" @if ($expert->transport) checked @endif">
                    				<label class="custom-control-label" for="customCheck3">Transport</label>
                    			</div>
                    		</div>
                    	</div>
                    </div>

                    <div class="form-group row">
                    	<label for="example-text-input" class="col-sm-2 col-form-label">Soumis à la TVA : </label>
                    	<div class="row">
                    		<div class="col-md-4">
                    			<div class="custom-control custom-checkbox">
                    				<input type="checkbox" class="custom-control-input" id="customCheck4" data-parsley-multiple="groups"
                    				data-parsley-mincheck="2" name="tva" @if ($expert->tva) checked @endif">
                    				<label class="custom-control-label" for="customCheck4">TVA</label>
                    			</div>
                    		</div>
                    	</div>
                    </div>

					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">N° Tel 1 : <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="num_tel1" type="text" value="{{ $expert->telephone_1 }}" id="example-email-input"></div></div>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">N° Tel 2 : <samp class="float-right text-danger"></samp></label><div class="col-sm-10"><input class="form-control" name="num_tel2" type="text" value="{{ $expert->telephone_2 }}" id="example-email-input"></div></div>

					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Adresse : <samp class="float-right text-danger"></samp></label><div class="col-sm-10"><input class="form-control" name="adresse" type="text" value="{{ $expert->adresse }}" id="example-email-input"></div></div>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Agerement organisme : <samp class="float-right text-danger"></samp></label><div class="col-sm-10"><input class="form-control" name="agerement_organisme" type="text" value="{{ $expert->agerement_organisme }}" id="example-email-input"></div></div>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Agrement date obtention : <samp class="float-right text-danger"></samp></label><div class="col-sm-10"><input class="form-control" name="agrement_date_obtention" type="date" value="{{ $expert->agrement_date_obtention }}" id="example-email-input"></div></div>
                    <div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Identifiant fiscal (NIF) : <samp class="float-right text-danger"></samp></label><div class="col-sm-10"><input class="form-control" name="nif" type="text" value="{{ $expert->nif }}" id="example-email-input"></div></div>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">RIB / RIP : <samp class="float-right text-danger"></samp></label><div class="col-sm-10"><input class="form-control" name="rib" type="text" value="{{ $expert->rib }}" id="example-email-input"></div></div>
					@endif

					<h4 class="header-title">Informations de Connexion</h4>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Nom d'utilisateur <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" value="{{ $user->username }}" readonly name="username" type="text" id="example-text-input"></div></div>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Mot de passe <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="password" type="password"  id="example-password-input"></div></div>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Confirmation mot de passe <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="conf_password" type="password"  id="example-password-input"></div></div>


					<div class="text-right"><a href="{{ URL::previous() }}" class="btn btn-secondary waves-effect m-l-5">Retour</a> <button type="submit" class="btn btn-primary waves-effect waves-light">Valider</button></div>

				</div>
			</form>
		</div>
	</div><!-- end col -->
</div>
@endsection
