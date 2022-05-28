@extends('layouts.cms')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<section class="content">
    <form action="{{ route('youtube.store') }}" method="POST">
        @csrf
        <div class="pull-right md-8 ">
            <a class="btn btn-primary md-4" href="{{ route('youtube.index') }}"> Back</a>
            <button type="submit" class="btn btn-success md-4">Submit</button>
        </div>
        <div class="table-responsive">
            <table class="table" id="multiForm">
                <thead>
                    <tr>
                        <th>Youtube key</th>
                        <th>Webpage</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td><input type="text" name="youtube_video_key" class="form-control" required/></td>
                    <td>
                        <select type="text" name="webpageID" class="form-control">
                            @foreach($webpage as $w)
                                <option value="{{$w->id}}">{{$w->slug}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Youtube key</th>
                        <th>Webpage </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </form>
</section>
@endsection
