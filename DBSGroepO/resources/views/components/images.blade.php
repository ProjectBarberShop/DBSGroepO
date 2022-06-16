<div class="modal" id="modal-info" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog"></div>
        <div class="modal-dialog-scrollable d-flex justify-content-center align-content-center">
            <div class="modal-content bg-info w-75">
                <div class="modal-header">
                    <h2 class="modal-title">Selecteer foto</h2>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row m-0 h-100">
                    @forelse($imagesdata as $img)
                        <div class="d-flex justify-content-center align-items-center col-6 col-md-4 p-0">
                            <a onclick="cloneimage({{$img->id}}, 'b', 'imagePosition', null, null, true)" data-bs-dismiss="modal" class="m-2">
                                <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($img->photo)) }}" class="img-fluid" id="{{$img->id}}b">
                            </a>
                        </div>
                    @empty
                        <p class="fs-5">Er zijn nog geen foto's beschikbaar. Ga naar: <a href="{{ route('fotos.index') }}">foto's pagina</a></p>
                    @endforelse
                    @if($imagesdata != null)
                        {{ $imagesdata->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>