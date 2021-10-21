<?php
$e_arr = array();
$ec_arr = array();
$eid= isset($_GET['eid'])? $_GET['eid'] : 'all';
$e_arr['all'] = "All";
$ec_arr['all'] = "";
$date = isset($_GET['eid'])? $_GET['date'] : date('Y-m-d');

?>
<div class="col-md-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="filter-frm">
			<div class="col-md-12">
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<label for="establishment_id">Establishment</label>
							<select name="establishment_id" id="establishment_id" class="custom-select custom-select-sm select2">
								<option value="all" <?php echo $eid == 'all' ? 'selected' : '' ?>>All</option>
								<?php
									$establishment= $conn->query("SELECT * FROM establishment order by name asc");
									while($row=$establishment->fetch_assoc()):
										$e_arr[$row['id']] = ucwords($row['name']);
										$ec_arr[$row['id']] = $row['code'];
								?>
								<option value="<?php echo $row['id'] ?>" <?php echo $eid == $row['id'] ? 'selected' : '' ?>><?php echo $row['code'] . ' | ' . (ucwords($row['name'])) ?></option>
							<?php endwhile; ?>
							</select>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label for="date">Date</label>
							<input type="date" id="date" value="<?php echo date('Y-m-d') ?>" class="form-control form-control-sm">
						</div>
					</div>
					<div class="col-sm-2">
						<button class="btn btn-sm btn-primary mt-4"><i class="fa fa-filter"></i> Filter</button>
						<button class="btn btn-sm btn-success mt-4" onclick="_Print()"><i class="fa fa-print"></i> Print</button>
					</div>
				</div>
			</div>
			</form>
			<hr class="border-primary">
			<div id="report-tbl-holder">
				<table id="report-tbl" class="table table-stripped table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Date/Time</th>
							<th>Person's Code/Name</th>
							<th>Establishment's Code/Name</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$where = ($eid > 0 && is_numeric($eid)) ? " and e.id = {$eid} " : "";
						$tracks = $conn->query("SELECT t.*,Concat(p.firstname,' ',p.middlename,' ',p.lastname) as pname,p.code as pcode, e.name as ename,e.code as ecode from tracks t inner join people p on p.id=t.person_id inner join establishment e on. e.id = t.establishment_id where date_format(t.date_added,'%Y-%m-%d') = '{$date}' $where order by date(t.date_added) asc ");
						while($row=$tracks->fetch_assoc()):

						?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("M d, Y h:i A",strtotime($row['date_added'])) ?></td>
							<td><?php echo $row['pcode'] . ' - ' . (ucwords($row['pname'])) ?></td>
							<td><?php echo $row['ecode'] . ' - ' . (ucwords($row['ename'])) ?></td>
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	

	<noscript>
		<style>
			table{
				border-collapse:collapse;
				width: 100%;
			}
			tr,td,th{
				border:1px solid black;
			}
			td,th{
				padding: 3px;
			}
			.text-center{
				text-align: center;
			}
			p{
				margin: unset;
			}
		</style>
		<div align="center">
			<p><strong>(Covid-19) Contact Tracing System</strong></p>
			<p><strong>Report of <?php echo $e_arr[$eid] ?> Establishment</strong></p>
			<p><strong>As of <?php echo date('F d, Y',strtotime($date)) ?></strong></p>
			<p><small><?php echo $ec_arr[$eid]; ?></small></p>
		</div>
	</noscript>
	<script>
		function _Print(){
			start_loader();
			var ns = $('noscript').clone()
			var report = $('#report-tbl-holder').clone()

			var _html = report.prepend(ns.html())
			var nw = window.open('','_blank',"height=900,width=1200");
			nw.document.write(_html.html())
			nw.document.close()
			nw.print()

			setTimeout(function(){
				nw.close()
				end_loader()
			})
		}
		$(document).ready(function(){
			$('#filter-frm').submit(function(e){
				e.preventDefault()
				location.replace(_base_url_+'admin/?page=reports&eid='+$('#establishment_id').val()+'&date='+$('#date').val())
			})
		})
	</script>
</div>