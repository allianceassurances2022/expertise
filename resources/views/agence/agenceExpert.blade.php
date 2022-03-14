@extends('default')

@section('head_title')
Afféctation Expert à Agence
@endsection

@section('title')
Afféctation des Experts à Agence Code : <a href="{{route('agences.show', $agence->id)}}">{{$agence->CODE}}</a> 

@endsection

@section('head')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

	<link rel="stylesheet" href="{{asset('assets/css/dashboard_def.css')}}">
	<style type="text/css">
		table.dataTable thead .sorting, table.dataTable thead .sorting_asc, table.dataTable thead .sorting_desc, table.dataTable thead .sorting_asc_disabled, table.dataTable thead .sorting_desc_disabled, .table > tbody > tr > td, .table > tfoot > tr > td, .table > thead > tr > td 
		{
		    width: 30% !important;

		}

		.btn-danger {
		    background-color: #a2020c;
		    border: 1px solid #a2020c;
		}
		#dejaaffecte th:nth-child(3), #dejaaffecte tbody td:nth-child(3){
			display: inline-block;
			width: 200px !important;
			text-align: right;
		} 


			table.dataTable#pourAffecterAgenceExpert thead th, table.dataTable#pourAffecterAgenceExpert thead td {
		    padding: 10px 18px;
		    border-bottom: 1px solid #111;
		    width: 33% !important;
		}

	</style>
@endsection
@section('content')
<div class="row">
		<div class="col-12">
			<div class="card">
				<form id="frmAgence" method="POST">
					@csrf
					<input type="hidden" name="id_agence"  id="id_agence" value="{{$agence->id}}">
				</form>
				<div class="card-header">
					<h4 class="header-title"> <span class="fa fa-home"></span>Afféctation des Experts à Agence code : <a href="{{route('agences.show', $agence->id)}}">{{$agence->CODE}}</a></h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-4 col-md-6 col-sm-12 mb-3">
							<div class="card">
								<div class="card-header">
									<h4 class="header-title"> <span class="fa fa-home"></span> Liste des Experts </h4>
								</div>
								<div class="card-body collone">
									<table id="expert" class=" table-hover  display responsive nowrap" width="99%">
								        <thead class="nowrap">
								            <tr >
								            	<th class="all" style="width:10% !important;" >CODE</th>
								                <th class="all">Nom Prénom</th>
								                <th class="all">Code Expert</th>
								            </tr>
								        </thead>
								        <tbody>
		            					</tbody>
								    </table>
								</div>
							</div>
						</div>

						<div class="col-lg-4 col-md-6 col-sm-12" >
							<div class="card">
								<div class="card-header pourAffecter">
									<h4 class="header-title"> <span class="fa fa-home"></span>   Liste des Experts à affectées</h4>
								</div>
								<div class="card-body collone">
									<table id="pourAffecterAgenceExpert" class=" table dataTable table-responsive table-hover display  nowrap" style="border-bottom:1px #0000004d solid;height: 450px; overflow: auto; width:100%; ">
								        <thead>
								            <tr>
								                <th class="all">CODE</th>
  												<th class="all">Nom Prénom</th>
								                <th class="all">Code Expert</th>
								            </tr>
								        </thead>
								        <tbody>
		            					</tbody>
								    </table>
								</div>
								<form id="frmAffecterListe" action="{{route('agence.affecteExpertAgence')}}">
									@csrf
									<div class="col-xs-10 text-right" style="margin:5px 19px 22px 4px;">
										<button id="btnAffecterListe" type="submit" class="btn btn-primary waves-effect waves-light">Affecter la liste selectionnée</button>
									</div>
								</form>
							</div>
						</div>

						<div class="col-lg-4 col-md-6 col-sm-12" >
							<div class="card">
								<div class="card-header dejaAffecter">
									<h4 class="header-title"> <span class="fa fa-home"></span>   Liste des Experts déja affectées</h4>
								</div>
								<div class="card-body collone">
									<table id="dejaAffecte" class=" table  table-hover display responsive nowrap " width="99%" >
								        <thead>
								            <tr>
								                <th class="all">CODE</th>
								                <th class="all">Nom Prénom</th>
								                <th class="all">DATE D'AFFECTATION</th>
								            </tr>
								        </thead>
								        <tbody>
								        	
										</tbody>
								    </table>
								</div>
								<form id="frmDesaffecterListe" action="{{route('agence.detachExpertAgence')}}">
									@csrf
									<div class="col-xs-12 text-right" style="margin:5px 19px 22px 4px;">
										<button id="btnDesaffecterListe" type="submit" class="btn btn-danger waves-effect waves-light">Désaffecter la liste selectionnée</button>
									</div>
								</form>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- end col -->
@endsection

{{-- @section('head')
	<link href="{{asset('assets/plugins/select2/css/select2.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/role_permission.css')}}" rel="stylesheet" type="text/css" />

@endsection --}}

@section('js')
	<!--select2-->
	{{-- <script src="{{asset('assets/plugins/select2/js/select2.js')}}" ></script>
	<script src="{{asset('assets/js/pages/select2/select2-init.js')}}" ></script>
	<script src="{{asset('assets/js/pages/user.js')}}" ></script> --}}
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>



<script type="text/javascript">
$( document ).ready(function() {
	var items = []; //array of selected items' id 
   
    var table = $('#expert').DataTable({
      "columns": [
      		  {"data": "username", "orderable": true ,"searchable": true, "width": "20%" },
		      {"data": "nom", "orderable": true,"searchable": true},
		      {"data": "code" ,"name":"experts_details.code" ,"orderable": true,"searchable": true }
		      ],
		"rowId": 'id', 
		"processing": true,
		"serverSide": true,
		"rowCallback": function( row, data ) {
						    if ( jQuery.inArray($(row).attr('ID'), items) != -1 ) {  //element exist dans les selected_element  => so select it
						      $(row).addClass('selected');
						    }
						  },

		"ajax": {
	  			"url": '{{route("agence.ExpertNonAffecteDataTable")}}',
            	"dataType": "json",
				"type": 'POST',
				"crossDomain": true,
				"data": { '_token': function () {
											return $('input[name="_token"]').val();
											},
							'id_agence' :  $('#id_agence').val() 
						}
				},

		"order": [[ 2, "asc" ]],
		"searching": true,
		// "deferRender": true,
		"scrollY": "350px",
		 // "scrollCollapse": false,
		 // "scroller": false,
		"scrollX": true,
		"responsive": false,
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


  var tableExpert = $('#dejaAffecte').DataTable({
      "columns": [
		      {"data": "username", "orderable": true ,"searchable": true},
		      {"data": "nom", "orderable": true,"searchable": true},
		      {"data": "created_at"  ,"orderable": true,"searchable": true }
		      ],
		"rowId": 'id', // IdRow = Id_User in bd
		"processing": true,
		"serverSide": true,
		"ajax": {
	  			"url": '{{route("agence.ExpertAffecteDataTable")}}',
            	"dataType": "json",
				"type": 'POST',
				"crossDomain": true,
				"data": { 
						'_token': function () {
											return $('input[name="_token"]').val();
											},
						'id_agence' :  $('#id_agence').val() 
						}
				},

		"order": [[ 1, "asc" ]],
		"searching": true,
		// "deferRender": true,
		"scrollY": "350px",
		 // "scrollCollapse": false,
		 // "scroller": false,
		"scrollX": true,
		"responsive": false,
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

 
    $('#dejaAffecte tbody').on( 'click', 'tr', function () {
        toggleItem2(this['id']) ;
        $(this).toggleClass('selected');
    } );

    $('#btnDesaffecterListe').click( function () {
    	 
         //alert( table.rows('.selected').data() +' row(s) selected' );
    } );



//"""""""""""""""""""""""""""""""""""""""""""""selected items""""""""""""""""""""""""""""""""""""""""""""""""""


// toggle the Element_id in the items array
function toggleItem(element_id){  
    if(jQuery.inArray(element_id, items) != -1 ){ //element_id exist  => so remove it 
		    items.splice($.inArray(element_id, items), 1);
		}else{ // element_id dosen't exist  => so add it 
      items.push(element_id);
		}
}  

function toggleRow(row){
  	 var row = $(row).clone();
  	 var row_id =  $(row).attr('id');
    	if(jQuery.inArray(row_id, items) != -1 ){ //element_id exist  => so remove it 
		     $('#pourAffecterAgenceExpert tbody tr').remove('#'+row_id);
		}else{ // element_id dosen't exist  => so add it 
    		 $('#pourAffecterAgenceExpert tbody').prepend(row);
		}
}  

$('#expert tbody').on('click', 'tr', function(){   
        toggleRow(this);
        toggleItem(this['id']) ;
        $(this).toggleClass('selected');
        //console.log(items);
    });
//"""""""""""""""""""""""""""""""""""""""""""""End selected items""""""""""""""""""""""""""""""""""""""""""""""""""

//"""""""""""""""""""""""""""""""""""""""""""""Btn sent selected items""""""""""""""""""""""""""""""""""""""""""""""""""

$('#frmAffecterListe').on('submit' , function(e) {
	$('#btnAffecterListe').attr('disable', true);
	e.preventDefault();
	if (items.length !== 0) { 
	    $.ajax({
	        url: e.currentTarget.action,
	        type: 'POST',
	        dataType: 'json',
	        data: {'_token': function () {
											return $('input[name="_token"]').val();
											},
					'id_agence' :  $('#id_agence').val() ,
					'affecteListe': items
					
				 },
	        success: function(data) {
	                   // ... do something with the data...
	                   console.log(data);
	                   alert(data.etat +' : '+data.message);
	                   window.location.href = '{{route("agences.showExperts",$agence->id )}}';

	                 },
	       error: function(xhr, status, error) {
	       				console.log(error);
	       				console.log(xhr);
	       				alert('Erreur: Il n\'y a pas d\'Expert à affecter, '+error);
	       				// $('#btnAffecterListe').attr('disable', true);
	       } 
	    });
	}else{ alert('Il n\'y a pas d\'Expert à affecter ');
				$('#btnAffecterListe').attr('disable', false);
				return false;
		 }
});

//"""""""""""""""""""""""""""""""""""""""""""""selected items""""""""""""""""""""""""""""""""""""""""""""""""""
var items2 = []; //array of selected items' id 

// toggle the Element_id in the items array
function toggleItem2(element_id){  
    if(jQuery.inArray(element_id, items2) != -1 ){ //element_id exist  => so remove it 
		    items2.splice($.inArray(element_id, items2), 1);
		}else{ // element_id dosen't exist  => so add it 
      items2.push(element_id);
		}
}  

// 
//"""""""""""""""""""""""""""""""""""""""""""""End selected items""""""""""""""""""""""""""""""""""""""""""""""""""

//"""""""""""""""""""""""""""""""""""""""""""""End Btn sent selected items""""""""""""""""""""""""""""""""""""""""""""""""""

$('#frmDesaffecterListe').on('submit' , function(e) {
	$('#btnDesaffecterListe').attr('disable', true);
	e.preventDefault();
	// console.log(e.currentTarget.action);
    if (items2.length !== 0) { 
	    $.ajax({
	        url: e.currentTarget.action,
	        type: 'POST',
	        dataType: 'json',
	        data: {'_token': function () {
											return $('input[name="_token"]').val();
											},
					'id_agence' :  $('#id_agence').val() ,
					'affecteListe': items2
				 },
	        success: function(data) {
	                   // ... do something with the data...
	                   console.log(data);
	                   alert(data.etat +' : '+data.message);
	                   window.location.href = '{{route("agences.showExperts",$agence->id )}}';

	                 },
	       error: function(xhr, status, error) {
	       				console.log(error);
	       				console.log(xhr);
	       				alert('Erreur: Il n\'y a pas d\'Expert à affecter, '+error);
	       } 
	    });
	}else{ alert('Il n\'y a pas d\'Expert à désaffecter ');
				$('#btnDesaffecterListe').attr('disable', false);
				return false;
		 }
});

$(document).ajaxStart(function() {
         $(document.body).css({'cursor' : 'wait'});
         });
  $(document).ajaxStop(function() { 
        $(document.body).css({'cursor' : 'default'});
        });



});//END document.ready(

</script>



@endsection