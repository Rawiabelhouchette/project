@extends('layout.admin.app')

@section('annonce', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="#">Restaurant</a></li>
                <li class="active">Ajouter</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /. ROW  -->
    <div id="page-inner">

    <div class="col-md-12">
        <div class="card title">
            <div class="card-header">
                <h4>Ajouter un restaurant</h4>
            </div>
        </div>
    </div>
        <div class="row bott-wid">
            <div class="col-md-12 col-sm-12">
                @livewire('admin.restaurant.create')
            </div>
        </div>
    </div>
@endsection
