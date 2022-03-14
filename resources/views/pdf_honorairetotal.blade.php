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
   
      background-image: url('{{asset('assets/images/filigrane.jpg')}}');
      background-repeat:no-repeat;
   
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
   <div style="display:inline-block;width: 90%;padding:auto 2%; text-align: center;vertical-align: top;">
    <h1 style="padding: 0;margin:0 0px 5px 0;">RAPPORT HONORAIRE</h1>

    <p style="padding: 0px 10px ;margin:0; font-size: 14px; border-radius: 5px;font-size: 12px;">
      <section>
        <h5> {{$experts_details->code}}</h5>
        <p>
          Adresse: <strong>{{$experts_details->adresse}} </strong> <br/> Telephone: <strong>{{$experts_details->telephone_1}}</strong> / <strong>{{$experts_details->telephone_2}}</strong>
        </p>
      </section> 
    </p>
   </div>
   <div style="display:inline-block;width: 13.7%; text-align: center;vertical-align: top;">
    {{-- <img src="{{asset('assets/images/QR_Code.png')}}" alt="" style="width: 80% !important;vertical-align: top;margin-bottom: 5px;margin-top:20px;"> --}}
  
    {{-- <p style="padding: 0; margin:0;font-size: 10px;;">12A45B7E9</p> --}}
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
        <h4 class="header-dif"><span style="display: inline-block;width: 50%;text-align: center;">Rapport d'honoraire </span> <span style="display: inline-block;width: 50%;text-align: center;text-transform: uppercase;"> </span></h4> 
      </section>
      <section style="display: block; width: 100%;margin-top: 15px;clear: both;">




</section>

       <section style="display: block; width: 100%;margin-top: 15px;clear: both;margin-left: -8px;">
	   <div class="card">
	<div class="card-body">
		<div class="row">
				
			<div class="col-sm-6">
		
			</div>	
		</div>
	</div>
</div>
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
              @foreach ($Honoraire as $k=>$Honoraire)
                
              <tr>
                <td style="text-align: center;">{{$k+1}}</td>
                <td style="text-align:left">{{ $Honoraire->libelle}}</td>
                <td style="text-align: center;">{{$Honoraire->nombre}}</td>
                <td style="text-align: right;">{{ number_format($Honoraire->montant, 2,',', ' ') }}</td>
              </tr>0
                
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
        <form action="{{route('imprimmerHonorairetotl')}}" method="post">
			@csrf

			<div class="row">
      <input type="hidden" id="date_debut" name="date_debut" value="{{$date_debut}}">
      <input type="hidden" id="date_fin" name="date_fin"  value="{{$date_fin}}">
      <input type="hidden" id="code" name="code" value="{{$code}}">
      
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary waves-effect waves-light" formtarget="_blank">imprimer</button>
                  </div>
				</div>
			
			
		</form>
      </section>

      <br>
      <span style="font-size: 12px;float: right;">
        le: <span style="font-weight: bold;">{{$date}}</span> à <span style="font-weight: bold;">Alger</span>
      </span>
      <br>
      <span style="font-size: 12px;float: right;">
        cachet et signature de l'expert
      </span>
    </p>
  </main>
</body>
</html>