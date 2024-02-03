@extends('layout.public.app')

@section('content')
    <!-- ================ Listing Detail Basic Information ======================= -->
    @include('public.user.title-banner', ['title' => 'Mes favoris'])
    <!-- ================ End Listing Detail Basic Information ======================= -->

    <section class="show-case padd-bot-10">
        <div class="container">
            <div class="row">

                @include('public.user.menu', ['category' => 1])

                @livewire('public.user.favoris')

            </div>
        </div>
    </section>
@endsection
