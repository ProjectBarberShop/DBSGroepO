@extends('layouts.cms')
@section('content')

<section class="content">
    <div class="card container">
        <div class="card-body">
            <form action="{{route('agenda.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Titel</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Beschrijving</label>
                    <input type="text" class="form-control" name="description" required>
                </div>
                <div class="form-group">
                    <label for="start">Start</label>
                    <input type="datetime-local" class="form-control" name="start" required>
                </div>
                <div class="form-group">
                    <label for="end">Eind</label>
                    <input type="datetime-local" class="form-control" name="end" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</section>



@endsection