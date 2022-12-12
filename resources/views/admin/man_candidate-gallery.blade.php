<div class="container-fluid">
	
	<form action="" id="manage-user" enctype="multipart/form-data">
       
		<input type="hidden" name="id" value="<?= isset($user) ? $user->id : '' ?>">
        <input type="hidden" name="gal" value="<?= isset($user) ? $user->id : '' ?>">
		
        @csrf

        <div class="form-group">
            <label for="" class="control-label">Image Gallery 1</label>
            <input type="file" accept="image/*" class="form-control" name="img1">
        </div>

		<div class="form-group">
            <label for="" class="control-label">Image Gallery 2</label>
            <input type="file" accept="image/*" class="form-control" name="img2">
        </div>

		<div class="form-group">
            <label for="" class="control-label">Image Gallery 3</label>
            <input type="file" accept="image/*" class="form-control" name="img3">
        </div>

		<div class="form-group">
            <label for="" class="control-label">Image Gallery 4</label>
            <input type="file" accept="image/*" class="form-control" name="img4">
        </div>

		<div class="form-group">
            <label for="" class="control-label">Image Gallery 5</label>
            <input type="file" accept="image/*" class="form-control" name="img5">
        </div>

		<div class="form-group">
            <label for="" class="control-label">Image Gallery 6</label>
            <input type="file" accept="image/*" class="form-control" name="img6">
        </div>


		<div class="form-group">
            <label for="" class="control-label">Image Gallery 7</label>
            <input type="file" accept="image/*" class="form-control" name="img7">
        </div>


		<div class="form-group">
            <label for="" class="control-label">Image Gallery 8</label>
            <input type="file" accept="image/*" class="form-control" name="img8">
        </div>

		<div class="form-group">
            <label for="" class="control-label">Image Gallery 9</label>
            <input type="file" accept="image/*" class="form-control" name="img9">
        </div>

		<div class="form-group">
            <label for="" class="control-label">Image Gallery 10</label>
            <input type="file" accept="image/*" class="form-control" name="img10">
        </div>


  

	</form>
</div>

<script>
	function displayImg(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        	$('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$('#manage-user').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'<?= route("candidate_manager", "save") ?>',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved.','success')
					setTimeout(function(){
						location.reload()
					},1500)
				}else if(resp == 2){
					alert_toast('Data successfully updated.','success')
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