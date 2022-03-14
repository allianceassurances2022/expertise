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
					<h4 class="header-title"> <span class="typcn typcn-user-add"></span> Formulaire D'ajout D'un Expert</h4>
				</div>
				<div class="card-body">
					<h4 class="header-title">Formulaire D'ajout D'un Expert</h4>
					<div class="form-group row">
						<label for="example-text-input" class="col-sm-2 col-form-label">Nom <samp class="float-right text-danger">*</samp></label><div class="col-sm-10">
						<input class="form-control" type="text" value="Artisanal kale" id="example-text-input"></div>
					</div>
					<div class="form-group row"><label for="example-search-input" class="col-sm-2 col-form-label">Prenom<samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" type="search" value="How do I shoot web" id="example-search-input"></div>
					</div>
					<div class="form-group row"><label for="example-email-input" class="col-sm-2 col-form-label">Adresse Email<samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" type="email" value="bootstrap@example.com" id="example-email-input"></div>
					</div>
					<div class="form-group row"><label for="example-url-input" class="col-sm-2 col-form-label">URL<samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" type="url" value="https://getbootstrap.com" id="example-url-input"></div>
					</div>

					<h4 class="header-title">Informations de Connecxion</h4>
					<div class="form-group row"><label for="example-text-input" class="col-sm-2 col-form-label">Nom d'utilisateur <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" type="text" value="Artisanal kale" id="example-text-input"></div></div>
					<div class="form-group row"><label for="example-search-input" class="col-sm-2 col-form-label">Mot de passe<samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" type="search" value="How do I shoot web" id="example-search-input"></div>
					</div>
					<div class="form-group row"><label for="example-email-input" class="col-sm-2 col-form-label">Confirmation mot de passe<samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" type="email" value="bootstrap@example.com" id="example-email-input"></div>
					</div>
					<div class="form-group row">
						<label for="example-email-input" class="col-sm-2 col-form-label">Role de l'utilisateur<samp class="float-right text-danger">*</samp></label>
						<div class="col-sm-10">
							<select class="form-control">
								<option>Select</option>
								<option>Large select</option>
								<option>Small select</option>
							</select>
						</div>
					</div>


					<div class="text-right"><a href="{{ URL::previous() }}" class="btn btn-secondary waves-effect m-l-5">Cancel</a> <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button></div>
					
				</div>
			</div>
		</div><!-- end col -->
	</div>
@endsection