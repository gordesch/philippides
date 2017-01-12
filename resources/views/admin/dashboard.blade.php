@extends('layouts.app')

@section('content')

    <h1>Administration</h1>

    @include('admin.partials.user')
    @include('admin.partials.section')
    @include('admin.partials.virtual-number')

@endsection