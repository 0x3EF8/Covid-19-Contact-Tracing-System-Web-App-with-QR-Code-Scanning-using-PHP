<?php
require_once('../../config.php');
include('../../libs/phpqrcode/qrlib.php'); 
if(isset($_GET['id']) && !empty($_GET['id'])){
	$qry = $conn->query("SELECT * FROM establishment where id = {$_GET['id']}");
	foreach($qry->fetch_array() as $k => $v){
		if(!is_numeric($k)){
			$$k = $v;
		}
	}
}
$zone = $conn->query("SELECT * FROM barangay_list where id = $zone_id ")->fetch_array()['name'];
$city = $conn->query("SELECT * FROM city_list where id = $city_id ")->fetch_array()['name'];
$state = $conn->query("SELECT * FROM state_list where id in (SELECT state_id  FROM city_list where id = $city_id ) ")->fetch_array()['name'];
?>
<!-- <div class="row">
	<div class="col-md-12 mb-2 justifu-content-end">
		<button class="btn btn-sm btn-success float-right" type="button" id="print-card"><i class="fa fa-print"></i> Print</button>
	</div>
</div> -->
<div class="col-md-12">
	<div class="form-group">
		<div class="form-group d-flex justify-content-center">
			<img src="<?php echo validate_image(isset($image_path) ? $image_path : '') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
		</div>
	</div>
	<hr class="border-primary">
	<dl>
		<dt>Code</dt>
		<dd><?php echo ucwords($code) ?></dd>
	</dl>
	<dl>
		<dt>Establishment Name</dt>
		<dd><?php echo ucwords($name) ?></dd>
	</dl>
	<dl>
		<dt>Address</dt>
		<dd><?php echo strtoupper($address.', '.$zone.', '.$city.' City, '.$state) ?></dd>
	</dl>
</div>
<script>
	// $('#print-card').click(function(){
	// 	var ccts = $('#cts-card').clone()

	// 	var nw = window.open('','_blank','height=600,width800');
	// 	nw.document.write(ccts.html())
	// 	nw.document.close()
	// 	nw.print()
	// 	setTimeout(function(){
	// 		window.close()
	// 	},750)
	// })
	$(document).ready(function(){
		if($('#uni_modal .modal-header button.close').length <= 0)
		$('#uni_modal .modal-header').append('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
	})
</script>
<style>
	#uni_modal .modal-footer{
		display: none;
	}
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>