<!DOCTYPE html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <style>
        body{
            text-align: center;
            font-family: 'Roboto';
            width: 50%;
            margin: auto;
            padding: 10px;
        }
        .logo{
            width: 50% !important;
        }
        p{
            text-transform: capitalize;
        }
        h4{
            font-size: 1.2em;
            line-height: 1;
            margin: 0;
            text-align: right;
        }
        .entete{
            font-size: 1.08em;
            border-top: 1px #00899a solid;
            padding-top: 17px;
            text-align: right;
        }
        img.logo{
            width: 50% !important;
        }
        .link{
            text-align: left;
            display: block;
            font-size: 0.9em;
            margin: 20px 0;
            display: inline-block;
            text-align: center;
            font-size: 0.9em;
            margin: 17px 0 74px 0;
            display: inline-block;
            text-align: center;
            width: 100%;
        }
        .link a{
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
            padding: 10px 15px;
            background-color: #4a90df;
            font-size: 0.9em;
            border-radius: 5px;
        }
        footer{
            font-size: 0.85em;
            background-color: #00899a;
            padding: 3% 5%;
            width: 90%;
            color: white;
        }
        footer p{
            margin: 0;
        }
        .calcul{
            margin-top: 120px;
        }
        .calcul .col{
            display: inline-block;
            width: 22%;
            text-align: center;
        }
        .calcul .col img{
            width: 50%;
            display: block;
            margin: auto;
        }
        .currency{
            font-size: 0.5em;
        }
        .calcul h3{
            margin-bottom: 0;
        }
        .calcul h2{
            margin-top: 10px;
        }
        h5{
            text-align: right;
            margin-top: 12px;
            font-size: 19px;
            margin-bottom: 0;
            text-transform: capitalize;
        }
        h5 span{
            font-size:0.9em;
        }
        span{
            color:#60605f;
        }
        h2 span{
            vertical-align: top;
        }
    </style>
</head>
<html>
    <body>
    <img src="{{asset('assets/images/logo_dark.svg')}}" alt="" class="logo">
    <p class="entete">Une nouvelle expertise a été {{$action}} sous le numéro : {{$expertise->id}}<br/></p>
    <h5>crée le :<span>{{\Carbon\Carbon::parse($expertise->created_at)->format('d/m/Y à h:m:s')}}</h5>
    
    <p class="link">
        <a href="{{route('expertise.show', $expertise->id)}}">Plus De Détail.</a>
    </p>
    <footer>
       <p> 
       SPA Alliance assurances. Centre des affaires El-Qods, Esplanade Porte 14, 3eme etage, Cheraga, Alger.</p><br/>
       www.allianceassurances.com.dz Tél: +213 21 34 46 46 / +213 21 34 31 31 Fax: +213 21 34 12 25
        </p>

    </footer>
    </body>
</html>