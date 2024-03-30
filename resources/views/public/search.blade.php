@extends('layout.public.app')

@section('content')
    @livewire('public.search-box')

    @livewire('public.search', ['hasSessionValue' => $hasSessionValue])
@endsection
