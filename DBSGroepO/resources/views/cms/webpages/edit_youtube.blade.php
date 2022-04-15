@extends('layouts.cms')

@section('content')
    <section class="content">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pagina hoofdtekst</h3>
                </div>
                    <form action="{{ route('paginas.update', $page->id) }}" method="post">
                        <table class="table" id="multiForm">
                            <thead>
                                <tr>
                                    <th>Youtube key</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($page->youtube as $y)
                                    <tr>
                                        <td>
                                            <input type="text" name="multiInput[{{ $y->id }}][youtube_video_key]"class="form-control" value="{{ $y->youtube_video_key }}" required />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Youtube key</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="card-body">
                            @component('components.youtube')
                                @slot('youtube_key')
                                    {{ $y->youtube_video_key }}
                                @endslot
                            @endcomponent
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('paginas.index') }}"> Back</a>
                </div>
            </div>
        </div>
    </section>
@endsection
