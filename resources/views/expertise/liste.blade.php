@extends('default')

@section('head_title')
	ODS en instance
@endsection

@section('title')
	ODS en instance
@endsection

@section('head')
	<link href="{{asset('assets/plugins/select2/css/select2.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="{{asset('assets/css/ODSStyling.css')}}">
	<style>

		#dossier_ods table.dataTable.nowrap th, #dossier_ods table.dataTable.nowrap td {
		    white-space: nowrap;
		    width: 7% !important;
		    text-align: center;
		}

		#dossier_ods table.dataTable.nowrap th:nth-child(1), #dossier_ods table.dataTable.nowrap td:nth-child(1){
		    white-space: nowrap;
		    width: 1% !important;
		}

		#dossier_ods table.dataTable.nowrap th:nth-child(2), #dossier_ods table.dataTable.nowrap td:nth-child(2){
		    white-space: nowrap;
		    width: 15% !important;
		}

		#dossier_ods table.dataTable.nowrap th:nth-child(7), #dossier_ods table.dataTable.nowrap td:nth-child(7){
		    white-space: nowrap;
		    width: 1% !important;
		}

		#dossier_ods table.dataTable.nowrap th:nth-child(7), #dossier_ods table.dataTable.nowrap td:nth-child(7){
		    white-space: nowrap;
		    width: 1% !important;
		}
		table.dataTable{
			height: 100% !important;
		}
	</style>
@endsection

@section('content')
	<div id="dossier_ods" class="liste">
		<div class="row">
			<div class="col-sm-12">
				<div id="accordion3" class="formulaire-recherche">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h5 class="mb-0 mt-0 font-16">
								<a data-toggle="collapse" data-parent="#accordion3" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="text-dark"><i class="mdi mdi-folder-outline"></i> Liste Des ODS<span class="ion-arrow-down-b"></span></a>
							</h5>
						</div>
						<div id="collapseThree" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion3" style="">
							<div class="card-body">
								<div class="row">
									<form>
										@csrf
									</form>
									<div class="col-sm-12">
										<table id="ods" class="table dataTable table-responsive table-hover display responsive nowrap">
										    <thead>
										        <tr>
										            <th>ID</th>
										            <th>N° Dossier</th>
										            <th>Date Sinistre</th>
										            <th>Date ODS</th>
										            <th>Assuré</th>
										            <th>Statut</th>
										            <th>Détail</th>
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

	<div id="dossier_ods" class="liste">
		<div class="row">
			<div class="col-sm-12">
				<div id="accordion4" class="formulaire-recherche">
					<div class="card">
						<div class="card-header" id="headingSix">
							<h5 class="mb-0 mt-0 font-16">
								<a data-toggle="collapse" data-parent="#accordion4" href="#collapseSix" aria-expanded="true" aria-controls="collapseSix" class="text-dark"><i class="mdi mdi-folder-outline"></i> Traitements (PVs)<span class="ion-arrow-down-b"></span></a>
							</h5>
						</div>
						<div id="collapseSix" class="collapse show" aria-labelledby="headingSix" data-parent="#accordion4" style="">
							<div class="card-body">
								<div class="row">
									<form>
										@csrf
									</form>
									<div class="col-sm-12">
										<table id="traitement" class="table dataTable table-responsive table-hover display responsive nowrap">
										    <thead>
										        <tr>
										            <th>N° PV</th>
										            <th>Type</th>
										            <th>N°</th>
										            <th>Expert</th>
										            <th>Date</th>
										            <th>Statut PV</th>
										            <th>Montant TTC</th>
										            <th>Détail</th>
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

	<div class="liste">
		<div class="row">
			<div class="col-sm-4 text-right">
				<form action="{{route('expertise.creer')}}" method="post" >
				  @csrf
				  <input type="hidden" name="id" id="id_ods">
				<button class="btn btn-success generer-ods"  id="bouton_creer" style="display:none;">Expertise</button>
			    </form>
			</div>
            <div class="col-sm-2 text-right">
				<form action="{{route('expertise.declaration')}}" method="post" >
				  @csrf
				  <input type="hidden" name="id" id="id_ods_declaration">
				<button class="btn  btn-info generer-ods"  id="bouton_declaration" style="display:none;">Déclaration</button>
			    </form>
			</div>
			<div class="col-sm-3 text-right">
				<form action="{{route('expertise.creerAdditif')}}" method="post" >
				  @csrf
				  <input type="hidden" name="id" id="id_ods_additif">
				<button class="btn  btn-success generer-ods" id="bouton_additif" style="display:none;">Additif</button>
				</form>
			</div>

			@if(auth()->user()->hasAnyPermission(['contre expertise']))
			<div class="col-sm-3 text-right">
				<form action="{{route('expertise.contre')}}" method="post" >
				  @csrf
				  <input type="hidden" name="id" id="id_contre_exertise">
				<button class="btn  btn-success generer-ods" id="bouton_contre" style="display:none;">Contre Expertise</button>
				</form>
			</div>
			@endif


			<div class="col-sm-12 text-right">
				<form action="{{route('expertise.modifierAdditif')}}" method="post" >
				  @csrf
				  <input type="hidden" name="id" id="id_expertise_additif">
				<button class="btn  btn-success generer-ods" id="bouton_modifier" style="display:none;">Additif</button>
				</form>
			</div>

            @if(auth()->user()->hasAnyPermission(['contre expertise']))
			<div class="col-sm-12 text-right">
				<form action="{{route('expertise.modifierContre')}}" method="post" >
				  @csrf
				  <input type="hidden" name="id" id="id_contre">
				<button class="btn  btn-success generer-ods" id="bouton_modifier_contre" style="display:none;">Contre Expertise</button>
				</form>
			</div>
			@endif

		</div>

        <div class="row">
            @if(auth()->user()->hasAnyPermission(['exlure ods']))
			<div class="col-sm-12 text-right">
				<form action="{{route('sendExlu')}}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir soumettre ?');">
				  @csrf
				  <input type="hidden" name="id" id="id_ods_exclur">
				<button class="btn btn-danger generer-ods" id="exclur_ods">Exclure ODS</button>
				</form>
			</div>
			@endif
        </div>
	</div>


<div class="my-wrapper">
	<div class="my-modal">
		<div class="close"><p>X</p></div>
		<div class="row">
			<div class="col-sm-12">
				<h5 class="titre"><i class="ti ti-folder icon-design"></i> Details de l'ODS N° </h5>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label> Numero Dossier sinistre: </label>
							<input disabled type="text" class="form-control" required="" id="num_sini">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Date Sinistre: </label>
							<input disabled type="text" class="form-control" required="" id="date_sini">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Assuré: </label>
							<input disabled type="text" class="form-control" required="" id="assure_sini">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>N° Police: </label>
							<input disabled type="text" class="form-control" required="" id="police_num">
						</div>
					</div>
					<!-- <div class="col-md-4">
						<div class="form-group">
							<label>Effet: </label>
							<input disabled type="text" class="form-control" required="" id="pol_effet">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Expiration: </label>
							<input disabled type="text" class="form-control" required="" id="pol_exp">
						</div>
					</div> -->
				</div>
				<div class="divider"></div>

				<h5 class="text-left font-weight-bold"><i class="ti ti-truck icon-design"></i> Vehicule </h5>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Marque: </label>
							<input disabled type="text" class="form-control" required="" id="veh_marque">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Model: </label>
							<input disabled type="text" class="form-control" required="" id="veh_model">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Matricule: </label>
							<input disabled type="text" class="form-control" required="" id="veh_mat">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>N° Serie: </label>
							<input disabled type="text" class="form-control" required="" id="num_ser">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Nom et Prenom du tiers: </label>
							<input disabled type="text" class="form-control" required="" id="tier_nom_pre">
						</div>
					</div>
				</div>
				<div class="divider"></div>

				<h5 class="text-left font-weight-bold"><i class="ti ti-user icon-design"></i> Expert</h5>
				<div class="row">
					<!-- <div class="col-md-6">
						<div class="form-group">
							<label>Code: </label>
							<input disabled type="text" class="form-control" required="" id="expert_code">
						</div>
					</div> -->
					<div class="col-md-12">
						<div class="form-group">
							<label>Nom et prenom: </label>
							<input disabled type="text" class="form-control" required="" id="nom_prenom">
						</div>
					</div>
				</div>
				<div class="divider"></div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Date de l'ODS: </label>
							<input disabled type="text" class="form-control" required="" id="ods_date_fait">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Remarque ODS: </label>
							<textarea disabled type="text" class="form-control" required="" rows="5" id="remarque"></textarea>
						</div>
					</div>
				</div>

				<div class="divider"></div>

				<div id="recap_pv">
					<h5 class="text-left font-weight-bold"> Recapitulatif N°</h5>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Date du PV: </label>
								<input disabled type="text" class="form-control" required="" id="pv_date">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Statut PV: </label>
								<input disabled type="text" class="form-control" required="" id="pv_statut">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Montant HT: </label>
								<input disabled type="text" class="form-control" required="" id="pv_montant_ht">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Montant TTC: </label>
								<input disabled type="text" class="form-control" required="" id="pv_montant_ttc">
							</div>
						</div>
					</div>
				</div>
				<div class="divider"></div>
				<div class="row">
					<div class="col-sm-12 text-right">
						<button type="button" class="btn btn-lg btn-secondary waves-effect waves-light close-btn"><i class="ion-android-system-back"></i> Retour</button>
						<a href="" class="btn btn-lg btn-primary waves-effect waves-light print-pdf"><i class="mdi mdi-printer"></i> Editer</a>
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

////////////////////////////////////////////////////////////////////// declaration globale
		var ref_sinis;
		var selectedODS;
		var selectedExpertise;
		var id_ods;
		var id_ods_declaration;
		var id_ods_exclur;
		var id_expertise_additif;
		var id_contre;
		var remarque_relance;

		function verif_null(){
				if (selectedODS) {
					$( "#bouton_creer" ).show("fast");
					$( "#bouton_declaration" ).show("fast");
				}
				if (selectedExpertise) {

					if(selectedExpertise.type=="Expertise"){

					$( "#bouton_additif" ).show("fast");
					//$( "#bouton_contre" ).show("fast");
					$( "#bouton_modifier" ).hide("fast");
					//$( "#bouton_modifier_contre" ).hide("fast");
				}else if(selectedExpertise.type=="Additif"){
					$( "#bouton_creer" ).hide();
					$( "#bouton_additif" ).hide("fast");
					//$( "#bouton_contre" ).hide("fast");
					$( "#bouton_modifier" ).show("fast");
					//$( "#bouton_modifier_contre" ).hide("fast");
				}else if(selectedExpertise.type=="Contre Expertise"){
					$( "#bouton_creer" ).hide("fast");
					$( "#bouton_additif" ).hide("fast");
					//$( "#bouton_contre" ).hide("fast");
					$( "#bouton_modifier" ).hide("fast");
					//$( "#bouton_modifier_contre" ).show("fast");
				}
				}else {
					$( "#bouton_additif" ).hide("fast");
					//$( "#bouton_contre" ).hide("fast");
					$( "#bouton_modifier" ).hide("fast");
					//$( "#bouton_modifier_contre" ).hide("fast");
				}

			}



///////////////////////////////////////////////////////////////////////////////////////

		$( document ).ready(function() {

////////////////////////////////////////////////////////////////////////// traitement creer



////////////////////////////////////////////////////////////////////////// chargement table ods

$('#ods thead tr').clone(true).appendTo( '#ods thead');

$('#ods thead tr:eq(1) th').each( function (i) {
    var title = $(this).text();
    if (title != "Détail"){
    $(this).html( '<input type="text" placeholder="Recherche '+title+'" />' );
    }


} );

		    // $('#ods tfoot th ').each(function () {
			// 	var title = $(this).text();
			// 	if (title != "Détail"){
			// 		$(this).html( '<input type="text" placeholder="Recherche" style="width:auto;"/>' );
			// 	}

			// });

			 myFunction = function(){
			 	// console.log(selectedODS);

				$( ".my-wrapper" ).fadeIn( "slow", function() {});
				$('body').css( "height","100vh");
				$('body').css( "overflow-y","hidden");
				$('#num_sini').val(selectedODS.ref_sinistre);
				$('#date_sini').val(selectedODS.date_sinistre);
				$('#assure_sini').val(selectedODS.nom_tiers+" "+selectedODS.prenom_tiers);
				$('#police_num').val(selectedODS.ref_police);
				// $('#pol_effet').val(selectedODS.date_effet);
				// $('#pol_exp').val(selectedODS.date_expiration);
				$('#veh_marque').val(selectedODS.marque);
				$('#veh_model').val(selectedODS.model);
				$('#veh_mat').val(selectedODS.matricule);
				$('#num_ser').val(selectedODS.num_serie);
				$('#tier_nom_pre').val(selectedODS.nom_tiers+" "+selectedODS.prenom_tiers);
				$('#expert_code').val();
				$('#nom_prenom').val(selectedODS.expert);
				$('#ods_date_fait').val(selectedODS.date_ods);
				$('#remarque').val(selectedODS.remarque);
		        $('.my-wrapper h5.titre').html("<i class='ti ti-folder icon-design'></i> "+"Details de l'ODS N°: "+selectedODS.num_ods);

		        $('.print-pdf').attr('href','../downloadPDF/'+selectedExpertise.id);
		        $('#recap_pv h5').text("Recapitulatif du PV N° ");
				$('#pv_date').val("");
				$('#pv_statut').val("");
				$('#pv_montant_ht').val("");
				$('#pv_montant_ttc').val("");

		        if(selectedExpertise){
		        	$('.print-pdf').attr('href','../downloadPDF/'+selectedExpertise.id);
		        	$('#recap_pv h5').text("Recapitulatif du PV N° "+selectedExpertise.id_ods);
					$('#pv_date').val(selectedExpertise.created_at);
					$('#pv_statut').val(selectedExpertise.libelle);
					//$('#pv_montant_ht').val(selectedExpertise.MHT_expertise);
					$('#pv_montant_ttc').val(selectedExpertise.MTC_expertise);
		        }
			}

			$( ".close, .close-btn" ).click(function() {
				$( ".my-wrapper" ).fadeOut( "slow", function() {});
				$('body').css( "height","auto");
				$('body').css( "overflow","auto");
			});

				var table_ods = $('#ods').DataTable({
					"responsive": true,
					"autoWidth": true,
					"columns": [
					{"data": "id",  "orderable": true,"visible": false, "searchable": true},
                    {"data": "ref_sinistre", "orderable": true, "searchable": true},
                    {"data": "date_ods", "orderable": true, "searchable": true},
					{"data": "date_ods", "orderable": true, "searchable": true},
					{"data": "nom_tiers", "orderable": true, "searchable": true},
					{"data": "libelle", "orderable": true, "searchable": false},
					{"data": "detail", "orderable": true, "searchable": false},

					],
					"rowId": 'id', // IdRow = Id_User in bd
					"processing": true,
					"serverSide": true,
					"ajax": {
						url: '{{route('expertise.liste_table')}}',
						type: 'POST',
						data: {
							'_token': function () {
											return $('input[name="_token"]').val();
											},
							'ref_sin': function(){ return ref_sinis ;}
						}

					},
					"fnDrawCallback": function( oSettings ) {
                        $("#ods tbody tr:first-child").trigger("click");
                    },

					"order": [[0, "asc"]],
                    // "ordering": false,
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

				table_ods.columns().every(function () {
					var that = this;

					$('input, select', this.header()).on('keyup change', function () {
						if (that.search() !== this.value) {
							that
									.search(this.value)
									.draw();
						}
					});


				});

				$("#ods tbody").delegate('tr', 'click', function() {

			    //console.log(table_tiers.row( this ).data());
			    //toggleRow_tiers(table_tiers.row( this ).data());
			    $("#ods .highlight").removeClass('highlight');
			    $( this ).addClass('highlight');
			    selectedODS = table_ods.row( this ).data();
			    selectedExpertise = null;
		        verif_null();
		        $("#id_ods").val(selectedODS.id);
		        $id_ods=selectedODS.id;
		        $id_ods_declaration=$id_ods;
		        $id_ods_exclur=$id_ods;
		        $("#id_ods_declaration").val(selectedODS.id);
		        $("#id_ods_exclur").val(selectedODS.id);
		        $("#id_ods_additif").val(selectedODS.id);
		        $id_ods_additif=selectedODS.id;
		        $("#id_contre_exertise").val(selectedODS.id);
		        $id_contre_exertise=selectedODS.id;

		        if (  $.fn.DataTable.isDataTable( $('#traitement') ) ) {
		        	$('#traitement').DataTable().ajax.reload();
		        	return;
		        }

		        tableTraitement();

		        });

////////////////////////////////////////////////////////////////////////////////////////////////////////////


		    });


////////////////////////////////////////////////// table traitement

function tableTraitement(){

	function currencyFormat(num) {
			  return (
			    num
			      .toFixed(2) // always two decimal digits
			      .replace('.', ',') // replace decimal point character with ,
			      .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 ') + ''
			  ) // use ' ' as a separator
			}


	table_traitement = $('#traitement').DataTable({
			"responsive": true,
			"autoWidth": true,
			"columns": [

			{"data": "id", "orderable": true, "searchable": true},
			{"data": "type", "orderable": true, "searchable": true},
			{"data": "num_expertise", "orderable": true, "searchable": true},
			{"data": "expert", "orderable": true, "searchable": true},
			{"data": "created_at", "orderable": true, "searchable": true},
			{"data": "libelle", "orderable": true, "searchable": true},
			{"data": "MTC_expertise", "orderable": true, "searchable": true,
			"render" : function(data, type, row) {
				return currencyFormat(Number(row.MTC_expertise));
			}},
			//{"data": "MHT_expertise", "orderable": true, "searchable": true},
			{"data": "detail", "orderable": true, "searchable": true},

			],
					"rowId": 'id', // IdRow = Id_User in bd
					"processing": true,
					"serverSide": true,
					"ajax": {
						url: '{{route('expertise.traitement_table')}}',
						type: 'POST',
						data: {
							'_token': function () {
								return $('input[name="_token"]').val();
							},
							'id_ods': function(){ return $id_ods ;}
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

		    $("#traitement tbody").delegate('tr', 'click', function() {
			    //console.log(table_tiers.row( this ).data());
			    //toggleRow_tiers(table_tiers.row( this ).data());
			    $("#traitement .highlight").removeClass('highlight');
			    $( this ).addClass('highlight');
			    selectedExpertise = table_traitement.row( this ).data();
			    id_expertise_additif = selectedExpertise.id;
			    $("#id_expertise_additif").val(selectedExpertise.id);
			    id_contre = selectedExpertise.id;
			    $("#id_contre").val(selectedExpertise.id);
		        verif_null();
		    });


}

	</script>
@endsection
