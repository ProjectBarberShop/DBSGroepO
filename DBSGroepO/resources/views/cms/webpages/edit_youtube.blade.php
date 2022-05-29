@extends('layouts.cms')

@section('content')
    <section class="content">
                @foreach ($pagecontent as $page)
                    <div class="pull-right ">
                        <a class="btn btn-danger" href="{{ route('editColomText.edit', $page->id) }}"> Back</a>
                        <button type="submit" form="submition-form" formaction="{{ route('youtubeWebpage.updateYoutube', $page->id) }}" class="btn btn-primary">Update</button>
                        <input type="button" name="add" value="nieuwe key toevoegen" id="addRemoveIp" class="btn btn-outline-dark" required>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="card">
                    <form id="submition-form" method="post">
                        @csrf
                        @method('post')
                        <div class="table-responsive">
                            <table class="table" id="multiForm">
                                <thead>
                                    <tr>
                                        <th>Youtube key</th>
                                        <th>Nieuwe key</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($page->youtube as $y)
                                        <tr>
                                            <td><input type="text" name="oldInput[{{ $y->id }}][youtube_video_key]" class="form-control" value="{{ $y->youtube_video_key }}" required /></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Youtube key</th>
                                        <th>Nieuwe key</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="card-body d-flex">
                            @foreach ($page->youtube as $y)
                                @component('components.youtube')
                                    @slot('youtube_key')
                                        {{ $y->youtube_video_key }}
                                    @endslot
                                @endcomponent
                            @endforeach
                        </div>
                    </form>
                @endforeach
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
            $("#multiForm").append('<tr><td><input type="text" name="multiInput[' + i +
                '][youtube_video_key]" class="form-control" required/></td><td><button type="button" class="remove-item btn btn-danger">Delete</button></td></tr>'
                );
        });
        $(document).on('click', '.remove-item', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endsection
