@extends('layouts.app')

@section('title') PDF @endsection

@section('content')

<div class="container">
    <form action="{{ route('c.test.pdf') }}/pdf" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="pdf">
        <button type="submit" class="btn btn-primary">Wyślij</button>
    </form>
</div>

@endsection
