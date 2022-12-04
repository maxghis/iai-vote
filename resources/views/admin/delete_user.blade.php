<div class="container-fluid">
	<h3>Are You shure that you want to delete this user ?</h3>
	<form action="" id="manage-user">
       
		<input type="hidden" name="id" value="<?= isset($user) ? $user->id : '' ?>">
        @csrf
	</form>
</div>
<script>
	$('#manage-user').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
            url:'<?= route("user_manager", "delete") ?>',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully delete",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
                else{
                    alert_toast("some error occured",'success')
					setTimeout(function(){
						location.reload()
					},1500)
                }

			},
            error:function(xhr, ajaxOptions, thrownError){
                alert_toast(xhr.responseText,'success', 10000)

                end_load();
                
                
            }
            
		})
	})
</script>