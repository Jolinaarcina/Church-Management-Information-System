<div class="content py-3">
    <h3>Search Result/s</h3>
    <hr>
    <div class="card card-outline card-primary rounded-0 shadow">
        <div class="card-body rounded-0">
            <?php 
            $search_text = "Searching Baptismal Record with ";
            if(!empty($_GET['code'])){
                $search_text .= " Code like <b>'{$_GET['code']}'</b>";
            }
            ?>
            <h4><?= $search_text ?></h4>
            <table class="table table-bordered table-striped">
                <colgroup>
					<col width="5%">
					<col width="20%">
					<col width="20%">
					<col width="25%">
					<col width="15%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Ticket Code</th>
						<th>Full Name</th>
						<th>Request Type</th>
						<th>Status</th>
                        <th>Remarks</th>
					</tr>
				</thead>
                <tbody>
					<?php 
						$i = 1;
                        $search = "";
                        if(!empty($_GET['code'])){
                            if(empty($search)) $search = " where ";
                            $search .= " `code` LIKE '%{$_GET['code']}%' ";
                        }
                        $sql = "SELECT * from `message_list` {$search} order by unix_timestamp(`fullname`) asc ";
						$qry = $conn->query($sql);
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo ($row['code']) ?></td>
							<td><?php echo ucwords($row['fullname']) ?></td>
							<td class=""><?php echo ucwords($row['type']) ?></td>
							<td class="text-center">
								<?php if($row['status1'] == 1): ?>
									<span class="badge badge-pill badge-success">Approved</span>
                                <?php elseif($row['status1'] == 2): ?>
									<span class="badge badge-pill badge-danger">Disapproved</span>
								<?php else: ?>
								<span class="badge badge-pill badge-warning">On Process...</span>
								<?php endif; ?>
							</td>
                            <td class=""><?php echo ucwords($row['remarks']) ?></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });
    })
</script>