<!-- content-wrapper ends -->

<!-- partial:./partials/_footer.html -->

<footer class="footer">

    <div class="card">

        <div class="card-body">

            <div class="d-sm-flex justify-content-center justify-content-sm-between">

                {{-- <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Made with

                    <i class="mdi mdi-heart" style="color: red"></i> by Converthink Solutions</span> --}}

                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright

                    © All Rights Reserved {{ date('Y') }} , Softech Solutions</span>

            </div>

        </div>

    </div>

</footer>

<!-- partial -->

</div>

<!-- main-panel ends -->

</div>

<!-- page-body-wrapper ends -->

</div>

<!-- container-scroller -->



<!-- base:js -->

<script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>

<!-- endinject -->

<!-- Plugin js for this page-->

<script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>

<!-- End plugin js for this page-->

<!-- inject:js -->

<script src="{{ asset('js/staff/off-canvas.js') }}"></script>

<script src="{{ asset('js/staff/hoverable-collapse.js') }}"></script>

<script src="{{ asset('js/staff/file-upload.js') }}"></script>

<!-- endinject -->

<!-- plugin js for this page -->

<!-- End plugin js for this page -->

<!-- Custom js for this page-->

<script src="{{ asset('js/staff/dashboard.js') }}"></script>



<!-- End custom js for this page-->

@livewireScripts
<x-livewire-alert::scripts />
@stack('extra_js')

</body>



</html>

