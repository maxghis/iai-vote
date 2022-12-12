<div id="preloader"></div>
<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<div class="modal fade" id="confirm_modal" role='dialog'>
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title">Confirmation</h5>
    </div>
    <div class="modal-body">
      <div id="delete_content"></div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
    </div>
  </div>
</div>
<div class="modal fade" id="uni_modal" role='dialog'>
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title"></h5>
    </div>
    <div class="modal-body">
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    </div>
    </div>
  </div>
</div>
</body>
<script>
   window.start_load = function(){
  $('body').prepend('<di id="preloader2"></di>')
}
window.end_load = function(){
  $('#preloader2').fadeOut('fast', function() {
      $(this).remove();
    })
}

window.uni_modal = function($title = '' , $url=''){
  start_load()
  $.ajax({
      url:$url,
      error:err=>{
          console.log()
          alert("An error occured")
      },
      success:function(resp){
          if(resp){
              $('#uni_modal .modal-title').html($title)
              $('#uni_modal .modal-body').html(resp)
              $('#uni_modal').modal('show')
              end_load()
          }
      }
  })
}
window._conf = function($msg='',$func='',$params = []){
   $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
   $('#confirm_modal .modal-body').html($msg)
   $('#confirm_modal').modal('show')
}
 window.alert_toast= function($msg = 'TEST',$bg = 'success'){
    $('#alert_toast').removeClass('bg-success')
    $('#alert_toast').removeClass('bg-danger')
    $('#alert_toast').removeClass('bg-info')
    $('#alert_toast').removeClass('bg-danger')

  if($bg == 'success')
    $('#alert_toast').addClass('bg-success')
  if($bg == 'danger')
    $('#alert_toast').addClass('bg-danger')
  if($bg == 'info')
    $('#alert_toast').addClass('bg-info')
  if($bg == 'danger')
    $('#alert_toast').addClass('bg-danger')
  $('#alert_toast .toast-body').html($msg)
  $('#alert_toast').toast({delay:1000000000}).toast('show');
}
$(document).ready(function(){
  $('#preloader').fadeOut('fast', function() {
      $(this).remove();
    })
})


$(document).ready(function(){
  $('.closoast').on('click', function() {
    $('#alert_toast').toast('hide');
    })
})
$(document).ready(function(){
  $('.mainuu').on('click', function() {
    $('.tab').toggle();
    })
})
</script>	