<!-- Essential javascripts for application to work-->
<script src="{{ asset('../js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('../js/popper.min.js') }}"></script>
<script src="{{ asset('../js/bootstrap.min.js') }}"></script>
<script src="{{ asset('../js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('../js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('../js/bootstrap-datepicker.es.js') }}" charset="UTF-8"></script>
<script src="{{ asset('../js/gijgo.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('../js/main.js') }}"></script>
<script src="{{ asset('../js/select2.min.js')}}"></script>

<!-- The javascript plugin to display page loading on top-->
<script src="{{ asset('js/plugins/pace.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script type="text/javascript">
    // Login Page Flipbox control
    $('.login-content [data-toggle="flip"]').click(function() {
        $('.login-box').toggleClass('flipped');
        return false;
    });
</script>

@livewireScripts
