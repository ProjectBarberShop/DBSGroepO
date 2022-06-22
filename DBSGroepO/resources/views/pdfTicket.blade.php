<!DOCTYPE html>
<html>
<head>
    <title>Boeking barbershop tickets</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        .title {
            position: absolute;
            width: 50%;
        }
        .right {
            margin-left: 100mm;
        }
        .float-right {
            float: right;
        }
        .text-right {
            text-align: right;
        }
        .space {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="title">
        <h1 class="text-bold">Bestelformulier voor toegangskaarten voor '{{$title}}'</h1>
        <p class="space">Datum: {{$start}} / {{$end}}</p>
    </div>

    <div>
        <img src="{{public_path('assets/images/barbershop.jpg')}}" height="100" class="right float-right">
    </div>
    <p class="text-right">Duketown Barbershop Singers</p>
    <p class="text-right">www.duketownbarbershopsingers.nl</p>
    <p class="text-right">Telefoon: (06) 12 02 04 81</p>
    <p class="text-right">E-mail: sluija@planet.nl</p>

    <div class="position-relative">
        <h2 class="text-bold">Besteld door: </h2>
        <p>Naam: {{$name}}</p>
        <p>Adres: {{$address}}</p>
        <p>Postcode: {{$postalcode}}</p>
        <p>Woonplaats: {{$place}}</p>
        <p>Telefoon: {{$phonenumber}}</p>
        <p>E-mail: {{$email}}</p>
    </div>
    <h2>Hiermee bestel ik:</h2>
    <table>
        <tr>
            <th>Aantal</th>
            <th>Omschrijving</th>
            <th>Eenheidsprijs</th>
            <th>Bedrag</th>
        </tr>
        <tr>
            <td>{{$amount}}</td>
            <td>{{$description}}</td>
            <td>€{{$price}}</td>
            <td>€{{$total_price}}</td>
        </tr>
    </table>
    <div>
        <p>
            Het totaalbedrag dient u over te maken op bankrekening NL90RABO0144529599, ten name van de Duketown
            Barbershop Singers in 's-Hertogenbosch, onder vermelding van <u>OWNK 2016</u> met uw <u>naam</u> en uw <u>postcode</u>.
        </p>
        <p>
            Na ontvangst van uw betaling krijgt u een bevestigingsmail, waarin staat hoe de kaarten
            in uw bezit komen.
        </p>
    </div>
    <div class="mt-5">
        <p>Hartelijk dank voor uw bestelling.</p>
        <p>Ad Sluijmers (boekingsmanager)</p>
    </div>
</body>
</html>
