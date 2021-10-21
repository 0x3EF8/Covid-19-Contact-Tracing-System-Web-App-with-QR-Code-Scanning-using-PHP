<?php 
require_once('../../config.php');
if(isset($_GET['id']) && !empty($_GET['id'])){
	$qry = $conn->query("SELECT * FROM barangay_list where id = {$_GET['id']}");
	foreach($qry->fetch_array() as $k => $v){
		if(!is_numeric($k)){
			$$k = $v;
		}
	}
}
?>
<form action="" id="city-frm">
	<div id="msg" class="form-group"></div>
	<input type="hidden" name='id' value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
	<div class="form-group">
		<label for="code" class="control-label">Code</label>
		<input type="text" class="form-control form-control-sm" name="code" id="code" value="<?php echo isset($code) ? $code : '' ?>" required>
	</div>
	<div class="form-group">
		<label for="name" class="control-label">Barangay/Zone</label>
		<input type="text" class="form-control form-control-sm" name="name" id="name" value="<?php echo isset($name) ? $name : '' ?>" required>
	</div>
	<div class="form-group">
		<label for="description" class="control-label">Description</label>
		<textarea type="text" class="form-control form-control-sm" name="description" id="description" required ><?php echo isset($description) ? $description : '' ?></textarea>
	</div>
	<div class="form-group">
		<label for="description" class="control-label">City/State</label>
		<select name="city_id" id="" class="custom-select custom-select-sm select2">
			<?php 
			$city = $conn->query("SELECT c.*,s.name as sname FROM city_list c inner join state_list s on c.state_id = s.id order by c.name asc");
			while($row=$city->fetch_assoc()):
			?>
			<option value="<?php echo $row['id'] ?>" <?php echo isset($city_id) && $city_id == $row['id'] ? "selected" : '' ?>><?php echo ucwords($row['name'].' City, '.$row['sname']) ?></option>
			<?php endwhile; ?>
		</select>
	</div>

</form>
<script>
	$(document).ready(function(){
		$('.select2').select2();
		$('#city-frm').submit(function(e){
			e.preventDefault()
			start_loader()
			if($('.err_msg').length > 0)
				$('.err_msg').remove()
			$.ajax({
				url:_base_url_+'classes/Zone.php?f=save',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)

				},
				success:function(resp){
				if(resp == 1){
					location.reload();
				}else if(resp == 3){
					var _frm = $('#city-frm #msg')
					var _msg = "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Code already exists.</div>"
					_frm.prepend(_msg)
					_frm.find('input#code').addClass('is-invalid')
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