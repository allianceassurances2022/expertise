@extends('default')

@section('head_title')
	Gestion Des Experts
@endsection

@section('title')
	Gestion Des Experts
@endsection

@section('head')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="{{asset('assets/css/dashboard_def.css')}}">
@endsection

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h4 class="header-title"> <span class="ion-android-friends"></span> Vue Globale Sur Les Experts</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-3">
							<div class="card-counter info">
						        <i class="dripicons-user"></i>
						        <span class="count-numbers">12</span>
						        <span class="count-name">Experts Actifs</span>
						     </div>
						</div>
						<div class="col-3">
							<div class="card-counter info">
						        <i class="dripicons-user"></i>
						        <span class="count-numbers">29</span>
						        <span class="count-name">Experts Innactifs</span>
						     </div>
						</div>
						<div class="col-3">
							<div class="card-counter primary">
						        <i class="dripicons-user"></i>
						        <span class="count-numbers">29</span>
						        <span class="count-name">Experts affectés</span>
						     </div>
						</div>
						<div class="col-3">
							<div class="card-counter primary">
						        <i class="dripicons-user"></i>
						        <span class="count-numbers">29</span>
						        <span class="count-name">Experts non affectés</span>
						     </div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- end col -->
	</div>
	

	<div class="row">
		<div class="col-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h4 class="header-title"> <span class="ion-android-friends"></span> Liste De Tout Les Experts </h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<form>
								@csrf
							</form>
							<table id="user" class="table  table-responsive table-bordered nowrap" style="width:100%">
						        <thead>
						            <tr>
										<th>id</th>
										<th>username</th>
										<th>nom</th>
										<th>prenom</th>
										<th>etat</th>
										<th>email</th>
										<th>code</th>
										<th>wilaya_designation</th>
										<th>telephone_1</th>
										<th>telephone_2</th>
										<th>agerement_organisme</th>
										<th>agrement_date_obtention</th>
										<th class="action">action</th>
						            </tr>
						        </thead>
								<tbody>
								</tbody>
						        <tfoot>
						            <tr>
										<th>id</th>
										<th>username</th>
										<th>nom</th>
										<th>prenom</th>
										<th>etat</th>
										<th>email</th>
										<th>code</th>
										<th>wilaya_designation</th>
										<th>telephone_1</th>
										<th>telephone_2</th>
										<th>agerement_organisme</th>
										<th>agrement_date_obtention</th>
										<th class="action">action</th>
						            </tr>
						        </tfoot>
						    </table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection

@section('js')
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script>
		$( document ).ready(function() {

			$('#user tfoot th ').each(function () {
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
					$(this).html( '<input type="text" placeholder="" style="width:100% !important; padding:0;"/>' );
				}

			});


				var table = $('#user').DataTable({
					"columns": [

						{"data": "id", "orderable": true, "searchable": true},
						{"data": "username", "orderable": true, "searchable": true, "visible": false},
						{"data": "nom", "orderable": true, "searchable": true},
						{"data": "prenom", "orderable": true, "searchable": true},
						{"data": "etat", "orderable": true, "searchable": true},
						{"data": "email", "orderable": true, "searchable": true},
						{"data": "code","name":"experts_details.code", "orderable": true, "searchable": true},
						{"data": "wilaya_designation","name":"experts_details.wilaya_designation", "orderable": true, "searchable": true},
						{"data": "telephone_1","name":"experts_details.telephone_1", "orderable": true, "searchable": true},
						{"data": "telephone_2","name":"experts_details.telephone_2", "orderable": true, "searchable": true},
						{"data": "agerement_organisme","name":"experts_details.agerement_organisme", "orderable": true, "searchable": true},
						{"data": "agrement_date_obtention","name":"experts_details.agrement_date_obtention", "orderable": true, "searchable": true},
						{"data": "action", "orderable": false,"searchable": false}

					],
					"rowId": 'email', // IdRow = Id_User in bd
					"processing": true,
					"serverSide": true,
					"ajax": {
						url: '{{route('experts.table')}}',
						type: 'POST',
						data: {
							'_token': function () {
											return $('input[name="_token"]').val();
											}
						}
					},

					"order": [[0, "asc"]],
					"searching": true,
					"deferRender": true,
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
				table.columns().every(function () {
					var that = this;

					$('input, select', this.footer()).on('keyup change', function () {
						if (that.search() !== this.value) {
							that
									.search(this.value)
									.draw();
						}
					});
				});
		});

	</script>
	<script>
		$( document ).ready(function() {
			$("table").delegate('tr', 'click', function() {
				$("table .highlight").removeClass('highlight');
	        	$( this ).addClass('highlight');
		        //get <td> element values here!!??
		    });
		});
	</script>
	
@endsection