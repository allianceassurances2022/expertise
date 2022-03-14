@extends('default')

@section('head_title')
Détail Choc
@endsection

@section('title')
Détail Choc {{$choc->choc}}
@endsection

@section('head')
{{-- <link href="{{asset('assets/plugins/select2/css/select2.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" /> --}}

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{asset('assets/css/ODSStyling.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/vue-select.css')}}">
<style type="text/css">
table{
  text-align: center;
}
#accordion10, #accordion11{
  margin-bottom: 20px;
}
</style>
@endsection

@section('content')
<input type="hidden" id="editAct" value="{{$edit}}">
<div class="liste" >
  <div class="row" id="info_ods" >
   <div class="col-sm-12">
    <div id="accordion6" class="formulaire-recherche">
     <div class="card">
      <div class="card-header" id="headingOne">
       <h5 class="mb-0 mt-0 font-16">
        <a data-toggle="collapse" data-parent="#accordion6" href="#collapseSix" aria-expanded="true" aria-controls="collapseSix" class="text-dark"><i class="ion-information-circled"></i> Information de l'ODS <span class="ion-arrow-down-b"></span>
        </a>
      </h5>
    </div>
    <div id="collapseSix" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion6" style="">
     <div class="card-body">

      <div class="row">
        <div class="col-md-12">
          <h6></h6>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
           <label>N° Sinistre</label>
           <input type="text" class="form-control" value="{{$expertise->ods->ref_sinistre}}" required name="ref_sinistre"  id="ref_sinistre" readonly>
         </div>
       </div>
       <div class="col-md-6">
        <div class="form-group">
         <label>Date Sinistre</label>
         <input type="text" class="form-control" value="{{$expertise->ods->date_sinistre}}" required="" name="date_sinistre" id="date_sinistre" readonly>
       </div>
     </div>
   </div>
   <div class="row">
    <div class="col-md-6">
      <div class="form-group">
       <label>Police</label>
       <input type="text" class="form-control"  value="{{$expertise->ods->ref_police}}" required="" name="ref_police" id="ref_police" readonly>
     </div>
   </div>
   <div class="col-md-6">
    <div class="form-group">
     <label>Assuré/Tiers</label>
     <input type="text" class="form-control" value="{{$expertise->ods->nom_tiers}}" required="" name="nom_tiers"  id="nom_tiers" readonly>
   </div>
 </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

@if($edit = 1)
<form id="choc_details" method="post" action="{{route('choc.update', $choc->id)}}">
  @endif
  @csrf

  @verbatim
  <div  id="root">
    <div class="liste" >
      <div class="row" id="info_ods" >
        <div class="col-sm-12">
          <div id="accordion9" class="formulaire-recherche">
            <div class="card">
              <div class="card-header" id="headingNine">
                <h5 class="mb-0 mt-0 font-16">
                  <a data-toggle="collapse" data-parent="#accordion9" href="#collapseNine" aria-expanded="true" aria-controls="collapseNine" class="text-dark"><i class="ion-information-circled"></i> Information Du Choc {{choc.choc}} <span class="ion-arrow-down-b"></span>
                  </a>
                </h5>
              </div>
              <div id="collapseNine" class="collapse show" aria-labelledby="headingNine" data-parent="#accordion9" style="">
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-12">
                      <h6></h6>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Type Choc</label>
                        <input type="text" class="form-control" v-model="choc.choc" required="" name="type_choc" id="type_choc" readonly>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Description</label>
                        <textarea  class="form-control" name="description_choc" id="description_choc" required>{{choc.description}}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div id="accordion11" class="formulaire-recherche">
                        <div class="card">
                          <div class="card-header" id="headingEle">
                            <h5 class="mb-0 mt-0 font-16">
                              <a data-toggle="collapse" data-parent="#accordion11" href="#collapseEle" aria-expanded="true" aria-controls="collapseEle" class="text-dark"><i class="ion-information-circled"></i> Avis <span class="ion-arrow-down-b"></span>
                              </a>
                            </h5>
                          </div>
                          <div id="collapseEle" class="collapse show" aria-labelledby="headingEle" data-parent="#accordion11" style="">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Détail de réparation</label>
                                    <textarea  class="form-control" rows="5" name="remarque" id="remarque">{{choc.remarque}}</textarea>
                                  </div>
                                </div>
                              </div>
                              <div class="row ">
                                <div v-if="estat == 1" class="col-md-12">
                                  <div class="form-group">
                                    <label>Etat</label>
                                    <input type="text" class="form-control" v-model="choc.etat" name="etat_choc" id="etat_choc" readonly>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>





    <div class="liste">
      <div class="row" >
        <div class="col-sm-12">
          <div id="accordion7" class="formulaire-recherche">
            <div class="card">
              <div class="card-header" id="headingFive">
                <h5 class="mb-0 mt-0 font-16">
                  <a data-toggle="collapse" data-parent="#accordion7" href="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven" class="text-dark"><i class="ion ion-model-s"></i> Fournitures <span class="ion-arrow-down-b"></span>
                  </a>
                </h5>
              </div>
              <div class="card-body" style="text-align: center;color: red;font-size: large;">
                Ne pas allouer des fournitures avec AUTRES sauf pièce non existante dans la liste
              </div>
              <div id="collapseSeven" class="collapse show" aria-labelledby="headingFive" data-parent="#accordion7" style="">
                <div class="card-body">
                  <table class="table table-bordered table-striped table-hover table-sm">
                   <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Pièce</th>
                        <th>Prix</th>
                        <th>Nb</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody v-sortable.tr="odsLines">
                    <tr  v-for="(odsLine , index) in odsLines" :key="index">
                      <td>{{index+1}}</td>
                    <td>
                        <v-select
                            name="piece"
                            v-model="odsLine.piece"
                            @input="getCatPiece(index)"
                            label="intitule"
                            :options="PiecesOptions">
                        </v-select>
                  </td>
                  <td >  <input  class="form-control text-right" type="number" min="0" step=".01"  name=""  v-model="odsLine.price" @change="calculateLineTotal(odsLine)"></td>

                  <td >  <input class="form-control text-right" type="number" min="1" step="1"   name=""  v-model="odsLine.nb"  @change="calculateLineTotal(odsLine)" ></td>

                  <td >  <input class="form-control text-right" type="number" min="0" step=".01" name=""  v-model="odsLine.total" readonly ></td>
                  <td>
                    <button v-if="editAct !=0" type="button" class="btn btn-default" @click="addOdsLine(index)"><i class="ion-plus"> </i>Ajouter</button>
                    <button v-if="editAct !=0" type="button" class="btn btn-danger" @click="deleteOdsLine(index, odsLine)" >Supprimer </button>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="5"></td>
                  <td> <button v-if="editAct !=0" type="button" class="btn btn-custom btn-block btn-default" @click="addOdsLine(odsLines.length)"><i class="ion-plus"> </i>Ajouter</button>
                    <button v-if="editAct !=0" type="button" class="btn btn-custom btn-block btn-default"  @click="AutreaddOdsLine(odsLines.length)"><i class="ion-plus"> </i>Autres</button></td>

                  </tr>


                </tfoot>
              </table>


            </div>

            <div class="card-body">
              <table class="table table-bordered table-striped table-hover table-sm">
               <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Autre</th>
                    <th>Prix</th>
                    <th>Nb</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody v-sortable.tr="AutreodsLines">
                <tr  v-for="(odsLine , index) in AutreodsLines" :key="index">
                  <td>{{index + 1}}</td>
                  <td>
                    <input type="text" name="" v-model="odsLine.libelle">
                  </td>
                  <td>  <input  class="form-control text-right" type="number" min="0" step=".01"  name=""  v-model="odsLine.price" @change="calculateLineTotal(odsLine)"></td>

                  <td>  <input class="form-control text-right" type="number" min="1" step="1"   name=""  v-model="odsLine.nb"  @change="calculateLineTotal(odsLine)" ></td>

                  <td>  <input class="form-control text-right" type="number" min="0" step=".01" name=""  v-model="odsLine.total" readonly ></td>
                  <td>
                    <button v-if="editAct !=0" type="button" class="btn btn-default" @click="AutreaddOdsLine(index)"><i class="ion-plus"> </i>Ajouter</button>
                    <button v-if="editAct !=0" type="button" class="btn btn-danger" @click="AutredeleteOdsLine(index, odsLine)" >Supprimer </button>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="6"></td>
                </tr>

                <tr>
                  <td colspan="1"></td>
                  <td>
                    <input  type="hidden" class="form-control" placeholder="0.00">
                  </td>
                  <td colspan="" class="text-right "> Total Unit</td>
                  <td>
                    <input  type="number" class="form-control" placeholder="0.00" readonly v-model="ODS_subtotal">
                  </td>
                  <td colspan="" class="text-right ">Total HT</td>
                  <td>
                    <input  type="number" class="form-control" placeholder="0.00" readonly v-model="ODS_total">
                  </td>
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

<div class="row mt-2">
  <div class="col-sm-12">
    <div id="accordion10" class="formulaire-recherche">
      <div class="card">
        <div class="card-header" id="headingTen">
          <h5 class="mb-0 mt-0 font-16">
            <a data-toggle="collapse" data-parent="#accordion10" href="#collapseTen" aria-expanded="true" aria-controls="collapseTen" class="text-dark"><i class="ion-information-circled"></i> Details <span class="ion-arrow-down-b"></span>
            </a>
          </h5>
        </div>
        <div id="collapseTen" class="collapse show" aria-labelledby="headingTen" data-parent="#accordion10" style="">
          <div class="card-body">

            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Main d'oeuvre (Montant)</label>
                  <input  class="form-control text-right" type="number" min="0" name="main_oeuvre" id="main_oeuvre" v-model="choc.main_oeuvre"  @change="someMontant()">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Immobilisation (Jours)</label>
                  <input  class="form-control text-right" type="number" min="0" name="immobilisation" id="immobilisation" v-model="choc.immobilisation"  @change="someMontant()">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Peinture</label>
                  <input  class="form-control text-right" type="number" min="0" name="Autres" id="Autres" v-model="choc.Autres"  @change="someMontant()">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Non soumis a la TVA</label>
                  <input  class="form-control text-right" type="checkbox" name="non_tva" id="non_tva" v-model="choc.non_tva" @change="someMontant()">
                </div>
            </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>TVA fourniture</label>
                  <input  class="form-control text-right" type="number" min="0" step="0.01" name="TVA" id="TVA" v-model="choc.TVA" readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>MTC</label>
                  <input  class="form-control text-right" type="number" min="0" step="0.01" name="MTC_choc" id="MTC_choc" v-model="choc.MTC_choc" readonly>
                </div>
              </div>
            </div>

            <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                  <label>Vétusté %</label>
                  <input  class="form-control text-right" type="number" min="0" max ="50" step="5" name="vetuste" id="vetuste" v-model="choc.vetuste">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                  <label>Vétusté pneumatique %</label>
                  <input  class="form-control text-right" type="number" min="0" max ="60" step="5" name="vetuste_pneumatique" id="vetuste_pneumatique" v-model="choc.vetuste_pneumatique">
                </div>
            </div>
            </div>
            <div class="row">
              <div class="col-sm-12 text-right ">
               <button v-if="editAct !=0" type="button" class=" btn btn-success" id="btnChocSave" @click="saveODS()">Modifier</button>
               @endverbatim
               <a href="{{route('expertise.show',$choc->expertise_id)}}" class="col-sm-2 btn btn-default btn-block btn-secondary text-center" id="btnChocRetour">Retour</a>

             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
</div>
</form>



<input type="hidden" id="URL_option_categorie" value="{{route('categorie.optionAll')}}">
<input type="hidden" id="URL_fournitures_choc" value="{{route('fournitures_choc.getAll',$choc->id)}}">
<input type="hidden" id="URL_autre_fournitures_choc" value="{{route('autre_fournitures_choc.getAll',$choc->id)}}">
<input type="hidden" id="URL_choc" value="{{route('choc.info',$choc->id)}}">
<input type="hidden" id="URL_option_pieces" value="{{route('piece.optionAll')}}">


@endsection
@section('js')
<script src="{{asset('assets/js/vue.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/vue-select.js')}}"></script>
<script  src="{{asset('assets/js/app_choc_edit.js')}}" type="text/javascript"> </script>

<!--select2-->
{{-- <script src="{{asset('assets/plugins/select2/js/select2.js')}}" ></script>
<script src="{{asset('assets/js/pages/select2/select2-init.js')}}" ></script> --}}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

<script>
  $( document ).ready(function() {
////////////////////////////////////////////////////////////////////// declaration globale
var ref_sinis;
var selectedODS;
var id_ods;
var remarque_relance;
    // console.log($("#choc_details").serializeArray());


////////////////////////////////////////////////////////////////////// Relance ODS


///////////////////////////////////////////////////////////////////////////////////////
});


</script>
@endsection
