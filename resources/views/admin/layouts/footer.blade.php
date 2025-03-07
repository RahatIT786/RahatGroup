<footer class="main-footer">
    <div class="footer-right">
        Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Softech Solutions
    </div>
    {{-- <div class="footer-right">

    </div> --}}
</footer>
</div>
</div>

<!-- General JS Scripts -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.js') }}"></script>
<script src="{{ asset('js/tooltip.js') }}"></script>
<script data-navigate-once src="{{ asset('css/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('css/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/stisla.js') }}"></script>

<!-- JS Libraies -->
<script src="{{ asset('js/daterangepicker.js') }}"></script>
<script src="{{ asset('js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('js/summernote-bs4.js') }}"></script>
{{-- <script src="assets/modules/simple-weather/jquery.simpleWeather.min.js"></script>
<script src="assets/modules/chart.min.js"></script>
<script src="assets/modules/jqvmap/dist/jquery.vmap.min.js"></script>
<script src="assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="assets/modules/summernote/summernote-bs4.js"></script>--}}
<script src="{{ asset('js/jquery.chocolat.min.js')}}"></script> 
<!-- Page Specific JS File -->
{{-- <script src="assets/js/page/index-0.js"></script> --}}

<!-- Select 2 JS File -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-Single').select2();
    });
</script>


<!-- Template JS File -->
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>



@livewireScripts
<x-livewire-alert::scripts />

@stack('extra_js')

</body>

</html>
