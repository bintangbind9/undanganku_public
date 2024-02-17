  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{asset('assets/js/stisla.js')}}"></script>

  <!-- JS Libraies -->
  <script src="{{asset('assets/stisla/datatables/media/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/stisla/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

  {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/js/mdb.min.js"></script> --}}
  <script src="{{asset('assets/stisla/datatables.net-select-bs4/js/select.bootstrap4.min.js')}}"></script>
  {{-- <script src="{{asset('assets/stisla/sweetalert/dist/sweetalert.min.js')}}"></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.16/dist/sweetalert2.min.js"></script>
  <script src="{{asset('assets/stisla/select2/dist/js/select2.full.min.js')}}"></script>
  <script src="{{asset('assets/stisla/summernote/summernote-bs4.js')}}"></script>
  {{-- <script src="{{asset('assets/js/page/modules-datatables.js')}}"></script> --}}
  <!-- Template JS File -->
  <script src="{{asset('assets/js/scripts.j')}}s"></script>
  <script src="{{asset('assets/js/custom.js')}}"></script>
  <script src="{{asset('assets/whatsapp_plugin/js/whatsapp-editor.js')}}"></script>

  <!-- Cropper -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>

  <!-- Custom Script -->
  @include('layouts.script_custom_format_date_time')
