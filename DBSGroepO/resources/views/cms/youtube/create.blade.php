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
        <table class="table" id="multiForm">
            <thead>
                <tr>
                    <th>Youtube key</th>
                    <th>Webpage</th>
                    <th>Rij toevoegen</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="text" name="multiInputYoutube[0][YoutubeKey]" class="form-control" required/></td>
                <td>
                    <select type="text" name="multiInput[0][Webpage]" class="form-control">
                        @foreach($webpage as $w)
                            <option value="{{$w->id}}">{{$w->slug}}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="button" name="add" value="Add" id="addRemoveIp" class="btn btn-outline-dark" required></td>
            </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>Youtube key</th>
                    <th>Webpage</th>
                    <th>Rij toevoegen</th>
                </tr>
            </tfoot>
        </table>
    </form>
</section>

<script>
    var i = 0;
    $("#addRemoveIp").click(function () {
        ++i;
        $("#multiForm").append('<tr><td><input type="text" name="multiInputYoutube['+i+'][YoutubeKey]" class="form-control" required/></td><td><select type="text" name="multiInput['+i+'][Webpage]" class="form-control"> @foreach($webpage as $w) <option value="{{$w->id}}">{{$w->slug}}</option> @endforeach </select></td><td><button type="button" class="remove-item btn btn-danger">Delete</button></td></tr>');
    });
    $(document).on('click', '.remove-item', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection
