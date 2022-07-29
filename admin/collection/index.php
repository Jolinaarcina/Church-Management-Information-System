<style>
    .img-avatar{
        width:45px;
        height:45px;
        object-fit:cover;
        object-position:center center;
        border-radius:100%;
    }
</style>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Collections Record</h3>
		<div class="card-tools">
			<a href="./?page=collection/manage_entry" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New Entry</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="20%">
					<col width="20%">
					<col width="25%">
					<col width="20%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Date Created</th>
						<th>Collection Code</th>
						<th>Brgy</th>
						<th>Date</th>
						<th>Amount</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT * from `collection_list` order by unix_timestamp(`brgy`) asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td><?php echo ($row['code']) ?></td>
							<td class=""><?php echo ($row['brgy']) ?></td>
							<td class=""><?php echo ($row['date']) ?></td>
							<td class=""><?php echo ($row['amount']) ?></td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <!-- <a class="dropdown-item" href="./?page=collection/view_details&id=<?php echo $row['id'] ?>" data-id=""><span class="fa fa-window-restore text-gray"></span> View</a> -->
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item" href="./?page=collection/manage_entry&id=<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>" data-code="<?php echo $row['code'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
									<div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>" data-code="<?php echo $row['code'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete <b>"+$(this).attr('data-code')+"\'s</b> from baptismal records permanently?","delete_entry",[$(this).attr('data-id')])
		})
		$('.update_status').click(function(){
            uni_modal("Update <b>"+$(this).attr('data-code')+"\'s</b> Status","members/update_status.php?id="+$(this).attr('data-id'),"mid-large")
        })
		$('.view_details').click(function(){
			uni_modal("booking Details", "booking/view_details.php?id="+$(this).attr('data-id'),'large')
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });
	})
	function delete_entry($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Collection.php?f=delete_entry",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>