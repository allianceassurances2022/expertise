@extends('default')

@section('head_title')
Ajouter Un Utilisateur
@endsection

@section('title')
Permissions de l'utilisateur {{$user->username}}
@endsection

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card m-b-30">
			<div class="card-header">
				<h4 class="header-title"> <span class="typcn typcn-user-add"></span> Affectation des permissions</h4>
			</div>

			<form name="ajout_role" action="{{route('utilisateur.role.update',$user->id)}}" method="post">
				@csrf

				<div class="card-body">
					<h4 class="header-title">Affectation des permissions à l'utilisateur: {{$user->username}}</h4>

					<div class="form-group row">
					 <label for="example-text-input" class="col-sm-2 col-form-label">Nom d'utilisateur </label>
					   <div class="col-sm-10"><input class="form-control" value="{{ $user->username }}" readonly name="username" type="text" id="example-text-input"></div>
					</div>

					<div class="form-group row">
						<label for="role" class="col-sm-2 col-form-label">Liste des Rôles </label>
						<div class="col-sm-10">
							<select id="roles" class="form-control select2-multiple" multiple  name="role[]" {{(count($userRoles) !=0 || count($userPermissions) ==0)? '': 'disabled' }}  >
								@foreach ($roles as $role)
									<option value="{{$role->id}}"   @if ( in_array($role->name, $userRoles)) selected @endif >{{$role->name}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<label for="role" class="col-form-label text-md-right">Liste des permissions </label>
						</div>
						<div class="col-md-8">
						    <div class="checkbox checkbox-primary">
								<input {{-- class="col-md-6" --}} type="checkbox" id="parPermission" name="parPermission" {{(count($userRoles) !=0 || count($userPermissions) ==0) ? '': 'checked="checked"' }}>
								<label for="parPermission" >Modifier les permissions </label>
							</div>
						</div>
                    </div> 

                    <div class="form-group row">
						<label for="permissions" class="col-md-4 col-form-label text-md-right">Permissions</label>
						<div class="col-md-8">		

							<select id="permissions" class="form-control select2-multiple" multiple  name="permissions[]"  {{(count($userRoles) !=0 || count($userPermissions) ==0) ? 'disabled': '' }}   >
								@foreach ($Permissions as $permission)
									<option value="{{$permission->id}}"   @if ( in_array($permission->name, $userPermissions)) selected @endif >{{$permission->libelle}}</option>
								@endforeach
							</select>   {{--  'user' , 'roles' , 'Permissions' , 'userRoles' , 'userPermissions' --}}
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
	<link href="{{asset('assets/plugins/select2/css/select2.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/role_permission.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('js')
	<!--select2-->
	<script src="{{asset('assets/plugins/select2/js/select2.js')}}" ></script>
	<script src="{{asset('assets/js/pages/select2/select2-init.js')}}" ></script>
	<script src="{{asset('assets/js/pages/user.js')}}" ></script>
@endsection