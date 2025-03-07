</body>
<footer class="footer">
    <div class="footer-bottom">
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright-text">
                            <p class="mb-0">&copy; {{ date('Y') }} RAHAT IT Solutions. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>

{{-- <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> --}}
<script src="{{ asset('js/agent/jquery-3.7.1.min.js') }}"></script>

<script src="{{ asset('js/agent/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('js/agent/jquery.waypoints.js') }}"></script>
<script src="{{ asset('js/agent/jquery.counterup.min.js') }}"></script>

<script src="{{ asset('js/agent/plugins/select2/js/select2.min.js') }}"></script>

<script src="{{ asset('js/agent/owl.carousel.min.js') }}"></script>

<script src="{{ asset('js/agent/plugins/slick/slick.js') }}"></script>

<script src="{{ asset('js/agent/plugins/aos/aos.js') }}"></script>

<script src="{{ asset('js/agent/script.js') }}"></script>

<script src="{{ asset('js/agent/summernote.js') }}"></script>

{{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script> --}}
{{-- <script src="../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
    data-cf-settings="d46bb2d3dcd0b68c6f6ac766-|49" defer></script> --}}
@livewireScripts
<x-livewire-alert::scripts />
@stack('extra_js')
<script>
function isNumeric(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
}
</script>


</html>
