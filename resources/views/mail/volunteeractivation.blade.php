@extends('mail.layout')

@section('title')
Twoje konto zostało aktywowane!
@endsection

@section('name')
wolontariuszu
@endsection

@section('content')
Twoje konto zostało aktywowane! Możesz teraz zalogować się do systemu!
@endsection

@section('button-link')
{{ route('login') }}
@endsection

@section('button-text')
Zaloguj się
@endsection
