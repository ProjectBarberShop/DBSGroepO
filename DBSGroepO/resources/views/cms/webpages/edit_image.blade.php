@extends('layouts.cms')

@section('content')
    <section class="content">
                @foreach ($pagecontent as $page)
                    <div class="pull-right ">
                        <a class="btn btn-danger" href="{{ route('youtubeWebpage.editYoutube', $page->id) }}"> Back</a>
                        <button type="submit" form="submition-form" formaction="{{ route('imageWebpage.updateYoutube', $page->id) }}" class="btn btn-primary">Update</button>
                        <input type="button" name="add" value="nieuwe afbeelding toevoegen" id="addRemoveIp" class="btn btn-outline-dark" required>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="card">
                    <form id="submition-form"  method="POST">
                        @csrf
                        @method('POST')
                        <table class="table" id="multiForm">
                            <thead>
                                <tr>
                                    <th>image id</th>
                                    <th>Niewe image</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($page->Image as $img)
                                        <tr>
                                            <td>
                                                <select id="images" name="oldInput[{{++$img->id }}][image_id]" class="w-100">
                                                    @foreach($afbeeldingen as $af)
                                                        <option value="{{$af->id}}"  {{$af->id == $img->id ? 'selected' : ''}}>{{$af->title}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>image id</th>
                                    <th>Niewe image</th>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                @endforeach
                <div class="card-body">
                    @foreach ($page->Image as $img)
                    <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($img->photo)) }}" class="w-25 h-25 ">
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#multiForm').DataTable();
        });
        var i = 0;
        $("#addRemoveIp").click(function() {
            ++i;
            $("#multiForm").append(
                '<tr>'+
                    '<td>'+
                            '<select id="images" name="multiInput['+i+'][image_id]" class="w-100">'+
                                '@foreach($afbeeldingen as $img)'+
                                '<option value="{{$img->id}}">{{$img->title}}</option>'+
                                '@endforeach'+
                            '</select>'+
                    '</td>'+
                    '<td><button type="button" class="remove-item btn btn-danger">Delete</button></td>'+
                '</tr>'
                );
        });
        $(document).on('click', '.remove-item', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endsection
