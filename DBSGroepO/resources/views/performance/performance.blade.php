@extends('layouts.app')

@section('content')
<section id="contentperformance">
    @foreach ($optredens as $pref)
    <div class="card">
        <div class="d-block p-2">
            <h3><b>{{ $pref->title}}:</b> {{ date('d/M/Y',strtotime($pref->start))}}</h3>
            <p>{{ $pref->description}}</p>
            <p>
                @if(!empty($pref->location))
                    locatie: <a href='{{ $pref->locationURL }}' target="_blank">{{ $pref->location }}<a><br>
                @else
                    locatie: is niet opgegeven<br>
                @endif
                Begint op: {{ date("H:i:s",strtotime($pref->start))}}<br>
                eindigt op: {{ date("H:i:s",strtotime($pref->end))}}
            </p>
        </div>
    </div>
    
    @endforeach
    {{ $optredens->links() }}
</section>

    


@endsection