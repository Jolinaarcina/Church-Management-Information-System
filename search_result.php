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
            if(!empty($_GET['name']) && !empty($_GET['code'])){
                $search_text .= " or Name like <b>'{$_GET['name']}'</b>";
            }
            if(!empty($_GET['name']) && empty($_GET['code'])){
                $search_text .= " or Name like <b>'{$_GET['name']}'</b>";
            }
            ?>
            <h4><?= $search_text ?></h4><br><br>
            <table class="table table-borderless table-striped">
                <colgroup>
					<col width="35%">
					<col width="35%">
					<col width="45%">
					<col width="45%">
				</colgroup>
				<thead>
					<tr>
						<th>Baptismal Code</th>
						<th>Full Name</th>
						<th>Date Baptised</th>
						<th>Action</th>
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
                        if(!empty($_GET['name'])){
                            if(empty($search)) 
                                $search = " where ";
                            else
                                $search .= " or ";
                            $search .= " `fullname` LIKE '%{$_GET['name']}%' ";
                        }
                        $sql = "SELECT * from `baptismal_list` {$search} order by unix_timestamp(`fullname`) asc ";
						$qry = $conn->query($sql);
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td><h3><?php echo ($row['code']) ?></h3></td>
							<td><h2 class="font-weight-bold text-success"><?php echo ucwords($row['fullname']) ?></h2></td>
							<td class=""><h3><?php echo date("M d, Y",strtotime($row['date'])) ?></h3></td>
							<td align="center">
								<h3><a href="./?page=request_bap" class="text-muted" target=""><i class="fa fa-external-link-alt text-secondary opacity-75"></i> Request Record</a></h3>
							</td>
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
            sDom: 'lrtip',
            "paging": false,
		    "info": false,
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });
    })
</script>