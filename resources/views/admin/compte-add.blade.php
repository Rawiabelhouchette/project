@extends('layout.app')

@section('comptes', 'active')

@section('content')
<div class="row bg-title" style="padding-top: 20px;">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <ol class="breadcrumb" style="text-align: left;">
            <li><a href="#">Comptes</a></li>
            <li class="active">Choix de compte</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>              
    <!-- /. ROW  -->
<div id="page-inner">  
    <div class="row">
        @foreach ($liens as $lien)
        <div class="col-md-6 col-sm-6">
            <div class="widget unique-widget">
                <a href="{{ route($lien[2]) }}">
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-12 text-center">
                            <i class="{{ $lien[1] }}" style="font-size: 50px;"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3>{{ $lien[0] }}</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection