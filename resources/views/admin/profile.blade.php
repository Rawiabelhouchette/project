@extends('layout.admin.app')

@section('profil', 'active')

@section('content')
    <!-- ================ Listing Detail Basic Information ======================= -->
    {{-- @include('public.user.title-banner', ['title' => 'Mon compte']) --}}
    <!-- ================ End Listing Detail Basic Information ======================= -->

    <section class="show-case">
        <div class="container">
            <div class="row">

                {{-- @include('public.user.menu', ['category' => 0]) --}}

                @livewire('admin.profile')

            </div>
        </div>
    </section>
@endsection
