@extends('mail.layout')

@section('title')
Nowy wolontariusz
@endsection

@section('name')
Koordynatorze
@endsection

@section('content')
Jest nowy wolontariusz! <br>
Login wolontariusza: <b>{{ $data['name'] }}</b>
@endsection

@section('button-link')
{{ route('c.v.active') }}
@endsection

@section('button-text')
Aktywuj wolontariusza
@endsection

