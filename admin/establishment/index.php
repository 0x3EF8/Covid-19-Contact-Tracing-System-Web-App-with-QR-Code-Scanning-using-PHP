<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary new_establishment" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<!-- <colgroup>
					<col width="5%">
					<col width="15%">
					<col width="25%">
					<col width="25%">
					<col width="15%">
					<col width="15%">
				</colgroup> -->
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Code</th>
						<th>Name</th>
						<th>Address</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT p.*,z.name as zname,c.name as cname, s.name as sname FROM establishment p inner join barangay_list z on z.id = p.zone_id inner join city_list c on c. id= z.city_id inner join state_list s on s.id = c.state_id order by z.name asc ");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo $row['code'] ?></b></td>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<td><b><?php echo ucwords($row['address'].', '.$row['zname'].', '.$row['cname'].' City, '.$row['sname']) ?></b></td>
						<td class="text-center">
		                    <div class="btn-group">
		                    	<a href="javascript:void(0)" data-id='<?php echo $row['id'] ?>' class="btn btn-primary btn-flat view_establishment">
		                          <i class="fas fa-eye"></i>
		                        </a>
		                        <a href="javascript:void(0)" data-id='<?php echo $row['id'] ?>' class="btn btn-primary btn-flat manage_establishment">
		                          <i class="fas fa-edit"></i>
		                        </a>
		                        <button type="button" class="btn btn-danger btn-flat delete_establishment" data-id="<?php echo $row['id'] ?>">
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
		$('.new_establishment').click(function(){
			uni_modal("New Individual","./establishment/manage.php")
		})
		$('.manage_establishment').click(function(){
			uni_modal("Manage Individual","./establishment/manage.php?id="+$(this).attr('data-id'))
		})
		$('.view_establishment').click(function(){
			uni_modal("Establishment's Details","./establishment/view.php?id="+$(this).attr('data-id'))
		})
		$('.delete_establishment').click(function(){
		_conf("Are you sure to delete this Individual?","delete_establishment",[$(this).attr('data-id')])
		})
		$('#list').dataTable()
	})
	function delete_establishment($id){
		start_loader()
		$.ajax({
			url:_base_url_+'classes/establishment.php?f=delete',
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