@extends('layouts.master')
@section('page_title', 'Anasayfa')
@section('page_description', 'Anasayfa-index')

@section('content')
<div class="container">
    <div class="box">
        <h1 class="box-title">İstka</h1>
        <p class="box-text">
            text
        </p>

        <button class="button" id="hello">BUTTON</button>
        <span class="button button-info">BUTTON1</span>
        <span class="button button-success">BUTTON2</span>
    </div>
</div>

<div class="container">
    <ul class="liste">
        <li>Coffee</li>
        <li>Tea</li>
        <li>Milk
            <ul>
                <li>Coffee</li>
                <li>Tea</li>
                <li>Milk</li>
            </ul>
        </li>
    </ul>

</div>
@endsection