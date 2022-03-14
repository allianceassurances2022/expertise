@extends('default')

@section('head_title')
	Création Expertise
@endsection

@section('title')
Choix Expertise
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
				<p style="margin-top: 9px; margin-bottom: 9px;"> Création Expertise pour ODS N°: {{ $ods->num_ods }} </p>
			</div>	
			<div class="col-sm-6">
				<p style="margin-top: 9px; margin-bottom: 9px;"> Dossier N°: {{ $ods->ref_sinistre }} </p>
			</div>	
		</div>
	</div>
</div>

</br>

		<div class="row">

			<div class="col-xl-4 ">
				<div class="card m-b-30 card-body text-center">
					<img src="{{asset('assets/images/reperation.svg')}}" class="illustration">
					<h4 class="card-title font-20 mt-0">PV EXPERTISE AUTOMOBILE</h4>
					<form action="{{route('expertise.new')}}" method="post" >
						@csrf
						<input type="hidden" name="id" value="{{ $ods->id }}">
						<input type="hidden" name="model" value="1">
						<button class="btn btn-block btn-primary waves-effect waves-light"><i class="fa fa-plus"></i> Création</button>
					</form>
				</div>
			</div>

			<div class="col-xl-4 ">
				<div class="card m-b-30 card-body text-center">
					<img src="{{asset('assets/images/reforme.svg')}}" class="illustration">
					<h4 class="card-title font-20 mt-0">PV DE REFORME</h4>
					<form action="{{route('expertise.new')}}" method="post" >
						@csrf
						<input type="hidden" name="id" value="{{ $ods->id }}">
						<input type="hidden" name="model" value="2">
						<button  class="btn btn-block btn-primary waves-effect waves-light"><i class="fa fa-plus"></i> Création</button>
					</form>
				</div>
			</div>

			<div class="col-xl-4 ">
				<div class="card m-b-30 card-body text-center">
					<img src="{{asset('assets/images/vol.svg')}}" class="illustration">
					<h4 class="card-title font-20 mt-0">PV VOL TOTAL</h4>
					<form action="{{route('expertise.new')}}" method="post" >
						@csrf
						<input type="hidden" name="id" value="{{ $ods->id }}">
						<input type="hidden" name="model" value="3">
						<button  class="btn btn-block btn-primary waves-effect waves-light"><i class="fa fa-plus"></i> Création</button>
					</form>
				</div>
			</div>

		</div>

		<div class="row">

			<div class="col-xl-4 ">
				<div class="card m-b-30 card-body text-center">
					<img src="{{asset('assets/images/incendie.svg')}}" class="illustration">
					<h4 class="card-title font-20 mt-0">PV INCENDIE VEHICULE</h4>
					<form action="{{route('expertise.new')}}" method="post" >
						@csrf
						<input type="hidden" name="id" value="{{ $ods->id }}">
						<input type="hidden" name="model" value="4">
						<button class="btn btn-block btn-primary waves-effect waves-light"><i class="fa fa-plus"></i> Création</button>
					</form>
				</div>
			</div>

			<div class="col-xl-4 ">
				<div class="card m-b-30 card-body text-center">
					<img src="{{asset('assets/images/ras.svg')}}" class="illustration">
					<h4 class="card-title font-20 mt-0">PV R.A.S</h4>
					<form action="{{route('expertise.new')}}" method="post" >
						@csrf
						<input type="hidden" name="id" value="{{ $ods->id }}">
						<input type="hidden" name="model" value="5">
						<button  class="btn btn-block btn-primary waves-effect waves-light"><i class="fa fa-plus"></i> Création</button>
					</form>
				</div>
			</div>

			<div class="col-xl-4 ">
				<div class="card m-b-30 card-body text-center">
					<img src="{{asset('assets/images/carence.svg')}}" class="illustration">
					<h4 class="card-title font-20 mt-0">PV CARENCE</h4>
					<form action="{{route('expertise.new')}}" method="post" >
						@csrf
						<input type="hidden" name="id" value="{{ $ods->id }}">
						<input type="hidden" name="model" value="6">
						<button  class="btn btn-block btn-primary waves-effect waves-light"><i class="fa fa-plus"></i> Création</button>
					</form>
				</div>
			</div>

		</div>



@endsection
