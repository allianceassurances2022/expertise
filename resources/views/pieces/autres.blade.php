@extends('default')

@section('head_title')
Autres Pièces
@endsection

@section('title')
Autres Pièces
@endsection

@section('head')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
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
                <h4 class="header-title"> <span class="ion-android-friends"></span> Liste de tous les Autres Pièces</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form>
                            @csrf
                        </form>
                        <table id="expertise" class="table  table-responsive table-bordered nowrap" style="width:100%" >
                            <thead>
                                <tr>
                                    <th>Pièce</th>
                                    <th>Expert</th>
                                    <th>Date création</th>
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

@endsection

@section('js')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	<script>
		$( document ).ready(function() {

            $('#expertise thead tr').clone(true).appendTo( '#expertise thead');

            $('#expertise thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Recherche '+title+'" />' );

            } );


				var table = $('#expertise').DataTable({
					"responsive": true,
					"autoWidth": true,
                    "dom": 'B<"clear">lfrtip',
                    "buttons": [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
					"columns": [

						{"data": "libelle", "orderable": true, "searchable": true},
						{"data": "expert", "orderable": true, "searchable": true},
						{"data": "date", "orderable": true, "searchable": true}

					],
					"rowId": 'id', // IdRow = Id_User in bd
					"processing": true,
					"serverSide": true,
					"ajax": {
						url: '{{route('autresp.table')}}',
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

					$('input, select', this.header()).on('keyup change', function () {
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

