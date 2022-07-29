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
            <table class="table table-bordered table-striped">
                <colgroup>
					<col width="5%">
					<col width="30%">
					<col width="20%">
					<col width="25%">
					<col width="15%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Matrimony Code</th>
						<th>Husband Name</th>
						<th>Wife Name</th>
						<th>Date of Matrimony</th>
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
                            $search .= " `fullname` LIKE '%{$_GET['name']}%' or `wife` LIKE '%{$_GET['name']}%'  ";
                        }
                        $sql = "SELECT * from `matrimony_list` {$search} order by unix_timestamp(`fullname`) asc ";
						$qry = $conn->query($sql);
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><h3><?php echo $i++; ?></h3></td>
							<td class=""><h3><?php echo ($row['code']) ?></h3></td>
							<td><h3><?php echo ucwords($row['fullname']) ?></h3></td>
							<td><h3><?php echo ucwords($row['wife']) ?></h3></td>
							<td class=""><h3><?php echo date("M d, Y",strtotime($row['date'])) ?></h3></td>
							<td align="center">
                                <h3>
                                <a href="./?page=request_wed" class="text-muted" target=""><i class="fa fa-external-link-alt text-secondary opacity-75"></i> Request Record</a>
                                </h3>
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