<!-- jQuery -->
<script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('template/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('template/fastclick/lib/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ asset('template/nprogress/nprogress.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('template/iCheck/icheck.min.js') }}"></script>
<!-- Datatables -->
<script src="{{ asset('template/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script src="{{ asset('template/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>

<script src="{{ asset('template/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('template/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<script src="https://cdn.datatables.net/scroller/1.4.2/js/dataTables.scroller.min.js"></script>
<script src="{{ asset('template/jszip/dist/jszip.min.js') }}"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('template/js/custom.min.js') }}"></script>
<script src="{{ asset('template/sweetalert/sweetalert.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

<script>
    $(document).ready(function() {
      $('.date').datepicker({});

      $(".number").on("keypress keyup blur",function (event) {    
           $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                $(".error").css("display", "inline");
                event.preventDefault();
            }else{
            	$(".error").css("display", "none");
            }
        });

        $('.disabled').keypress(function(e) {
            return false
        });

        $('.noSpace').keydown(function(event) {
          if (event.keyCode == '32') {
             event.preventDefault();
           }
        });

        $(".decimalOnly").keydown(function (event) {
            if (event.shiftKey == true) {
                event.preventDefault();
            }

            if ((event.keyCode >= 48 && event.keyCode <= 57) || 
                (event.keyCode >= 96 && event.keyCode <= 105) || 
                event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
                event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

            } else {
                event.preventDefault();
            }

            if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
                event.preventDefault(); 
            //if a decimal has been added, disable the "."-button

        });
    });
</script>