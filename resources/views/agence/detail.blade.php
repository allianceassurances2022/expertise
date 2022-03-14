@extends('default')

@section('head_title')
Détail Agence
@endsection

@section('title')
Détail Agence code : {{$agence->CODE}} 

@endsection

@section('head')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="{{asset('assets/css/dashboard_def.css')}}">
	<style type="text/css">
		table.dataTable thead .sorting, table.dataTable thead .sorting_asc, table.dataTable thead .sorting_desc, table.dataTable thead .sorting_asc_disabled, table.dataTable thead .sorting_desc_disabled, .table > tbody > tr > td, .table > tfoot > tr > td, .table > thead > tr > td 
		{
		    width: 33% !important;*/
		}

		.btn-danger {
		    background-color: #a2020c;
		    border: 1px solid #a2020c;
		}
		/*#dejaaffecte th:nth-child(3), #dejaaffecte tbody td:nth-child(3){
			display: inline-block;
			width: 200px !important;
			text-align: right;
		}*/ 
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
					<h4 class="header-title"> <span class="fa fa-home"></span>Agence code : {{$agence->CODE}}</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-10">
								<h4 class="header-title">Détail Agence : </h4>
								<div class="form-group row">
									<label for="code_agence" class="col-sm-2 col-form-label">DR d'Agence</label>
									<div class="col-sm-10">
										<input class="form-control" name="dr_agence" type="text" id="dr_agence" readonly value="{{$agence->drAgence->libelle}}">
									</div>
								</div>
								<div class="form-group row">
									<label for="code_agence" class="col-sm-2 col-form-label">Code d'Agence</label>
									<div class="col-sm-10">
										<input class="form-control" name="code_agence" type="text" id="code_agence" readonly value="{{$agence->CODE}}">
									</div>
								</div>
								<div class="form-group row">
									<label for="code_agence" class="col-sm-2 col-form-label">Type d'Agence</label>
									<div class="col-sm-10">
										<input class="form-control" name="type_agence" type="text" id="type_agence" readonly value="{{$agence->typeAgence->type}}">
									</div>
								</div>
								<div class="form-group row">
									<label for="code_agence" class="col-sm-2 col-form-label">Statut d'Agence</label>
									<div class="col-sm-10">
										{!! $agence->STATUT == '0' ? "<button class='btn btn-danger'><span class=' label label-danger'>Inactif</span> </button>" 
                                                                      :"<button  class='btn btn-primary'><span class='primary label label-default'>Actif</span> </button>" !!}
									</div>
									
								</div>
								<div class="form-group row">
									<label for="code_agence" class="col-sm-2 col-form-label">Chef d'Agence</label>
									<div class="col-sm-10">
										<input class="form-control" name="chef_agence" type="text" id="chef_agence" readonly value="{{$agence->CHEF_AGENCE}}">
									</div>
								</div>
								<div class="form-group row">
									<label for="code_agence" class="col-sm-2 col-form-label">Email d'Agence</label>
									<div class="col-sm-10">
										<input class="form-control" name="email_agence" type="text" id="email_agence" readonly value="{{$agence->EMAIL}}">
									</div>
								</div>								
							
						</div>
					</div>
				</div>

				<div class="col-12">
					<div class="row">
{{-- _____________________________________Card_____________________________________________________ --}}
						<div class="col-md-6 col-xs-12" >
							<div class="card">
								<div class="card-header dejaAffecter">
									<h4 class="header-title"> <span class="fa fa-home"></span>   Liste des Utilisateurs affectées</h4>
								</div>
								<div class="card-body collone">
									<table id="AffectedUser" class=" table table-responsive table-hover responsive display nowrap">
								        <thead>
								            <tr>
								                <th style="width: 30% ">CODE</th>
								                <th style="width: 30% !important">Nom Prénom</th>
								                <th style="width: 30% !important">DATE D'AFFECTATION</th>
								            </tr>
								        </thead>
								        <tbody>
										</tbody>
								    </table>
								</div>
								<div class="col-xs-12 text-right" style="margin:5px 19px 22px 4px;">
									<a href="{{route('agences.showUsers',$agence->id)}}">
										<button class="btn btn-danger waves-effect waves-light">Modifier affectation 
										</button>
									</a>
								</div>
							</div>
						</div>
{{-- ________________________________________End Card______________________________________________ --}}

{{-- _____________________________________Card_____________________________________________________ --}}
						<div class="col-md-6 col-xs-12" >
							<div class="card">
								<div class="card-header dejaAffecter">
									<h4 class="header-title"> <span class="fa fa-home"></span>   Liste des Experts affectées</h4>
								</div>
								<div class="card-body collone">
									<table id="AffectedExpert" class=" table table-responsive table-hover responsive display nowrap" >
								        <thead>
								            <tr>
								                <th style="width: 30% !important">CODE</th>
								                <th style="width: 30% !important">Nom Prénom</th>
								                <th style="width: 30% !important">DATE D'AFFECTATION</th>
								            </tr>
								        </thead>
								        <tbody>
										</tbody>
								    </table>
								</div>
								<div class="col-xs-12 text-right" style="margin:5px 19px 22px 4px;">
										<a href="{{route('agences.showExperts',$agence->id)}}">
											<button class="btn btn-danger waves-effect waves-light">Modifier affectation 
											</button>
										</a>
								</div>
							</div>
						</div>
{{-- ________________________________________End Card______________________________________________ --}}
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


<script type="text/javascript">
$( document ).ready(function() {

console.log($('#frmAgence').serialize() );

    var tableUser = $('#AffectedUser').DataTable({
      "columns": [
		      {"data": "username", "orderable": true ,"searchable": true},
		      {"data": "nom", "orderable": true,"searchable": true},
		      {"data": "created_at"  ,"orderable": true,"searchable": true }
		      ],
		"rowId": 'id', // IdRow = Id_User in bd
		"processing": true,
		"serverSide": true,
		"ajax": {
	  			"url": '{{route("agence.UserAffecteDataTable")}}',
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
		"scrollY": "350px",
		// "scrollCollapse": true,
		// "scroller": false,
		"scrollX": true,
		"responsive": true,
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



 var tableExpert = $('#AffectedExpert').DataTable({
      "columns": [
		      {"data": "username", "orderable": true ,"searchable": true},
		      {"data": "nom", "orderable": true,"searchable": true},
		      {"data": "created_at"  ,"orderable": true,"searchable": true }
		      ],
		"rowId": 'ID', // IdRow = Id_User in bd
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
		"deferRender": true,
		"scrollY": "350px",
		// "scrollCollapse": true,
		// "scroller": false,
		"scrollX": true,
		"responsive": true,
 
 		// "selected": true,


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


});//END document.ready(

</script>



@endsection