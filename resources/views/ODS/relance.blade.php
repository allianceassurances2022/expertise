@extends('default')

@section('head_title')
	Relance ODS
@endsection

@section('title')
	Relance ODS
@endsection

@section('head')
	<link href="{{asset('assets/plugins/select2/css/select2.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="{{asset('assets/css/ODSStyling.css')}}">
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
										            <th>N° Dossier</th>
										            <th>Date Sinistre</th>
										            <th>N° ODS</th>
										            <th>Date ODS</th>
										            <th>Assuré</th>
										            <th>Statut</th>
										            <th>Relance</th>
										            <th>Détail</th>
										        </tr>
										    </thead>
										    <tbody>
										    </tbody>
										    <tfoot>
										    	<tr>
										            <th>N° Dossier</th>
										            <th>Date Sinistre</th>
										            <th>N° ODS</th>
										            <th>Date ODS</th>
										            <th>Assuré</th>
										            <th>Statut</th>
										            <th>Relance</th>
										            <th>Détail</th>
										        </tr>
										    </tfoot>
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



	<div class="liste" >
		<div class="row" id="info_ods" >
			<div class="col-sm-12">
				<div id="accordion6" class="formulaire-recherche">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h5 class="mb-0 mt-0 font-16">
								<a data-toggle="collapse" data-parent="#accordion6" href="#collapseSix" aria-expanded="true" aria-controls="collapseSix" class="text-dark"><i class="mdi mdi-folder-outline"></i> Information de l'ODS<span class="ion-arrow-down-b"></span>
								</a>
							</h5>
						</div>
						<div id="collapseSix" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion6" style="">
							
							<div class="card-body">
								{{--<div class="masque"></div>--}}
								<div class="row">
									<div class="col-md-4">
										<h6><i class="ion-information-circled"></i> Information de l'ODS</h6>
										<div class="form-group">
											<label>N° Sinistre</label>
											<input type="text" class="form-control" required="" name="ref_sinistre" placeholder="Type something" id="ref_sinistre" readonly>
										</div>
										<div class="form-group">
											<label>Date Sinistre</label>
											<input type="text" class="form-control" required="" name="date_sinistre" placeholder="Type something" id="date_sinistre" readonly>
										</div>
										<div class="form-group">
											<label>Police</label>
											<input type="text" class="form-control" required="" name="ref_police" placeholder="Type something" id="ref_police" readonly>
										</div>
										<div class="form-group">
											<label>Assuré/Tiers</label>
											<input type="text" class="form-control" required="" name="tiers" placeholder="Type something" id="assure" readonly>
										</div>
									</div>
									<div class="col-md-4">
										<h6><i class="ion-information-circled"></i> Information de l'ODS</h6>
										<div class="form-group">
											<label>Date</label>
											<input type="date" class="form-control" required="" placeholder="Type something" name="date_ods" id="date_ods" readonly>
										</div>
										<div class="form-group">
											<label>Expert</label>
											<input type="text" class="form-control" required="" placeholder="Type something" name="expert" id="expert" readonly>
										</div>
										<div class="form-group">
											<label>Matricule</label>
											<input type="text" class="form-control" required="" name="matricule" placeholder="Type something" id="matricule" readonly>
										</div>
										<div class="form-group">
											<label>Remarque</label>
											<textarea class="form-control" required="" name="remarque" placeholder="Type something" id="remarque" readonly></textarea>
										</div> 
									</div>
									<div class="col-md-4">
										<h6><i class="ion-information-circled"></i> Information de l'ODS</h6>
										<div class="form-group">
											<label>Marque</label>
											<input type="text" class="form-control" required="" placeholder="Type something" id="marque" name="marque" readonly>
										</div>
										<div class="form-group">
											<label>Model</label>
											<input type="text" class="form-control" required="" placeholder="Type something" id="model" name="model" readonly>
										</div>
										<div class="form-group">
											<label>N° Serie</label>
											<input type="text" class="form-control" required="" placeholder="Type something" name="num_serie" id="num_serie" readonly>
										</div>
										<div class="form-group">
											<label>N° Téléphone</label>
											<input type="text" class="form-control" name="num_tel" placeholder="Type something" id="num_tel" readonly>
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






	<div class="my-wrapper">
	<div class="my-modal">
		<div class="close"><p>X</p></div>
		<div class="row">
			<div class="col-sm-12">
				<h5 class=""><i class="ti ti-folder icon-design"></i> liste des relances de l'ODS N° </h5>

				<div class="card-body">
								<div class="row">
									<form>
										@csrf
									</form>
									<div class="col-sm-12">
										<table id="liste_relance" class="table dataTable table-responsive table-hover display responsive nowrap">
										    <thead>
										        <tr>
										            <th>Date Relance</th>
										            <th>N° Relance</th>
										            <th>Remarque</th>
										        </tr>
										    </thead>
										    <tbody>
										    </tbody>
										    <tfoot>
										    	<tr>
										            <th>Date Relance</th>
										            <th>N° Relance</th>
										            <th>Remarque</th>
										        </tr>
										    </tfoot>
										</table>
									</div>
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
				<h5 class="">etes vous sur de vouloir relancer l'ODS ? </h5>

				<div class="card-body">

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Remarque</label>
								<textarea class="form-control" id="remarque_relance"></textarea>
							</div>
						</div>
					</div>

					<div class="liste">
						<div class="row">
							
							<div class="col-sm-6 text-right">
								<button class="btn  btn-success generer-ods" id="btn_relance">Relancer</button>
							</div>

							
							<div class="col-sm-6 text-right">
								<button class="btn  btn-danger generer-ods" >Annuler</button>
							</div>
						</div>
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
		var id_ods;
		var remarque_relance;


////////////////////////////////////////////////////////////////////// Relance ODS

		$( "#btn_relance" ).click(function() {
			remarque_relance = $.trim($("#remarque_relance").val());
			//alert(remarque_relance);

			$.ajax({
           type:'POST',
           url:'{{route('ods.relance_ods')}}',
           data:{
           	'_token': function () {
				return $('input[name="_token"]').val();
				},
            id:selectedODS.id,
            remarque_relance:remarque_relance,
           },
           success:function(data){
           	  alert(data.message);
              window.location = data.url;
           }
        });

		});

///////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////// Recupe info ods

		function recupe_info() {

			$.ajax({
           type:'POST',
           url:'{{route('ods.recupeInfo')}}',
           data:{
           	'_token': function () {
				return $('input[name="_token"]').val();
				},
            id:selectedODS.id,
           },
           success:function(data){
           	  //alert(data.num_ods);
              //window.location = data.url;
              $("#ref_sinistre").val( data.ref_sinistre) ;
              $("#date_sinistre").val( data.date_sinistre );
              $("#ref_police").val( data.ref_police);
              $("#assure").val( data.nom_tiers);
              $("#matricule").val( data.matricule);
              $("#marque").val( data.marque);
              $("#model").val( data.model);
              $("#date_ods").val( data.date_ods);
              $("#num_serie").val( data.num_serie);
              $("#expert").val( data.expert);
              $("#num_tel").val( data.num_tel);
              $("#remarque").val( data.remarque);

           }
        });

		};

///////////////////////////////////////////////////////////////////////////////////////

		$( document ).ready(function() {

////////////////////////////////////////////////////////////////////// pour liste des relance

			myFunction = function(){

				$( ".my-wrapper" ).fadeIn( "slow", function() {});
				$('body').css( "height","100vh");
				$('body').css( "overflow-y","hidden");
				

			}
			$( ".close, .close-btn" ).click(function() {
				$( ".my-wrapper" ).fadeOut( "slow", function() {});
				$('body').css( "height","auto");
				$('body').css( "overflow","auto");
			});

//////////////////////////////////////////////////////////////////////// pour relancer un ods

			myFunction2 = function(){

				$( ".my-wrapper2" ).fadeIn( "slow", function() {});
				$('body').css( "height","100vh");
				$('body').css( "overflow-y","hidden");
				

			}
			$( ".close, .close-btn" ).click(function() {
				$( ".my-wrapper2" ).fadeOut( "slow", function() {});
				$('body').css( "height","auto");
				$('body').css( "overflow","auto");
			});


////////////////////////////////////////////////////////////////////////// chargement table ods			

		    $('#ods tfoot th ').each(function () {
				var title = $(this).text();
				if(title=="Etat"){
					$select="<select>"+
							"<option value=''>Tous</option>"+
							"<option value='1'>Actif</option>"+
							"<option value='0'>Inactif</option>"+
							"</select>";
					$(this).html($select);
				}
				else if (title != "Action"){
					$(this).html( '<input type="text" placeholder="Recherche" style="width:auto;"/>' );
				}

			});


				var table_ods = $('#ods').DataTable({
					"responsive": true,
					"autoWidth": true,
					"columns": [
                    {"data": "ref_sinistre", "orderable": true, "searchable": true},
                    {"data": "date_ods", "orderable": true, "searchable": true},
					{"data": "num_ods", "orderable": true, "searchable": true},
					{"data": "date_ods", "orderable": true, "searchable": true},
					{"data": "nom_tiers", "orderable": true, "searchable": true},
					{"data": "libelle", "orderable": true, "searchable": true},
					{"data": "relance", "orderable": true, "searchable": true},
					{"data": "detail", "orderable": true, "searchable": true},

					],
					"rowId": 'ref_sinistre', // IdRow = Id_User in bd
					"processing": true,
					"serverSide": true,
					"ajax": {
						url: '{{route('ods.relance_table')}}',
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

					$('input, select', this.footer()).on('keyup change', function () {
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
			    affiche_relance();
			    recupe_info();
		        //verif_null();
		    });

////////////////////////////////////////////////////////////////////////////////////////////////////////////

		    
		});



/////////////////////////////////////////////////////////////////////////////////Table tiers

function affiche_relance(){


var table_liste_relance;	
$('#liste_relance tfoot th ').each(function () {
			var title = $(this).text();
				$(this).html( '<input type="text" placeholder="Recherche " />' );
		});
if (  $.fn.DataTable.isDataTable( $('#liste_relance') ) ) {
  $('#liste_relance').DataTable().ajax.reload();
   return;
}


tablerelance();	

		}

function tablerelance(){
	table_liste_relance = $('#liste_relance').DataTable({
			"responsive": true,
			"autoWidth": true,
			"columns": [

			{"data": "date_relance", "orderable": true, "searchable": true},
			{"data": "id", "orderable": true, "searchable": true},
			{"data": "remarque", "orderable": true, "searchable": true},

			],
					"rowId": 'date_relance', // IdRow = Id_User in bd
					"processing": true,
					"serverSide": true,
					"ajax": {
						url: '{{route('ods.relance_table_ods')}}',
						type: 'POST',
						data: {
							'_token': function () {
								return $('input[name="_token"]').val();
							},
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

	table_liste_relance.columns().every(function () {
			var that = this;

			$('input, select', this.footer()).on('keyup change', function () {
				if (that.search() !== this.value) {
					that
					.search(this.value)
					.draw();
				}
			});
		});

		
		    


}


	</script>
@endsection