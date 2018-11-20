 <!-- footer content -->
 <footer>
 	<div class="pull-center" align="center">
 		<strong>Copyrights &copy; 2018 - PIS. All Rights Reserved</strong>
 	</div>
 	<div class="clearfix"></div>
 </footer>
 <!-- /footer content -->
 <!-- jQuery -->
 {{-- <script src="{{asset("portal/vendors/jquery/dist/jquery.min.js")}}"></script> --}}
 <!-- Bootstrap -->

 <script src="{{asset("portal/vendors/bootstrap/dist/js/bootstrap.min.js")}}"></script>
 <!-- FastClick -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 <script src="{{asset("portal/vendors/fastclick/lib/fastclick.js")}}"></script>
 <!-- NProgress -->
 <script src="{{asset("portal/vendors/nprogress/nprogress.js")}}"></script>
 <!-- Chart.js -->
 <script src="{{asset("portal/vendors/Chart.js/dist/Chart.min.js")}}"></script>
 <!-- jQuery Sparklines -->
 <script src="{{asset("portal/vendors/jquery-sparkline/dist/jquery.sparkline.min.js")}}"></script>
 <!-- Flot -->
 <script src="{{asset("portal/vendors/Flot/jquery.flot.js")}}"></script>
 <script src="{{asset("portal/vendors/Flot/jquery.flot.pie.js")}}"></script>
 <script src="{{asset("portal/vendors/Flot/jquery.flot.time.js")}}"></script>
 <script src="{{asset("portal/vendors/Flot/jquery.flot.stack.js")}}"></script>
 <script src="{{asset("portal/vendors/Flot/jquery.flot.resize.js")}}"></script>
 <!-- Flot plugins -->
 <script src="{{asset("portal/vendors/flot.orderbars/js/jquery.flot.orderBars.js")}}"></script>
 <script src="{{asset("portal/vendors/flot-spline/js/jquery.flot.spline.min.js")}}"></script>
 <script src="{{asset("portal/vendors/flot.curvedlines/curvedLines.js")}}"></script>
 <!-- DateJS -->
 <script src="{{asset("portal/vendors/DateJS/build/date.js")}}"></script>
 <!-- bootstrap-daterangepicker -->
 <script src="{{asset("portal/vendors/moment/min/moment.min.js")}}"></script>
 <script src="{{asset("portal/vendors/bootstrap-daterangepicker/daterangepicker.js")}}"></script>

 <!-- Custom Theme Scripts -->
 <script src="{{asset("portal/build/js/custom.min.js")}}"></script>
 <script src="{{asset('portal/js/iziToast.js')}}"></script>
 <script src="{{asset('portal/js/iziwrapper.js')}}"></script>
 <script src="{{asset('portal/js/image.js')}}?{{md5(date('Y-m-d h:i:s'))}}"></script> 
 <script src="{{asset("portal/vendors/iCheck/icheck.min.js")}}"></script>
 <!-- Datatables -->
 <script src="{{asset("portal/vendors/datatables.net/js/jquery.dataTables.min.js")}}"></script>
 <script src="{{asset("portal/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>
 <script src="{{asset("portal/vendors/datatables.net-buttons/js/dataTables.buttons.min.js")}}"></script>
 <script src="{{asset("portal/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js")}}"></script>
 {{-- <script src="{{asset("portal/vendors/datatables.net-buttons/js/buttons.flash.min.js")}}"></script>
 --}}<script src="{{asset("portal/vendors/datatables.net-buttons/js/buttons.html5.min.js")}}"></script>
 <script src="{{asset("portal/vendors/datatables.net-buttons/js/buttons.print.min.js")}}"></script>
 <script src="{{asset("portal/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js")}}"></script>
 <script src="{{asset("portal/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js")}}"></script>
 <script src="{{asset("portal/vendors/datatables.net-responsive/js/dataTables.responsive.min.js")}}"></script>
 <script src="{{asset("portal/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js")}}"></script>
 <script src="{{asset("portal/vendors/datatables.net-scroller/js/dataTables.scroller.min.js")}}"></script>
 <script src="{{asset("portal/vendors/jszip/dist/jszip.min.js")}}"></script>
 <script src="{{asset("portal/vendors/pdfmake/build/pdfmake.min.js")}}"></script>
 <script src="{{asset("portal/vendors/pdfmake/build/vfs_fonts.js")}}"></script>
 <script src="{{asset("portal/vendors/validator/validator.js")}}"></script>
 <script src="{{asset("portal/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js")}}"></script>
 <script src="{{asset("portal/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js")}}">
 	
 </script>
 <!-- jQuery library -->

  <script src="{{asset('chosen/chosen.jquery.js')}}"></script>

    <script type="text/javascript">
      $('.chosen-select').chosen({ width: '100%', no_results_text: "Oops, No result matches your input:", height:'100%'});
    </script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
  $('#datatable').DataTable();
</script>
 @stack('scripts')
 