@extends('default')

@section('head_title')
	Modifier Une Agence 
@endsection

@section('title')
	Modifier Une Agence 
@endsection


@section('head')

@endsection
@section('content')
	<div class="row">
		
		<div class="col-12">

			<div class="card m-b-30">
				<div class="card-header">
					<h4 class="header-title"> <span class="fa fa-home"></span> Formulaire De modification De l'Agence N°: {{$agence->id}}</h4>
				</div>

				<form name="ajout_user" action="{{route('agence.update',$agence->id)}}" method="post">
					@csrf
					<div class="card-body">
						<div class="form-group row"><label for="code_agence" class="col-sm-2 col-form-label">Code Agence</label><div class="col-sm-10"><input class="form-control" name="code_agence" type="text" id="code_agence" value='{{$agence->CODE}}' readonly></div></div>
						
						<div class="form-group row">
							<label for="email_agence" class="col-sm-2 col-form-label" >Adresse Email Agence <samp class="float-right text-danger">*</samp></label><div class="col-sm-10"><input class="form-control" name="email_agence" type="text" id="email_agence" value="{{$agence->EMAIL}}">
							</div>
						</div>
						<div class="form-group row">
							<label for="chef_agence" class="col-sm-2 col-form-label">Chef d'Agence </label><div class="col-sm-10"><input class="form-control" name="chef_agence" type="text" id="chef_agence" value="{{$agence->CHEF_AGENCE}}"></div></div>
						<div class="form-group row">
							<label  class="col-sm-2 col-form-label" for="type_agence">Type d'Agence <samp class="float-right text-danger">*</samp></label>
							<div class="col-sm-10">
								<select class="form-control" name="type_agence" id="type_agence">
									<option value="4" @if( $agence->TYPE_AGENCE =="4") selected @endif> AG-A </option>
									<option value="2" @if( $agence->TYPE_AGENCE =="2") selected @endif> AG-P </option>
									<option value="3" @if( $agence->TYPE_AGENCE =="3") selected @endif> AG-D </option>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label for="statut_agence" class="col-sm-2 col-form-label" >Statut de l'Agence</label>
							<div class="col-sm-10">
								<select class="form-control" name="statut" id="statut_agence">
									<option value="1" @if( $agence->STATUT ===1) selected @endif>Actif</option>
									<option value="0" @if( $agence->STATUT ===0) selected @endif>Innactif</option>
								</select>
							</div>
						</div>
						

						<div class="form-group row">
							<label for="direction" class="col-sm-2 col-form-label">Direction <samp class="float-right text-danger">*</samp></label>
							<div class="col-sm-10">
								<select class="form-control" name="direction" id="direction">
									<option value="49"  @if( $agence->DR ==="49") selected @endif>Direction Alger Est</option>
									<option value="16"  @if( $agence->DR ==="16") selected @endif>Direction Alger Ouest</option>
									<option value="09"  @if( $agence->DR ==="09") selected @endif>Direction Blida</option>
									<option value="31"  @if( $agence->DR ==="31") selected @endif>Direction Oran</option>
									<option value="19"  @if( $agence->DR ==="19") selected @endif>Direction Setif</option>
									<option value="23"  @if( $agence->DR ==="23") selected @endif>Direction Annaba</option>
									<option value="13"  @if( $agence->DR ==="13") selected @endif>Direction Tlemcen</option>
								</select>
							</div>
						</div>

						<div class="text-right"><a href="{{ URL::previous() }}" class="btn btn-secondary waves-effect m-l-5">Annuler</a> <button type="submit" class="btn btn-primary waves-effect waves-light">Modifier</button></div>
						
					</div>
				</form>
			
	</div>	


	
	</div>
	</div><!-- end col -->
@endsection


@section('js')
<script>
function goBack() {
  history.back(-2);
}
</script> 
@endsection