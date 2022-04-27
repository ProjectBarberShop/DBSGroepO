@extends('layouts.cms')

@section('content')
<section id="CMSFotosContent" class="d-flex flex-row align-items-start">
    <div id="previewer" class="card">
        <label class="card-title">
        <div class="card-body">
            <form action="{{ route('fotos.store') }}" method="POST" class="d-flex flex-column" enctype="multipart/form-data">
                @csrf  
                <label for="title">titel:</label>  
                <input type="text" name="title" placeholder="title">
                <label for="photo">foto:</label>
                <img id="preview" src="#" alt="afbeelding"/>
                <input type="file" name="photo" id="file" accept="image/*" onchange="getImgData()">
                <label for="category">Categorie:</label>
                <input list="category" name="category" id="category" value="-">
                <button type="submit" class="btn btn-primary float-right mt-4">+</button>
            </form>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      </div>
    </div>
</secton>
@endsection
<script>

 function getImgData() {
  const files = document.getElementById("file").files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      document.getElementById('preview').src = this.result;
    });    
  }
}
</script>