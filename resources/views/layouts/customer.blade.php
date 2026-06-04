@extends('layouts.app')

@section('content')
    @include('navigation.customer.top')
    
    <main class="pb-20">  {{-- Padding bottom buat floating nav --}}
        @yield('customer-content')
    </main>
    
    @include('navigation.customer.bottom')
@endsection