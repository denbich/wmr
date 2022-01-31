@extends('mail.layout')

@section('title')
Potwierdzenie skasowania niewykorzystanych punków 2021 rok
@endsection

@section('name')
wolontariuszu
@endsection

@section('content')
Zgodnie z wcześniejszą zapowiedzią, skasowaliśmy <b>{{ $datam['points'] }} punktów</b> zgromadzonych przez Ciebie do 31.01.2022 r.
Dziękujemy jeszcze raz za wspólnie spędzony czas! Oczekuj nowych formularzy i śledź nasze social media, bo uwierz, będzie się działo!
@endsection

@section('button-link')
{{ route('login') }}
@endsection

@section('button-text')
Zaloguj się do ISOW
@endsection

