@extends('default')

@section('head_title')
PV Expertise ID {{ $expertise->id }} ({{ $ods->ref_sinistre }})
@endsection

@section('title')
PV Expertise Automobile
@endsection


@section('head')
<link href="{{asset('assets/plugins/select2/css/select2.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{asset('assets/css/ODSStyling.css')}}">
<style>
#chocs table.dataTable.nowrap th, #chocs table.dataTable.nowrap td {
	white-space: nowrap;
	width: 1% !important;
}
		/*table.dataTable.nowrap th, table.dataTable.nowrap td {
		    width: 23% !important;
		    text-align: center;
		    }*/

		    #chocs_list table.dataTable.nowrap th, #chocs_list table.dataTable.nowrap td {
		    	width: 23% !important;
		    	text-align: center;
		    }


		</style>
		@endsection

@section('content')

@if($expertise->code)
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-sm-12 text-center">
				Code Validation :  {{ $expertise->code }}
			</div>
		</div>
	</div>
</div>

</br>

@endif


<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-sm-4">
				<p style="    margin-top: 9px; margin-bottom: 9px;"> PV ID {{ $expertise->id }} ({{ $ods->ref_sinistre }})</p>
			</div>
			{{-- <div class="col-sm-4">
				<p style="    margin-top: 9px; margin-bottom: 9px;"> Status : {{$status_ods->libelle}} </p>
			</div> --}}
			<div class="col-sm-4">
				<p style="    margin-top: 9px; margin-bottom: 9px;"> Traitement @if($expertise->type=="1") Expertise @endif @if($expertise->type=="2") Additif @endif @if($expertise->type=="3") Contre Expertise @endif </p>
			</div>
		</div>
		@if($expertise->status=="1" && $expertise->motif_rejet != "")
		<div class="row">
			<div class="col-sm-12">
				<h4 style="color: #ea5c5c;">Expertise Rejetée</h4>
				<h7 style="color: #ea5c5c;font-weight: bold;text-decoration: underline;">Motif de rejet :</h7>
				<p style="color: #ea5c5c;">{{$expertise->motif_rejet}}</p>
			</div>
		</div>
		@endif
	</div>
</div>




		<div id="details_ods" class="liste">
			<div class="row">
				<div class="col-sm-12">
					<div id="accordion11" class="formulaire-recherche">
						<div class="card">
							<div class="card-header" id="headingOne">
								<h5 class="mb-0 mt-0 font-16">
									<a data-toggle="collapse" data-parent="#accordion11" href="#collapse11" aria-expanded="true" aria-controls="collapse11" class="text-dark"><i class="mdi mdi-folder-outline" style="margin-top: 15px;"></i> Details ODS <span class="ion-arrow-down-b"></span></a>
								</h5>
							</div>
							<div id="collapse11" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion11" style="">
								<div class="card-body">
									<div class="row">
										<div class="col-md-4">
											<h6><i class="ion-information-circled"></i> Information de l'ODS</h6>
											<div class="form-group">
												<label>N° Sinistre</label>
												<input type="text" class="form-control" required="" name="ref_sinistre" placeholder="" readonly value="{{ $ods->ref_sinistre }}">
											</div>
											<div class="form-group">
												<label>Date Sinistre</label>
												<input type="date" class="form-control" required="" name="date_sinistre" placeholder="" readonly value="{{ $ods->date_sinistre }}">
											</div>
											<div class="form-group">
												<label>Police</label>
												<input type="text" class="form-control" required="" name="ref_police" placeholder="" readonly value="{{ $ods->ref_police }}">
											</div>
											<div class="form-group">
												<label>Assuré/Tiers</label>
												<input type="text" class="form-control" required="" name="tiers" placeholder="" readonly value="{{ $ods->nom_tiers . ' ' . $ods->prenom_tiers }}">
											</div>
											<div class="form-group">
												<label>N° Téléphone</label>
												<input type="text" class="form-control" name="num_tel" placeholder="" readonly value="{{ $ods->num_tel }}">
											</div>
										</div>
										<div class="col-md-4">
											<h6><i class="ion-information-circled"></i> Information de l'ODS</h6>
											<div class="form-group">
												<label>Date</label>
												<input type="date" class="form-control" required="" placeholder="" name="date_ods" readonly value="{{ $ods->date_ods }}">
											</div>
											<div class="form-group">
												<label>Expert</label>
												<input type="text" class="form-control" required="" placeholder="" name="expert" readonly value="{{ $ods->expert }}">
											</div>
											<div class="form-group">
												<label>Matricule</label>
												<input type="text" class="form-control" required="" name="matricule" placeholder="" readonly value="{{ $ods->matricule }}">
											</div>
											<div class="form-group">
												<label>Remarque</label>
												<textarea class="form-control" required="" name="remarque" placeholder="" readonly>{{ $ods->remarque }}</textarea>
											</div>
										</div>
										<div class="col-md-4">
											<h6><i class="ion-information-circled"></i> Information de l'ODS</h6>
											<div class="form-group">
												<label>Marque</label>
												<input type="text" class="form-control" required="" placeholder="" name="marque" readonly value="{{ $ods->marque }}">
											</div>
											<div class="form-group">
												<label>Model</label>
												<input type="text" class="form-control" required="" placeholder="" name="model" readonly value="{{ $ods->model }}">
											</div>
											<div class="form-group">
												<label>N° Serie</label>
												<input type="text" class="form-control" required="" placeholder="" name="num_serie" id="num_serie" readonly value="{{ $ods->num_serie }}">
											</div>
											<div class="form-group">
												<label>Puissance</label>
												<input type="text" class="form-control" name="num_tel" placeholder="" readonly value="{{ $ods->libelle_puissance }}">
											</div>
											<div class="form-group">
												<label>Carburant</label>
												<input type="text" class="form-control" name="num_tel" placeholder="" readonly value="{{ $ods->carburant }}">
											</div>
											<div class="form-group">
												<label>Couleur</label>
												<input type="text" class="form-control" name="num_tel" placeholder="" readonly value="{{ $ods->couleur }}">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		</br>

<div class="card">
	<div class="card-body">
		<form action="{{route('expertise.store')}}" method="post">
			@csrf

			<div class="row">
				<div class="col-md-3">
					<h6><i class="ion-information-circled"></i> Information</h6>
					<div class="form-group">
						<label>Date d'Expertise</label>
						<input type="date" class="form-control" required onfocusout="verif_champ_date();" name="date_expertise" value="{{$expertise->date_expertise}}" id="date_expertise">
					</div>
				</div>
				<div class="col-md-3">
					<h6><i class="ion-information-circled"></i> Information</h6>
					<div class="form-group">
						<label>Heure d'Expertise</label>
						<input type="time" class="form-control" required onfocusout="verif_champ_heure();" name="heure_expertise" value="{{$expertise->heure_expertise}}" id="heure_expertise">
					</div>
				</div>
				<div class="col-md-3">
					<h6><i class="ion-information-circled"></i> Information</h6>
					<div class="form-group">
						<label>Lieu d'Expertise</label>
						<input type="text" class="form-control" required name="lieu_expertise" value="{{$expertise->lieu_expertise}}" id="lieu_expertise">
					</div>
				</div>
				<div class="col-md-3">
					<h6><i class="ion-information-circled"></i> Information</h6>
					<div class="form-group">
						<label>Couleur véhicule</label>
						<input type="text" class="form-control" required name="couleur" value="{{$expertise->couleur}}" id="couleur">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<h6><i class="ion-information-circled"></i> Information</h6>
					<div class="form-group row">
						<label class="col-sm-8 col-form-label col-form-label-sm">Selon la déclaration de l'assuré, quel Taux de responsabilité estimez-vous ?</label>
						{{-- <input type="text" class="form-control" required name="taux_resp" value="{{$expertise->taux_resp}}" id="couleur"> --}}
						<select class="col-sm-2 col-form-label col-form-label-sm" name="taux_resp" id="taux_resp">
							<option value="0" @if($expertise->taux_resp == 0) selected @endif>0 %</option>
							{{-- <option value="25" @if($expertise->taux_resp == 25) selected @endif>25 %</option> --}}
							<option value="50" @if($expertise->taux_resp == 50) selected @endif>50 %</option>
							{{-- <option value="75" @if($expertise->taux_resp == 75) selected @endif>75 %</option> --}}
							<option value="100" @if($expertise->taux_resp == 100) selected @endif>100 %</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<h6><i class="ion-information-circled"></i> Information</h6>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label col-form-label-sm">Valeur Vénale</label>
						<input class="col-sm-6 col-form-label col-form-label-sm" type="number" class="form-control" required name="valeur_venal" value="{{$expertise->valeur_venal}}" id="valeur_venal">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Observation</label>
						<textarea class="form-control" placeholder="" LINE="10" rows="8" name="observation">{{$expertise->observation}}</textarea>
					</div>
				</div>
			</div>



			@if($expertise->status=="1")
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary waves-effect waves-light">Sauvegarder</button>
				</div>
			</div>
			@endif
			            <input type="hidden" name="id_ods" value="{{ $ods->id }}">
			            <input type="hidden" name="expertise_id" value="{{ $expertise->id }}">
		</form>
	</div>
</div>

		<div id="chocs" class="liste">
			<div class="row">
				<div class="col-sm-12">
					<div id="accordion3" class="formulaire-recherche">
						<div class="card">
							<div class="card-header" id="headingOne" style="height: 64px;">
								<h5 class="mb-0 mt-0 font-16">
									<a data-toggle="collapse" data-parent="#accordion3" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="text-dark"><i class="mdi mdi-folder-outline" style="margin-top: 15px;"></i> Liste Des chocs</a>


									@if($expertise->status<="1")
									@if(auth()->user()->hasAnyPermission(['add choc']))
									<div class="dropdown  float-right" style="display: block; top: -32px;">
										<a class="btn btn-danger dropdown-toggle" href="https://example.com" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											@if($expertise->type<="1")
											Ajouter Un Choc
											@endif
											@if($expertise->type=="2")
											Séléctionner Un Choc
											@endif
										</a>

										<div class="dropdown-menu " aria-labelledby="dropdownMenuLink" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;position: absolute !important;top: -9px !important; right: 0 !important;">
											@foreach($choc_listes as $choc_liste )
											<a class="dropdown-item" href="{{route('choc.creer',[$expertise->id,$choc_liste->choc ])}}">Choc "{{$choc_liste->choc}}"</a>
											@endforeach
                                    {{-- <a class="dropdown-item" href="{{route('choc.creer',[$expertise->id,'A'])}}">Choc "A"</a>
                                    <a class="dropdown-item" href="{{route('choc.creer',[$expertise->id,'B'])}}">Choc "B"</a>
                                    <a class="dropdown-item" href="{{route('choc.creer',[$expertise->id,'C'])}}">Choc "C"</a>
                                    <a class="dropdown-item" href="{{route('choc.creer',[$expertise->id,'D'])}}">Choc "D"</a> --}}
                                        </div>
                                    </div>
                                     @endif
                                    @endif
                                </h5>


                    </div>
                    <div id="collapseThree" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion3" style="">
                    	<div class="card-body">
                    		<div class="row">
                    			<form>
                    				@csrf
                    			</form>
                    			<div class="col-sm-12">
                    				<table id="choc" class="table dataTable table-responsive table-hover display responsive nowrap">
                    					<thead>
                    						<tr>
                    							<th>ID</th>
                    							<th>Nom</th>
                    							<th>Description</th>
                    							<th>Montant TTC</th>
                    							<!-- <th>Statut</th> -->
                    							<th>Action</th>
                    						</tr>
                    					</thead>
                    					<tbody>
                    					</tbody>
                    				</table>
                    			</div>
                    		</div>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</br>

<div id="chocs_list" class="liste">
	<div class="row">
		<div class="col-sm-12">
			<div id="accordion8" class="formulaire-recherche">
				<div class="card">
					<div class="card-header" id="headingPro">
						<h5 class="mb-0 mt-0 font-16">
							<a data-toggle="collapse" data-parent="#accordion8" href="#collapse44" aria-expanded="true" aria-controls="collapse44" class="text-dark"><i class="mdi mdi-folder-outline"></i> Liste Des fournitures<span class="ion-arrow-down-b"></span></a>
						</h5>
					</div>
					<div id="collapse44" class="collapse show" aria-labelledby="headingPro" data-parent="#accordion8" style="">
						<div class="card-body">
							<div class="row">
								<form>
									@csrf
								</form>
								<div class="col-sm-12">
									<table id="fourniture" class="table dataTable table-responsive table-hover display responsive nowrap">
										<thead>
											<tr>
												<th>Article</th>
												<th>Description</th>
												<th>Prix Unitaire</th>
												<th>Quantité</th>
												<th>Montant Général</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</br>

<div class="card">
	<div class="card-body">
		<div class="row">
			{{-- <div class="col-md-6">
				<h6><i class="ion-information-circled"></i> Montant</h6>
				<div class="form-group">
					<label>Montant Hors Taxe</label>
					<input class="form-control" required="" name="remarque" placeholder="{{$expertise->MHT_expertise}} DA" readonly style="font-size: 2em; padding: 25px 15px;">
				</div>
			</div> --}}
			<div class="col-md-12">
				<h6><i class="ion-information-circled"></i> Montant</h6>
				<div class="form-group">
					<label>Montant Toute Taxe Comprise</label>
					<input class="form-control" required="" name="remarque" placeholder="{{number_format($expertise->MTC_expertise, 2, ',', ' ')}} DA" readonly style="font-size: 2em; padding: 25px 15px;">
				</div>
			</div>
		</div>
		{{-- <div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Remarque</label>
					<textarea class="form-control" required="" name="remarque" placeholder="Type something" readonly>{{ $ods->remarque }}</textarea>
				</div>
			</div>
		</div> --}}
	</div>
</div>

</br>

<div id="honoraire" class="liste">
	<div class="row">
		<div class="col-sm-12">
			<div id="accordion9" class="formulaire-recherche">
				<div class="card">
					<div class="card-header" id="headingPro">
						<h5 class="mb-0 mt-0 font-16">
							<a data-toggle="collapse" data-parent="#accordion9" href="#collapse44" aria-expanded="true" aria-controls="collapse44" class="text-dark"><i class="mdi mdi-folder-outline"></i> Honoraire<span class="ion-arrow-down-b"></span></a>
						</h5>
					</div>
					<div id="collapse44" class="collapse show" aria-labelledby="headingPro" data-parent="#accordion9" style="">
						<div class="card-body">
							<div class="row">
								<div class="col-sm-12">
									<table id="honoraire" class="table dataTable table-responsive table-hover display responsive nowrap">
										<thead>
											<tr>
												<th>Libellé</th>
												<th>Nombre</th>
												<th>Montant</th>
											</tr>
										</thead>
										<tbody>
												@foreach ($honoraires as $honoraire)
												<tr>
												<td>{{$honoraire->libelle}}</td>
												<td>{{$honoraire->nombre}}</td>
												<td>{{number_format($honoraire->montant, 2, ',', ' ')}} DA</td>
												</tr>
												@endforeach
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12 text-right">
									Montant Total honoraire : <label style="font-size: large;">  {{number_format($somme, 2, ',', ' ')}} DA</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</br>

<div class="card">
	<div class="card-body">
		<div class="row">

			@if($expertise->status=="1")

			<div class="col-sm-12 text-right">
				@if(auth()->user()->hasAnyPermission(['valider expertise']))
				<div class="btn-group">
					<form action="{{route('expertise.delete',$expertise->id)}}" method="post">
						@csrf
						<button  class="btn btn-danger" ><i class="typcn typcn-trash"></i> Supprimer</button>
					</form>
				</div>
				<div class="btn-group">
					<button type="button" class="btn btn-success" onclick="myFunctionValider()">Valider</button>
				</div>
				@endif
				@if(auth()->user()->hasAnyPermission(['edit honoraire']))
				<div class="btn-group">
					<a href="{{route('expertise.honoraire',$expertise->id)}}" class="btn btn-warning" >Honoraire</a>
				</div>
				@endif
                @if(auth()->user()->hasAnyPermission(['edit photo']))
                <div class="btn-group">
					<a href="{{route('expertiseImage',$expertise->id)}}" class="btn btn-info" >Photos</a>
				</div>
                @endif
			</div>
			@endif
			@if($expertise->status=="2")
			<div class="col-sm-12 text-right">
				<div class="btn-group">
					@if(auth()->user()->hasAnyPermission(['devalider expertise']))
					<button type="button" class="btn btn-danger" onclick="myFunctionDevalider()">Rejeter</button>
					@endif
				</div>
				<div class="btn-group">
					<a href="{{route('imprimmerHonoraire',$expertise->id)}}" class="btn btn-primary" ><i class="typcn typcn-printer"></i> Imprimmer Honoraire</a>
				</div>
				<div class="btn-group">
					<a href="{{route('imprimmer',$expertise->id)}}" class="btn btn-primary" ><i class="typcn typcn-printer"></i> Imprimmer PVE</a>
				</div>
				<div class="btn-group">
					@if(auth()->user()->hasAnyPermission(['valider expertise final']))
					<button type="button" class="btn btn-success" onclick="myFunctionValiderFinal()">Valider</button>
					@endif
				</div>
                @if(auth()->user()->hasAnyPermission(['edit photo']))
                <div class="btn-group">
					<a href="{{route('expertiseImage',$expertise->id)}}" class="btn btn-info" >Photos</a>
				</div>
                @endif
			</div>
			@endif
			@if($expertise->status=="3")
			<div class="col-sm-12 text-right">
				<div class="btn-group">
					<a href="{{route('imprimmerHonoraire',$expertise->id)}}" class="btn btn-primary" ><i class="typcn typcn-printer"></i> Imprimmer Honoraire</a>
				</div>
				<div class="btn-group">
					<a href="{{route('imprimmer',$expertise->id)}}" class="btn btn-primary" ><i class="typcn typcn-printer"></i> Imprimmer PVE</a>
				</div>
                @if(auth()->user()->hasAnyPermission(['edit photo']))
                <div class="btn-group">
					<a href="{{route('expertiseImage',$expertise->id)}}" class="btn btn-info" >Photos</a>
				</div>
                @endif
                @if(auth()->user()->hasAnyPermission(['davalider expertise final']))
                <div class="btn-group">
                <form action="{{route('expertise.devaliderFinal',$expertise->id)}}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir soumettre ?');">
                    @csrf

                        <button class="btn btn-lg btn-danger waves-effect waves-light">Dévalider expertise</button>

                </form>
                </div>
                @endif
			</div>
			@endif
		</div>
	</div>
</div>

<div class="my-wrapper3">
	<div class="my-modal">
		<div class="close"><p>X</p></div>
		<div class="row">
			<div class="col-sm-12">
				<h5 class="">Validation expertise</h5>
				<div class="row">
					<div class="col-md-12">
						<p>Etes vous sure de bien vouloir valider l'expertise ID {{ $expertise->id }}, cliquez sur retour afin d'annuler, ou cliquez sur valider afin de valider.</p>
					</div>
				</div>
				<form action="{{route('expertise.valider',$expertise->id)}}" method="post">
					@csrf
					{{-- <div class="row">
						<div class="form-group">
							<label>N° PV Expertise</label>
							<input type="text" class="form-control" required placeholder="Type something" name="num_pv" value="{{ $expertise->id }}">
						</div>
					</div> --}}
					<div class="divider"></div>
					<div class="row">
						<div class="col-sm-12 text-right buttons-list">
							<button type="button" class="btn btn-lg btn-secondary waves-effect waves-light close-btn"><i class="ion-android-system-back"></i> Retour</button>

							<button class="btn btn-lg btn-success waves-effect waves-light">Valider </button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="my-wrapper4">
	<div class="my-modal">
		<div class="close"><p>X</p></div>
		<div class="row">
			<div class="col-sm-12">
				<h5 class="">dévalidation expertise ID {{ $expertise->id }}</h5>
				<div class="row">
					<div class="col-md-12">
						<p>Etes vous sure de bien vouloir dévalider l'expertise ID {{ $expertise->id }}, cliquez sur retour afin d'annuler, ou cliquez sur valider afin de valider.</p>
					</div>
				</div>
				<form action="{{route('expertise.devalider',$expertise->id)}}" method="post">
					@csrf
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Motif de rejet </label>
							<textarea  class="form-control" name="motif_rejet" id="motif_rejet" required></textarea>
						</div>
					</div>
				</div>
				<div class="divider"></div>
				<div class="row">
					<div class="col-sm-12 text-right buttons-list">

							<button type="button" class="btn btn-lg btn-secondary waves-effect waves-light close-btn"><i class="ion-android-system-back"></i> Retour</button>

							<button class="btn btn-lg btn-success waves-effect waves-light">Dévalider </button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="my-wrapper5">
	<div class="my-modal">
		<div class="close"><p>X</p></div>
		<div class="row">
			<div class="col-sm-12">
				<h5 class="">Validation expertise ID {{ $expertise->id }}</h5>
				<div class="row">
					<div class="col-md-12">
						<p>Etes vous sure de bien vouloir valider l'expertise ID {{ $expertise->id }}, une fois valider vous ne pouvez plus la dévalider, cliquez sur retour afin d'annuler, ou cliquez sur valider afin de valider.</p>
					</div>
				</div>
				<div class="divider"></div>
				<div class="row">
					<div class="col-sm-12 text-right buttons-list">
						<form action="{{route('expertise.valider_final',$expertise->id)}}" method="post">
							<button type="button" class="btn btn-lg btn-secondary waves-effect waves-light close-btn"><i class="ion-android-system-back"></i> Retour</button>
							@csrf
							<button class="btn btn-lg btn-success waves-effect waves-light">Valider </button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js')
<!--select2-->
<script src="{{asset('assets/plugins/select2/js/select2.js')}}" ></script>
<script src="{{asset('assets/js/pages/select2/select2-init.js')}}" ></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

<script>
	function verif_champ_date(){
		var now = new Date();
		var datedujour = now.toISOString().split('T')[0];
		var heure = ('0'+now.getHours()  ).slice(-2);
		var minute = ('0'+now.getMinutes()  ).slice(-2);
		var heuredujour = heure + minute ;
		var heuresaisi = $('#heure_expertise').val();
		heuresaisi = heuresaisi.replace(':','');
		if($('#date_expertise').val() > datedujour ){
			alert('Date supèrieure a la date du jours');
			$('#date_expertise').val(datedujour);
		}
	}
	function verif_champ_heure(){
		var now = new Date();
		var datedujour = now.toISOString().split('T')[0];
		var heure = ('0'+now.getHours()  ).slice(-2);
		var minute = ('0'+now.getMinutes()  ).slice(-2);
		var heuredujour = heure + minute ;
		var heuresaisi = $('#heure_expertise').val();
		heuresaisi = heuresaisi.replace(':','');
		if($('#date_expertise').val() == datedujour && heuresaisi > heuredujour) {
			alert('Heure supèrieure a l\'heure actuel');
			$('#heure_expertise').val(heuredujour);
		}
	}
</script>

<script>

	var id_expertise="{{$expertise->id}}";
	var selectedchoc;
	var id_choc;

	///////////////////////////////////////////////////////////////////////////////////////

	$( document ).ready(function() {

		myFunctionValider = function(){

		        $( ".my-wrapper3" ).fadeIn( "slow");
		        $('body').css( "height","100vh");
		        $('body').css( "overflow-y","hidden");



		        $( ".my-wrapper3 .close, .my-wrapper3 .close-btn" ).click(function() {
		        	$( ".my-wrapper3" ).fadeOut( "slow", function() {});
		        	$('body').css( "height","auto");
		        	$('body').css( "overflow","auto");

		        });

		    }

		    myFunctionDevalider = function(){

		        $( ".my-wrapper4" ).fadeIn( "slow");
		        $('body').css( "height","100vh");
		        $('body').css( "overflow-y","hidden");


		        $( ".my-wrapper4 .close, .my-wrapper4 .close-btn" ).click(function() {
		        	$( ".my-wrapper4" ).fadeOut( "slow", function() {});
		        	$('body').css( "height","auto");
		        	$('body').css( "overflow","auto");

		        });

		    }

		    myFunctionValiderFinal = function(){

		        $( ".my-wrapper5" ).fadeIn( "slow");
		        $('body').css( "height","100vh");
		        $('body').css( "overflow-y","hidden");


		        $( ".my-wrapper5 .close, .my-wrapper5 .close-btn" ).click(function() {
		        	$( ".my-wrapper5" ).fadeOut( "slow", function() {});
		        	$('body').css( "height","auto");
		        	$('body').css( "overflow","auto");

		        });

		    }

		    $( "#details_ods h5 a" ).trigger("click");

		    function currencyFormat(num) {
			  return (
			    num
			      .toFixed(2) // always two decimal digits
			      .replace('.', ',') // replace decimal point character with ,
			      .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 ') + ''
			  ) // use ' ' as a separator
			}


			var table_choc = $('#choc').DataTable({
				"responsive": true,
				"autoWidth": true,
				"columns": [
				{"data": "id", "orderable": true, "searchable": true},
				{"data": "choc", "orderable": true, "searchable": true},
				{"data": "description", "orderable": true, "searchable": true},
				{"data": "MTC_choc", "orderable": true, "searchable": true,
				"render" : function(data, type, row) {
					return currencyFormat(Number(row.MTC_choc));
				}},
					// {"data": "etat", "orderable": true, "searchable": true},
					{"data": "detail", "orderable": true, "searchable": true},

					],
					"rowId": 'id', // IdRow = Id_User in bd
					"processing": true,
					"serverSide": true,
					"ajax": {
						url: '{{route('expertise.choc_table')}}',
						type: 'POST',
						data: {
							'_token': function () {
								return $('input[name="_token"]').val();
							},
							'id_expertise': function(){ return id_expertise ;}
						}
					},

					"order": [[0, "asc"]],
					"searching": true,
					"deferRender": true,
					"scrollY":"180px",
					"language": {
						"info": " page : _PAGE_ sur _PAGES_   (de _START_ à _END_ sur un total de : _TOTAL_ enregistrements )",
						"infoEmpty": "Pas de résultat",
						"infoFiltered": " - Filtere dans _MAX_ enregistrements",
						"decimal": "",
						"emptyTable": "Pas de résultat",
						"infoPostFix": "",
						"thousands": ",",
						"lengthMenu": " <select>" +
						'<option value="10">10</option>' +
						'<option value="20">20</option>' +
						'<option value="30">30</option>' +
						'<option value="40">40</option>' +
						'<option value="50">50</option>' +
						'<option value="100">100</option>' +
						'<option value="-1">Tous</option>' +
								"</select>  lignes à afficher", //_MENU_

								"loadingRecords": "Veuillez patienter - Chargement...",
//"processing":     "<img src='{{asset('assets/images/loading_bar.gif')}}' > Chargement...",
"search": "Recherche:",
"zeroRecords": "Pas de résultat",
"paginate": {
	"first": "Premier",
	"last": "Dernier",
	"next": "Suivant",
	"previous": "précédent"
}
}
});
			table_choc.columns().every(function () {
				var that = this;

				$('#accordion3 input,#accordion3 select', this.footer()).on('keyup change', function () {
					if (that.search() !== this.value) {
						that
						.search(this.value)
						.draw();
					}
				});
			});

			$("#choc tbody").delegate('tr', 'click', function() {

				$("#choc .highlight").removeClass('highlight');
				$( this ).addClass('highlight');
				selectedchoc = table_choc.row( this ).data();
				id_choc=selectedchoc.id;

				if (  $.fn.DataTable.isDataTable( $('#fourniture') ) ) {
					$('#fourniture').DataTable().ajax.reload();
					return;
				}

				tableFourniture();

			});



////////////////////////////////////////////////////////////////////////////////////////////////////////////

});


////////////////////////////////////////////////// table fourniture

function currencyFormat(num) {
			  return (
			    num
			      .toFixed(2) // always two decimal digits
			      .replace('.', ',') // replace decimal point character with ,
			      .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 ') + ''
			  ) // use ' ' as a separator
			}

function tableFourniture(){
	table_fourniture = $('#fourniture').DataTable({
		"responsive": true,
		"autoWidth": true,
		"columns": [

		{"data": "libelle", "orderable": true, "searchable": true},
		{"data": "intitule", "orderable": true, "searchable": true},
		{"data": "price", "orderable": true, "searchable": true,
		"render" : function(data, type, row) {
					return currencyFormat(Number(row.price));
				}},
		{"data": "nb", "orderable": true, "searchable": true},
		{"data": "total", "orderable": true, "searchable": true,
		"render" : function(data, type, row) {
					return currencyFormat(Number(row.total));
				}},

		],
					"rowId": 'id', // IdRow = Id_User in bd
					"processing": true,
					"serverSide": true,
					"ajax": {
						url: '{{route('expertise.fourniture_table')}}',
						type: 'POST',
						data: {
							'_token': function () {
								return $('input[name="_token"]').val();
							},
							'id_choc': function(){ return id_choc ;}
						}
					},

					"order": [[0, "asc"]],
					"searching": true,
					"deferRender": true,
					"scrollY": "108px",
					"language": {
						"info": " page : _PAGE_ sur _PAGES_   (de _START_ à _END_ sur un total de : _TOTAL_ enregistrements )",
						"infoEmpty": "Pas de résultat",
						"infoFiltered": " - Filtere dans _MAX_ enregistrements",
						"decimal": "",
						"emptyTable": "Pas de résultat",
						"infoPostFix": "",
						"thousands": ",",
						"lengthMenu": " <select>" +
						'<option value="10">10</option>' +
						'<option value="20">20</option>' +
						'<option value="30">30</option>' +
						'<option value="40">40</option>' +
						'<option value="50">50</option>' +
						'<option value="100">100</option>' +
						'<option value="-1">Tous</option>' +
								"</select>  lignes à afficher", //_MENU_
								"loadingRecords": "Veuillez patienter - Chargement...",
								"search": "Recherche:",
								"zeroRecords": "Pas de résultat",
								"paginate": {
									"first": "Premier",
									"last": "Dernier",
									"next": "Suivant",
									"previous": "précédent"
								}
							},

						});


	$("#fourniture tbody").delegate('tr', 'click', function() {

			    //console.log(table_tiers.row( this ).data());
			    //toggleRow_tiers(table_tiers.row( this ).data());
			    $("#fourniture .highlight").removeClass('highlight');
			    $( this ).addClass('highlight');
			    //selectedODS = table_traitement.row( this ).data();
		        //verif_null();
		    });


}


</script>

@endsection
