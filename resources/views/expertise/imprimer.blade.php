@extends('impression_default')

@section('head')
 <link rel="stylesheet" media="print" href="{{asset('assets/css/print_style.css')}}" />
 <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
 <style>
  body{
   font-family: 'Roboto';
  }
 </style>
@endsection

@section('content')
 <button onclick="myFunction()" class="print" style="display: none;">Print this page</button>
@endsection
 <div class="printable">
 	<header>
 	  <div style="display:inline-block;width: 14%; text-align: center;vertical-align: top;">
 	 	<img src="{{asset('assets/images/Alliance_assurances_logo.jpg')}}" alt="" style="width: 100% !important;vertical-align: top;margin-bottom: 5px;">
 	  	<h5 style="font-weight: 100;padding: 0;margin:0 0px 5px 0;font-size: 8px;">ALLIANCE ASSURANCES</h5>
 	 </div>
 	 <div style="display:inline-block;width: 68%;padding:auto 2%; text-align: center;vertical-align: top;">
 	  <h1 style="padding: 0;margin:0 0px 5px 0;">Rapport D'Expertise</h1>
 	  <p style="padding: 0;margin:0; font-size: 14px;">{{$expert->nom}} {{$expert->prenom}} / Code: {{$expert->code}} / <br/>Adresse: {{$expert->adresse}} / Email: {{$expert->email}} / téléphone: {{$expert->num_tel}} /  </p>
 	 </div>
 	 <div style="display:inline-block;width: 14%; text-align: center;vertical-align: top;">
 	  <img src="{{asset('assets/images/QR_Code.png')}}" alt="" style="width: 100% !important;vertical-align: top;margin-bottom: 5px;">
 	  <p style="padding: 0; margin:0;font-size: 10px;;">12A45B7E9</p>
 	 </div>
 	</header>
 	<div class="content">
 	 <h4 style="padding: 5px 5px;margin:0 0 5px 0;background-color: black;font-weight: bold;">
 	  <span style="display: inline-block;width: 33%;text-decoration: underline;">Pv Numero <span class="date_expert">{{$expertise->id}}</span></span>
 	  <span style="display: inline-block;width: 33%;text-decoration: underline;">Additif Numero: <span class="date_expert"></span></span>
 	 </h4>
 	 
 	 <h5  style="padding: 0;margin:10px;">
 	  <span style="display: inline-block;width: 33%;">Date Expertise: <span class="date_expert">{{$expert->nom}} {{$expert->prenom}}</span></span>
 	  <span style="display: inline-block;width: 30%;">Lieu: <span class="lieu_expert">{{$expert->code}}</span></span> 
 	  <span style="display: inline-block;width: 36%; text-align: right;">Numero Sinistre: <span class="lieu_expert">{{$ods->ref_sinistre}}</span></span>
 	 </h5>
 	
 	 <h5  style="padding: 0;margin:10px;">
 	  <span style="display: inline-block;width: 33%;">Date Expertise: <span class="date_expert">{{$expert->created_at}}</span></span>
 	  <span style="display: inline-block;width: 36%;">Lieu: <span class="lieu_expert">{{$expert->adresse}}</span></span> 
 	  <span style="display: inline-block;width: 30%; text-align: right;">Numero ODS: <span class="lieu_expert">{{$ods->id}}</span></span>
 	 </h5> 
 	 
 	 <h5 style="padding: 0;margin:10px;">
 	  <span style="display: inline-block;width: 36%;">VIN: <span class="lieu_expert">{{$ods->num_serie}}</span></span>
 	 </h5> 
 	 
 	 <div class="liner"></div> 
 	
 	 <h4 style="padding: 5px 5px;margin:0 0 5px 0;font-weight: bold;text-decoration: underline;">Informations Vehicule/Assuré</h4>
 	 <h5  style="padding: 0;margin:10px;">
 	  <span style="display: inline-block;width: 33%;">N° Sinistre: <span class="date_expert">{{$ods->ref_sinistre}}</span></span>
 	  <span style="display: inline-block;width: 36%;">Date Sinistre: <span class="lieu_expert">{{$ods->date_sinistre}}</span></span> 
 	  <span style="display: inline-block;width: 30%; text-align: right;">Police: <span class="lieu_expert">{{$ods->ref_police}}</span></span>
 	 </h5>
 	
 	 <h5  style="padding: 0;margin:10px;">
 	  <span style="display: inline-block;width: 33%;">Assuré/Tiers: <span class="date_expert">{{$ods->nom_tiers}} {{$ods->prenom_tiers}}</span></span>
 	  <span style="display: inline-block;width: 36%;">Date d'expertise: <span class="lieu_expert">{{$expert->created_at}}</span></span> 
 	  <span style="display: inline-block;width: 30%; text-align: right;">Expert: <span class="lieu_expert">{{$expert->nom}} {{$expert->prenom}}</span></span>
 	 </h5>
 	 <h5  style="padding: 0;margin:10px;">
 	  <span style="display: inline-block;width: 33%;">Matricule: <span class="date_expert">{{$ods->matricule}}</span></span>
 	  <span style="display: inline-block;width: 36%;">Marque: <span class="lieu_expert">{{$ods->marque}}</span></span> 
 	  <span style="display: inline-block;width: 30%; text-align: right;">Model: <span class="lieu_expert">{{$ods->model}}</span></span>
 	 </h5>
 	
 	 <div style="border: 1px #ababab solid;">
 	  <h5 style="padding: 0;margin:10px;">
 	   <span style="display: inline-block;width: 50%;">Remarque ODS: "<span class="lieu_expert">{{$ods->id}}</span>"</span>
 	  </h5>
 	  <p style="padding: 0;margin:10px;font-size: 14px;"> {{$ods->remarque}}</p>
 	 </div>
 	 <div class="liner"></div> 
 	 <h4 style="padding: 5px 5px;margin:0 0 5px 0;font-weight: bold;text-decoration: underline;">Liste Des Chocs</h4>
 	 <table>
 	  <thead>
 	   <tr>
 	    <td> CHOC</td>
 	    <td>Montant Fourniture</td>
 	    <td>Montant HT</td>
 	    <td>Montant TTC</td>
 	   </tr>
 	  </thead>
 	  <tbody>
 	   @foreach($chocs as $choc)
 	    <tr>
 	     <td>Choc "{{$choc->choc}}"</td>
 	     <td>{{$choc->total_fourniture}} da</td>
 	     <td>{{$choc->MHT_choc}} da</td>
 	     <td>{{$choc->MTC_choc}} da</td>
 	    </tr>
 	   @endforeach
 	  </tbody>
 	 </table>
 	 <div class="liner"></div> 
 	 <h4 style="padding: 5px 5px;margin:0 0 5px 0;font-weight: bold;text-decoration: underline;">Rapport General</h4>
 	 
 	 <div style="border: 1px #ababab solid; padding: 10px;">
 	 	<div>
 	 		<div style="display: inline-block;width: 70%; vertical-align: top;">
 			  	<h5 style="padding: 5px 5px;margin:0 0 5px 0;font-weight: bold;text-decoration: underline;">Remarque</h5>
 				@foreach($chocs as $choc)
 				<p style="padding: 0;margin:10px;font-size: 10px;">
 				   {{" ".$choc->remarque}}
 				</p>
 				@endforeach
 	 		</div>
 	 		<div style="display: inline-block;width: 29%;vertical-align: top;">
 			  	<h5 style="padding: 0;margin:10px;">
 				   <span style="display: inline-block;width: 100%;margin-right: 1%;">
 				   	<label for="" style="display: inline-block;margin-bottom: 5px; font-size: 10px;">Montant HT</label>
 				   	<input type="text" style="border:2px black solid;display: inline-block;width: 100%;padding: 10px; text-align: right; font-weight: bold;font-size: 10px;" value="120 000.00 da">
 				   </span>
 				   <span style="display: inline-block;width: 100%; margin-right: 1%;">
 				   	<label for="" style="display: inline-block;margin-bottom: 5px; font-size: 10px;">Montant TTC</label>
 				   	<input type="text" style="border:2px black solid;display: inline-block;width: 100%;padding: 10px; text-align: right; font-weight: bold;font-size: 10px;" value="120 000.00 da">
 				   </span>
 			  	</h5> 
 	 		</div>
 	 		
 	 	</div>
 	
 		
 		<h5 style="padding: 5px 5px;margin:0 0 5px 0;font-weight: bold;text-decoration: underline;">Résumé Des Chocs</h5>
 		<table>
 		   <thead>
 		    <tr>
 		     <td>Chocs</td>
 		     <td>Vols</td>
 		     <td>suspition de fraude</td>
 		     <td>Assuré Fautif</td>
 		    </tr>
 		   </thead>
 		   <tbody>
 		    @foreach($chocs as $choc)
 		     <tr>
 		      <td style="display:inline-block;padding: 200px auto;">Choc "{{$choc->choc}}"</td>
 		      <td>{{$choc->vol}}</td>
 		      <td>{{$choc->suspicion_fraude}}</td>
 		      <td>{{$choc->assure_fautif}}</td>
 		     </tr>
 		    @endforeach
 		   </tbody>
 	 	</table>
 	 </div>
 	</div>
 	
 	@foreach($chocs as $choc)
 	<div class="content2">
 	 <h4 style="text-align: center;padding: 0;margin:10px;">DETAIL CHOC</h4>
 	 <h5  style="padding: 0;margin:10px;">
 	  <span style="display: inline-block;width: 33%; text-align: center;">Choc: <span class="date_expert">{{$choc->choc}}</span></span>
 	  <span style="display: inline-block;width: 33%; text-align: center;">Date De Création: <span class="lieu_expert">{{$choc->date_expertise}}</span></span> 
 	  <span style="display: inline-block;width: 33%; text-align: center;">Date De Validation: <span class="lieu_expert">{{$choc->validated_at}}</span></span> 
 	 </h5>
 	
 	 <div style="border: 1px #bbb solid;margin: 10px; padding: 10px;">
 	 	<h5 style="padding: 0;margin:10px 0 10px 0;"><span style="display: inline-block;width: 50%;">Remarque (Vol)</span></h5>
 	 	<p style="font-size: 12px;">{{$choc->vol}}</p>
 	 </div>
 	 
 	 <div style="border: 1px #bbb solid;margin: 10px; padding: 10px;">
 	 	<h5 style="padding: 0;margin:10px 0 10px 0"><span style="display: inline-block;width: 50%;">Remarque (Sucpition de fraude)</span></h5>
 	 	<p style="font-size: 12px;">{{$choc->suspicion_fraude}}</p>
 	 </div>
 	
 	 <div style="border: 1px #bbb solid;margin: 10px; padding: 10px;">
 	 	<h5 style="padding: 0;margin:10px 0 10px 0"><span style="display: inline-block;width: 50%;">Remarque (Assuré Fautif)</span></h5>
 	 	<p style="font-size: 12px;">{{$choc->assure_fautif}}</p>
 	 </div>
 	
 	 <h5 style="padding: 0;margin:10px;margin-top: 0.5cm;">
 		   <span style="display: inline-block;width: 15.2%;margin-right: 1%;">
 		   	<label for="" style="display: inline-block;margin-bottom: 5px;">Total Fourniture: </label>
 		   	<input type="text" style="border:2px black solid;display: inline-block;width: 100%;padding: 10px; font-weight: bold;" value="{{$choc->total_fourniture}} da">
 		   </span>
 	
 		   
 		   <span style="display: inline-block;width: 15.2%;margin-right: 1%;">
 		   	<label for="" style="display: inline-block;margin-bottom: 5px;">Immobilisation: </label>
 		   	<input type="text" style="border:2px black solid;display: inline-block;width: 100%;padding: 10px; font-weight: bold;" value="{{$choc->total_fourniture}} da">
 		   </span>
 	
 		   <span style="display: inline-block;width: 15.2%; margin-right: 1%;">
 		   	<label for="" style="display: inline-block;margin-bottom: 5px;">Main D'Oeuvre:</label>
 		   	<input type="text" style="border:2px black solid;display: inline-block;width: 100%;padding: 10px; font-weight: bold;" value="{{$choc->MTC_choc}} da">
 		   </span>
 		   
 		   <span style="display: inline-block;width: 15.2%; margin-right: 1%;">
 		   	<label for="" style="display: inline-block;margin-bottom: 5px;">Autre:</label>
 		   	<input type="text" style="border:2px black solid;display: inline-block;width: 100%;padding: 10px; font-weight: bold;" value="{{$choc->Autres}} da">
 		   </span>
 		   
 		   <span style="display: inline-block;width: 15.2%;margin-right: 1%;">
 		   	<label for="" style="display: inline-block;margin-bottom: 5px;">Montant HT: </label>
 		   	<input type="text" style="border:2px black solid;display: inline-block;width: 100%;padding: 10px; font-weight: bold;" value="{{$choc->MHT_choc}} da">
 		   </span>
 	
 		   <span style="display: inline-block;width: 15.2%; margin-right: 1%;">
 		   	<label for="" style="display: inline-block;margin-bottom: 5px;">Montant TTC:</label>
 		   	<input type="text" style="border:2px black solid;display: inline-block;width: 100%;padding: 10px; font-weight: bold;" value="{{$choc->MTC_choc}} da">
 		   </span>
 	 </h5>
 	
 	  <h5 style="padding: 5px 5px;margin:0 0 5px 0;font-weight: bold;text-decoration: underline;">Description</h5>
 	  <p style="font-size: 12px;padding:0 10px 0 10px;">{{$choc->description}}</p>
 	
 	  <h5 style="padding: 5px 5px;margin:0 0 5px 0;font-weight: bold;text-decoration: underline;">Liste Des Fournitures</h5>
 	  <table style="border: none;">
 	  		<thead>
 	  			<tr style="border: none;">
 	  				<td style="width: 14%;border: 1px black solid;">ID Piece</td>
 	  				<td style="width: 14%;border: 1px black solid;">Valeur</td>
 	  				<td style="width: 14%;border: 1px black solid;">Designation</td>
 	  				<td style="width: 14%;border: 1px black solid;">Prix</td>
 	  				<td style="width: 14%;border: 1px black solid;">Nombre</td>
 	  				<td style="width: 14%;border: 1px black solid;">Total</td>
 	  			</tr>
 	  		</thead>
 	  		<tbody>
 	  			<tr style="border: none;">
 	  				<td style="width: 14%;border: 1px black solid;">2135</td>
 	  				<td style="width: 14%;border: 1px black solid;">30000 da</td>
 	  				<td style="width: 14%;border: 1px black solid;">phares</td>
 	  				<td style="width: 14%;border: 1px black solid;">25000 da</td>
 	  				<td style="width: 14%;border: 1px black solid;">2</td>
 	  				<td style="width: 14%;border: 1px black solid;">50000 da</td>
 	  			</tr>
 				<tr style="border: none;">
 	  				<td style="width: 14%;border: 1px black solid;">1500</td>
 	  				<td style="width: 14%;border: 1px black solid;">9000 da</td>
 	  				<td style="width: 14%;border: 1px black solid;">par-choc L</td>
 	  				<td style="width: 14%;border: 1px black solid;">4000 da</td>
 	  				<td style="width: 14%;border: 1px black solid;">2</td>
 	  				<td style="width: 14%;border: 1px black solid;">8000 da</td>
 	  			</tr>
 	  		</tbody>
 	  </table>
 	  
 	</div>
 	@endforeach
 	<div class="content3">
 		
 	</div>
 	
 	<footer>
 	 pv imprimmé le : 27/01/2020 Par ACHAT <span></span>
 	</footer>
 </div>
@section('js')

<script>
 function myFunction() {
   window.print();
 }
 $( document ).ready(function() {
  $( ".print" ).trigger("click");
 });
</script>
@endsection