@extends('layouts.app')

@section('content')
<section id="contentpreformance">
    @foreach ($optredens as $pref)
    <div class="card">
        <div class="d-block p-2">
            <h3>{{ $pref->title}}: {{ date('d/M/Y',strtotime($pref->start))}}</h3>
            <p>{{ $pref->description}}</p>
            <p>
                locatie: <a href='{{ $pref->locationURL }}' target="_blank">{{ $pref->location }}<a><br>
                Begint op: {{ date("H:i:s",strtotime($pref->start))}}<br>
                eindigt op: {{ date("H:i:s",strtotime($pref->end))}}
            </p>
        </div>
    </div>
    
    @endforeach
</section>
@endsection