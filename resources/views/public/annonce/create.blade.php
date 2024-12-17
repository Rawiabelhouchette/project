@extends('public.template')

@section('breadcrumb')
    <h5>
        <a href="{{ route('accueil') }}" title="Revenir à la recherche" style="text-decoration: underline;">Accueil</a> &nbsp;
        &gt; &nbsp;
        Déposer une annonce
    </h5>
@endsection

@section('page-content')
    @foreach ($typeAnnonces as $type)
        <div class="col-md-4 col-sm-6">
            <div class="widget unique-widget">
                <div class="row">
                    <div class="widget-caption {{ $type->color }}">
                        <div class="col-xs-4 no-pad">
                            <i class="icon {{ $type->icon }}"></i>
                        </div>
                        <a href="{{ route($type->route) }}">
                            <div class="col-xs-8">
                                <div class="widget-detail">
                                    <h3>{{ $type->nom }}</h3>
                                    <span>{{ $type->nom }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
