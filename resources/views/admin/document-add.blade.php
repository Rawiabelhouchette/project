@extends('layout.app')

@section('catalogue', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="#">Document</a></li>
                <li class="active">Choix de document</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /. ROW  -->
    <div id="page-inner">
        <div class="row" style="margin-bottom: 10px;">
            <form action="{{ route('document.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-xl-2 col-lg-3 col-xs-12">
                    <select name="type_document" id="type_document" class="form-control" required>
                        <option value="">Type de document</option>
                        @foreach ($liens as $lien)
                            <option value="{{ $lien[0] }}">{{ $lien[0] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-3 col-lg-3 col-xs-8">
                    <input type="file" name="import" class="form-control" required id="import" accept=".csv,.xls,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                </div>
                <div class="col-xl-2 col-lg-2 col-xs-4">
                    <button type="submit" class="form-control" id="btn-import">Importer</button>
                </div>
            </form>
        </div>
        <div class="row">
            @foreach ($liens as $lien)
                <div class="col-md-6 col-xs-12 col-lg-4">
                    <div class="widget unique-widget">
                        @if ($lien[2] != '')
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
                        @else
                            <a href="javascript:void(0)">
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
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection


@section('js')
    <script>
        $('#btn-import').click(function() {
            if ($('#type_document').val() != '' && $('#import').val() != '') {
                let timerInterval;
                Swal.fire({
                    title: 'Importation en cours...',
                    height: '40%',
                    width: '40%',
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    },
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer');
                    }
                });
            }
        });
    </script>
@endsection
