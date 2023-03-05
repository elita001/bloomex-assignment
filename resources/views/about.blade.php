@extends('layouts.layout')
@section('bodyClass', 'about-page')
@section('content')
    <div class="container text-center">
        <h1 class="mt-4">About us</h1>
        <p class="about-sub-heading">The page contains responsive elements based on Bootstrap 5 and SASS custom styling</p>
        <h3 class="mt-4">Progressbar:</h3>
        <ul class="progress-items">
            <li class="progress-item done">1<span></span></li>
            <li class="progress-item current">2<span></span></li>
            <li class="progress-item">3<span></span></li>
            <li class="progress-item">4<span></span></li>
            <li class="progress-item">5<span></span></li>
            <li class="progress-item">6<span></span></li>
        </ul>
        <h3 class="mt-4">Form step:</h3>
        <div class="steps">
            <div class="step">
                <div class="step-heading">
                    Yes or No?
                </div>
                <input id="choice-yes" type="radio" class="btn-check step-radio--next" name="choice" value="1">
                <label for="choice-yes" class="step-btn step-choice btn-grow">Yes</label>
                <input id="choice-no" type="radio" class="btn-check step-radio--next" name="choice" value="0">
                <label for="choice-no" class="step-btn step-choice btn-grow">No</label>
            </div>
        </div>
    </div>
@endsection