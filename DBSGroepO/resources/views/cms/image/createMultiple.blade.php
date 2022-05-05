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
    <form action="{{ route('Afbeelding.storeMultiple' , $pageID) }}" method="POST">
        @csrf
        @method('POST')
        <div class="pull-right md-8 ">
        <a class="btn btn-primary md-4" href="{{url('cms/paginas')}}"> Back</a>
            <button type="submit" class="btn btn-success md-4">Submit</button>
        </div>
        <table class="table" id="multiForm">
            <thead>
                <tr>
                    <th>afbeelding</th>
                    <th>Rij toevoegen</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                <input list="images" name="multiInput[0][image_id]" id="afbeeldingen" class="form-control">
                    <datalist id="images" class="w-100">
                        @foreach($afbeeldingen as $img)
                            <option value="{{$img->id}}">{{$img->title}}</option>
                        @endforeach 
                    </datalist>
                </td>
                <td><input type="button" name="add" value="Add" id="addRemoveIp" class="btn btn-outline-dark" required></td>
            </tr>
            </tbody>
        </table>
    </form>
</section>
<script>
    $(document).ready( function () {
    $('#multiForm').DataTable();
    } );
    var i = 0;
    $("#addRemoveIp").click(function () {
        ++i;
        $("#multiForm").append('<tr><td>'+
                '<input list="images" name="multiInput[0][image_id]" id="afbeeldingen" class="form-control">'+
                    '<datalist id="images" class="w-100">'+
                        '@foreach($afbeeldingen as $img)'+
                            '<option value="{{$img->title}}">{{$img->id}}</option>'+
                        '@endforeach'+ 
                    '</datalist>'+
                '</td><td><button type="button" class="remove-item btn btn-danger">Delete</button>'+
        '</td></tr>');
    });
    $(document).on('click', '.remove-item', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection
