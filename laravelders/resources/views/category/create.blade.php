@extends('layouts.master')
@section('page_title', 'Kategori Oluşturma')
@section('page_description', 'Kategori ekleme sayfası')
  @section('content')
  @include('layouts.sections._createCategory')
  @include('layouts.sections._modalCategory')
    @endsection

@section('js')
@include('layouts.js.categoryjs')
@endsection
