@extends('layouts.app')

@section('navigation')
    @include('layouts.navigation.customer.top')
    @include('layouts.navigation.customer.bottom')
@endsection

@section('content')
    <div class="main-content pt-16 pb-16">
        @yield('customer-content')
    </div>
@endsection
