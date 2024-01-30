@extends('layout.public.app')

@section('content')
    <!-- ================ Listing Detail Basic Information ======================= -->
    <section class="detail-section" style="background:url(http://via.placeholder.com/1920x850);" data-overlay="6">
        <div class="overlay" style="background-color: rgb(36, 36, 41); opacity: 0.5;"></div>
        <div class="profile-cover-content">
            <div class="container">
                <div class="center">
                    <h3 style="color: white;">Mes favoris</h3>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ End Listing Detail Basic Information ======================= -->

    <section class="show-case">
        <div class="container">
            <div class="row">

                @include('public.menu', ['category' => 1])

                @livewire('public.user.favoris')

            </div>
        </div>
    </section>
@endsection
