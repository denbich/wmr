@extends('mail.layout')

@section('title')
{{ $data['title'] }}
@endsection

@section('name')
wolontariuszu
@endsection

@section('content')
{!! $data['content'] !!}
@endsection

@section('button-link') {{ route('v.dashboard') }} @endsection

@section('button-text') Zaloguj się do systemu @endsection

