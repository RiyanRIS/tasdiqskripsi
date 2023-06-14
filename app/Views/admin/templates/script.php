
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
<!-- Notifications Plugin -->
<script src="<?=site_url('assets/')?>plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=site_url('assets/')?>dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?=site_url('assets/')?>dist/js/demo.js"></script> -->

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

  <?php if(session()->has('msg')){
  if(session()->get('msg')[0] == 1){ ?>
      toastr.success("<?= session()->get('msg')[1] ?>", 'Berhasil');
  <?php }elseif(session()->get('msg')[0] == 0){ ?>
      toastr.error("<?= session()->get('msg')[1] ?>", 'Gagal');
  <?php }
  } ?>

  $('#datatable').DataTable()

  $('#myForm, #myForm1, #myForm2, #myForm3').submit(function(e){
    e.preventDefault()
    var dataToSend  = new FormData(this)
    var formId = $(this)
    var formIdN = $(this).closest("form").attr('id')
    var submit = $(this).closest('form').find(':submit')
    var action = $(formId).attr('action')
    var url = $(formId).attr('data-url')
    var refresh = $(formId).attr('data-refresh')

		$('#modalnya .modal-footer #submit').prop('disabled', true)
		submit.prop('disabled', true)
    $.ajax({
      url      : url,
      dataType : 'json',
      type     : 'post',
      data     : dataToSend,
      processData :false,
      contentType :false,
      cache       :false,
      beforeSend: async function(){
        $('#loading').show()
        $( '#'+formIdN+' .card').append("<div class='overlay'><i class='fas fa-2x fa-sync-alt'></i></div>")
        await new Promise(r => setTimeout(r, 500))
      },
      complete:function(){
        $('#loading').hide()
        $('.overlay').remove()
        // $('#modalnya .modal-footer #submit').prop('disabled', false)
    		// submit.prop('disabled', false)
      },
			error:function(){
        toastr.error("Terjadi Kesalahan Pada Server!", "Error");
      },
      success : async function(data){
        // console.log(data)
        $('.invalid-feedback').remove()
        $('.is-invalid').removeClass('is-invalid');

        if(typeof(data.file) != "undefined" && data.file !== null){
          if(data.file == false){
            $.each(data.error_file, function(key, value){
              $('#'+key).addClass('is-invalid')
              $('#notifikasi_'+key).append(`<div class="invalid-feedback">`+value+`</div>`)
            })
          }else{
            $.each(data.error_file, function(key, value){
              $('#'+key).removeClass('is-invalid')
              $('#notifikasi_'+key).append('')
            })
          }
        } else {
          if(data.status){
            toastr.success("Berhasil Memperbarui Data", "Berhasil");
            if(refresh == 'refresh'){
              await new Promise(r => setTimeout(r, 1000))
              window.location.replace(data.url)
            }
          }else{
            if(data.errors){
              $.each(data.errors, function(key, value){
                $('#'+key).addClass('is-invalid')
                $('#notifikasi_'+key).append(`<div class="invalid-feedback">`+value+`</div>`)
              })
            }
            $('html,body').animate({scrollTop: $('body').offset().top},'fast');
          }
        }

        $('#modalnya .modal-footer #submit').prop('disabled', false)
        submit.prop('disabled', false)
      }
    })
  })
})
</script>