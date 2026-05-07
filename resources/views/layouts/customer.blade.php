@extends('layouts.app')

@section('navigation')
    @include('layouts.navigation.customer')
@endsection

@section('content')
    <div class="main-content">
        @yield('customer-content')
    </div>
@endsection
