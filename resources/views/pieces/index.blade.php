@extends('default')

@section('head_title')
    Inventaire Pieces et categories
@endsection

@section('title')
    Inventaire Pieces et categories
@endsection

@section('head')
    <link href="{{asset('assets/plugins/select2/css/select2.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/ODSStyling.css')}}">
    <style>
        #dossier_ods table.dataTable.nowrap th, #dossier_ods table.dataTable.nowrap td {
            white-space: nowrap;
            width: 11% !important;
        }

        #dossier_ods table.dataTable.nowrap th:nth-child(1), #dossier_ods table.dataTable.nowrap td:nth-child(1) {
            white-space: nowrap;
            width: 1% !important;
        }

        #dossier_ods table.dataTable.nowrap th:nth-child(3), #dossier_ods table.dataTable.nowrap td:nth-child(3) {
            white-space: nowrap;
            width: 21% !important;
        }

        #traitement_ods table.dataTable.nowrap th, #traitement_ods table.dataTable.nowrap td {
            white-space: nowrap;
            width: 11% !important;
        }

        #traitement_ods table.dataTable.nowrap th:nth-child(1), #traitement_ods table.dataTable.nowrap td:nth-child(1) {
            white-space: nowrap;
            width: 2% !important;
        }

        #traitement_ods table.dataTable.nowrap th:nth-child(3), #traitement_ods table.dataTable.nowrap td:nth-child(3) {
            white-space: nowrap;
            width: 21% !important;
        }

        #traitement_ods table.dataTable.nowrap th:nth-child(2), #traitement_ods table.dataTable.nowrap td:nth-child(2) {
            white-space: nowrap;
            width: 25% !important;
        }
    </style>
@endsection

@section('content')

    <div id="dossier_ods" class="liste">
        <div class="row">
            <div class="col-sm-12">
                <div id="accordion3" class="formulaire-recherche">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0 mt-0 font-16">
                                <a data-toggle="collapse" data-parent="#accordion3" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="text-dark"><i class="mdi mdi-folder-outline"></i> liste Des Categories<span class="ion-arrow-down-b"></span></a>
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
                                                    <th>ID</th>
                                                    <th>Intitulé</th>
                                                    <th>Description</th>
                                                    <th>Date D'Ajout</th>
                                                    <th>Date de Modification</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Intitulé</th>
                                                    <th>Description</th>
                                                    <th>Date D'Ajout</th>
                                                    <th>Date de Modification</th>
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
            </div>
        </div>
    </div>

    <div id="traitement_ods" class="liste">
        <div class="row">
            <div class="col-sm-12">
                <div id="accordion4" class="formulaire-recherche">
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0 mt-0 font-16">
                                <a data-toggle="collapse" data-parent="#accordion4" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour" class="text-dark"><i class="mdi mdi-folder-outline"></i> Liste Des Pieces/Articles<span class="ion-arrow-down-b"></span></a>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion4" style="">
                            <div class="card-body">
                                <div class="row">
                                    <form>
                                        @csrf
                                    </form>
                                    <div class="col-sm-12">
                                        <table id="article" class="table dataTable table-responsive table-hover display responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Intitulé</th>
                                                    <th>Description</th>
                                                    <th>Date D'Ajout</th>
                                                    <th>Date de Modification</th>
                                                    <th>Action</th>
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

<div class="my-wrapper3">
    <div class="my-modal">
        <div class="close"><p>X</p></div>
        <div class="row">
            <div class="col-sm-12">
                <h5 class="">Desactivation de la Categorie N°  </h5>
                <div class="row">
                    <div class="col-md-12">
                        <p>Etes vous sure de bien vouloir supprimer l'ODS numéro xxxxx, cliquez sur abandonner afin d'abandonner, ou cliquez sur annuler l'ods afin de confirmer l'annulation de l'ods.</p>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="row">
                    <div class="col-sm-12 text-right buttons-list">
                        <button type="button" class="btn btn-lg btn-secondary waves-effect waves-light close-btn"><i class="ion-android-system-back"></i> Abandonner</button>
                        <a href="./annuler/1" class="btn btn-lg btn-danger waves-effect waves-light"><i class="mdi mdi mdi-delete"></i>Desactiver La Categorie</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="my-wrapper4">
    <div class="my-modal">
        <div class="close"><p>X</p></div>
        <div class="row">
            <div class="col-sm-12">
                <h5 class="">Desactivation de l'article N°  </h5>
                <div class="row">
                    <div class="col-md-12">
                        <p>Etes vous sure de bien vouloir supprimer l'ODS numéro xxxxx, cliquez sur abandonner afin d'abandonner, ou cliquez sur annuler l'ods afin de confirmer l'annulation de l'ods.</p>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="row">
                    <div class="col-sm-12 text-right buttons-list">
                        <button type="button" class="btn btn-lg btn-secondary waves-effect waves-light close-btn"><i class="ion-android-system-back"></i> Abandonner</button>
                        <a href="./annuler/1" class="btn btn-lg btn-danger waves-effect waves-light"><i class="mdi mdi mdi-delete"></i>Desactiver L'Article</a>
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
    </script>
    <script>
////////////////////////////////////////////////////////////////////// declaration globale
$( document ).ready(function() {

        var selectedODS;
        var selectedArticle;

        var ref_sinis;
        var idcategorie ;
        var selectedODS;
        var id_ods;
        var remarque_relance;
        idcategorie ='';

       function verif_null(){
                if (selectedODS) {
                    $( "#bouton_creer" ).show("fast");
                    $( "#bouton_modifier" ).show("fast");
                    $( "#bouton_additif" ).show("fast");
                }
        }

 
    function affiche_tiers(idcat){
        idcategorie = idcat;
        console.log('cat '+idcategorie);   
        
        // if (  $.fn.DataTable.isDataTable( $('#tiers') ) ) {
          $('#article').DataTable().ajax.reload();
        //    return;
        // }
        // tableTiers();   

    } 

    myFunctionAnnulerCat = function(){
        DesactiverCategorie=["Desactivation De La Categorie N° "+selectedODS.id+" sous le libelle '"+selectedODS.libelle+"'",
                             "Etes vous sure de bien vouloir Desactiver la Categorie Numéro "+selectedODS.id+" sous le libelle '"+selectedODS.libelle+"' cliquez sur abandonner afin d'abandonner la Desactivation, ou cliquez sur Desactiver la categorie afin de confirmer sa Desactivation",
                             "<a href='./annuler/1' class='btn btn-lg btn-danger waves-effect waves-light'><i class='fa fa-thumbs-down'></i> Desactiver La Categorie</a>"
                             ];
        ActiverCategorie=["Activation De La Categorie N° "+selectedODS.id+" sous le libelle '"+selectedODS.libelle+"'",
                             "Etes vous sure de bien vouloir Activer la Categorie Numéro "+selectedODS.id+" sous le libelle '"+selectedODS.libelle+"' cliquez sur abandonner afin d'abandonner l'Activation, ou cliquez sur Activer la categorie afin de confirmer son activation",
                             "<a href='./annuler/1' class='btn btn-lg btn-primary waves-effect waves-light'><i class='fa fa-thumbs-up'></i> activer La Categorie</a>"
                             ];
        $(".my-wrapper3 .buttons-list a").remove();                     
        $(".my-wrapper3 h5").text(selectedODS.etat=="1" ? DesactiverCategorie[0]: ActiverCategorie[0]);
        $(".my-wrapper3 .row p").text(selectedODS.etat=="1" ? DesactiverCategorie[1]: ActiverCategorie[1]);
        $(".my-wrapper3 .buttons-list").append(selectedODS.etat=="1" ? DesactiverCategorie[2]: ActiverCategorie[2]);

        $(".my-wrapper3 a").attr("href","./categorie/desactiver/"+selectedODS.id);
        $( ".my-wrapper3" ).fadeIn( "slow");
        $('body').css( "height","100vh");
        $('body').css( "overflow-y","hidden");

        console.log(selectedODS);

        $( ".my-wrapper3 .close, .my-wrapper3 .close-btn" ).click(function() {
            $( ".my-wrapper3" ).fadeOut( "slow", function() {});
            $('body').css( "height","auto");
            $('body').css( "overflow","auto");

        });

    }

    myFunctionAnnulerArt = function(){
        DesactiverArticle=["Desactivation De L'Article N° "+selectedArticle.id+" sous le libelle '"+selectedArticle.intitule+"'",
                             "Etes vous sure de bien vouloir Desactiver l'Article "+selectedArticle.id+" sous le libelle '"+selectedArticle.intitule+"' cliquez sur abandonner afin d'abandonner la Desactivation, ou cliquez sur Desactiver L'Article afin de confirmer sa Desactivation",
                            "<a href='./annuler/1' class='btn btn-lg btn-danger waves-effect waves-light'><i class='fa fa-thumbs-down'></i> Desactiver L'Article</a>"
                            ];
        ActiverArticle=["Activation De L'Article N° "+selectedArticle.id+" sous le libelle '"+selectedArticle.intitule+"'",
                             "Etes vous sure de bien vouloir Activer l'Article "+selectedArticle.id+" sous le libelle '"+selectedArticle.intitule+"' cliquez sur abandonner afin d'abandonner l'activation, ou cliquez sur Activer L'Article afin de confirmer Son Activation",
                            "<a href='./annuler/1' class='btn btn-lg btn-primary waves-effect waves-light'><i class='fa fa-thumbs-up'></i> Activer L'Article</a>"
                            ];

        $(".my-wrapper4 .buttons-list a").remove();                     
        $(".my-wrapper4 h5").text(selectedArticle.etat=="1" ? DesactiverArticle[0]: ActiverArticle[0]);
        $(".my-wrapper4 .row p").text(selectedArticle.etat=="1" ? DesactiverArticle[1]: ActiverArticle[1]);
        $(".my-wrapper4 .buttons-list").append(selectedArticle.etat=="1" ? DesactiverArticle[2]: ActiverArticle[2]);

        $(".my-wrapper4 a").attr("href","./article/desactiver/"+selectedArticle.id);
        $( ".my-wrapper4" ).fadeIn( "slow");
        $('body').css( "height","100vh");
        $('body').css( "overflow-y","hidden");

        console.log(selectedArticle);

        $( ".my-wrapper4 .close, .my-wrapper4 .close-btn" ).click(function() {
            $( ".my-wrapper4" ).fadeOut( "slow", function() {});
            $('body').css( "height","auto");
            $('body').css( "overflow","auto");

        });
    }
        

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

                // debut table ODS
                var table_ods = $('#ods').DataTable({
                    "responsive": true,
                    "autoWidth": true,
                    "columns": [
                    {"data": "id", "orderable": true, "searchable": true},
                    {"data": "libelle", "orderable": true, "searchable": true},
                    {"data": "Description", "orderable": true, "searchable": true},
                    {"data": "created_at", "orderable": true, "searchable": true},
                    {"data": "updated_at", "orderable": true, "searchable": true},
                    {"data": "Actions", "orderable": false, "searchable": false},

                    ],
                    "rowId": 'ref_sinistre', // IdRow = Id_User in bd
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        url: '{{route('categorie.liste_table')}}',
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
                        "thousands" :",",
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
                    },
                    "fnDrawCallback": function( oSettings ) {
                        $("#ods tbody tr:first-child").trigger("click");
                    }
                });

                // fin table ODS

                // debut table tiers
                var table_tiers = $('#article').DataTable({
                        "responsive": true,
                        "autoWidth": true,
                        "columns": [

                        {"data": "id", "orderable": true, "searchable": true},
                        {"data": "intitule", "orderable": true, "searchable": true},
                        {"data": "description", "orderable": true, "searchable": true},
                        {"data": "created_at", "orderable": true, "searchable": true},
                        {"data": "updated_at", "orderable": true, "searchable": true},
                        {"data": "Actions", "orderable": false, "searchable": false}
                        ],
                                "rowId": 'id', // IdRow = Id_User in bd
                                "processing": true,
                                "serverSide": true,
                                "ajax": {
                                    url: "{{route('article.table')}}",
                                    type: 'POST',
                                    datatype: 'JSON',
                                    data: {
                                        '_token': function () {
                                            return $('input[name="_token"]').val();
                                        },
                                        'id': function(){ return  idcategorie;}
                                    }
                                },

                                "order": [[0, "asc"]],
                                "searching": true,
                                "deferRender": true,
                                "scrollY": "250px",
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
                                },
                                "fnDrawCallback": function( oSettings ) {
                                    $("#article tbody tr:first-child").trigger("click");
                                }
                });

                // fin table tiers
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
                    $("#ods .highlight").removeClass('highlight');
                    selectedcategorie = table_ods.row( this ).data();
                    toggleRow_sinistre(selectedcategorie);
                    
                    $( this ).addClass('highlight');
                    selectedODS = table_ods.row( this ).data();
                    verif_null();
                });

                $("#article tbody").delegate('tr', 'click', function() {
                    $("#article .highlight").removeClass('highlight');
                    selectedcategorie = table_tiers.row( this ).data();
                    
                    $( this ).addClass('highlight');
                    selectedArticle = table_tiers.row( this ).data();
                    verif_null();
                });


                function toggleRow_sinistre(data){
                    console.log(data.id);
                    affiche_tiers(data.id);
                }  

////////////////////////////////////////////////////////////////////////////////////////////////////////////

            
        });

    </script>
@endsection