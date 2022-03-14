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
        margin-top: 130px;
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
          <br/>
          Identifiant fiscal (NIF ) : <strong>{{$expert->nif}} </strong>
          <br/>
          RIB/RIP : <strong>{{$expert->rib}} </strong>
        </p>
      </section>
    </p>
   </div>
   <h4 style="text-align: center;margin-top: 5px;">NOTE HONORAIRE</h4>
   <div style="display:inline-block;width: 13.7%; text-align: center;vertical-align: top;">
    {{-- <img src="{{asset('assets/images/QR_Code.png')}}" alt="" style="width: 80% !important;vertical-align: top;margin-bottom: 5px;margin-top:20px;">
    <p style="padding: 0; margin:0;font-size: 10px;;">12A45B7E9</p> --}}
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
        <h4 class="header-dif"><span style="display: inline-block;width: 50%;text-align: center;">Note d'honoraire {{$ods->id}}-{{$expertise->id}} </span> @if(auth()->user()->previllege != 'expert' ) <span style="display: inline-block;width: 50%;text-align: center;text-transform: uppercase;"> STATUT: {{$status_expertise->libelle}}</span> @endif</h4>
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
              <span style="font-weight: normal;float: right;background-color: white;padding:5px;border-radius: 1px;margin-top:-5px;width: 57%;">{{\Carbon\Carbon::parse($ods->date_sinistre)->format('d/m/Y')}}</span>
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

          <h3 style="padding:  5px; margin: 0; margin-bottom: 0px;text-align: center;background-color: #01737e;color:white;margin-right: -3px;margin-top: 0px;width: 100%;margin-left: -2px;">Informations Générales</h3>
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
              <span style="background-color: #e3e3e3;display: inline-block;padding:5px;width: 30%;">N° ODS: </span>
              <span style="font-weight: normal;float: right;background-color: white;padding:5px; border-radius: 1px;margin-top:-5px;width: 57%;">{{$ods->id}}</span>
            </li>
          </ul>


          </p>
        </div>

        <div style="font-size:12px;width:47.9% !important;border:1px black solid;border-radius: 5px; position: relative !important; display: inline-block; padding: 10px 2px 10px 2px; margin-left: 1%; vertical-align: top;padding-bottom: 10px;height: 285px;">

          <h3 style="padding: 10px 5px; margin: 0; margin-bottom: 0px;text-align: center;background-color: #01737e;color:white;margin-right: -3px;margin-top: -11px;width: 100%;margin-left: -2px;border-radius: 5px 5px 0 0">Informations Vehicule</h3>
          <div style="border-bottom:  2px #01737e dotted; width: 90%;margin:auto; text-align: center;"></div>

          <ul style="font-weight: bold;margin-left: -40px;margin-top: 0px;padding:15px 30px;">
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
          </ul>
        </div>
      </section>

       <section style="display: block; width: 100%;margin-top: 15px;clear: both;margin-left: -8px;">
        <div style="font-size:12px;width:100% !important;border:1px black solid;border-radius: 5px; position: relative !important; display: inline-block; padding: 10px 2px 10px 2px; margin-left: 1%; vertical-align: top;margin-top:0px;">

          <h3 style="padding: 10px 5px; margin: 0; margin-bottom: 0px;text-align: center;background-color: #01737e;color:white;margin-right: -3px;margin-top: -11px;width: 100%;margin-left: -2px;border-radius: 5px 5px 0 0">Liste Des Honoraires</h3>
          <table width="100%">
            <thead>
              <tr>
                <td style="width: 7%;text-align: center;">N°</td>
                <td style="width: 56%;text-align: left;">Designation</td>
                <td style="width: 7%;text-align: center;">Qté</td>
                <td style="text-align: center;">Total (DA)</td>
              </tr>
            </thead>
            <tbody>
              @foreach ($honoraires as $k=>$honoraire)

              <tr>
                <td style="text-align: center;">{{$k+1}}</td>
                <td style="text-align:left">{{$honoraire->libelle}}</td>
                <td style="text-align: center;">{{$honoraire->nombre}}</td>
                <td style="text-align: right;">{{ number_format($honoraire->montant, 2,',', ' ') }}</td>
              </tr>

              @endforeach
            </tbody>
          </table>
        </div>
          <p style="margin: 0;margin-bottom: 30px; padding: 6px 10px;text-align: right;font-size: 10px;">
            <label for="" style="display: block;font-weight: bold;clear: both;">
              <input type="text" style="display: inline-block;width: 87px;background-color: #e3e3e3;float: right;padding: 5px 10px;" value="{{ number_format($somme, 2,',', ' ') }}">
              <span style="display: inline-block; float: right; padding-top: 5px;">Total honoraire </span>
            </label>
          </p>
        </div>

      </section>

      <br>
      <span style="font-size: 12px;float: right;">
        le: <span style="font-weight: bold;">{{date('d/m/Y')}}</span>
      </span>
      <br>
      <span style="font-size: 12px;float: right;">
        cachet et signature de l'expert
      </span>
    </p>
  </main>
</body>
</html>
