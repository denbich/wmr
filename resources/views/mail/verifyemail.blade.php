@extends('mail.layout')

@section('title')
Zweryfikuj adres email
@endsection

@section('name')
wolontariuszu
@endsection

@section('content')
Kliknij poniższy przycisk, aby zweryfikować swój adres e-mail.
Jeśli nie utworzyłeś konta, nie musisz nic więcej robić.
@endsection

@section('button-link')
{{ $url }}
@endsection

@section('button-text')
Zaloguj się i sprawdź!
@endsection

