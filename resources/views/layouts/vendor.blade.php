@extends('layouts.app')

@section('navigation')
    @include('layouts.navigation.vendor')
@endsection

@section('content')
    <div class="main-content">
        @yield('vendor-content')
    </div>
@endsection
