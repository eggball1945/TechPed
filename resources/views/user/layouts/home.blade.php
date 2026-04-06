@extends('user.layouts.app')

@section('title', 'Home | TechPed')

@section('content')

    @include('user.item.promosi')
    @include('user.item.flashsale')

    @include('user.item.kategori')
    @include('user.item.terlaris')
    @include('user.item.item')
    @include('user.item.produk-baru')
    @include('user.layouts.circle')

@endsection