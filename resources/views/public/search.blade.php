@extends('layout.public.app')

@section('content')
    @include('layout.public.search_box')

    @livewire('public.search', ['filter' => $filter])
@endsection
