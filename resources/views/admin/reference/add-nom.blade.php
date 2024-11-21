@extends('layout.admin.app')

@section('reference', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="#">Référence</a></li>
                <li class="active">Gestion du nom de référence</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /. ROW  -->
    <div id="page-inner">
        <div class="row bott-wid">
            {{-- <div class="col-md-12 col-sm-12">
                <livewire:Admin.Reference.addNom />
            </div> --}}

            <div class="col-md-12 col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <h4>Liste des références</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-2 table-hover" id="dataTable"></table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            let headers = document.querySelectorAll("#dataTable th");
            headers.forEach(header => {
                header.style.backgroundColor = "#F3F5F7";
            });

            const columns = [{
                    title: 'N°',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    title: 'Type',
                    name: 'type',
                    data: 'type',
                },
                {
                    title: 'Nom de référence',
                    name: 'nom',
                    data: 'nom',
                },
                {
                    title: 'Date de création',
                    name: 'created_at',
                    render: function(data, type, row) {
                        var date = new Date(row.created_at);
                        return date.toLocaleDateString('fr-FR') + ' ' + date.toLocaleTimeString('fr-FR');
                    },
                },
                {
                    title: 'Créé par',
                    orderable: false,
                    render: function(data, type, row) {
                        return row.user.nom + ' ' + row.user.prenom;
                    },
                },
                // {
                //     className: "text-center",
                //     render: function(data, type, row) {
                //         return '<a href="javascript:void(0)" data-id="' + row.id + '" class="edit"><i class="fa fa-pencil"></i></a>';
                //     }
                // }
            ];

            const link = "{{ route('references.nom.datatable') }}";

            const params = {
                tableId: 'dataTable',
                url: link,
                columns: columns,
            };

            const dataTable = initDataTable(params);

            window.addEventListener('relaod:dataTable', event => {
                datatable.ajax.reload();
            });

            $(document).on('click', '.edit', function(e) {
                // scroll to top with animation
                $('html, body').animate({
                    scrollTop: 0
                }, 'slow');
                Livewire.dispatch('editNomReference', [$(this).data('id')]);
            });
        });
    </script>
@endsection
