<div class="row">
	<div class="col-sm-12">
		<div id="accordion" class="formulaire-recherche">
			<div class="card">
				<div class="card-header" id="headingOne">
					<h5 class="mb-0 mt-0 font-16">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="text-dark">Formulaire de Recherche <span class="ion-arrow-down-b"></span></a>
					</h5>
				</div>
				<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" style="">
					<div class="card-body">
						<div class="card-body">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#home" role="tab" aria-selected="true">Rechercher</a></li>
								<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-selected="false">Rechercher Par Dossier Sinistre</a></li>
								<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages" role="tab" aria-selected="false">Rechercher Par Police</a></li>
							</ul><!-- Tab panes -->
							<div class="tab-content">
								<div class="tab-pane p-3 active show" id="home" role="tabpanel">
									<form action="" id="Formulaire_recherche">
										<div class="row">
											<div class="col-lg-2">
												<select id="direction" class="form-control select2"  name="recherche_direction">
													@foreach($directions as $direction)
														<option value="{{$direction->code}}">{{$direction->libelle}}</option>
													@endforeach
												</select> 
											</div>
											<div class="col-lg-2">
												<select id="agence" class="form-control select2"  name="recherche_agence">
													<option value="-1">All Agences</option>
												</select> 
											</div>
											<div class="col-lg-2">
												<input class="form-control" type="date" value="1970-08" id="date_debut" name="date_debut">								
											</div>
											<div class="col-lg-2">
												<input class="form-control" type="date" value="2020-08" id="date_fin" name="date_fin">
											</div>
											<div class="col-lg-2">
												<button type="submit" class="search-submit btn btn-block btn-primary waves-effect waves-light" style="font-size: 17px;">
													<i class="dripicons dripicons-search" style="font-size:13px;"></i> RECHERCHER</button>
											</div>
										</div>
									</form>
								</div>
								<div class="tab-pane p-3" id="profile" role="tabpanel">
									<form action="" id="Formulaire_sinistre">
										<div class="row">
											<div class="col-lg-10">
												<input class="form-control" type="text" placeholder="Dossier Sinistre" id="dossier_sinistre_r" name="dossier_sinistre_r">								
											</div>
											<div class="col-lg-2">
												<button type="submit" class="btn btn-block btn-primary waves-effect waves-light" style="font-size: 17px;">
													<i class="dripicons dripicons-search" style="font-size:13px;"></i> RECHERCHER</button>
											</div>
										</div>
									</form>
								</div>
								<div class="tab-pane p-3" id="messages" role="tabpanel">
									<form action="" id="Formulaire_police">
										<div class="row">
											<div class="col-lg-10">
												<input class="form-control" type="text" placeholder="Numero De Police" id="dossier_police_r" name="dossier_police_r">								
											</div>
											<div class="col-lg-2">
												<button type="submit" class="btn btn-block btn-primary waves-effect waves-light" style="font-size: 17px;">
													<i class="dripicons dripicons-search" style="font-size:13px;"></i> RECHERCHER</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>