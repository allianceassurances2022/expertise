<?php
	header('Access-Control-Allow-Origin: *'); 
	header('Access-Control-Allow-Headers: Origin, Content-Type'); 
	header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
 ?>
@extends('default')

@section('head_title')
	Liste des Agences
@endsection

@section('title')
	Liste des Agences
@endsection

@section('head')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="{{asset('assets/css/dashboard_def.css')}}">
	<style>
		
		table tbody td:nth-child(8){
			display: inline-block !important;
			width: 100px !important;
		}

		table.dataTable thead .sorting, table.dataTable thead .sorting_asc, table.dataTable thead .sorting_desc, table.dataTable thead .sorting_asc_disabled, table.dataTable thead .sorting_desc_disabled, .table > tbody > tr > td, .table > tfoot > tr > td, .table > thead > tr > td {
		    width: 12% !important;
		    /*text-align: center;*/
		}

	</style>
@endsection

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h4 class="header-title"> <span class="fa fa-home"></span> Vue Globale</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-2 col-md-4">
							<div class="card-counter info">
						        <i class="fa fa-home"></i>
						        <span class="count-numbers">12</span>
						        <span class="count-name">AGA</span>
						     </div>
						</div>
						<div class="col-lg-2 col-md-4">
							<div class="card-counter primary">
						        <i class="fa fa-home"></i>
						        <span class="count-numbers">29</span>
						        <span class="count-name">AGD</span>
						     </div>
						</div>
						<div class="col-lg-2 col-md-4">
							<div class="card-counter info">
						        <i class="fa fa-home"></i>
						        <span class="count-numbers">6</span>
						        <span class="count-name">AGP</span>
						     </div>
						</div>
						<div class="col-lg-2 col-md-4">
							<div class="card-counter primary">
						        <i class="fa fa-home"></i>
						        <span class="count-numbers">250/18</span>
						        <span class="count-name">Agences Actives/Innactives</span>
						     </div>
						</div>
						<div class="col-lg-2 col-md-4">
							<div class="card-counter info">
						        <i class="fa fa-home"></i>
						        <span class="count-numbers">268</span>
						        <span class="count-name">Totalité Agence</span>
						     </div>
						</div>
						<div class="col-lg-2 col-md-4">
							<div class="card-counter primary">
						        <i class="fa fa-home"></i>
						        <span class="count-numbers">102</span>
						        <span class="count-name">Agences et Annexes</span>
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
				<form method="POST">
					@csrf
				</form>
				<div class="card-header">
					<h4 class="header-title"> <span class="fa fa-home"></span>   Liste de toute les agences</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<table id="agence" class=" table table-responsive table-hover nowrap" style="width: 100% !important">
						        <thead>
						            <tr nowrap>
						                <th>DG</th>
						                <th style="width: 20% !important;">DR</th>
						                <th>CODE</th>
						                <th>TYPE AGENCE</th>
						                
						                
						                <th style="width: 20% !important;">CHEF D'AGENCE</th>
						                <th>EMAIL</th>
						                <th class="text-center">STATUT</th>
						                <th>ACTION</th>
						            </tr>
						        </thead>
						        <tbody>
            					</tbody>
						        <tfoot>
						            <tr>
						                <th>DG</th>
						                <th>DR</th>
						                <th>CODE</th>
						                <th>TYPE AGENCE</th>
						               
						                <th>CHEF D'AGENCE</th>
						                <th>EMAIL</th>
						                <th class="text-center">STATUT</th>
						                <th>ACTION</th>
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

    $('#agence tfoot th ').each( function () {
      var title = $(this).text();
        if(title=="STATUT"){   // Etat 
            $select="<select>"+
            "<option value=''>Tous</option>"+
            "<option value='1'>Actif</option>"+
            "<option value='0'>Inactif</option>"+
            "</select>";
          $(this).html($select);
        }else if( title=="TYPE AGENCE"){   // Type Agence
        		$select="<select>"+
        				"<option value=''>Tous</option>"+
        				@foreach($type_agence as $type)
        					"<option value='{{$type->id}}' >{{$type->libelle}}</option>"+
        				@endforeach 
					"</select>";
        		$(this).html($select);
        }else if(title=="DR"){  //directions
        		$select="<select>"+
        				"<option value=''>Tous</option>"+
        				@foreach($directions as $data)
        					"<option value='{{$data->libelle}}' >{{$data->libelle}}</option>"+
        				@endforeach 
					"</select>";
        		$(this).html($select);
        }else if(title=="ACTION"){
        			$(this).html( '' );
        }else{
          $(this).html( '<input type="text" placeholder="Recherche " />' );
        }

    } );

    
    var table = $('#agence').DataTable({ 
      "columns": [
		      {"data": "DG" , "orderable": true ,"searchable": true, "visible" : false},
		      {"data": "DR", "name":"directions.libelle" , "orderable": true ,"searchable": true},
		      {"data": "CODE", "orderable": true ,"searchable": true},
		      {"data": "TYPE_AGENCE", "orderable": true,"searchable": true},
		      {"data": "CHEF_AGENCE"  ,"orderable": true,"searchable": true},
		      {"data": 'EMAIL', "orderable": true ,"searchable": true},
		       {"data": "STATUT"  ,"orderable": true,"searchable": true},
		      {"data": 'action', "orderable": false ,"searchable": false}
		      ],
		"rowId": 'DR'+'_'+'CODE', // IdRow = Id_User in bd
		"processing": true,
		"serverSide": true,
		
		"ajax": {
	  			"url": '{{route("agence.datatableAll")}}',
            	"dataType": "json",
				"type": 'POST',
				"crossDomain": true,
				"data": { '_token': function () {
											return $('input[name="_token"]').val();
											}
						}
				},

		"order": [[ 1, "asc" ]],
		"searching": true,
		"deferRender": true,
		// "scrollY": false,
		// "scrollCollapse": false,
		// "scroller": false,
		// "scrollX": true,
		"language": {
			  "info": " page : _PAGE_ sur _PAGES_   (de _START_ à _END_ sur un total de : _TOTAL_ enregistrements )" ,
			  "infoEmpty": "Pas de résultat",
			  "infoFiltered": " - Filtere dans _MAX_ enregistrements",
			  "decimal":        "",
			  "emptyTable":     "Pas de résultat",
			  "infoPostFix":    "",
			  "thousands":      ",",
			  "lengthMenu":     " <select>"+
			  '<option value="10">10</option>'+
			  '<option value="20">20</option>'+
			  '<option value="30">30</option>'+
			  '<option value="40">40</option>'+
			  '<option value="50">50</option>'+
			  '<option value="100">100</option>'+
			  '<option value="-1">Tous</option>'+
			"</select>  lignes affaichées", //_MENU_

			"loadingRecords": "Veuillez patienter - Chargement...",
			"processing":     "<img src='{{asset('assets/images/sp-loading.gif')}}' > Chargement...",
			"search":         "Recherche:",
			"zeroRecords":    "Pas de résultat",
			"paginate": {
					  "first":      "Premier",
					  "last":       "Dernier",
					  "next":       "Suivant",
					  "previous":   "précédent"
					}
			}
		});

// DataTable
// var table = $('#police').DataTable();

// Apply the search

table.columns().every( function () {
  var that = this;

  $( 'input, select', this.footer() ).on( 'keyup change', function () {
    if ( that.search() !== this.value ) {
      that
      .search( this.value )
      .draw();
    }
  } );
} );

  });
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