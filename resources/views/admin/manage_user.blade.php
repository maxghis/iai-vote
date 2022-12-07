<div class="container-fluid">
	
	<form action="" id="manage-user">
       
		<input type="hidden" name="id" value="<?= isset($user) ? $user->id : '' ?>">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" class="form-control" value="<?= isset($user) ? $user->name : '' ?>" required>
		</div>

		<div class="form-group">
			<label for="name">Matricule</label>
			<input type="text" name="matricule" id="matricule" class="form-control" value="<?= isset($user) ? $user->matricule : '' ?>" required>
		</div>

        @csrf

        <div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" id="email" class="form-control" value="<?= isset($user) ? $user->email : '' ?>" required>
		</div>

		<div class="form-group">
			<label for="type">User Type</label>
			<select name="type" id="type" class="custom-select">
				<option value="2" <?= isset($user->type) && $user->type == 2 ? 'selected': '' ?>>User</option>
                <option value="1" <?= isset($user->type) && $user->type == 1 ? 'selected': '' ?>>Admin</option>
			</select>
		</div>
	</form>
</div>
<script>
	$('#manage-user').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
            url:'<?= route("user_manager", "save") ?>',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}

                if(resp ==2){
					alert_toast("Data Updated successfully",'success')
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