@extends('layout.admin.app')

@section('reference', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="#">Référence</a></li>
                <li class="active">Gestion de Référence</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /. ROW  -->
    <div id="page-inner">
        <div class="row bott-wid">
            <div class="col-md-12 col-sm-12">
                <livewire:Admin.Reference.add />

                <div class="">
                    <div class="card card-list">

                        <div class="card-header">
                            <h4>Liste des noms de référence</h4>
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
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        title: 'Type',
                        data: 'reference.type',
                    }, {
                        title: 'Nom de référence',
                        data: 'reference.nom',
                    }, {
                        title: 'Valeur',
                        data: 'valeur'
                    }, {
                        title: 'Date de création',
                        data: 'created_at',
                        render: function(data, type, row) {
                            return formatDateToDMY(row.created_at);
                        },
                    }, {
                        title: 'Créer par',
                        sortable: false,
                        render: function(data, type, row) {
                            if (!row.user) {
                                return '-';
                            }
                            return row.user.nom + ' ' + row.user.prenom;
                        }
                    }, {
                        title: 'Action',
                        sortable: false,
                        className: "text-center",
                        render: function(data, type, row) {
                            return `
                            <a href="javascript:void(0)" data-id="` + row.id + `" class="edit"><i class="fa fa-pencil"></i></a>
                            <a href="javascript:void(0)" data-id="` + row.id + `" class="delete"><i class="fa fa-trash"></i></a>
                        `;
                        }
                    }
                ];

                const params = {
                    url: "{{ route('references.datatable') }}",
                    columns: columns,
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
                    Livewire.dispatch('editReference', [$(this).data('id')]);
                });

                $(document).on('click', '.delete', function(e) {
                    const data = {
                        message: 'Voulez-vous vraiment supprimer cette référence valeur ?',
                        onConfirm: () => {
                            Livewire.dispatch('deleteReference', [$(this).data('id')]);
                        }
                    }

                    showConfirmationNotification(data);
                });
            });
        </script>
    @endsection
