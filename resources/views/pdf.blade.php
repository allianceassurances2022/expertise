<html>
<head>
  <style>
  @page { margin: 50px auto; }

    header {
      position: fixed;
      top: -60px;
      left: 0px;
      right: 0px;
      padding: 20px 20px 10px 20px;
    }
    footer {
      position: fixed;
      bottom: -60px;
      left: 0px; right: 0px;
      height: 35px;
      text-align: center;
      font-size: 12px;
      padding: 20px 30px;
    }
    p {
      page-break-after: always;
      margin-top:100px;
      padding: auto 20px;
    }
    p:last-child {
      page-break-after: never;
    }
    main{

    }
    .choc-header{
      background-color: #01737e;
        margin-top: -8px;
        padding: 10px;
        line-height: 1.5;
        width: 100%;
        text-align: center;
        border-bottom: 1px #ccc solid;
        color: white;
        font-weight: bold;
        border-radius: 5px;
    }
    section h4{
        background-color: #01737e;
        margin-top: -8px;
        padding: 10px;
        line-height: 1.5;
        width: 100%;
        text-align: center;
        border-bottom: 1px #ccc solid;
        color: white;
        font-weight: bold;
        border-radius: 5px;
    }

    header section{
      padding: 0;
      margin: 0;
    }
    header section h5{
      padding: 0;
      margin: 0;
      font-size: 1.2em;
      margin-bottom: 5px;

    }
    header section p{
      margin: 0;
      padding: 0;
    }
    ul{
      margin-left: -20px;
    }
    ul li{
      list-style: none;
      padding: 5px 0px;
      margin-left: 0;
      font-size: 10px;
    }
    body{
      font-family: sans-serif;
    }
    table{
      padding: 10px;
    }

    table tbody td{
      padding: 3px 5px;
    }

    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }

    table thead{
      font-weight: bold;
    }
    table thead td{
      padding: 5px;
    }
    h4.header-dif{
      background-color: white;
      border: 1px #01737e solid !important;
      color: #01737e !important;
      padding-top: 10px;
      padding-bottom: 5px;
    }

    .illustration{
      width: 10%;
      opacity: 0;
    }

  </style>
</head>
<body>
  <header style="padding: 30px 50px 50px 50px;">
    {{-- <div style="display:inline-block;width: 13.7%; text-align: center;vertical-align: top;">
      <img src="{{asset('assets/images/Alliance_assurances_logo.jpg')}}" alt="" style="width: 80% !important;margin-top:20px;vertical-align: top;margin-bottom: 5px;">
      <h5 style="font-weight: 100;padding: 0;margin:0 0px 5px 0;font-size: 8.5px;width: 120%;margin-left: -10px;">ALLIANCE ASSURANCES</h5>
    </div> --}}
   <div style="display:inline-block;width: 100%;padding:auto 2%; text-align: center;vertical-align: top;">
    {{-- <h1 style="padding: 0;margin:0 0px 5px 0;">RAPPORT D'EXPERTISE</h1> --}}
    <p style="padding: 0px 10px ;margin:0; font-size: 14px; border-radius: 5px;font-size: 12px;">
      <section>
        <h5>{{$ods->expert}} / {{$ods->code_expert}}</h5>
        <p>
          Adresse: <strong>{{$expert->adresse}} </strong> <br/> Email: <strong>{{$user->email}}</strong> <br/> Telephone: <strong>{{$expert->telephone_1}}</strong> / <strong>{{$expert->telephone_2}}</strong><br/> Categorie expertise:
          <strong>
            @if (($expert->auto) == '1')
            Auto
            @endif
            @if (($expert->risque_indu) == '1')
            , Risque individuel
            @endif
            @if (($expert->transport) == '1')
            , Transport
            @endif
          </strong>
        </p>
      </section>
    </p>
   </div>
   <h4 style="text-align: center;margin-top: 5px;">RAPPORT D'EXPERTISE</h4>
   <div style="display:inline-block;width: 13.7%; text-align: center;vertical-align: top;">
    {{-- <img src="{{asset('assets/images/QR_Code.png')}}" alt="" style="width: 80% !important;vertical-align: top;margin-bottom: 5px;margin-top:20px;">
    <p style="padding: 0; margin:0;font-size: 10px;;">12A45B7E9</p> --}}
    @if($expertise->code)
    <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(100)->generate(route ('imprimmer',$expertise->id))) }} " style="margin-top: -125px;width:120px;">
    @endif
   </div>
  </header>
  <footer style="text-align:left;margin-bottom: -15px;font-size: 12px;margin-left: -10px;">
     <span style="font-size: 10px;">Imprimmé Par <strong>{{strtoupper(auth()->user()->username)}} <span style="display:inline-block;margin-left: 150px;"></strong> Le <strong>{{date('Y-m-d H:i:s')}}</strong></span></span>
     <span style="font-size: 10px;margin-left:160px;">https://allianceassurances.com.dz/</span>
     <span style="display: block;position: absolute;right: 20px;">
      <div id="footer">
        <p class="page">Page </p>
      </div>
      </span>
  </footer>
  <main>
    <p>
      <section style="display: block; width: 100%;">
        <h4 class="header-dif"><span style="display: inline-block;width: 50%;text-align: center;">PVE AUTOMOBILE:<br/> {{now()->year}} / {{sprintf('%04d', $num_pv->num_pv)}}* </span> @if(auth()->user()->previllege != 'expert' ) <span style="display: inline-block;width: 50%;text-align: center; text-transform: uppercase;"> STATUT: {{$Status_expertise->libelle}}</span> @endif</h4>
      </section>
      <section style="display: block; width: 100%;margin-top: 15px;clear: both;">

        <div style="font-size:12px;width:47.9% !important;border:1px black solid;border-radius: 5px; position: relative !important; display: inline-block; padding: 10px 2px 10px 2px; margin-right: 1%; vertical-align: top;margin-top:0px;height: 285px;">

          <h3 style="padding: 10px 5px; margin: 0; margin-bottom: 0px;text-align: center;background-color: #01737e;color:white;margin-right: -3px;margin-top: -11px;width: 100%;margin-left: -2px;border-radius: 5px 5px 0 0">Informations Assuré</h3>

          <ul style="font-weight: bold;margin-left: -40px;">
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">ASSURE: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px;border-radius: 1px;margin-top:-5px;width: 57%;font-size:95% !important;">{{$tiers->nom}} {{$tiers->prenom}}</span>
            </li>
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">DATE SINISTRE: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px;border-radius: 1px;margin-top:-5px;width: 57%;">{{ \Carbon\Carbon::parse($ods->date_sinistre)->format('d/m/Y') }}</span>
            </li>
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">N° POLICE: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px;border-radius: 1px;margin-top:-5px;width: 57%;">{{$ods->ref_police}}</span>
            </li>
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">N° SINISTRE: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px; border-radius: 1px;margin-top:-5px;width: 57%;">{{$ods->ref_sinistre}}</span>
            </li>
          </ul>

          <h3 style="padding:  5px; margin: 0; margin-bottom: 0px;text-align: center;background-color: #01737e;color:white;margin-right: -3px;margin-top: 0px;width: 100%;margin-left: -2px;">Informations Expert</h3>
          <ul style="font-weight: bold;margin-left: -40px;">
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">EXPERT: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px; border-radius: 1px;margin-top:-5px;width: 57%;">{{$ods->expert}}</span>
            </li>
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">DATE EXPERTISE: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px; border-radius: 1px;margin-top:-5px;width: 57%;">{{\Carbon\Carbon::parse($expertise->date_expertise)->format('d/m/Y')}}</span>
            </li>
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">DATE ODS: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px; border-radius: 1px;margin-top:-5px;width: 57%;">{{\Carbon\Carbon::parse($ods->date_ods)->format('d/m/Y')}}</span>
            </li>
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">LIEU EXPERTISE: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px; border-radius: 1px;margin-top:-5px;width: 57%;">{{$expertise->lieu_expertise}}</span>
            </li>
          </ul>


          </p>
        </div>

        <div style="font-size:12px;width:47.9% !important;border:1px black solid;border-radius: 5px; position: relative !important; display: inline-block; padding: 10px 2px 10px 2px; margin-left: 1%; vertical-align: top;padding-bottom: 10px;height: 285px;">

          <h3 style="padding: 10px 5px; margin: 0; margin-bottom: 0px;text-align: center;background-color: #01737e;color:white;margin-right: -3px;margin-top: -11px;width: 100%;margin-left: -2px;border-radius: 5px 5px 0 0">Informations Vehicule</h3>
          <div style=" width: 90%;margin:auto; text-align: center;"></div>

          <ul style="font-weight: bold;margin-left: -40px; margin-top: 0px;padding:15px 30px;">
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">MATRICULE:</span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px;border-radius: 1px;margin-top:-5px;width: 57%;">{{$ods->matricule}}</span>
            </li>
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">MARQUE: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px;border-radius: 1px;margin-top:-5px;width: 57%;">{{$ods->marque}}</span>
            </li>
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">MODEL: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px;border-radius: 1px;margin-top:-5px;width: 57%;">{{$ods->model}}</span>
            </li>
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">VIN: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px;border-radius: 1px;margin-top:-5px;width: 57%;">{{$ods->num_serie}}</span>
            </li>
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">CODE AGENCE: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px; border-radius: 1px;margin-top:-5px;width: 57%;">{{Str::substr($ods->ref_sinistre, 0,5)}}</span>
            </li>
            {{-- <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">VETUSTE: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px; border-radius: 1px;margin-top:-5px;width: 57%;">00 000 000 DA</span>
            </li> --}}
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">COULEUR: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px; border-radius: 1px;margin-top:-5px;width: 57%;">{{$expertise->couleur}}</span>
            </li>
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">PUISSANCE: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px; border-radius: 1px;margin-top:-5px;width: 57%;">{{$ods->libelle_puissance}}</span>
            </li>
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">CARBURANT: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px; border-radius: 1px;margin-top:-5px;width: 57%;">{{$ods->carburant}}</span>
            </li>
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">IMMOBILISATION: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px; border-radius: 1px;margin-top:-5px;width: 57%;">{{$premier_choc->immobilisation}} JOURS</span>
            </li>
          </ul>
        </div>
      </section>

      <section style="display: block; width: 100%;margin-top: 15px;clear: both;margin-left: 10px;">
        <div style="font-size:12px;width:49% !important;border:1px black solid;border-radius: 5px; position: relative !important; display: inline-block; padding: 10px 2px 10px 2px; margin-left: -10px; vertical-align: top;margin-top:0px;height: 250px;">

          <h3 style="padding: 10px 5px; margin: 0; margin-bottom: 0px;text-align: center;background-color: #01737e;color:white;margin-right: -3px;margin-top: -11px;width: 100%;margin-left: -2px;border-radius: 5px 5px 0 0">Remarque Generale</h3>

          <ul style="font-weight: bold;margin-left: -40px;">
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 40%;">TAUX DE RESPONSABILITE: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px; border-radius: 1px;margin-top:-5px;width: 47%;">{{$expertise->taux_resp}} %</span>
            </li>
            <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 40%;">VALEUR VENALE: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px; border-radius: 1px;margin-top:-5px;width: 47%;">{{number_format($expertise->valeur_venal, 2,',', ' ')}} DA</span>
            </li>
            {{-- <li style="display: block;width: 90%; margin: -7px auto;">
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 40%;">SENS DU CHOC: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px; border-radius: 1px;margin-top:-5px;width: 47%;"></span>
            </li> --}}
          </ul>

          <h3 style="padding:  5px; margin: 0; margin-bottom: 0px;text-align: center;background-color: #01737e;color:white;margin-right: -3px;margin-top: 0px;width: 100%;margin-left: -2px;">Observation</h3>
          <div style="font-size:11px;padding: 5px;">{{$expertise->observation}}</div>

          <p style="margin: 0; padding: 6px 10px;height: 145px;"></p>
        </div>

        <div style="font-size:12px;width:49% !important;border:1px black solid;border-radius: 5px; position: relative !important; display: inline-block; padding: 10px 2px 10px 2px; margin-left: 1%; vertical-align: top;margin-top:0px;height: 250px;">

          <h3 style="padding: 10px 5px; margin: 0; margin-bottom: 0px;text-align: center;background-color: #01737e;color:white;margin-right: -3px;margin-top: -11px;width: 100%;margin-left: -2px;border-radius: 5px 5px 0 0">Decompte</h3>
          <table width="100%">
            <thead>
              <tr>
                <td style="text-align: center;">Choc</td>
                <td style="text-align: center;">Montant HT</td>
                <td style="text-align: center;">TVA</td>
                <td style="text-align: center;">Montant TTC</td>
              </tr>
            </thead>
            <tbody>
              @foreach($choc_list as $k=>$choc)
                @if ($k % 2 == 0)
                <tr style="background-color: #ffee9f94;">
                @else
                <tr>
                @endif
                  <td style="text-align: center;">Choc "{{$choc->choc}}"</td>
                  <td style="text-align: right;">{{ number_format($choc->total_fourniture, 2,',', ' ') }}</td>
                  <td style="text-align: right;">{{ number_format($choc->tva, 2,',', ' ') }}</td>
                  <td style="text-align: right;">{{ number_format($choc->MTC_choc, 2,',', ' ') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <p style="margin: 0; padding: 6px 10px;height: 83px;text-align: right;font-size: 10px;">
            {{-- <label for="" style="display: block;font-weight: bold;clear: both;vertical-align: middle;height: 20px;">
              <input type="text" value="{{number_format($expertise->MHT_expertise, 2,',', ' ')}} Da" style="display: inline-block;width: 80px;background-color:#e3e3e3;float: right;padding: 5px 10px;">
              <span style="display: inline-block; float: right; padding-top: 5px;">TOTAL HT </span>
            </label>
            <label for="" style="display: block;font-weight: bold;clear: both;">
              <input type="text" value="19%" style="display: inline-block;width: 80px;background-color:#e3e3e3;float: right;padding: 5px 10px;">
              <span style="display: inline-block; float: right; padding-top: 5px;">TVA </span>
            </label> --}}
            <label for="" style="display: block;font-weight: bold;clear: both;">
              <input type="text" value="{{number_format($expertise->MTC_expertise, 2,',', ' ')}} Da" style="display: inline-block;width: 80px;background-color:#e3e3e3;float: right;padding: 5px 10px;">
              <span style="display: inline-block; float: right; padding-top: 5px;">TOTAL TTC </span>
            </label>
            <label style="display: block;font-weight: bold;clear: both;text-align: right;padding-top:10px;">
              Le Présent Procé Verbal est arreté à la somme de:<br>
              <span style="font-size: 11px">{{ $arret}} dianrs</span>
            </label>
          </p>
        </div>

      </section>

       <section style="display: block; width: 100%;margin-top: 15px;clear: both;margin-left: 10px;">
        <div style="font-size:12px;width:100% !important;border:1px black solid;border-radius: 5px; position: relative !important; display: inline-block; padding: 10px 2px 10px 2px; margin-left: -10px; vertical-align: top;margin-top:0px;">

          <h3 style="padding: 10px 5px; margin: 0; margin-bottom: 0px;text-align: center;background-color: #01737e;color:white;margin-right: -3px;margin-top: -11px;width: 100%;margin-left: -2px;border-radius: 5px 5px 0 0">Résumé Des Chocs</h3>

          <table width="100%" style="text-align: center;font-size: 11px;">
            <thead>
              <tr>
                <td style="width: 10%;text-align: center;">Choc</td>
                <td style="width: 90%;text-align: center;">Description</td>
              </tr>
            </thead>
            <tbody>
              @foreach($choc_list as $k=>$choc)
                @if ($k % 2 == 0)
                  <tr style="background-color: #ffee9f94;">
                @else
                  <tr>
                @endif
                    <td>Choc "{{$choc->choc}}"</td>
                    <td style="text-align: left;">{{$choc->description}}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      <div class="note" style="font-size: 12px;padding-top: 10px;padding-left: 10px;">AUCUN ADDITIF NE SERA ACCORDÉ AU-DELA DE 03 MOIS</div>
      </section>
      @if(auth()->user()->previllege != 'expert' )
      @if($expertise->status != 3)
      <span style="display:block;position:absolute;top:2em;font-size:4em;transform-origin: 0 0; transform: rotate(20deg);opacity:0.18;width:80%;margin-left:15%;text-align:center;z-index:0;">Attente de<br/> Validation</span>
      @endif
      @endif

    </p>



    @foreach($choc_list as $choc)
    <p>
      <section style="display: block; width: 100%;">
        <h4 class="header-dif"><span style="display: inline-block;width: 55%;text-align: center;">PVE AUTOMOBILE: {{now()->year}} / {{sprintf('%04d', $num_pv->num_pv)}}* </span> <span style="display: inline-block;width: 45%;text-align: center;"> CHOC "{{$choc->choc}}"</span></h4>
      </section>

       <section style="display: block; width: 100%;margin-top: 15px;clear: both;margin-left: 10px;">
        <div style="font-size:12px;width:100% !important;border:1px black solid;border-radius: 5px; position: relative !important; display: inline-block; padding: 10px 2px 10px 2px; margin-left: -10px; vertical-align: top;margin-top:0px;">

          <h3 style="padding: 10px 5px; margin: 0; margin-bottom: 0px;text-align: center;background-color: #01737e;color:white;margin-right: -3px;margin-top: -11px;width: 100%;margin-left: -2px;border-radius: 5px">Description du Choc</h3>

          <p width="100%" style="text-align: left;font-size: 11px;margin: 0;padding:;height: 30px; ">
            {{$choc->description}}
          </p>
        </div>
      </section>

      <section style="display: block; width: 100%;margin-top: 15px;clear: both;margin-left: 10px;">
        <div style="font-size:12px;width:100% !important;border:1px black solid;border-radius: 5px; position: relative !important; display: inline-block; padding: 10px 2px 10px 2px; margin-left: -10px; vertical-align: top;margin-top:0px;">

          <h3 style="padding: 10px 5px; margin: 0; margin-bottom: 0px;text-align: center;background-color: #01737e;color:white;margin-right: -3px;margin-top: -11px;width: 100%;margin-left: -2px;border-radius: 5px">Détaille de réparation </h3>

          <p width="100%" style="text-align: left;font-size: 11px;margin: 0;padding:;height: 30px; ">
            {{$choc->remarque}}
          </p>
        </div>
      </section>

       {{-- <section style="display: block; width: 100%;margin-top: 15px;clear: both;margin-left: 10px;">
        <div style="font-size:12px;width:31.5% !important;border:1px black solid;border-radius: 5px; position: relative !important; display: inline-block; padding: 10px 2px 10px 2px; margin-left: -10px;margin-right: 10px;  vertical-align: top;margin-top:0px;">

          <h3 style="padding: 10px 5px; margin: 0; margin-bottom: 0px;text-align: center;background-color: #01737e;color:white;margin-right: -3px;margin-top: -11px;width: 100%;margin-left: -2px;border-radius: 5px 5px 0 0">Avis Vol</h3>

          <p style="margin: 0; padding: 6px 10px;height: 100px;">
            {{$choc->vol}}
          </p>
        </div>

         <div style="font-size:12px;width:31.5% !important;border:1px black solid;border-radius: 5px; position: relative !important; display: inline-block; padding: 10px 2px 10px 2px; margin-right: 10px; vertical-align: top;margin-top:0px;">

          <h3 style="padding: 10px 5px; margin: 0; margin-bottom: 0px;text-align: center;background-color: #01737e;color:white;margin-right: -3px;margin-top: -11px;width: 100%;margin-left: -2px;border-radius: 5px 5px 0 0">Avis Suspition De Fraude</h3>

          <p style="margin: 0; padding: 6px 10px;height: 100px;">
            {{$choc->suspicion_fraude}}
          </p>
        </div>

         <div style="font-size:12px;width:31.5% !important;border:1px black solid;border-radius: 5px; position: relative !important; display: inline-block; padding: 10px 2px 10px 2px; margin-right: 10px; vertical-align: top;margin-top:0px;">

          <h3 style="padding: 10px 5px; margin: 0; margin-bottom: 0px;text-align: center;background-color: #01737e;color:white;margin-right: -3px;margin-top: -11px;width: 100%;margin-left: -2px;border-radius: 5px 5px 0 0">Avis Assuré Fautif</h3>

          <p style="margin: 0; padding: 6px 10px;height: 100px;">
            {{$choc->assure_fautif}}
          </p>
        </div>
      </section> --}}

      <section style="display: block; width: 100%;margin-top: 15px;clear: both;margin-left: -8px;">
        <div style="font-size:12px;width:100% !important;border:1px black solid;border-radius: 5px; position: relative !important; display: inline-block; padding: 10px 2px 10px 2px; margin-left: 1%; vertical-align: top;margin-top:0px;">

          <h3 style="padding: 10px 5px; margin: 0; margin-bottom: 0px;text-align: center;background-color: #01737e;color:white;margin-right: -3px;margin-top: -11px;width: 100%;margin-left: -2px;border-radius: 5px 5px 0 0">Détail Des Fournitures</h3>
          <table width="100%">
            <thead>
              <tr>
                <td style="width: 7%;text-align: center;">N°</td>
                <td style="width: 16%;text-align: left;">Catégorie</td>
                <td style="width: 40%;text-align: left;">Article</td>
                <td style="text-align: center;">Prix U (DA)</td>
                <td style="width: 7%;text-align: center;">Qté</td>
                <td style="text-align: center;">Total (DA)</td>
              </tr>
            </thead>
            <tbody>
              @foreach ($fourniture_list as $k=>$fourniture)
                @if($fourniture->choc_id==$choc->id)
                  @if($k%2==0){
                    <tr style="background-color: #ffee9f94;">
                  }
                  @else{
                    <tr>
                  }
                  @endif
                    <td style="text-align: center;">{{$k+1}}</td>
                    <td style="text-align:left">{{$fourniture->libelle}}</td>
                    <td style="text-align:left">{{$fourniture->intitule}}</td>
                    <td style="text-align: right;">{{ number_format($fourniture->price, 2,',', ' ') }}</td>
                    <td style="text-align: center;">{{$fourniture->nb}}</td>
                    <td style="text-align: right;">{{ number_format($fourniture->total, 2,',', ' ') }}</td>
                  </tr>
                @endif
              @endforeach

              //autres chocs
              @foreach ($autre_fourniture as $k=>$fourniture)
                @if($fourniture->choc_id==$choc->id)
                  @if($k%2==0){
                    <tr style="background-color: #ffee9f94;">
                  }
                  @else{
                    <tr>
                  }
                  @endif
                    <td style="text-align: center;">{{$k+1}}</td>
                    <td style="text-align:left">{{$fourniture->libelle}}</td>
                    <td style="text-align:left">{{$fourniture->libelle}}</td>
                    <td style="text-align: right;">{{ number_format($fourniture->price, 2,',', ' ') }}</td>
                    <td style="text-align: center;">{{$fourniture->nb}}</td>
                    <td style="text-align: right;">{{ number_format($fourniture->total, 2,',', ' ') }}</td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
          <p style="margin: 0;margin-bottom: 30px; padding: 6px 10px;text-align: right;font-size: 10px;">
            <label for="" style="display: block;font-weight: bold;clear: both;">
              <input type="text" style="display: inline-block;width: 87px;background-color: #e3e3e3;float: right;padding: 5px 10px;" value="{{ number_format($choc->total_fourniture, 2,',', ' ') }}">
              <span style="display: inline-block; float: right; padding-top: 5px;">Fournitures HT </span>
            </label>
            <label for="" style="display: block;font-weight: bold;clear: both;">
              <input type="text" style="display: inline-block;width: 87px;background-color: #e3e3e3;float: right;padding: 5px 10px;" value="{{ number_format($choc->immobilisation, 2,',', ' ') }}">
              <span style="display: inline-block; float: right; padding-top: 5px;">Immobilisations </span>
            </label>
            <label for="" style="display: block;font-weight: bold;clear: both;">
              <input type="text" value="{{ number_format($choc->main_oeuvre, 2,',', ' ') }}" style="display: inline-block;width: 87px;background-color: #e3e3e3;float: right;padding: 5px 10px;">
              <span style="display: inline-block; float: right; padding-top: 5px;">Main D'Oeuvre </span>
            </label>
            <label for="" style="display: block;font-weight: bold;clear: both;">
              <input type="text" value="{{ number_format($choc->Autres, 2,',', ' ') }}" style="display: inline-block;width: 87px;background-color: #e3e3e3;float: right;padding: 5px 10px;">
              <span style="display: inline-block; float: right; padding-top: 5px;">Peinture </span>
            </label>
            <label for="" style="display: block;font-weight: bold;clear: both;">
              <input type="text" value="{{ number_format(($choc->tva), 2,',', ' ') }}" style="display: inline-block;width: 87px;background-color: #e3e3e3;float: right;padding: 5px 10px;">
              <span style="display: inline-block; float: right; padding-top: 5px;">TVA </span>
            </label>
            <label for="" style="display: block;font-weight: bold;clear: both;">
              <input type="text" value="{{ number_format($choc->MTC_choc, 2,',', ' ') }}" style="display: inline-block;width: 87px;background-color: #e3e3e3;float: right;padding: 5px 10px;">
              <span style="display: inline-block; float: right; padding-top: 5px;">Total TTC </span>
            </label>
            <label for="" style="display: block;font-weight: bold;clear: both;">
              <input type="text" value="{{ number_format($choc->vetuste, 2,',', ' ') }} %" style="display: inline-block;width: 87px;background-color: #e3e3e3;float: right;padding: 5px 10px;">
              <span style="display: inline-block; float: right; padding-top: 5px;">Vétusté </span>
            </label>
          </p>
        </div>

      </section>
      @if(auth()->user()->previllege != 'expert' )
      @if($expertise->status != 3)
            <span style="display:block;position:absolute;top:2em;font-size:4em;transform-origin: 0 0; transform: rotate(20deg);opacity:0.18;width:80%;margin-left:15%;text-align:center;z-index:0;">Attente de<br/> Validation</span>
      @endif
      @endif

      <br>
      <span style="font-size: 12px;float: right;">
        <span style="font-weight: bold;">le : {{date('d/m/Y')}}</span>
      </span>
      <br>
      <span style="font-size: 12px;float: right;">
        cachet et signature de l'expert
      </span>
    </p>
    @endforeach
  </main>
</body>
</html>
