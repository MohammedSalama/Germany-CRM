@extends('Backend.master')
@section('css')
@endsection

@section('title')
    Location
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6"> Location <h4 class="mb-0"> </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color"> Location </a></li>
                    <li class="breadcrumb-item active">Settings</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="container">
{{--        <h1>How to Get Current User Location with Laravel - Tutsmake.com</h1>--}}
        <div class="card">
            <div class="card-body">
                @if($currentUserInfo)
                    <h4>IP: {{ $currentUserInfo->ip }}</h4>
                    <h4>Country Name: {{ $currentUserInfo->countryName }}</h4>
                    <h4>Country Code: {{ $currentUserInfo->countryCode }}</h4>
                    <h4>Region Code: {{ $currentUserInfo->regionCode }}</h4>
                    <h4>Region Name: {{ $currentUserInfo->regionName }}</h4>
                    <h4>City Name: {{ $currentUserInfo->cityName }}</h4>
                    <h4>Zip Code: {{ $currentUserInfo->zipCode }}</h4>
                    <h4>Latitude: {{ $currentUserInfo->latitude }}</h4>
                    <h4>Longitude: {{ $currentUserInfo->longitude }}</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
