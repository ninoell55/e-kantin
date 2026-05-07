@extends('layouts.app')

@section('navigation')
    @include('layouts.navigation.admin')
@endsection

@section('content')
    <div class="main-content">
        @yield('admin-content')
    </div>
@endsection
