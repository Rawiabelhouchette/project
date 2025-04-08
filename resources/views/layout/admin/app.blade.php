<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{--
    <meta name="description" content="Best Responsive job portal template build on Latest Bootstrap.">
    <meta name="keywords" content="job, nob board, job portal, job listing">
    <meta name="robots" content="index,follow">' --}}

        <link type="image/x-icon" href="{{ asset('assets/img/logo-vamiyi-by-numrod-small.png') }}" rel="icon">
        <link type="image/x-icon" href="{{ asset('assets/img/logo-vamiyi-by-numrod-small.png') }}" rel="shortcut icon">

        <title>Vamiyi @yield('title')</title>

        @livewireStyles

        <!-- BOOTSTRAP STYLES-->
        <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />

        <!-- FONTAWESOME STYLES-->
        <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet" />

        <!-- Line Font STYLES-->
        <link href="{{ asset('assets/css/line-font.css') }}" rel="stylesheet" />

        <!-- Dropzone Style-->
        <link href="{{ asset('assets/css/dropzone.css') }}" rel="stylesheet" />

        <!-- Bootstrap Editor-->
        <link href="{{ asset('assets/css/bootstrap-wysihtml5.css') }}" rel="stylesheet" />

        <!-- Common Style -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />

        <!-- CUSTOM STYLES-->
        <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />

        <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" rel="stylesheet" />

        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

        {{-- Dropzone --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.min.css" rel="stylesheet">

        <style>
            #map {
                height: 160px;
            }

            footer {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                height: 30px;
                background-color: #fff;
                /* background-color: #333; */
                color: #333;
                /* color: #fff; */
                line-height: 5px;
                text-align: right;
            }

            .card-body {
                /* background-color: #e0e0e0;*/
            }

            input::-webkit-input-placeholder {
                font-style: italic;
            }

            input::-moz-placeholder {
                font-style: italic;
            }

            input:-ms-input-placeholder {
                font-style: italic;
            }

            input::-ms-input-placeholder {
                font-style: italic;
            }

            input::-webkit-input-placeholder {
                color: #C0C0C0;
            }

            input::-moz-placeholder {
                color: #C0C0C0;
            }

            input:-ms-input-placeholder {
                color: #C0C0C0;
            }

            input::-ms-input-placeholder {
                color: #C0C0C0;
            }
        </style>

        <style>
            #dataTable tfoot {
                position: fixed;
                bottom: 0;
                width: 100%;
                max-height: 20vh;
                margin-top: calc(100vh - 20vh);
            }

            #dataTable .dataTables_paginate {
                bottom: 5000px;
                position: fixed;
            }

            #dataTable {
                width: 100% !important;
            }

            #dataTable td {
                height: 35px;
            }

            #dataTable th {
                background: #0c556e !important;
                height: 35px;
                border: none !important;
                color: #fff;
                font-weight: 400;
            }
        </style>

        <style>
            /* SELECT 2 : CUSTOM */
            .select2-container .select2-selection--single {
                height: 37px !important;
                padding-top: 5px !important;
                padding-bottom: 5px !important;
            }

            .select2-selection__arrow {
                height: 35px !important;
            }

            .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
                background-color: #de6600 !important;
            }
        </style>

        <style>
            .pointer-cursor {
                cursor: pointer;
            }
        </style>

        @yield('css')

        @php
            $defaultColor = '#de6600';
        @endphp

    </head>

    <body>

        <div id="wrapper">

            @include('layout.admin.navbar')

            @include('layout.admin.sidebar')

            {{-- @include('sweetalert::alert') --}}

            <div id="page-wrapper">

                @yield('content')

                @include('layout.admin.footer')
            </div>

            <!-- FOOT -->
        </div>
        <!-- /. WRAPPER  -->

        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src="{{ asset('assets/js/jquery-1.10.2.js') }}"></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <!-- METISMENU SCRIPTS -->
        <script src="{{ asset('assets/js/jquery.metisMenu.js') }}"></script>
        <!-- Bootstrap Editor Js -->
        <script src="{{ asset('assets/js/wysihtml5-0.3.0.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap-wysihtml5.js') }}"></script>
        <!-- Scrollbar Js -->
        <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
        <!-- Dropzone Js -->
        <script src="{{ asset('assets/js/dropzone.js') }}"></script>
        <!-- CUSTOM SCRIPTS -->
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <!-- JQUERY -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.js" integrity="sha512-6DC1eE3AWg1bgitkoaRM1lhY98PxbMIbhgYCGV107aZlyzzvaWCW1nJW2vDuYQm06hXrW0As6OGKcIaAVWnHJw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>

        <!-- FONTAWSOME -->
        {{--
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
        crossorigin="anonymous"></script> --}}
        {{--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-rq3yrAQH0gezS8fRwU6Q/0Z0DlnV7B4ALxP5F9X9DhSkvM8zAywRU/kZBkxzZBpY5o5P5xu6ws3aIF9fUJMB8A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
        {{--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-rq3yrAQH0gezS8fRwU6Q/0Z0DlnV7B4ALxP5F9X9DhSkvM8zAywRU/kZBkxzZBpY5o5P5xu6ws3aIF9fUJMB8A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- SWEET ALERT -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- fancybox -->
        <script src="{{ asset('assets_client/plugins/js/jquery.fancybox.js') }}"></script>

        {{-- Default color --}}

        <script>
            const defaultColor = '#de6600';
            // show notification
            const showNotification = ({
                message,
                icon,
                timer = 5000,
                title,
                timerProgressBar = true,
                confirmButtonText = 'OK',
                onConfirm = () => {},
            }) => {
                Swal.fire({
                    icon: icon,
                    title: title,
                    confirmButtonColor: 'green',
                    html: "<p style='font-size: 17px'>" + message + "</p>",
                    confirmButtonText: '<span style="font-size: 15px;">' + confirmButtonText + '</span>',
                    width: '40%',
                    timerProgressBar: timerProgressBar,
                    timer: timer,
                    confirmButtonColor: defaultColor,
                }).then((result) => {
                    if (result.isConfirmed) {
                        onConfirm();
                    }
                });
            }

            window.addEventListener('alert:modal', event => {
                alert(event.detail[0].message);
            });

            window.addEventListener('swal:modal', event => {
                const data = {
                    icon: event.detail[0].icon,
                    title: event.detail[0].title,
                    message: event.detail[0].message,
                };

                showNotification(data);
            });
        </script>

        @if (session()->has('success'))
            <script>
                console.log("{{ session()->get('success') }}");
                const data = {
                    icon: 'success',
                    title: 'Opération réussie',
                    message: "{{ session()->get('success') }}",
                    timer: 4000,
                };

                showNotification(data);
            </script>
        @endif

        @if (session()->has('error'))
            <script>
                const data = {
                    icon: 'error',
                    title: 'Oops...',
                    message: "{{ session()->get('error') }}",
                    timer: 4000,
                };

                showNotification(data);
            </script>
        @endif

        @if (session()->has('info'))
            <script>
                const data = {
                    icon: 'info',
                    title: 'Information',
                    message: "{{ session()->get('info') }}",
                    timer: 4000,
                };

                showNotification(data);
            </script>
        @endif

        <script>
            // Mettre une etoile pour les champs requis
            // $(document).ready(function() {
            //     $("label").each(function() {
            //         if ($(this).hasClass("required")) {
            //             $(this).append(' <b style="color: red; font-size: 100%;">*</b>');
            //         }
            //         $(this).append(' :');
            //     });
            // });
        </script>

        {{-- Datatable --}}
        <script>
            let headers = document.querySelectorAll("#example th");
            headers.forEach(header => {
                header.style.border = "1px solid black";
                header.style.backgroundColor = "lightblue";
            });
        </script>

        <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" rel="stylesheet" />

        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://unpkg.com/imask"></script>

        {{--
    <script>
        let elements = document.getElementsByClassName('telephone');
        let maskOptions = {
            mask: '00 00 00 00'
        };
        for (let i = 0; i < elements.length; i++) {
            let mask = IMask(elements[i], maskOptions);
        }
    </script> --}}

        <script>
            // take cpuntry name as parameter
            function applyMask(country = 'Togo') {
                $('.telephone').each(function() {
                    let maskOptions;

                    switch (country) {
                        case 'Togo':
                            maskOptions = {
                                mask: '00 00 00 00'
                            }; // Format for Togo
                            break;
                        default:
                            maskOptions = {
                                mask: '00 00 00 00'
                            }; // Default format (TOGO)
                    }

                    let mask = IMask(this, maskOptions);
                });
            }

            // Datatable
            const initDataTable = ({
                tableId = 'dataTable',
                url,
                columns,
                order = [0, "desc"],
            }) => {
                return $('#dataTable').DataTable({

                    order: [
                        [0, "desc"]
                    ],
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    pageLength: 25,
                    oLanguage: {
                        "sProcessing": "Traitement en cours...",
                        "sSearch": "Rechercher&nbsp;:",
                        "sLengthMenu": "Afficher _MENU_ éléments",
                        "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                        "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                        "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                        "sInfoPostFix": "",
                        "sLoadingRecords": "Chargement en cours...",
                        "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                        "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                        "oPaginate": {
                            "sFirst": "Premier",
                            "sPrevious": "Pr&eacute;c&eacute;dent",
                            "sNext": "Suivant",
                            "sLast": "Dernier"
                        },

                        "oAria": {
                            "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                            "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                        }
                    },
                    Processing: true,
                    serverSide: true,
                    ajax: {
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        data: function(d) {
                            d.page = d.start / d.length + 1;
                            d.search = d.search.value;
                            d.length = d.length;
                            return d;
                        },
                    },
                    columns: columns,
                });
            }

            // convert date to d-m-Y H:i:s format
            const formatDateToDMY = (inputDate) => {
                var date = new Date(inputDate);
                var day = ('0' + date.getDate()).slice(-2);
                var month = ('0' + (date.getMonth() + 1)).slice(-2);
                var year = date.getFullYear();
                var hours = ('0' + date.getHours()).slice(-2);
                var minutes = ('0' + date.getMinutes()).slice(-2);
                var seconds = ('0' + date.getSeconds()).slice(-2);
                var formattedDate = day + '-' + month + '-' + year + ' ' + hours + ':' + minutes + ':' + seconds;
                return formattedDate;
            }

            // show confirmation notification
            const showConfirmationNotification = ({
                message,
                icon = 'warning',
                confirmButtonText = 'Oui, je confirme',
                cancelButtonText = 'Annuler',
                onConfirm = () => {},
                onCancel = () => {},
                onDismiss = () => {},
            }) => {
                Swal.fire({
                    icon: icon,
                    title: 'Êtes-vous sûr ?',
                    showCancelButton: true,
                    confirmButtonColor: 'red',
                    cancelButtonColor: 'gray',
                    html: "<p style='font-size: 17px'>" + message + "</p>",
                    confirmButtonText: '<span style="font-size: 15px;">' + confirmButtonText + '</span>',
                    cancelButtonText: '<span style="font-size: 15px;">' + cancelButtonText + '</span>',
                    width: '40%',
                }).then((result) => {
                    if (result.isConfirmed) {
                        onConfirm();
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        onCancel();
                    } else {
                        onDismiss();
                    }
                });
            }
        </script>

        @livewireScripts

        @stack('scripts')

        @yield('js')

    </body>

</html>
