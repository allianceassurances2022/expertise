@extends('default')

@section('head_title')
	Ajouter un Role
@endsection

@section('title')
	Ajouter un Role
@endsection

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h4 class="header-title"><span class="typcn typcn-user-add"></span> Modifier D'un role</h4>
				</div>

				<form name="ajout_role" action="{{route('role.update')}}" method="post">
					@csrf
					<div class="card-body">
						<h4 class="header-title">Formulaire Modifier D'un Role</h4>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-2 col-form-label">Nom du rôle</label>
							<div class="col-sm-10">
								<input class="form-control" name="name" type="text" value="{{ $role->name }}" readonly id="example-text-input">
								<input class="form-control" name="id" type="hidden" value="{{ $role->id }}" readonly id="example-text-input">
							</div>
						</div>

						<div class="form-group row">
							<label for="role" class="col-sm-2 col-form-label">Liste des permissions <samp class="float-right text-danger">*</samp></label>
							<div class="col-sm-10">
								<select id="permissions" class="form-control select2-multiple" multiple  name="permission[]" >
									@foreach ($permissions as $permission)
										<option value="{{$permission->id}}"   @if ( in_array($permission->id, $rolePermissionsId)) selected @endif >{{$permission->libelle}}</option>
									@endforeach
								</select>
							</div>
						</div>


						<div class="text-right">
							<a href="{{ URL::previous() }}" class="btn btn-secondary waves-effect m-l-5">Cancel</a>
							<button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
						</div>

					</div>
				</form>
			</div>
		</div><!-- end col -->
	</div>
@endsection

@section('head')
	<link href="{{asset('assets/css/clients-ajouter.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/plugins/select2/css/select2.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/role_permission.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('js')
	<!--select2-->
	<script src="{{asset('assets/plugins/select2/js/select2.js')}}" ></script>
	<script src="{{asset('assets/js/pages/select2/select2-init.js')}}" ></script>
@endsection