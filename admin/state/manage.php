<?php 
require_once('../../config.php');
if(isset($_GET['id']) && !empty($_GET['id'])){
	$qry = $conn->query("SELECT * FROM state_list where id = {$_GET['id']}");
	foreach($qry->fetch_array() as $k => $v){
		if(!is_numeric($k)){
			$$k = $v;
		}
	}
}
?>
<form action="" id="state-frm">
	<div id="msg" class="form-group"></div>
	<input type="hidden" name='id' value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
	<div class="form-group">
		<label for="code" class="control-label">Code</label>
		<input type="text" class="form-control form-control-sm" name="code" id="code" value="<?php echo isset($code) ? $code : '' ?>" required>
	</div>
	<div class="form-group">
		<label for="name" class="control-label">State</label>
		<input type="text" class="form-control form-control-sm" name="name" id="name" value="<?php echo isset($name) ? $name : '' ?>" required>
	</div>
	<div class="form-group">
		<label for="description" class="control-label">Description</label>
		<textarea type="text" class="form-control form-control-sm" name="description" id="description" required ><?php echo isset($description) ? $description : '' ?></textarea>
	</div>
</form>
<script>
	$(document).ready(function(){
		$('#state-frm').submit(function(e){
			e.preventDefault()
			start_loader()
			if($('.err_msg').length > 0)
				$('.err_msg').remove()
			$.ajax({
				url:_base_url_+'classes/State.php?f=save',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)

				},
				success:function(resp){
				if(resp == 1){
					location.reload();
				}else if(resp == 3){
					var _frm = $('#state-frm #msg')
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