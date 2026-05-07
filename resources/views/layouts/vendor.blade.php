@extends('layouts.app')

@section('navigation')
    @include('layouts.navigation.vendor.top')
    @include('layouts.navigation.vendor.bottom')
@endsection

@section('content')
    <div class="main-content pt-16 pb-16">
        @yield('vendor-content')
    </div>
@endsection
