@extends('mail.layout')

@section('title')
Stanowiska zostały przydzielone na imprezę {{ $data['title'] }}!
@endsection

@section('name')
wolontariuszu
@endsection

@section('content')
Stanowiska na imprezę {{ $data['title'] }} zostały przydzielone! Sprawdź jakie otrzymałeś.
@endsection

@section('button-link')
{{ $data['link'] }}
@endsection

@section('button-text')
Zaloguj się i sprawdź!
@endsection

