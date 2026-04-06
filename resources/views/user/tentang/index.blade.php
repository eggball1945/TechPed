@extends('user.layouts.app')

@section('title', 'Tentang - TechPed')

@section('content')
    <div class="isi-section">
        @include('user.tentang.isi')
    </div>

    <div class="circle-section mt-24 lg:mt-32">
        @include('user.tentang.circle')
    </div>

    <div class="staff-section mt-24 lg:mt-32">
        @include('user.tentang.staff')
    </div>

    <div class="mt-24 lg:mt-32">
        @include('user.layouts.circle')
    </div>
@endsection