<div class="container-fluid">
	
	<form action="" id="manage-user" enctype="multipart/form-data">
       
		<input type="hidden" name="id" value="<?= isset($user) ? $user->id : '' ?>">
		<div class="form-group">
			<label for="name">Candidate Name</label>
			<input type="text" name="name" id="name" class="form-control" value="<?= isset($user) ? $user->name : '' ?>" required>
		</div>

		
        @csrf
      @isset($user)
		<div class="form-group">
			<label for="type">Category </label>
			<select name="type" id="type" class="custom-select">
				@foreach ($categories as $category)
                <option value="{{ $category->id }}" <?=  $category->id == $user->cathegory_id ? 'selected': '' ?>>{{ $category->cat }}</option>
                @endforeach
			</select>
		</div>

        @else
        <div class="form-group">
			<label for="type">Category </label>
			<select name="type" id="type" class="custom-select">
				@foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->cat }}</option>
                @endforeach
			</select>
		</div>

        @endisset 


		@isset($user)
		<div class="form-group">
			<label for="type">Classe </label>
			<select name="classe" id="classe" class="custom-select">
				@foreach ($classes as $classe)
                <option value="{{ $classe->name }}" <?=  $classe->name == $user->classe ? 'selected': '' ?>>{{ $classe->name }}</option>
                @endforeach
			</select>
		</div>

        @else
        <div class="form-group">
			<label for="classe">Classe </label>
			<select name="classe" id="classe" class="custom-select">
				@foreach ($classes as $classe)
                <option value="{{ $classe->name }}">{{ $classe->name }}</option>
                @endforeach
			</select>
		</div>

        @endisset 

        <div class="form-group">
            <label for="" class="control-label">Desciption</label>
            <textarea name="description" id="" cols="30" rows="5"><?= isset($user) ? $user->description : '' ?></textarea>
        </div>

        <div class="form-group">
            <label for="" class="control-label">Image Profil</label>
            <input type="file" accept="image/*" class="form-control" name="imgp">
        </div>

        <div class="form-group">
            <label for="" class="control-label">Image Campagne</label>
            <input type="file" accept="image/*" class="form-control" name="imgc">
        </div>

        <div class="form-group">
            <label for="" class="control-label">Video Campagne</label>
            <input type="file" accept="video/*" class="form-control" name="videoc">
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