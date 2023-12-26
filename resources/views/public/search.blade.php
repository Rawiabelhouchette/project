@extends('layout.public.app')

@section('content')
    @include('layout.public.search_box', [
        'key' => $key,
        'type' => $type,
    ])

    @livewire('public.search', [
        'key' => $key,
        'type' => $type,
        'filter' => $filter ?? [],
    ])
@endsection
