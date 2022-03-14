@extends('default')

@section('head_title')
Afféctation Agence à Expert
@endsection

@section('title')
Afféctation des Agences à l'expert N° {{$expert->id}} 
({{$expert->username}})
@endsection

@section('head')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
	<link rel="stylesheet" href="{{asset('assets/css/dashboard_def.css')}}">
	<style type="text/css">
		table.dataTable thead .sorting, table.dataTable thead .sorting_asc, table.dataTable thead .sorting_desc, table.dataTable thead .sorting_asc_disabled, table.dataTable thead .sorting_desc_disabled, .table > tbody > tr > td, .table > tfoot > tr > td, .table > thead > tr > td 
		{
		   
		}

		.btn-danger {
		    background-color: #a2020c;
		    border: 1px solid #a2020c;
		}
		#dejaaffecte th:nth-child(1), #dejaaffecte tbody td:nth-child(1){
			display: none;
			width: 350px !important;
			
		}
		#dejaaffecte th:nth-child(3), #dejaaffecte tbody td:nth-child(3){
			display: inline-block;
			width: 200px !important;
			text-align: right;
		} 
		.highlight{
		    background-color: transparent !important;
		    color: black;
		    font-weight: 600;
		}

	</style>
@endsection
@section('content')
<div class="row">
		<div class="col-12">
			<div class="card">
				<form method="POST">
					@csrf
				</form>
				<div class="card-header">
					<h4 class="header-title"> <span class="fa fa-home"></span>Affectation des Agences à l'expert N° 0{{$expert->id}} ( {{$expert->username}} )</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-4 col-md-6 col-sm-12 mb-3">
							<div class="card">
								<form method="POST">
									@csrf
								</form>
								<div class="card-header">
									<h4 class="header-title"> <span class="fa fa-home"></span>   Liste des agences</h4>
								</div>
								<div class="card-body collone" >
									<table id="agence" class="display responsive nowrap" width="99%">
								        <thead class="nowrap">
								            <tr>
								                <th  class="all" >DR</th>
								                <th  class="all">CODE</th>
								                <th  class="all">CHEF D'AGENCE</th>
								            </tr>
								        </thead>
								        <tbody>
		            					</tbody>
								    </table>
								</div>
								<div class="col-xs-12 text-right" style="margin:5px 19px 22px 4px;">
										<button id="btnSelectAll"  class="btn btn-primary waves-effect waves-light">Selectionner les agences Affichés</button>
									</div>
							</div>
						</div>

						<div class="col-lg-4 col-md-6 col-sm-12 mb-3" >
							<div class="card">
								<div class="card-header pourAffecter">
									<h4 class="header-title"> <span class="fa fa-home"></span>   Liste des Agences à affectées</h4>
								</div>
								<div class="card-body collone" >
									<table id="pourAffecterAgenceExpert" class=" table dataTable table-responsive table-hover display nowrap" style="border-bottom:1px #0000004d solid;height: 540px; overflow: auto; width:100%;">
								        <thead >
								            <tr>
								                <th class="all" style="width: 33% !important;">DR</th>
								                <th class="all">CODE</th>
								                <th class="all">CHEF D'AGENCE</th>
								            </tr>
								        </thead>
								        <tbody>
		            					</tbody>
								    </table>
								</div>
								<form id="frmAffecterListe" action="{{route('user.affecteAgenceUser')}}">
									@csrf
									<div class="col-xs-12 text-right" style="margin:5px 19px 22px 4px;">
										<button id="btnAffecterListe" type="submit" class="btn btn-primary waves-effect waves-light">Affecter la liste selectionnée</button>
									</div>
								</form>
							</div>
						</div>

						<div class="col-lg-4 col-md-6 col-sm-12 mb-3" >
							<div class="card">
								<div class="card-header dejaAffecter">
									<h4 class="header-title"> <span class="fa fa-home"></span>   Liste des Agences déja affectées</h4>
								</div>
								<div class="card-body collone">
									<table id="dejaAffecte" class=" table table-responsive table-hover nowrap" style="border-bottom:1px #0000004d solid;height: 400px; overflow: auto;">
								        <thead>
								            <tr>
								                <th style="width: auto !important;">DR</th>
								                <th style="width: auto !important;">CODE</th>
								                <th style="width: auto !important;">Chef d'Agence</th>
								                <th style="text-align: right;">AFFECTATION</th>
								            </tr>
								        </thead>
								        <tbody>
								        	@foreach($agence_list as $agence)
								        	<tr id="{{$agence->id}}">
									        	<td style="width: auto !important">{{$agence->dr}}</td>
									        	<td style="width: auto !important">{{$agence->code}}</td>
									        	<td style="width: auto !important">{{$agence->CHEF_AGENCE}}</td>
									        	<td style="text-align: right;">{{$agence->updated_at}}</td>
								        	</tr>
								        	@endforeach
								        	<!--  -->
										</tbody>
								    </table>
								</div>
								<form id="frmDesaffecterListe" action="{{route('user.desaffecteAgenceUser')}}">
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
	<script src="{{asset('assets/plugins/select2/js/select2.js')}}" ></script>
	<script src="{{asset('assets/js/pages/select2/select2-init.js')}}" ></script>
	<script src="{{asset('assets/js/pages/user.js')}}" ></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script type="text/javascript">
$( document ).ready(function() {
    
    var table = $('#agence').DataTable({
      "columns": [
		     
		      {"data": "DR" ,"name":"directions.libelle" , "orderable": true ,"searchable": true},
		      {"data": "CODE", "orderable": true ,"searchable": true},
		      {"data": "CHEF_AGENCE"  ,"orderable": true,"searchable": true,}
		      
		      ],
		"rowId": 'ID', 
		"processing": true,
		"serverSide": true,
		"rowCallback": function( row, data ) {
						    if ( jQuery.inArray($(row).attr('ID'), items) != -1 ) {  //element exist dans les selected_element  => so select it
						      $(row).addClass('selected');
						    }
						  },
		"ajax": {
	  			"url": '{{route("user.AgenceNonAffecteDataTable")}}',
            	"dataType": "json",
				"type": 'POST',
				"crossDomain": true,
				"data": { '_token': function () {
											return $('input[name="_token"]').val();
											},
							'user':'{{$expert->id}}'
						}
				},
		"order": [[ 1, "asc" ]],
		"searching": true,
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


    var tableDejaAffecte = $('#dejaAffecte').DataTable(
    	{"autoWidth": false});
 
    $('#dejaAffecte tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
        toggleItem2(this['id']) ;
    } );

    

// DataTable
// var table = $('#police').DataTable();

// Apply the search
// table.columns().every( function () {
//   var that = this;

//   $( 'input, select', this.footer() ).on( 'keyup change', function () {
//     if ( that.search() !== this.value ) {
//       that
//       .search( this.value )
//       .draw();
//     }
//   } );
// } );


//"""""""""""""""""""""""""""""""""""""""""""""selected items""""""""""""""""""""""""""""""""""""""""""""""""""

var items = []; //array of selected items' id 

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

$('#agence tbody').on('click', 'tr', function(){   
        toggleRow(this);
        toggleItem(this['id']) ;
        $(this).toggleClass('selected');
        //console.log(items);
    });

function addItemIfDontExist(element_id){
	if(jQuery.inArray(element_id, items) == -1 ){ //element_id n'existe pas => so add it 
			    items.push(element_id);
			 	return true;
				}
		return false;
}

function addRow(row){
	var row = $(row).clone();
	$('#pourAffecterAgenceExpert tbody').prepend(row);
}

$('#btnSelectAll').click( function () {
    	 $.each($('#agence tbody tr'), function(index, val) {
    	 	 /* iterate through array or object */
    	 	if (addItemIfDontExist(val['id']) ) {
    	 		addRow(val);
    	 		$(val).toggleClass('selected');
    	 		console.log(val['id']);
    	 	}
    	 });
    });
//"""""""""""""""""""""""""""""""""""""""""""""End selected items""""""""""""""""""""""""""""""""""""""""""""""""""

$(document).ajaxStart(function() {
         $(document.body).css({'cursor' : 'wait'});
         });
  $(document).ajaxStop(function() { 
        $(document.body).css({'cursor' : 'default'});
        });



//"""""""""""""""""""""""""""""""""""""""""""""Btn sent selected items""""""""""""""""""""""""""""""""""""""""""""""""""

$('#frmAffecterListe').on('submit' , function(e) {
	e.preventDefault();
	// console.log(e.currentTarget.action);
    if (items.length !== 0) { 
	    $.ajax({
	        url: e.currentTarget.action,
	        type: 'POST',
	        dataType: 'json',
	        data: {'_token': function () {
											return $('input[name="_token"]').val();
											},
					'affecteListe': items,
					'id' : '{{$expert->id}}'
				 },
	        success: function(data) {
	                   // ... do something with the data...
	                   console.log(data);
	                   alert(data.etat +' : '+data.message);
	                   window.location.href = '{{route("experts.expertAgence",$expert->id )}}';

	                 },
	       error: function(xhr, status, error) {
	       				console.log(error);
	       				console.log(xhr);
	       } 
	    });
	}else{ alert('Il n\'y a pas d\'agences à affecter ');
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
					'affecteListe': items2,
					'id' : '{{$expert->id}}'
				 },
	        success: function(data) {
	                   // ... do something with the data...
	                   console.log(data);
	                   alert(data.etat +' : '+data.message);
	                   window.location.href = '{{route("experts.expertAgence",$expert->id )}}';

	                 },
	       error: function(xhr, status, error) {
	       				console.log(error);
	       				console.log(xhr);
	       } 
	    });
	}else{ alert('Il n\'y a pas d\'agences à désaffecter ');
				return false;
		 }
});






});//END document.ready(

</script>



@endsection