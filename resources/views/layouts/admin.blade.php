
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ trans('panel.logo_only') }}">
  <link rel="icon" type="image/png" href="{{ trans('panel.logo_only') }}">
  <title>
    @yield('sub-title') | {{ trans('panel.site_title') }}
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('/assets_v1/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('/assets_v1/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://use.fontawesome.com/5882f93e19.js"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('/assets_v1/icons/css/fontawesome.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/assets_v1/icons/css/solid.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/assets_v1/icons/css/all.css') }}">

  <link href="{{ asset('/assets_v1/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('/assets_v1/css/argon-dashboard.css?v=2.0.0') }}" rel="stylesheet" />

  <!-- JQUERY CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />

  <!-- datatables -->
  <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
  
  <style>
    .select2-container--default .select2-selection--single {
    background-color: #fff;
    border-radius: 4px;
    height: auto;
    }
    .modal-backdrop
    {
        opacity:0.5 !important;
    }

    
  </style>
  @yield('style') 
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  @yield('sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
        @yield('navbar')
    <!-- End Navbar -->
    @yield('content')
  </main>
  <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
  </form>

  @yield('rightbar')
 
  <!--   Core JS Files   -->
  <script src="{{ asset('/assets_v1/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('/assets_v1/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/assets_v1/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('/assets_v1/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('/assets_v1/js/plugins/chartjs.min.js') }}"></script>

  <!--   JQUERY JS Files   -->
  <script src="{{ asset('/assets_v1/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('/assets_v1/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('/assets_v1/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('/assets_v1/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('/assets_v1/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('/assets_v1/js/argon-dashboard.min.js?v=2.0.0') }}"></script>


  <!-- datatables -->
  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
  <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
  <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>

  <script>
        $(function() {
            let copyButtonTrans = 'COPY'
            let csvButtonTrans = 'EXCEL'
            let excelButtonTrans = 'EXCEL'
            let pdfButtonTrans = 'PDF'
            let printButtonTrans = 'PRINT'
            let colvisButtonTrans = 'VIEW'

            let languages = {
            'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
            };

            $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn btn-sm m-2 btn-primary' })
            $.extend(true, $.fn.dataTable.defaults, {
            language: {
                url: languages['{{ app()->getLocale() }}']
            },
            
            order: [],
            scrollX: true,
            pageLength: 100,
            dom: 'lBfrtip<"actions">',
            buttons: [
                
                {
                extend: 'csv',
                className: 'btn-primary btn-sm mt-1 mb-1',
                text: csvButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
                },
                {
                extend: 'excel',
                className: 'btn-primary btn-sm mt-1 mb-1',
                text: excelButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
                },
                {
                    extend: 'print',
                    className: 'btn-primary btn-sm mt-1 mb-1',
                    titleAttr: 'Click this print',
                    text: printButtonTrans,
                    exportOptions: {
                    columns: ':visible'
                    },

                },
                {
                extend: 'colvis',
                className: 'btn-primary btn-sm mt-1 mb-1',
                text: colvisButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
                
                }
            ]
            });
            $.fn.dataTable.ext.classes.sPageButton = '';
        });
    </script>

  @yield('script') 
</body>

</html>