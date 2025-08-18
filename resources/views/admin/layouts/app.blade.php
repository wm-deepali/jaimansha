<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminpannel/adminlte/plugins/fontawesome-free/css/all.min.css') }}">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('adminpannel/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('adminpannel/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('adminpannel/adminlte/plugins/jqvmap/jqvmap.min.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminpannel/adminlte/dist/css/adminlte.min.css') }}">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('adminpannel/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminpannel/adminlte/plugins/daterangepicker/daterangepicker.css') }}">

  <!-- Summernote -->
  <link rel="stylesheet" href="{{ asset('adminpannel/adminlte/plugins/summernote/summernote-bs4.min.css') }}">

  <!-- Bootstrap (optional CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    #ajax-loader {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        z-index: 9999;
        transform: translate(-50%, -50%);
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     @include('admin.layouts.nav-top')
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
     @include('admin.layouts.side-nav')
  </aside>

  <!-- Page Content -->
  <div class="content-wrapper">
    @yield('content')
  </div>

  <!-- Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<!-- Scripts -->
<script src="{{ asset('adminpannel/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminpannel/adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="{{ asset('adminpannel/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminpannel/adminlte/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('adminpannel/adminlte/plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('adminpannel/adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('adminpannel/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('adminpannel/adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('adminpannel/adminlte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('adminpannel/adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('adminpannel/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('adminpannel/adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('adminpannel/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('adminpannel/adminlte/dist/js/adminlte.js') }}"></script>

<!-- Bootstrap bundle (optional CDN) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  function initSummernote() {
      $('textarea.rich-editor').each(function () {
          if (!$(this).hasClass('summernote-initialized')) {
              $(this).summernote({
                  height: 200,
                  toolbar: [
                      ['style', ['bold', 'italic', 'underline', 'clear']],
                      ['font', ['strikethrough', 'superscript', 'subscript']],
                      ['para', ['ul', 'ol', 'paragraph']],
                      ['insert', ['link', 'picture', 'video']],
                      ['view', ['codeview']]
                  ]
              });
              $(this).addClass('summernote-initialized');
          }
      });
  }

  $(document).ready(function () {
      // Sidebar nav ajax loader
      $('.nav-link').on('click', function (e) {
          const url = $(this).attr('href');
          if (!url || url === '#' || url.startsWith('http')) return;

          e.preventDefault();
          $('.nav-link').removeClass('active');
          $(this).addClass('active');

          $('#ajax-loader').fadeIn();

          $.ajax({
              url: url,
              type: 'GET',
              dataType: 'html',
              success: function (data) {
                  const content = $(data).find('.content').html();
                  $('.content-wrapper').html('<section class="content">' + content + '</section>');

                  // ✅ Initialize summernote in the newly loaded content
                  initSummernote();

                  window.history.pushState({}, '', url);
              },
              error: function () {
                  alert('Failed to load page.');
              },
              complete: function () {
                  $('#ajax-loader').fadeOut();
              }
          });
      });

      // For back/forward browser button
      window.onpopstate = function () {
          location.reload();
      };

      // ✅ Initial load editor
      initSummernote();

      // ✅ On modal open
      $('.modal').on('shown.bs.modal', function () {
          initSummernote();
      });
  });
</script>


</body>
</html>
