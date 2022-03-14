@extends('default')

@section('head_title')
	Annuler & Supprimer Un ODS
@endsection

@section('title')
	Annuler & Supprimer Un ODS
@endsection

@section('head')
	<link href="{{asset('assets/plugins/select2/css/select2.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="{{asset('assets/css/ODSStyling.css')}}">
@endsection

@section('content')
	@include('ODS.barre_recherche')
	<div id="dossier_sinistre" class="liste">
		<div class="row">
			<div class="col-sm-12">
				<div id="accordion2 formulaire-recherche" class="formulaire-recherche">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h5 class="mb-0 mt-0 font-16">
								<a data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" class="text-dark"><i class="mdi mdi-folder-multiple"></i> Liste Des Dossiers Sinistres <span class="ion-arrow-down-b"></span></a>
							</h5>
						</div>
						<div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion2" style="">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-12">
										<form>
											@csrf
										</form>
										<table id="sinistre" class="table dataTable table-responsive table-hover display responsive nowrap">
										    <thead>
										        <tr>
										            <th>N° Sinistre</th>
										            <th>Date Sinistre</th>
										            <th>Matricule</th>
										            <th>Marque</th>
										            <th>Model</th>
										            <th>Police</th>
										            <th>Effet</th>
										            <th>Expiration</th>
										            <th>N° Serie</th>
										            <th>Assuré</th>
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
				<div id="accordion3" class="formulaire-recherche">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h5 class="mb-0 mt-0 font-16">
								<a data-toggle="collapse" data-parent="#accordion3" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="text-dark"><i class="mdi mdi-folder-outline"></i> Liste Des ODS par Dossier <span class="ion-arrow-down-b"></span></a>
							</h5>
						</div>
						<div id="collapseThree" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion3" style="">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-12">
										<table id="ods" class="table dataTable table-responsive table-hover display responsive nowrap">
										    <thead>
										        <tr>
										            <th>N° ID</th>
										            <th>N° Dossier</th>
										            <th>Date ODS</th>
										            <th>Expert</th>
										            <th>Tiers</th>
										            <th>Matricule</th>
										            <th>Statut</th>
										            <th>Annuler</th>
										            <!-- <th>Supprimer</th> -->
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
					<div class="col-md-4">
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
					</div>
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
					<div class="col-md-6">
						<div class="form-group">
							<label>Code: </label>
							<input disabled type="text" class="form-control" required="" id="expert_code">
						</div>
					</div>
					<div class="col-md-6">
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
				<div class="row">
					<div class="col-sm-12 text-right">
						<button type="button" class="btn btn-lg btn-secondary waves-effect waves-light close-btn"><i class="ion-android-system-back"></i> retour</button>
						<button type="button" class="btn btn-lg btn-primary waves-effect waves-light"><i class="mdi mdi-printer"></i> Editer</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="my-wrapper2">
	<div class="my-modal">
		<div class="close"><p>X</p></div>
		<div class="row">
			<div class="col-sm-12">
				<h5 class="">Supression de l'ODS N° </h5>
				<div class="row">
					<div class="col-md-12">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, vel, assumenda. Vero dolor modi necessitatibus maiores quo explicabo repudiandae esse doloribus animi ipsum laudantium minus soluta, consequuntur, magnam cum, deleniti.</p>
					</div>
				</div>
				<div class="divider"></div>
				<div class="row">
					<div class="col-sm-12 text-right">
						<button type="button" class="btn btn-lg btn-secondary waves-effect waves-light close-btn"><i class="ion-android-system-back"></i> Abandonner</button>
						<button type="button" class="btn btn-lg btn-danger waves-effect waves-light"><i class="mdi mdi mdi-delete"></i> Supprimer</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="my-wrapper3">
	<div class="my-modal">
		<div class="close"><p>X</p></div>
		<div class="row">
			<div class="col-sm-12">
				<h5 class="">Annulation de l'ODS N° </h5>
				<div class="row">
					<div class="col-md-12">
						<p>Etes vous sure de bien vouloir supprimer l'ODS numéro xxxxx, cliquez sur abandonner afin d'abandonner, ou cliquez sur annuler l'ods afin de confirmer l'annulation de l'ods.</p>
					</div>
				</div>
				<div class="divider"></div>
				<div class="row">
					<div class="col-sm-12 text-right">
						<button type="button" class="btn btn-lg btn-secondary waves-effect waves-light close-btn"><i class="ion-android-system-back"></i> Abandonner</button>
						<a href="./annuler/1" class="btn btn-lg btn-danger waves-effect waves-light"><i class="mdi mdi mdi-delete"></i> Annuler l'ODS</a>
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
		var data_dossier;
		var data_tiers;
		var data_expert;
		var ref_sinis;
		var selectedODS;
		var selectedSinistre;
		var recherche_parameters =[];

		function verif_null(){
				if (data_dossier && data_expert && data_tiers) {
					$( "#djilali" ).show("fast");
				}
			}

		function expert_option(nom){
        $('#select_expert option[value="'+nom+'"]').prop('selected', true);
        }

		$( document ).ready(function() {
			
			//rechercher par le police
			$( "form#Formulaire_sinistre" ).submit(function( event ) {
			  event.preventDefault();
			  
			  recherche_parameters = JSON.stringify( $("form#Formulaire_sinistre").serializeArray() );
			   // $( "form#Formulaire_sinistre" ).serializeObject();
			  console.log(recherche_parameters);
			  table_sinistre.ajax.reload();
			});

			$( "form#Formulaire_police" ).submit(function( event ) {
			  event.preventDefault();
			 recherche_parameters = JSON.stringify( $("form#Formulaire_police").serializeArray() );
			  console.log(recherche_parameters);
			  table_sinistre.ajax.reload();
			});
			$( "form#Formulaire_recherche" ).submit(function( event ) {
			  event.preventDefault();
			  recherche_parameters = JSON.stringify( $("form#Formulaire_recherche").serializeArray() );
			  console.log(recherche_parameters);
			  table_sinistre.ajax.reload();
			});
			//Formulaire_police

			myFunction = function(){
		        console.log(selectedODS);

				$( ".my-wrapper" ).fadeIn( "slow", function() {});
				$('body').css( "height","100vh");
				$('body').css( "overflow-y","hidden");
				$('#num_sini').val(selectedSinistre.ref_sinistre);
				$('#date_sini').val(selectedSinistre.date_sinistre);
				$('#assure_sini').val(selectedSinistre.assure);
				$('#police_num').val(selectedSinistre.ref_police);
				$('#pol_effet').val(selectedSinistre.date_effet);
				$('#pol_exp').val(selectedSinistre.date_expiration);
				$('#veh_marque').val(selectedSinistre.marque);
				$('#veh_model').val(selectedSinistre.model);
				$('#veh_mat').val(selectedSinistre.matricule);
				$('#num_ser').val(selectedSinistre.num_serie);
				$('#tier_nom_pre').val(selectedODS.nom_tiers+' '+selectedODS.prenom_tiers);
				$('#expert_code').val(selectedODS.code_expert);
				$('#nom_prenom').val(selectedODS.expert.replace('&#039;','\''));
				$('#ods_date_fait').val(selectedODS.date_ods);
				$('#remarque').val(selectedODS.remarque);
		        $('.my-wrapper h5.titre').html("<i class='ti ti-folder icon-design'></i> "+"Details de l'ODS N°: "+selectedODS.num_ods+" relatif au sinistre N°: "+selectedSinistre.ref_sinistre);

		}
		myFunctionDelete = function(){
			$( ".my-wrapper2" ).fadeIn( "slow", function() {});
			$('body').css( "height","100vh");
			$('body').css( "overflow-y","hidden");
		}
		myFunctionAnnuler = function(){

			
			$(".my-wrapper3 h5").text("Annulation de l'ODS N° "+selectedODS.num_ods+" relatif au sinistre N° "+selectedODS.ref_sinistre);
			$(".my-wrapper3 .row p").text("Etes vous sure de bien vouloir supprimer l'ODS numéro "+selectedODS.num_ods+", relatif au dossier sinistre numéro "+selectedODS.ref_sinistre+" cliquez sur abandonner afin d'abandonner, ou cliquez sur annuler l'ods afin de confirmer l'annulation de l'ods.");

			$(".my-wrapper3 a").attr("href","./annuler/"+selectedODS.id);
			$( ".my-wrapper3" ).fadeIn( "slow", function() {});
			$('body').css( "height","100vh");
			$('body').css( "overflow-y","hidden");

		}
			$( ".my-wrapper .close, .my-wrapper .close-btn" ).click(function() {
				$( ".my-wrapper" ).fadeOut( "slow", function() {});
				$('body').css( "height","auto");
				$('body').css( "overflow","auto");
			});

			//popup supression
			// $( ".my-wrapper2 .close, .my-wrapper2 .close-btn" ).click(function() {
			// 	$( ".my-wrapper2" ).fadeOut( "slow", function() {});
			// 	$('body').css( "height","auto");
			// 	$('body').css( "overflow","auto");
			// });

			$( ".my-wrapper3 .close, .my-wrapper3 .close-btn" ).click(function() {
				$( ".my-wrapper3" ).fadeOut( "slow", function() {});
				$('body').css( "height","auto");
				$('body').css( "overflow","auto");
			});

			$( "#djilali" ).click(function() {
				$( "#info_ods" ).toggle("slow");
				$( "#liste_ods" ).toggle("slow");

				$("#ref_sinistre").val( data_dossier.ref_sinistre) ;
				$("#date_sinistre").val( data_dossier.date_sinistre );
				$("#ref_police").val( data_dossier.ref_police);
				$("#assure").val( data_tiers.nom);
				$("#matricule").val( data_dossier.matricule);
				$("#marque").val( data_dossier.marque);
				$("#model").val( data_dossier.model);
				$("#num_serie").val( data_dossier.num_serie);
				$("#expert_don").val( data_expert.nom);
		    });

		    $( "#annuler" ).click(function() {
				$( "#info_ods" ).toggle("slow");
				$( "#liste_ods" ).toggle("slow");
		    });

			// On reprend le même id que dans le précédent chapitre
			var t=$('input[name="_token"]').val();
			$('#direction').on('change', function() {
			   
			   direction=$('#direction').val();

			   $.ajax({
			       url : '{{route('odsexperts.agence')}}',
			       type : 'POST',
			       dataType : 'json',
					data: {'_token':t, direction},
			       success : function(data){
				       $('#agence').html('');
				       $('#agence').append('<option value="-1">'+"All Agences"+'</option>');
				       $.each(data, function(i, item) {
				       	  var option='<option value="'+item.CODE+'">'+"Agence "+item.CODE+'</option>';
						  $('#agence').append(option);
						  // alert(item.CODE);
					   });
			       },

			       error : function(resultat, statut, erreur){
			       		alert('error');
			       },

			       complete : function(resultat, statut){
			       }

			   });
			});

		    // //Sinistre Table
		    // var table = $('#sinistre').DataTable({

		    // });

		    //ODS Table
		    // var table = $('#ODS').DataTable({

		    // });
		    //  var table = $('#tiers').DataTable({

		    // });

			
			$('#expert tfoot th ').each( function () {
				var title = $(this).text();
				$(this).html( '<input type="text" placeholder="Recherche " />' );
			});
		    //TIERS Table
		    var table_expert = $('#expert').DataTable({
					"responsive": true,
					"autoWidth": true,
					"columns": [

						{"data": "code","name":"experts_details.code", "orderable": true, "searchable": true},
						{"data": "nom", "orderable": true, "searchable": true},
						{"data": "prenom", "orderable": true, "searchable": true},
						{"data": "detail", "orderable": false, "searchable": true}
					],
					// "rowId": 'code', // IdRow = Id_User in bd
					"processing": true,
					"serverSide": true,
					"ajax": {
						url: '{{route('odsexperts.table')}}',
						type: 'POST',
						data: {'_token':t}
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
				// table_expert.columns().every(function () {
				// 	var that = this;

				// 	$('input, select', this.footer()).on('keyup change', function () {
				// 		if (that.search() !== this.value) {
				// 			that
				// 					.search(this.value)
				// 					.draw();
				// 		}
				// 	});
				// });

				$("#expert tbody").delegate('tr', 'click', function() {
			    //console.log(table_expert.row( this ).data());
			    toggleRow_expert(table_expert.row( this ).data());

			    $("#expert .highlight").removeClass('highlight');
			    $( this ).addClass('highlight');
		        verif_null();
		        });	

		        function toggleRow_expert(data){
  	            //var row_id =  $(row).attr('ref_sinistre');
  	            //console.log(data);
  	            data_expert=data;
  	            expert_option(data.nom);
                } 

		    

			$('.select2, .select2-multiple').select2({
				theme: "bootstrap",
			    placeholder: placeholder,
			});


/////////////////////////////////////////////////////////////////////////////////Table dossier sinistre

$('#sinistre tfoot th ').each(function () {
				var title = $(this).text();
				$(this).html( '<input type="text" placeholder="Filtre " />' );
			});


				var table_sinistre = $('#sinistre').DataTable({
					"responsive": true,
					"autoWidth": true,
					"columns": [

						{"data": "ref_sinistre", "orderable": true, "searchable": true},
						{"data": "date_sinistre", "orderable": true, "searchable": true},
						{"data": "matricule", "orderable": true, "searchable": true},
						{"data": "marque", "orderable": true, "searchable": true},
						{"data": "model", "orderable": true, "searchable": true},
						{"data": "ref_police", "orderable": true, "searchable": true},
						{"data": "date_effet", "orderable": true, "searchable": true},
						{"data": "date_expiration", "orderable": true, "searchable": true},
						{"data": "num_serie", "orderable": true,"searchable": true},
						{"data": "assure", "orderable": true,"searchable": true},
						{"data": "detail", "orderable": true,"searchable": true},

					],
					"rowId": 'ref_sinistre', // IdRow = Id_User in bd
					"processing": true,
					"serverSide": true,
					"ajax": {
						url: '{{route('dossier.table')}}',
						type: 'POST',
						data: {
							'_token': function () {
								return $('input[name="_token"]').val();
							},
							'recherche': function(){
							 return recherche_parameters ;
							}
						}
					},

					"order": [[0, "asc"]],
					"searching": true,
					"deferRender": true,
					"scrollY": "180px",
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
					},
					"fnDrawCallback": function( oSettings ) {
						$("#sinistre tbody tr:first-child").trigger("click");
				    }
				});
				
				// table_sinistre.columns().every(function () {
				// 	var that = this;

				// 	$('input, select', this.footer()).on('keyup change', function () {
				// 		if (that.search() !== this.value) {
				// 			that
				// 					.search(this.value)
				// 					.draw();
				// 		}
				// 	});
				// });

				$("#sinistre tbody").delegate('tr', 'click', function() {
					selectedSinistre = table_sinistre.row( this ).data();
			    // console.log($(this).attr('id'));
			    //console.log(table_sinistre.row( this ).data());
			    if (table_sinistre.row( this ).data()){
			    toggleRow_sinistre(table_sinistre.row( this ).data());
			    }
				$("#sinistre .highlight").removeClass('highlight');
	        	$( this ).addClass('highlight');
		        verif_null();
		        });

				function toggleRow_sinistre(data){
  	            //var row_id =  $(row).attr('ref_sinistre');
  	            ref_sinis = data.ref_sinistre;
  	            affiche_tiers(data.ref_sinistre);
  	            affiche_ods(data.ref_sinistre);
  	            data_dossier=data;
                }  




		

/////////////////////////////////////////////////////////////  fin

		});




/////////////////////////////////////////////////////////////////////////////////Table tiers

function tableTiers(){
	table_tiers = $('#tiers').DataTable({
			"responsive": true,
			"autoWidth": true,
			"columns": [

			{"data": "ref_sinistre", "orderable": true, "searchable": true},
			{"data": "nom", "orderable": true, "searchable": true},
			{"data": "prenom", "orderable": true, "searchable": true},
			{"data": "date_naissance", "orderable": true, "searchable": true},
			{"data": "matricule", "orderable": true, "searchable": true},
			{"data": "marque", "orderable": true, "searchable": true},
			{"data": "model", "orderable": true, "searchable": true},

			],
					"rowId": 'ref_sinistre', // IdRow = Id_User in bd
					"processing": true,
					"serverSide": true,
					"ajax": {
						url: '{{route('tiers.table')}}',
						type: 'POST',
						data: {
							'_token': function () {
								return $('input[name="_token"]').val();
							},
							'ref_sin': function(){ return ref_sinis ;}
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
}
});

	// table_tiers.columns().every(function () {
	// 		var that = this;

	// 		$('input, select', this.footer()).on('keyup change', function () {
	// 			if (that.search() !== this.value) {
	// 				that
	// 				.search(this.value)
	// 				.draw();
	// 			}
	// 		});
	// 	});


		$("#tiers tbody").delegate('tr', 'click', function() {
			    
			    //console.log(table_tiers.row( this ).data());
			    toggleRow_tiers(table_tiers.row( this ).data());
			    $("#tiers .highlight").removeClass('highlight');
			    $( this ).addClass('highlight');
		        verif_null();
		    });

		
		    function toggleRow_tiers(data){
  	            //var row_id =  $(row).attr('ref_sinistre');
  	            data_tiers=data;
  	        } 


}

function tableOds(){
	table_ods = $('#ods').DataTable({
			"responsive": true,
			"autoWidth": true,
			"columns": [

			{"data": "num_ods", "orderable": true, "searchable": true},
			{"data": "ref_sinistre", "orderable": true, "searchable": true},
			{"data": "date_ods", "orderable": true, "searchable": true},
			{"data": "expert", "orderable": true, "searchable": true},
			{"data": "nom_tiers", "orderable": true, "searchable": true},
			{"data": "matricule", "orderable": true, "searchable": true},
			// {"data": "matricule", "orderable": true, "searchable": true},
			{"data": "libelle", "orderable": true, "searchable": true},
			{"data": "Annuler", "orderable": true, "searchable": true},
			// {"data": "Supprimer", "orderable": true, "searchable": true},
			{"data": "detail", "orderable": true, "searchable": true},

			],
					"rowId": 'ref_sinistre', // IdRow = Id_User in bd
					"processing": true,
					"serverSide": true,
					"ajax": {
						url: '{{route('ods.tablepriv')}}',
						type: 'POST',
						data: {
							'_token': function () {
								return $('input[name="_token"]').val();
							},
							'ref_sin': function(){ return ref_sinis ;}
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
					"fnDrawCallback": function( oSettings ) {
						$("#ods tbody tr:first-child").trigger("click");
				    }
});
	

	// table_ods.columns().every(function () {
	// 		var that = this;

	// 		$('input, select', this.footer()).on('keyup change', function () {
	// 			if (that.search() !== this.value) {
	// 				that
	// 				.search(this.value)
	// 				.draw();
	// 			}
	// 		});
	// 	});

		
		$("#ods tbody").delegate('tr', 'click', function() {
			    
			    //console.log(table_tiers.row( this ).data());
			    //toggleRow_tiers(table_tiers.row( this ).data());
			    $("#ods .highlight").removeClass('highlight');
			    $( this ).addClass('highlight');
			    selectedODS = table_ods.row( this ).data();
		        //verif_null();
		    });
		
		    // function toggleRow_tiers(data){
  	   //          //var row_id =  $(row).attr('ref_sinistre');
  	   //          data_tiers=data;
  	   //      } 


}

function affiche_tiers(ref_sinis){


var table_tiers;	
$('#tiers tfoot th ').each(function () {
			var title = $(this).text();
				$(this).html( '<input type="text" placeholder="Recherche " />' );
		});
if (  $.fn.DataTable.isDataTable( $('#tiers') ) ) {
  $('#tiers').DataTable().ajax.reload();
   return;
}


tableTiers();	

		}


function affiche_ods(ref_sinis){

	
$('#ods tfoot th ').each(function () {
			var title = $(this).text();
				$(this).html( '<input type="text" placeholder="Recherche " />' );
		});
if (  $.fn.DataTable.isDataTable( $('#ods') ) ) {
  $('#ods').DataTable().ajax.reload();
   return;
}


tableOds();	

		}

</script>

	
@endsection