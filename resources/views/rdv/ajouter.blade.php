@extends('default')

@section('head_title')
    RDV pour ODS
@endsection

@section('title')
   RDV ODS
@endsection

@section('head')
    <link href="{{asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <style type="text/css">
        table.dataTable thead .sorting, table.dataTable thead .sorting_asc, table.dataTable thead .sorting_desc, table.dataTable thead .sorting_asc_disabled, table.dataTable thead .sorting_desc_disabled, .table > tbody > tr > td, .table > tfoot > tr > td, .table > thead > tr > td {

            width: 14% !important;
        }

        .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>thead>tr>th, .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>thead>tr>td, .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>tbody>tr>th, .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>tbody>tr>td {
            vertical-align: middle;
            padding: 0px;
        }

        .label-statut.btn-primary, .label-statut.btn-primary:hover{
            background: white !important;
            color: #40c68a !important;
            font-weight: 800 !important;
            border: 2px #40c68a solid !important;
        }

        .label-statut.btn-danger, .label-statut.btn-danger:active{
            background-color: white;
            border: 2px solid #ff5560;
            color: #ff5560;
            font-weight: bold;
        }

        .label-statut.btn-danger:not(:disabled):not(.disabled):active{
            color: #b21f2d;
            background-color: white !important;
            border-color: #b21f2d !important;
            border: 2px solid #ff5560 !important;
        }
        h6{
            margin: 0 !important;
        }




        /*table.dataTable thead .sorting:last-child, table.dataTable thead .sorting_asc:last-child, table.dataTable thead .sorting_desc:last-child, table.dataTable thead .sorting_asc_disabled:last-child, table.dataTable thead .sorting_desc_disabled:last-child , .table > tbody > tr > td:last-child , .table > tfoot > tr > td:last-child, .table > thead > tr > td:last-child {
            display: inline-block;
            width: 150px !important;
            padding: 14px 10px;
        }
        table .btn-primary {
            background-color: #007e8a;
            border: 1px solid #007e8a;
            padding: 5px 3px;
        }
*/
    </style>

@endsection

@section('content')

    <div id="dossier_ods" class="liste">
        <div class="row">
            <div class="col-sm-12">
                <div id="accordion3" class="formulaire-recherche">
                    <div class="card m-b-30">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0 mt-0 font-16">
                                <a data-toggle="collapse" data-parent="#accordion3" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="text-dark"><i class="mdi mdi-folder-outline"></i> Liste Des ODS par Dossier <span class="ion-arrow-down-b"></span></a>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse show " aria-labelledby="headingOne" data-parent="#accordion3" >
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table id="ods" class="table dataTable table-responsive  display responsive nowrap" style="width: 100%;" >
                                            <thead>
                                                <tr>
                                                    <th>N° ODS</th>
                                                    <th>N° Dossier</th>
                                                    <th>Date ODS</th>
                                                    <th>Expert</th>
                                                    <th>Tiers</th>
                                                    <th>Matricule</th>
                                                    <th>Date RDV</th> 
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

<div class="card">
    <div class="card-header">
        <h6>Information RDV du dossier N° <label id="lbl_ref_sinistre" class="col-form-label"></label></h6>
    </div>

    <div class="card-body">
        <form id="form_rdv" action="{{route("rdv.store")}}" method="POST" enctype="multipart/form-data">
            @csrf

           {{-- <div class="form-group">
                <div class=" date" >
                    <div class="col-sm-12 row" id="datetimepicker1" data-target-input="nearest">
                     <label for="date" class="col-sm-2 col-form-label">Date <samp class="float-right text-danger" >*</samp></label>
                        <input type="text" name="date" class="form-control col-sm-9 datetimepicker-input" data-target="#datetimepicker1"/>
                        <div class="input-group-append col-sm-1" data-target="#datetimepicker1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 control-label">DateTime Picking</label>
                <div class="input-group date form_datetime col-md-8" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                    <input class="form-control" size="16" type="text" value="">
                    <span class="input-group-addon"><span class="fa fa-remove"></span></span>
                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                </div>
                <input type="hidden" id="dtp_input1" value="" />
                <br/>
            </div> --}}
            <input type="hidden" id="id" name="id" value="" />
            <input type="hidden" id="ods_id" name="ods_id" value="" />

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4" style="margin-top:-6px;">
                        <label for="lieu" class="col-form-label">Lieu <samp class="float-right text-danger" >*</samp></label>
                        <div class="">
                            <input type="text" id="lieu" name="lieu" class="form-control"  value="" required>
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                        <label for="rdv_date" class="">Date <samp class="float-right text-danger" >*</samp></label>
                        <div class="">
                            <input type="date" id="rdv_date" name="rdv_date" class="form-control datetime" data-date-format="yyyy-MM-dd" value="" required>
                        </div>  
                    </div>
                    
                    <div class="col-sm-2" style="margin-top:-6px;">
                        <label for="rdv_date" class="col-form-label">Time <samp class="float-right text-danger" >*</samp></label>
                        <div class="">
                            <input type="time" id="rdv_time" name="rdv_time" class="form-control datetime" data-date-format="hh:ii" value="" required>
                        </div>
                    </div>
                    
                    <div class="col-sm-2" style="margin-top:-6px;">
                        <label for="status" class="col-form-label">Statut</label>
                        <div class="" id="statut_rdv">
                        
                        <label class="label-statut voir-detail btn btn-block btn-primary">Status RDV</label>
                        </div>
                    </div>

                    <div class="col-sm-2 text-right">
                        <div class="form-group  ">
                            <br>
                            <input id="btn_ajouter_rdv" class="btn btn-success btn-block text-center" type="submit" value="Programmer RDV"  style="margin-top: 8px;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="autre_mail" class="col-form-label">Autres email </label>
                        <div class="">
                            <input type="email" id="autre_mail" name="autre_mail" class="form-control email"  value="" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="autre_tel" class="col-form-label">Autres Tél </label>
                        <div class="">
                            <input type="text" id="autre_tel" name="autre_tel" class="form-control "  value="" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <label for="observation" class="col-form-label">Observation </label>
                    <div>
                        <textarea type="text" id="observation" name="observation" class="form-control " required rows="5"></textarea>
                    </div> 
                </div>
            </div>
        </form>


    </div>
</div>
@endsection

@section('js')
{{-- <script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datetimepicker-min.js')}}" type="text/javascript"></script>
 --}}{{-- <script src="https://tempusdominus.github.io/bootstrap-4/theme/js/tempusdominus-bootstrap-4.js"></script> --}}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script type="text/javascript">
   $(function(){
        $('#rdv_date').on('change',function(event) {
            /* Act on the event */
            console.log($('#rdv_date').val());
        });



   var table_ods = $('#ods').DataTable({
            "responsive": true,
            "autoWidth": true,
            "columns": [

            {"data": "num_ods", "orderable": true, "searchable": true},
            {"data": "ref_sinistre", "orderable": true, "searchable": true},
            {"data": "date_ods", "orderable": true, "searchable": true},
            {"data": "expert", "orderable": true, "searchable": true},
            {"data": "nom_tiers", "orderable": true, "searchable": true},
            {"data": "matricule", "orderable": true, "searchable": true},
            {"data": "rdv.rdv_date", "orderable": true, "searchable": true},
            // {"data": "marque", "orderable": true, "searchable": true},
            // {"data": "model", "orderable": true, "searchable": true},
            // {"data": "num_serie", "orderable": true, "searchable": true},
            // {"data": "num_tel", "orderable": true, "searchable": true},

            {"data": "detail", "orderable": true, "searchable": true},

            ],
                    "rowId": 'ref_sinistre', // IdRow = Id_User in bd
                    "processing": true,
                    "serverSide": true,
                    // "responsive": false,
                    "ajax": {
                        url: '{{route('ods.tableAll')}}',
                        type: 'POST',
                        data: {
                            '_token': function () {
                                return $('input[name="_token"]').val();
                            }
                            // ,
                            // 'ref_sin': function(){ return ref_sinis ;}
                        }
                    },

                    "order": [[0, "asc"]],
                    "searching": true,
                    "scrollY": "108px",
                     "scrollX": false,
                    // "deferRender": false,
                    "responsive":false,
                    "autoWidth": true,

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
    
$('#ods tfoot th ').each( function () {
      var title = $(this).text();
        if(title=="ACTION" || title== "Détail"){
                    $(this).html( '' );
        }else{
          $(this).html( '<input type="text" placeholder="Recherche " />' );
        }

    } );


    // table_ods.columns().every(function () {
    //         var that = this;

    //         $('input, select', this.footer()).on('keyup change', function () {
    //             if (that.search() !== this.value) {
    //                 that
    //                 .search(this.value)
    //                 .draw();
    //             }
    //         });
    //     });

    $("#ods tbody").delegate('tr', 'click', function() {
                
                //console.log(table_tiers.row( this ).data());
                //toggleRow_tiers(table_tiers.row( this ).data());

                $("#ods .highlight").removeClass('highlight');
                $( this ).addClass('highlight');
                selectedODS = table_ods.row( this ).data();
                selectedODS = selectedODS ? selectedODS:null;
                if("ref_sinistre" in selectedODS){
                    $('#lbl_ref_sinistre').text(selectedODS.ref_sinistre);
                }else{ $('#lbl_ref_sinistre').text('');}
                if (selectedODS  && "rdv" in selectedODS){
                    $('#lbl_ref_sinistre').text(selectedODS.ref_sinistre);
                    if("id" in selectedODS.rdv){
                        info_rdv(selectedODS);
                    }else{
                        rest_rdv();
                        $("#ods_id").val(selectedODS.id);
                    }
                }else{

                   rest_rdv();
                }

            });

    function info_rdv(data){ 
        console.log(data.rdv);
        for(var item in data.rdv) {
            $('#'+item).val(data.rdv[item]);    
        }
       // $("#ods_id").val(data.id);
        var today = moment(new Date());
        today =  moment(today).format('YYYY-MM-DD');
        var rdv_date = moment(data.rdv.rdv_date);
        rdv_date = moment(rdv_date).format('YYYY-MM-DD');
        if (today <= rdv_date ){
            $('#statut_rdv').html( '<label class=" btn btn-sm label-statut  btn-success btn-block">Programmé</label>');
        }else{
            $('#statut_rdv').html( '<label class=" btn btn-sm label-statut btn-danger btn-block">Echu</label>');
        }
         $('#btn_ajouter_rdv').val( 'Modifier');
    }

    function rest_rdv(){ 
       $('#form_rdv').trigger("reset");
       $('#id').val('');
        $("#ods_id").val('');
        // $('#lbl_ref_sinistre').text('');
       $('#statut_rdv').html( '<label class="voir-detail btn btn-sm label-statut btn-primary btn-block">Pas de RDV</label>');
       $('#btn_ajouter_rdv').val( 'Programmer RDV');
    }

   });
</script>

@endsection