@extends('layouts.app')

@section('content')

<section id="contentHome">
<div id="carouselExampleIndicators" class="  carousel slide carousel-fade w-75 p-3 mx-auto" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{asset('assets/images/TempFotos/Foto1.jpg')}}"" class="d-block w-100" style="height:300px; width;500px" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{asset('assets/images/TempFotos/Foto2.jpg')}}" class="d-block w-100"  style="height:300px; width;500px"alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{asset('assets/images/TempFotos/Foto3.jpg')}}" class="d-block w-100"  style="height:300px; width;500px"alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{asset('assets/images/TempFotos/Foto4.jpg')}}" class="d-block w-100"  style="height:300px; width;500px"alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{asset('assets/images/TempFotos/Foto5.jpg')}}" class="d-block w-100"  style="height:300px; width;500px"alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="container">
      <div class="response"></div>
      <div id='calendar'></div>  
  </div>

  <div class="container">
    <div class="d-inline p-2">
    <h3 class="text-left">Over ons</h3>
      <p class="text-left"> 
        In mei 1990 richtte dirigent Ger van Aart de Duketown Barbershop Singers op. De Duketown Barbershop Singers uit ‘s-Hertogenbosch (Duketown) zijn een groep enthousiaste mannen die zich met veel plezier toeleggen op het beoefenen van barbershopzang en -entertainment. Het repertoire bestaat onder andere uit jazz, musical en ballads in barbershopstijl en close harmony.
        De leden komen uit de wijde regio van ‘s-Hertogenbosch in leeftijd variërend van eind vijftig tot reeds enige tijd gepensioneerd. We repeteren het hele jaar elke dinsdag. Daarna is er de Afterglow met een glaasje en enige zangnootjes. Het koor streeft naar tien optredens per jaar. De huidige dirigent is Stef Fennis.<br> 
        </p>
        </div>
        <hr>
        <div class="d-block p-2">
        <h3 class="text-left">De community</h3>
        <p class="text-left"> 
        Dankzij een internationaal standaardrepertoire kunnen onze zangers bijna overal ter wereld zingen met ruim zeventigduizend andere barbershopzangers.
        De Duketown Barbershop Singers is aangesloten bij de HH-Dutch Association of Barbershop Singers (HH-DABS), een overkoepelende organisatie van barbershopzangers in Nederland.<br>
        </p>
        </div>
        <hr>
        <div class="d-block p-2">
        <h3 class="text-left">Lid worden</h3>
        <p class="text-left"> 
        na een introductieperiode van maximaal 3 maanden wordt het aspirant lid beoordeeld. Hij zingt in een kwartet zijn partij de songs Heart of my Heart en My Wild Irish Rose. Bij succesvol afzingen treedt hij toe tot het koor. De contributie bedraagt, inclusief de door DBS verstrekte kleding, maandelijks euro; 20,--.
        Kom luisteren tijdens de repetitie. We repeteren op dinsdagavond van 19:00 tot 22:15 uur in de Rietlandenschool, Pieter Langendijksingel 1, 5216 JZ s-Hertogenbosch. Ingang Koorleden door de gele deuren: Bilderdijkstraat, tegenover Bilderdijkstraat 23).<br>
      </p>
      </div>
  </div>
  <div class="container">
    <h4>Langs komen?</h4>
    <p>Op <a href="https://www.google.com/maps/dir//Bilderdijkstraat+23,+5216+TA+%27s-Hertogenbosch/@51.6840306,5.3272158,17z/data=!4m9!4m8!1m0!1m5!1m1!1s0x47c6ef0401e43ce9:0xe1672863df7d1e8b!2m2!1d5.3294045!2d51.6840306!3e0">deze locatie</a> kunt u ons vinden.</p>
  </div>
</section>
@endsection






