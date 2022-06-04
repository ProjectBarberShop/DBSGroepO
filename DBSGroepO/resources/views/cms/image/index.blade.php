@extends('layouts.cms')

@section('content')
<section id="CMSFotosContent" class="d-flex flex-row align-items-start row">
<div id="previewer" class="card">
        <label class="card-title">
        <div class="card-body">
            <form action="{{ route('fotos.store') }}" method="POST" class="d-flex flex-column w-100" enctype="multipart/form-data" autocomplete="off"> 
                @csrf  
                <label for="title">titel:</label>  
                <input type="text" name="title" placeholder="title">
                <label for="photo">foto:</label>
                <img id="preview" src="#" alt="afbeelding" class="w-50 h-50"/>
                <input type="file" name="photo" id="file" accept="image/*" onchange="getImgData()">
                <label for="tag">Categorie:</label>             
                <div>
                    <input name="tag" list="tags" id="tag">
                        <datalist id="tags" class="w-100">
                            @foreach($labels as $l)
                                <option value="{{$l->tag}}">{{$l->tag}}</option>
                            @endforeach
                        </datalist>
                    <input name="tag-color" type="color" id="tag-color">
                </div>
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
  <div class="d-flex flex-column ">
    <form action="" method="GET" class="d-flex flex-row" >
          @method('GET')
          @csrf
          <input type="text" name="search" id="search" class="form-control" placeholder="Zoeken">
          <select name="filter" id="filter" class="form-control">
          <option value="">Geen filter</option>
          @foreach ($labels as $l)
            <option value="{{$l->tag}}">{{$l->tag}}</option>
          @endforeach
        </select>
          <input type="submit" value="Zoeken" class="btn btn-primary ">
    </form>
    <table class="table d-none d-sm-block">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Titel</th>
            <th scope="col">Wordt in slider gebruikt?</th>
            <th scope="col">Foto preview</th>
            <th scope="col">category</th>
            <th scope="col"></th>
        </tr>
        </thead>
        @if($images != null)
        @foreach($images as $img)
        <tr>
            <td>{{$img->title}}</td>
            <td><form action="{{ route('fotos.update', $img->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    @if($img->useInSlider)
                    <button type="submit" class="btn btn-primary">Ja</button>
                    @else
                    <button type="submit" class="btn btn-primary">Nee</button>
                    @endif
                </form></td>
                <td><img src="data:image/jpg;base64,{{ chunk_split(base64_encode($img->photo)) }}" class="w-25 h-25 "></td>
                @foreach($labels as $l)
                    @if($l->tag == $img->tagName)
                        <td style="background-color:{{$l->color}}">{{$img->tagName}}</td>  
                        @break;
                    @endif 
                @endforeach
        
            <td>  
            <a href="{{ route('fotos.show', $img->id) }}" class="mr-2 btn btn-primary">Details</a>
                <form action="{{ route('fotos.destroy', $img->id) }}" method="POST">
                <input type="hidden" id="{{$img->title}}" name="{{$img->title}}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
        @endif
    </table>
    <table class="table d-block d-sm-none">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Foto</th>
            <th scope="col"></th>
        </tr>
        </thead>
        @if($images != null)
        @foreach($images as $img)
        <tr>
            <td><img src="data:image/jpg;base64,{{ chunk_split(base64_encode($img->photo)) }}" class="w-50 h-50 "></td>    
            <td>
                <a href="{{ route('fotos.show', $img->id) }}" class="mr-2 btn btn-primary">Details</a>
                <form action="{{ route('fotos.destroy', $img->id) }}" method="POST">
                <input type="hidden" id="{{$img->title}}" name="{{$img->title}}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
        @endif
    </table>
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