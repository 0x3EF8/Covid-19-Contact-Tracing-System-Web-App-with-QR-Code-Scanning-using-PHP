<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary new_city" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="25%">
					<col width="15%">
					<col width="20%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Code</th>
						<th>City</th>
						<th>Description</th>
						<th>State</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT c.*,s.name as sname FROM city_list c  inner join state_list s on s.id = c.state_id order by c.name asc ");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo $row['code'] ?></b></td>
						<td><b><?php echo $row['name'] ?></b></td>
						<td><b><?php echo $row['description'] ?></b></td>
						<td><b><?php echo ucwords($row['sname']) ?></b></td>
						<td class="text-center">
		                    <div class="btn-group">
		                        <a href="javascript:void(0)" data-id='<?php echo $row['id'] ?>' class="btn btn-primary btn-flat manage_city">
		                          <i class="fas fa-edit"></i>
		                        </a>
		                        <button type="button" class="btn btn-danger btn-flat delete_city" data-id="<?php echo $row['id'] ?>">
		                          <i class="fas fa-trash"></i>
		                        </button>
	                      </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>

	$(document).ready(function(){
		$('#list').dataTable()
		$('.new_city').click(function(){
			uni_modal("New City","./city/manage.php")
		})
		$('.manage_city').click(function(){
			uni_modal("Manage City","./city/manage.php?id="+$(this).attr('data-id'))
		})
		$('.delete_city').click(function(){
		_conf("Are you sure to delete this City?","delete_city",[$(this).attr('data-id')])
		})
		$('#list').dataTable()
	})
	function delete_city($id){
		start_loader()
		$.ajax({
			url:_base_url_+'classes/City.php?f=delete',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					location.reload()
				}
			}
		})
	}
</script>