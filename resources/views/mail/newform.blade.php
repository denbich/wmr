@extends('mail.layout')

@section('title')
Nowy formularz
@endsection

@section('name')
wolontariuszu
@endsection

@section('content')
Właśnie otworzyliśmy zapisy na: {{ $data['title'] }}. Więc nie czekaj dłużej i zapisz się! Data wygaśnięcia formularza: {{ $data['expiration'] }}.
@endsection

@section('button-link') {{ $data['button-link'] }} @endsection

@section('button-text') {{ $data['button-text'] }} @endsection

