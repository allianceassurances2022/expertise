@extends('default')

@section('head_title')
	Liste des Roles
@endsection

@section('title')
	Liste des Roles
@endsection

@section('head')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
@endsection

@section('content')
	

<div class="row">
	<div class="col-12">
		<div class="card m-b-30">
			<div class="card-header">
				<h4 class="header-title"> <span class="ion-android-friends"></span> Liste de tous les Roles</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<form>
							@csrf
						</form>
						<table id="role" class="display" style="width:100%">
							<thead>
							<tr>
								<th>Nom</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
							<tr>
								<th>Nom</th>
								<th>Action</th>
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

			$('#role tfoot th ').each(function () {
				var title = $(this).text();
				if (title != "Action")
					$(this).html( '<input type="text" placeholder="Recherche '+title+'" />' );
			});


			var table = $('#role').DataTable({
				"columns": [

					{"data": "name", "orderable": true, "searchable": true},
					{"data": "action", "orderable": false,"searchable": false}

				],
				"rowId": 'email', // IdRow = Id_User in bd
				"processing": true,
				"serverSide": true,
				"ajax": {
					url: '{{route('roles_table')}}',
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
				"scrollY": false,
				"scrollCollapse": false,
				"scroller": false,
				"scrollX": false,

				"language": {
					"info": " page : _PAGE_ sur _PAGES_   (de _START_ ?? _END_ sur un total de : _TOTAL_ enregistrements )",
					"infoEmpty": "Pas de r??sultat",
					"infoFiltered": " - Filtere dans _MAX_ enregistrements",
					"decimal": "",
					"emptyTable": "Pas de r??sultat",
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
							"</select>  lignes affaich??es", //_MENU_

					"loadingRecords": "Veuillez patienter - Chargement...",
//"processing":     "<img src='{{asset('assets/images/loading_bar.gif')}}' > Chargement...",
					"search": "Recherche:",
					"zeroRecords": "Pas de r??sultat",
					"paginate": {
						"first": "Premier",
						"last": "Dernier",
						"next": "Suivant",
						"previous": "pr??c??dent"
					}

				}


			});



			table.columns().every(function () {
				var that = this;

				$('input', this.footer()).on('keyup change', function () {
					if (that.search() !== this.value) {
						that
								.search(this.value)
								.draw();
					}
				});
			});

		});

	</script>
@endsection