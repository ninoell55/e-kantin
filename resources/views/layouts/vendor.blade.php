@extends('layouts.app')

@section('navigation')
    @include('layouts.navigation.vendor_top')
@endsection

@section('content')
    <div class="main-content">
        @yield('vendor-content')
    </div>
@endsection

@section('navigation')
    @include('layouts.navigation.vendor_bottom')
@endsection
