@extends('layout.admin.app')

@section('reference', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="#">Référence</a></li>
                <li class="active">Gestion des marques</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /. ROW  -->
    <div id="page-inner">
        <div class="row bott-wid">
            <div class="col-md-12 col-sm-12">
                @livewire('admin.marque.create')
            </div>
        </div>

        <div class="">
            <div class="card card-list">

                <div class="card-header" style="text-align: left !important;">
                    <h4>Liste des marques</h4>
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
            const columns = [{
                    title: 'N°',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    title: 'Nom',
                    data: 'nom',
                },
                {
                    title: 'Date de création',
                    render: function(data, type, row) {
                        return formatDateToDMY(row.created_at);
                    }
                },
                {
                    orderable: false,
                    title: 'Créer par',
                    render: function(data, type, row) {
                        if (!row.creator) {
                            return '-';
                        }

                        return row.creator.nom + ' ' + row.creator.prenom;
                    }
                },
                {
                    orderable: false,
                    title: 'Actions',
                    render: function(data, type, row) {
                        return `
                            <a class="edit" data-id="${row.id}" href="javascript:void(0)"><i class="fa fa-pencil"></i></a>
                            <a class="delete" data-id="${row.id}" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                        `;
                    }
                }
            ];

            const params = {
                columns: columns,
                url: "{{ route('marques.datatable') }}",
            };

            const datatable = initDataTable(params);

            window.addEventListener('relaod:dataTable', event => {
                datatable.ajax.reload();
            });

            $(document).on('click', '.edit', function(e) {
                // scroll to top with animation
                $('html, body').animate({
                    scrollTop: 0
                }, 'slow');
                Livewire.dispatch('editMarque', [$(this).data('id')]);
            });

            $(document).on('click', '.delete', function(e) {
                const id = $(this).data('id');

                const params = {
                    'message': 'La suppression de cette marque entrainera la suppression de tous les modèles associés. Voulez-vous continuer ?',
                    onConfirm: function() {
                        if (confirm('Voulez-vous vraiment continuer ?')) {
                            Livewire.dispatch('deleteMarque', [id]);
                        }
                    }
                }

                showConfirmationNotification(params);
            });

        });
    </script>
@endsection
