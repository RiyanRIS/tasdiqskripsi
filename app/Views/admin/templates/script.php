
<!-- jQuery -->
<script src="<?=site_url('assets/')?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=site_url('assets/')?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?=site_url('assets/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=site_url('assets/')?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?=site_url('assets/')?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=site_url('assets/')?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=site_url('assets/')?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=site_url('assets/')?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=site_url('assets/')?>dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=site_url('assets/')?>dist/js/demo.js"></script>

<script>

$(function(){
  var pathArray = window.location.pathname.split('/');
  var current = pathArray[2] ?? "dashboard";

  $('#nav li a').each(function(){
      var $this = $(this);
      // if the current path is like this link, make it active
      if($this.attr('data-nav') == current){
        $this.addClass('active');
      }
  })

  $('#datatable').DataTable();
})
</script>