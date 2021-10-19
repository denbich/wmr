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
<br><br>
<small>Jeśli masz problemy z kliknięciem przycisku „Zweryfikuj adres e-mail”, skopiuj poniższy adres URL i wklej go w przeglądarce internetowej: <a href="{{ $url }}">{{ $url }}</a></small>
@endsection

@section('button-link')
{{ $url }}
@endsection

@section('button-text')
Zweryfikuj emaila
@endsection

