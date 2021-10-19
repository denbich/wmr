@extends('mail.layout')

@section('title')
Resetowanie Hasła
@endsection

@section('name')
wolontariuszu
@endsection

@section('content')
Otrzymujesz tę wiadomość e-mail, ponieważ otrzymaliśmy prośbę o zresetowanie hasła do Twojego konta. <br><br>
Ten link do resetowania hasła wygaśnie za {{ $count }} minut. <br><br>
Jeśli nie zażądałeś zresetowania hasła, nie są wymagane żadne dalsze działania.
<br><br>
<small>Jeśli masz problem z kliknięciem przycisku „Resetuj hasło”, skopiuj poniższy adres URL i wklej go w przeglądarce internetowej: <a href="{{ $url }}">{{ $url }}</a></small>
@endsection

@section('button-link')
{{ $url }}
@endsection

@section('button-text')
Zresetuj hasło
@endsection

