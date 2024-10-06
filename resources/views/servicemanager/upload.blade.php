@extends('layout.app')
@section('content')
<h1>Upload Image to Google Drive</h1>
<form action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="image">Select Image:</label>
    <input type="file" name="image" id="image" required>
    <button type="submit">Upload</button>
    @if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if($errors->any())
    <p style="color: red;">{{ $errors->first() }}</p>
    @endif
</form>

@endsection