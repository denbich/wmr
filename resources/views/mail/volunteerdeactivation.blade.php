@extends('mail.layout')

@section('title')
Twoje konto nie zostało aktywowane!
@endsection

@section('name')
wolontariuszu
@endsection

@section('content')
Twoje konto nie zostało aktywowane! Powód: <br><br>

<b>{{ $data['reason'] }}</b>
@endsection

@section('button-link')
{{ route('login') }}
@endsection

@section('button-text')
Zaloguj się i dodaj nową zgodę
@endsection



