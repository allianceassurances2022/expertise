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
					<h4 class="header-title"> <span class="typcn typcn-user-add"></span> Affectation des permissions</h4>
				</div>
				<div class="card-body">
					<h4 class="header-title">Affectation des permissions à l'utilisateur{{$utilisateur}}</h4>
				
					<div class="text-right"><a href="{{ URL::previous() }}" class="btn btn-secondary waves-effect m-l-5">Cancel</a> <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button></div>
					
				</div>
			</div>
		</div><!-- end col -->
	</div>
@endsection