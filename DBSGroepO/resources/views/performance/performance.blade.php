@extends('layouts.app')

@section('content')
<section id="contentperformance">
    <div class="container mt-lg-5">
        @foreach ($optredens as $pref)
        <div class="card">
            <div class="d-block p-2">
                <h3><b>{{ $pref->title}}:</b> {{ date('d/M/Y',strtotime($pref->start))}}</h3>
                <p>{{ $pref->description}}</p>
                <p>
                    @if(!empty($pref->location))
                        locatie: <a href="http://maps.google.com/maps/place/{{ $pref->location }}" target="_blank">{{ $pref->location }}</a><br>
                    @else
                        locatie: is niet opgegeven<br>
                    @endif
                    Begint op: {{ date("H:i:s",strtotime($pref->start))}}<br>
                    eindigt op: {{ date("H:i:s",strtotime($pref->end))}}
                </p>
            </div>
        </div>
        @endforeach
    </div>
    {{ $optredens->links() }}
</section>




@endsection
