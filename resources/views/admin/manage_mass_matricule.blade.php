<div class="container-fluid">
	
	<form action="" id="manage-matricule">
       
		<input type="hidden" name="matricule" value="<?= isset($matricule) ? $matricule->id : '' ?>">
		<div class="form-group">
			<label for="name">Matricule</label>
			<textarea cols="40" rows="7"  name="matricule" id="<?= isset($matricule) ? $matricule->id : '' ?>" class="form-control"  required></textarea>
		</div>


        @csrf

		<div class="form-group">
			<label for="classe">Classe</label>
			<select name="classe" id="classe" class="custom-select">
             @foreach ($classes as $classe)
				<option value="{{ $classe->name }}" <?= isset($matricule->classe) && $matricule->classe == $classe->name ? 'selected': '' ?>>{{ $classe->name }}</option>
            @endforeach
                
			</select>
		</div>
	</form>
</div>
<script>
	$('#manage-matricule').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
            url:'<?= route("matricule_manager", "mass-save") ?>',
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