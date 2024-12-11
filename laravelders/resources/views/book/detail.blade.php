
@extends('layouts.master')
@section('page_title', 'Kitap detay')
@section('page_description', 'Kitap detay sayfası')
    @section('content')
    @include('layouts.sections._detailBook')
    @endsection
@section('js')
@include('layouts.js.bookjs')
@endsection