@extends('layout.public.app')

@section('content')
    <!-- ================ Listing Detail Basic Information ======================= -->
    @include('public.user.title-banner', ['title' => 'Mon compte'])
    <!-- ================ End Listing Detail Basic Information ======================= -->

    <section class="show-case">
        <div class="container">
            <div class="row">

                @include('public.user.menu', ['category' => 0])

                @livewire('public.user.account')

            </div>
        </div>
    </section>
@endsection
