<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap/bootstrap.min.js') }}"></script>
{{-- <script src="{{ URL::asset('assets/libs/bootstrap/bootstrap.bundle.min.js') }}"></script> --}}
<script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/node-waves/node-waves.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/feather-icons/feather-icons.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/plugins/lord-icon-2.1.0.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugins.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/assets/js/common.js') }}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script src="{{ URL::asset('assets/libs/dataTables/dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/libs/dataTables/dataTables.bootstrap5.js') }}"></script>
<!-- prismjs plugin -->
{{-- <script src="{{ URL::asset('assets/libs/prismjs/prismjs.min.js') }}"></script> --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script type="text/javascript" src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script> --}}
@yield('script')
@yield('script-bottom')
