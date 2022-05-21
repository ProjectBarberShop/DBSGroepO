@extends('layouts.cms')

@section('content')
<div class="container">

<form action="{{route ('learntosing.store')}}" method="POST" class="d-flex flex-column">
    @csrf
    <label for="title">Titel:</label>
    <input type="text" name="title" value="{{ old('title') }}">
    @error('title')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    <label for="description">Beschrijving:</label>
    <textarea id="description" name="description">{{ old('description') }}</textarea>
    <p id="count" class="h5 m-0">Tekens over: 255</p>
    @error('description')
    <p class="text-danger">{{ $message }}</p>
    @enderror
    <label for="category_id">Categorie</label>
    <select name="category_id">

        @foreach($categories as $category)
        <option {{ old('title') == $category->id ? ' selected' : ''}} value="{{ $category->id }}">{{ $category->title }}</option>
        @endforeach
    </select>
    <label for="date">Datum en tijd:</label>
    <input type="datetime-local" name="date" value="{{ old('date') }}">
    <label for="location">Locatie:</label>
    <input type="text" name="location" value="{{ old('location') }}">
    <label for="mentor">Begeleider:</label>
    <input type="text" name="mentor" value="{{ old('mentor') }}" >
    <label for="price">prijs:</label>
    <input type="number" step="0.01" name="price" value= {{ old('price') }}>
    <button type="submit" class="btn btn-primary float-right mt-4">Aanmaken</button>
</form>
</div>
@endsection

<script>
    let textarea = null;

setTimeout(() => {
    textarea = document.getElementById('description');
    textarea.addEventListener('keyup', textareaLengthCheck, false);
    textarea.addEventListener('keydown', textareaLengthCheck, false);
}, 1000);

function textareaLengthCheck() {
    let textAreaLength = textarea.value.length;
    let charactersLeft = 255 - textAreaLength;
    let count = document.getElementById('count');
    if(charactersLeft < 0){
        textarea.classList.add('is-invalid');
        count.classList.add('text-danger');
    }
    else{
        textarea.classList.remove('is-invalid');
        count.classList.remove('text-danger');
    }
    count.innerHTML = "Tekens over: " + charactersLeft;
}
</script>