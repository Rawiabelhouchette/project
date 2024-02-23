@extends('layout.public.app')

@section('content')
    @livewire('public.search-box')

    @livewire('public.search', ['filter' => $filter])
@endsection
