@extends('default')

@section('head_title')
    Modifier Un Article 
@endsection

@section('title')
    Modifier Un Article 
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

        .liste .card-header a{
            display: block;
        }
        .liste .card-header a span{
            float: right;
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
                                <a data-toggle="collapse" data-parent="#accordion3" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="text-dark"><i class="mdi mdi-folder-outline"></i> Modifier l'Article portant l'ID N° {{$article->id}} <span class="ion-arrow-down-b"></span></a>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse show " aria-labelledby="headingOne" data-parent="#accordion3" >
                            <div class="card-body ">
                                <form name="ajout_user" action="{{route('pieces.article.update',$article->id)}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" value="{{$article->id}}" name="id">
                                        <div class="col-md-2" style="margin-top:-6px;">
                                            <label for="lieu" class="col-form-label">Categorie:  <samp class="float-right text-danger" >*</samp></label>
                                            <select class="form-control" id="categorie" name="categorie">
                                                @foreach ($categoriePieces as $categoriePiece)
                                                <option value="{{$categoriePiece->id}}">{{$categoriePiece->libelle}}</option>
                                                @endforeach
                                                <option value="{{$categorie_lib->id}}" selected>{{$categorie_lib->libelle}}</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-3" style="margin-top:-6px;">
                                            <label for="lieu" class="col-form-label">Intitulé De L'Article:  <samp class="float-right text-danger" >*</samp></label>
                                            <div class="">
                                                <input type="text" id="intitule" name="intitule" class="form-control"  value="{{$article->intitule}}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <label for="rdv_date" class="">Description De L'Article:  <samp class="float-right text-danger" >*</samp></label>
                                            <div class="">
                                                <input id="description" name="description" class="form-control" required value="{{$article->description}}">
                                            </div>  
                                        </div>

                                        <div class="col-lg-2 text-right">
                                            <div class="form-group">
                                                <br>
                                                <input id="btn_ajouter_rdv" class="btn btn-success btn-block text-center" type="submit" value="Modifier l'Article"  style="margin-top: 8px;">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-1 text-right">
                                            <div class="form-group">
                                                <br>
                                                <a id="btn_ajouter_rdv" href="{{ URL::previous() }}" class="btn btn-default btn-block btn-secondary text-center" style="margin-top: 8px;color:white;">Annuler</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>

@endsection

@section('js')
@endsection