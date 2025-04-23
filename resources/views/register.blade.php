@extends('layout.public.app-2')

@section('title', 'Inscription')

@section('content')
    <section class="log-wrapper">
        <div class="container">
            <div class="col-md-2 col-sm-1"></div>
            <div class="col-md-8 col-sm-10">
                {{-- <div class="col-md-8 col-sm-10 col-md-offset-3 col-sm-offset-1"> --}}
                <div class="log-box padd-bot-25">
                    @livewire('public.auth.register')
                </div>
            </div>
            <div class="col-md-2 col-sm-1"></div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $('.navbar').removeClass('navbar-transparent');
    </script>
@endsection
