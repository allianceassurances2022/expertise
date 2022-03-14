@extends('default')

@section('head_title')
	Modifier Un Utilisateur
@endsection

@section('title')
	Modifier Un Utilisateur
@endsection

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h4 class="header-title"> <span class="typcn typcn-user-add"></span> Formulaire de modification D'un Utilisateur</h4>
				</div>

				<form name="ajout_user" action="{{route('utilisateur.update',$user->id)}}" method="post">
				@csrf
				<div class="card-body">
					<h4 class="header-title">Formulaire De modification Utilisateur</h4>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Nom <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="nom" value="{{ $user->nom }}" type="text" id="example-text-input"></div></div>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Prenom <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="prenom" type="text" value="{{ $user->prenom }}" id="example-search-input"></div></div>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Adresse Email <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="email" type="text" value="{{ $user->email }}" id="example-email-input"></div></div>
					<div class="form-group row"><label for="customCheck1" class="col-sm-2 col-form-label">Etat <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="etat" type="checkbox" @if ($user->etat===1) checked @endif id="customCheck1"></div></div>

					<h4 class="header-title">Informations de Connecxion</h4>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Nom d'utilisateur <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" value="{{ $user->username }}" readonly name="username" type="text" id="example-text-input"></div></div>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Mot de passe <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="password" type="password"  id="example-password-input"></div></div>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Confirmation mot de passe <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="conf-password" type="password"  id="example-password-input"></div></div>
					<div class="form-group row">
						<label for="example-email-input" class="col-sm-2 col-form-label">Role de l'utilisateur <samp class="float-right text-danger">*</samp></label>
						<div class="col-sm-10">
							<select class="form-control" name="previllege">
								@foreach ($roles as $role)
								  <option value="{{ $role->name }}" @if($user->previllege===$role->name) selected @endif>{{ $role->name }}</option>
								@endforeach
								{{-- <option value="expert" @if($user->previllege==='expert') selected @endif>Expert</option>
								<option value="agence" @if($user->previllege==='agence') selected @endif>Agence</option>
								<option value="backoffice" @if($user->previllege==='backoffice') selected @endif>Backoffice</option>
								<option value="supbackoffice" @if($user->previllege==='supbackoffice') selected @endif>Super Backoffice</option>
								<option value="dr"  @if($user->previllege==='dr') selected @endif>Direction Régional</option>
								<option value="admin" @if($user->previllege==='admin') selected @endif>Admin</option> --}}
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