@extends('default')

@section('head_title')
	Ajouter Un Utilisateur
@endsection

@section('title')
	Gestion Des Utilisateur
@endsection

@section('head')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<style type="text/css">
		table.dataTable thead .sorting, table.dataTable thead .sorting_asc, table.dataTable thead .sorting_desc, table.dataTable thead .sorting_asc_disabled, table.dataTable thead .sorting_desc_disabled, .table > tbody > tr > td, .table > tfoot > tr > td, .table > thead > tr > td {
    		width: 12% !important;
    		/*text-align: center;*/
		}

		table.dataTable thead .sorting:last-child, table.dataTable thead .sorting_asc:last-child, table.dataTable thead .sorting_desc:last-child, table.dataTable thead .sorting_asc_disabled:last-child, table.dataTable thead .sorting_desc_disabled:last-child , .table > tbody > tr > td:last-child , .table > tfoot > tr > td:last-child, .table > thead > tr > td:last-child {
			display: inline-block;
		    width: 150px !important;
		    padding: 14px 10px;
		}

	</style>
@endsection

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h4 class="header-title"> <span class="ion-android-friends"></span> Gestion Des Utilisateurs</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-2">
							<div class="card-counter info">
						        <i class="fa fa-user"></i>
						        <span class="count-numbers">12</span>
						        <span class="count-name">Admins</span>
						     </div>
						</div>
						<div class="col-2">
							<div class="card-counter primary">
						        <i class="fa fa-user"></i>
						        <span class="count-numbers">29</span>
						        <span class="count-name">Backoffice</span>
						     </div>
						</div>
						<div class="col-2">
							<div class="card-counter info">
						        <i class="fa fa-user"></i>
						        <span class="count-numbers">6</span>
						        <span class="count-name">Super Backoffice</span>
						     </div>
						</div>
						<div class="col-2">
							<div class="card-counter primary">
						        <i class="fa fa-user"></i>
						        <span class="count-numbers">18</span>
						        <span class="count-name">Super </span>
						     </div>
						</div>
						<div class="col-2">
							<div class="card-counter info">
						        <i class="fa fa-user"></i>
						        <span class="count-numbers">340</span>
						        <span class="count-name">Experts</span>
						     </div>
						</div>
						<div class="col-2">
							<div class="card-counter primary">
						        <i class="fa fa-user"></i>
						        <span class="count-numbers">102</span>
						        <span class="count-name">Agences</span>
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
					<h4 class="header-title"> <span class="ion-android-friends"></span> Liste de tous les utilisateurs</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<form>
								@csrf
							</form>
							<table id="user" class="table  table-responsive table-bordered nowrap" style="width:100%" >
						        <thead>
						            <tr>
										<th>Utilisateur</th>
										<th>Nom</th>
										<th>Prénom</th>
										<th>Previllege</th>
										<th>Email</th>
										<th>Etat</th>
										<th>Creation</th>
										<th>Modification</th>
										<th>Action</th>
						            </tr>
						        </thead>
								<tbody>
								</tbody>
						        <tfoot>
						        	<tr>
										<th>Utilisateur</th>
										<th>Nom</th>
										<th>Prénom</th>
										<th>Previllege</th>
										<th>Email</th>
										<th>Etat</th>
										<th>Creation</th>
										<th>Modification</th>
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
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
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
					$(this).html( '<input type="text" placeholder="Recherche" style="width:auto;"/>' );
				}

			});


				var table = $('#user').DataTable({
					"responsive": true,
					"autoWidth": true,
					"columns": [

						{"data": "username", "orderable": true, "searchable": true},
						{"data": "nom", "orderable": true, "searchable": true},
						{"data": "prenom", "orderable": true, "searchable": true},
						{"data": "previllege", "orderable": true, "searchable": true},
						{"data": "email", "orderable": true, "searchable": true},
						{"data": "etat", "orderable": true, "searchable": true},
						{"data": "created_at", "orderable": true, "searchable": true},
						{"data": "updated_at", "orderable": true, "searchable": true},
						{"data": "action", "orderable": false,"searchable": false}

					],
					"rowId": 'email', // IdRow = Id_User in bd
					"processing": true,
					"serverSide": true,
					"ajax": {
						url: '{{route('utilisateur.table')}}',
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
		function desactiver(id) {
			if ( confirm( "Voulez-vous vraiment désactiver l'utilisateur ?" ) ) {

				$.ajax({
					type: "POST",
					url: '{{route('utilisateur.desactiver')}}',
					data: {
						'_token': $('input[name=_token]').val(),
						id: id
						},
					success: function( data){
						alert(data.message);
						$('#user').DataTable().draw(false);
					},
					dataType: 'JSON'
				});
			} else {
				//ne rien faire
			}

		}
		function activer(id) {
			if ( confirm( "Voulez-vous vraiment activer l'utilisateur ?" ) ) {

				$.ajax({
					type: "POST",
					url: '{{route('utilisateur.activer')}}',
					data: {
						'_token': $('input[name=_token]').val(),
						id: id
					},
					success: function( data){
						alert(data.message);
						$('#user').DataTable().draw(false);
					},
					dataType: 'JSON'
				});
			} else {
				//ne rien faire
			}

		}
	</script>
	<script>
		$( document ).ready(function() {
			$("table body").delegate('tr', 'click', function() {
				$("table .highlight").removeClass('highlight');
	        	$( this ).addClass('highlight');
		        //get <td> element values here!!??
		    });
		});
	</script>
@endsection