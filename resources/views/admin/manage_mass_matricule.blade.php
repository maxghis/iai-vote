<div class="container-fluid">
	
	<form action="" id="manage-matricule" enctype="multipart/form-data">
       
		<input type="hidden" name="matricule" value="<?= isset($matricule) ? $matricule->id : '' ?>">
		<div class="form-group">
			<label for="name">Fichers excel Matricules</label>
			<input type="file" name="fichier" id="<?= isset($matricule) ? $matricule->id : '' ?>" class="form-control"  required />
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
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
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