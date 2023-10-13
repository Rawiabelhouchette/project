<!DOCTYPE html>
<html class="no-js') }}" lang="zxx">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Best Responsive job portal template build on Latest Bootstrap.">
		<meta name="keywords" content="job, nob board, job portal, job listing">
		<meta name="robots" content="index,follow">

		<title>ANNONCE</title>
		
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

		<link href="{{ asset('assets/css/perso.css') }}" rel="stylesheet" />

        <!-- DATATABLE -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">

        <style>
            #map { height: 160px; }
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
                        background-color: #e0e0e0;
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

        @yield('css')

	</head>
	<body>
		  
		<div id="wrapper">

            @include('layout.navbar')

            @include('layout.sidebar')

            {{-- @include('sweetalert::alert') --}}

			<div id="page-wrapper" >

                @yield('content')
                                
                <!-- /. PAGE WRAPPER  -->

                <footer class="main-footer">
                    <div class="row">
                        <div class="col-md-6" style="text-align: left !important;">
                            <strong>©Copyright 2023 Numrod.</strong>Tous droits réservés.
                        </div>
                        <div class="col-md-6" style="text-align: right !important;">
                            <strong>Version Janvier 2023</strong>
                        </div>
                    </div>
                </footer>
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
        {{-- <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script> --}}
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-rq3yrAQH0gezS8fRwU6Q/0Z0DlnV7B4ALxP5F9X9DhSkvM8zAywRU/kZBkxzZBpY5o5P5xu6ws3aIF9fUJMB8A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-rq3yrAQH0gezS8fRwU6Q/0Z0DlnV7B4ALxP5F9X9DhSkvM8zAywRU/kZBkxzZBpY5o5P5xu6ws3aIF9fUJMB8A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


		<!-- SWEET ALERT -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Opération réussie',
                timerProgressBar: true,
                confirmButtonText: '<span style="font-size: 15px;">OK</span>',
                timer: 4000,
                width: '40%',
                height: '40%',
                html: "<p style='font-size: 17px'>{{ session()->get('success') }}</p>",
            });

        </script>
        @endif

        @if (session()->has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                timerProgressBar: true,
                confirmButtonText: '<span style="font-size: 15px;">OK</span>',
                timer: 5000,
                width: '40%',
                height: '40%',
                html: "<p style='font-size: 17px'>{{ session()->get('error') }}</p>",
            });
        </script>
        @endif

        @if (session()->has('info'))
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Information',
                timerProgressBar: true,
                confirmButtonText: '<span style="font-size: 15px;">OK</span>',
                timer: 5000,
                width: '40%',
                height: '40%',
                html: "<p style='font-size: 17px'>{{ session()->get('info') }}</p>",
            });
        </script>
        @endif

        <script>
            // Mettre une etoile pour les champs requis
            $(document).ready(function(){
                $("label").each(function() {
                    if ($(this).hasClass("required")) {
                        $(this).append(' <b style="color: red; font-size: 100%;">*</b>');
                    }
                    $(this).append(' :');
                });
            });
        </script>


        {{-- Datatable --}}
        <script>
            let headers = document.querySelectorAll("#example th");
            headers.forEach(header => {
                header.style.border = "1px solid black";
                header.style.backgroundColor = "lightblue";
            });
        </script>
        <script>
            // $(document).ready(function() {
            //     $('#example').DataTable({
            //         "order": [
            //             [0, "desc"]
            //         ],
            //         "pageLength": 50,
            //         searching: false,
            //         "lengthChange": false,
            //         //"scrollY": "2000px",
            //         "scrollCollapse": true,
            //         fixedHeader: {
            //             header: true,
            //             footer: true,
            //             offsetTop: 5000
            //         },
    
    
            //         "oLanguage": {
    
            //             "sProcessing": "Traitement en cours...",
            //             "sSearch": "Rechercher&nbsp;:",
            //             "sLengthMenu": "Afficher _MENU_",
            //             "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            //             "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
            //             "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            //             "sInfoPostFix": "",
            //             "sLoadingRecords": "Chargement en cours...",
            //             "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
            //             "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            //             "oPaginate": {
            //                 "sFirst": "Premier",
            //                 "sPrevious": "Pr&eacute;c&eacute;dent",
            //                 "sNext": "Suivant",
            //                 "sLast": "Dernier"
            //             },
    
            //             "oAria": {
            //                 "sSortAscending": ": activer pour trier la colonne par ordre croissant",
            //                 "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
            //             }
            //         }
    
            //     });
            // });


            // var pagination = $('#example_paginate');

            // pagination.css({
            // 'position': 'fixed',
            // 'bottom': '0',
            // 'left': '0',
            // 'right': '0',
            // 'background-color': '#fff',
            // 'z-index': '999',
            // 'padding': '10px'
            // });
        </script>


        @yield('js')

	</body>
</html>