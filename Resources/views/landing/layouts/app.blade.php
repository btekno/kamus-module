@extends('layouts.app')

@section('root-meta')
    <title>@yield('title') :: {{ config('qamus.name') }}</title>
    <meta name="author" content="{{ config('qamus.meta.author') }}">
    <meta name="description" content="{{ config('qamus.meta.description') }}">
@endsection

@section('root-icon')
    <link href="{{ asset('assets/v1/img/logo/square/kamus-alt.png') }}" rel="icon" type="image/png">
    <link rel="shortcut icon" href="{{ asset('assets/v1/img/logo/square/kamus-alt.png') }}" type="image/x-icon">
@endsection

@section('root-header')
	<style type="text/css">
		.sidebar .sidebar_inner ul li.active, .sidebar .sidebar_inner ul li.uk-active {
			background-color: #d56faa;
		}
	</style>
    @include('qamus::landing.layouts.partials.header')
@endsection

@section('root-sidebar')
    @include('qamus::landing.layouts.partials.sidebar')
@endsection