<?php 
require_once('../../config.php');
?>
<div class="col-md-12">
	<table class="table table-striped" id="tracks">
		<thead>
			<tr>
				<th>Date</th>
				<th>Time</th>
				<th>Establishment</th>
				<th>Establishment Code</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$tracks = $conn->query("SELECT t.*,e.name as ename, e.code as ecode FROM tracks t inner join establishment e on e.id = t.establishment_id where t.person_id = ".$_GET['id']." order by date(t.date_added) desc ");
			while($row = $tracks->fetch_assoc()):
			?>
				<tr>
					<td><?php echo date("M d, Y",strtotime($row['date_added'])) ?></td>
					<td><?php echo date("h:i A",strtotime($row['date_added'])) ?></td>
					<td><?php echo ucwords($row['ename']) ?></td>
					<td><?php echo ucwords($row['ecode']) ?></td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>
<script>
	$('#tracks').dataTable()
</script>