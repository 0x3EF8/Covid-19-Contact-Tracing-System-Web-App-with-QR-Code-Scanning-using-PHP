<?php 
require_once('../../config.php');
if(isset($_GET['id']) && !empty($_GET['id'])){
	$qry = $conn->query("SELECT * FROM establishment where id = {$_GET['id']}");
	foreach($qry->fetch_array() as $k => $v){
		if(!is_numeric($k)){
			$$k = $v;
		}
	}
}
?>
<form action="" id="establishment-frm">
	<div id="msg" class="form-group"></div>
	<input type="hidden" name='id' value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
	<div class="form-group">
		<label for="name" class="control-label">Name</label>
		<input type="text" class="form-control form-control-sm" name="name" id="name" value="<?php echo isset($name) ? $name : '' ?>" required>
	</div>
	<div class="form-group">
		<label for="address" class="control-label">Address</label>
		<textarea type="text" class="form-control form-control-sm" name="address" id="address" required ><?php echo isset($address) ? $address : '' ?></textarea>
	</div>
	<div class="form-group">
		<label for="city_id" class="control-label">City/State</label>
		<select name="city_id" id="city_id" class="custom-select custom-select-sm select2" required>
			<option value=""></option>
			<?php 
			$city = $conn->query("SELECT c.*,s.name as sname FROM city_list c inner join state_list s on c.state_id=s.id order by c.name asc");
			while($row=$city->fetch_assoc()):
			?>
			<option value="<?php echo $row['id'] ?>" <?php echo isset($city_id) && $city_id == $row['id'] ? "selected" : '' ?>><?php echo ucwords($row['name'].' City, '.$row['sname']) ?></option>
			<?php endwhile; ?>
		</select>
	</div>
	<div class="form-group">
		<label for="zone_id" class="control-label">Barangay/Zone</label>
		<select name="zone_id" id="zone_id" class="custom-select custom-select-sm" required>
			<option value=""></option>
			<?php 
			$zone = $conn->query("SELECT * FROM barangay_list  order by name asc");
			while($row=$zone->fetch_assoc()):
			?>
			<option style="display: none" data-city="<?php echo $row['city_id'] ?>" value="<?php echo $row['id'] ?>" <?php echo isset($zone_id) && $zone_id == $row['id'] ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
			<?php endwhile; ?>
		</select>
	</div>
	<div class="form-group">
		<label for="" class="control-label">Image</label>
		<div class="custom-file">
          <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))">
          <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
	</div>
	<div class="form-group d-flex justify-content-center">
		<img src="<?php echo validate_image(isset($image_path) ? $image_path : '') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
	</div>
</form>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
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
	$(document).ready(function(){
		$('.select2').select2();
		$('#city_id').change(function(){
			var id = $(this).val();
			console.log($('#zone_id').find("[data-city='"+id+"']").length)
			$('#zone_id').find("[data-city='"+id+"']").show()
		$('#zone_id').select2();
		})
		$('#establishment-frm').submit(function(e){
			e.preventDefault()
			start_loader()
			if($('.err_msg').length > 0)
				$('.err_msg').remove()
			$.ajax({
				url:_base_url_+'classes/Establishment.php?f=save',
				data: new FormData($(this)[0]),
			    cache: false,
			    contentType: false,
			    processData: false,
			    method: 'POST',
			    type: 'POST',
				error:err=>{
					console.log(err)

				},
				success:function(resp){
				if(resp == 1){
					location.reload();
				}else if(resp == 3){
					var _frm = $('#establishment-frm #msg')
					var _msg = "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Person already exists.</div>"
					_frm.prepend(_msg)
					_frm.find('input#email').addClass('is-invalid')
					$('[name="code"]').focus()
				}else{
					alert_toast("An error occured.",'error');
				}
					end_loader()
				}
			})
		})
	})
</script>