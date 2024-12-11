
@extends('layouts.master')
@section('page_title', 'Kitap Oluşturma')
@section('page_description', 'Kitap ekleme sayfası')
    @section('content')
    @include('layouts.sections._createBook')
    @include('layouts.sections._modalBook')
    @endsection
@section('js')
@include('layouts.js.bookjs')
@endsection