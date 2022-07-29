<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `confirmation_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }

        $details_qry = $conn->query("SELECT * FROM `confirmation_details` where confirmation_id = '{$id}'");
        while($row = $details_qry->fetch_assoc()){
            ${$row['meta_field']} = $row['meta_value'];
        }
    }else{
    echo "<script>alert('Unknown Baptismal ID'); location.replace('./?confirmation=records');</script>";
    }
}
else{
    echo "<script>alert('Baptismal ID is required'); location.replace('./?confirmation=records');</script>";
}
?>
<style>
    @media screen {
        .show-print{
            display:none;
        }
    }
</style>
<div class="content py-3">
    <div class="card card-outline card-dark rounded-0">
        <div class="card-header rounded-0">
            <h5 class="card-title text-primary">Confirmation Details of <?= isset($code) ? $code : "" ?></h5>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div id="outprint">
                    <!-- <fieldset>
                        <div class="row justify-content-end show-print" >
                            <div class="form-group col-auto my-0">
                            <label for="" class="control-label text-info">Baptismal Code: </label><u class="px-3"><?= $code ?></u>
                            </div>
                        </div>
                        <div class="row justify-content-end my-0">
                            <div class="form-group col-auto">
                            <label for="" class="control-label text-info">Date Baptised: </label><u class="px-3"><?= date("F d, Y",strtotime($date)) ?></u>
                            </div>
                        </div>
                    </fieldset> -->
                    <fieldset>
                        <legend class="text-info"><center><b><h1>CERTIFICATE OF CONFIRMATION</h1></b><br><h2>This is to Certify</h2></center></legend><br><br>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end ">
                                    <div class="col-auto pr-2">
                                        <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3>that </h3></b>
                                    </div>
                                    <div class="col-auto flex-grow-1 pl-1 ">
                                    <h3><u><?= ucwords($fullname) ?></u></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto px-2">
                                        <b><h3>child of</h3></b>
                                    </div>
                                    <div class="col-auto flex-grow-1 ">
                                    <h3><u><?= ucwords($father_name) ?></u> and <u><?= ucwords($mother_name) ?></u></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto pr-2">
                                        <b><h3>Born in</h3></b>
                                    </div>
                                    <div class="col-auto flex-grow-1 pl-1 ">
                                    <h3> <u><?= ($place_of_birth) ?></u></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto px-2">
                                        <b><h3>on</h3></b>
                                    </div>
                                    <div class="col-auto flex-grow-1 ">
                                    <h3><u><?= date("F d, Y",strtotime($dob)) ?></u></h3>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <div class="col-auto px-2">
                                        <h3>Recieved the Sacrament of Confirmation</h3>
                                        <h3>According to the Rite of Roman Catholic Church</h3>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto pr-2">
                                        <b><h3>at</h3></b>
                                    </div>
                                    <div class="col-auto flex-grow-1 pl-1 ">
                                    <h3><u><?= $_settings->info('church_name') ?></u> </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto pr-2">
                                        <b><h3>in</h3></b>
                                    </div>
                                    <div class="col-auto flex-grow-1 pl-1 ">
                                    <h3><u><?= ($place_of_baptism) ?></u></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto pr-2">
                                        <b><h3>on</h3></b>
                                    </div>
                                    <div class="col-auto flex-grow-1 pl-1 ">
                                    <h3> <u><?= date("F d, Y",strtotime($date)) ?></u></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto pr-2">
                                        <b><h3>Conferred by</h3></b>
                                    </div>
                                    <div class="col-auto flex-grow-1 pl-1 ">
                                    <h3><u><?= ucwords($officient) ?></u></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto pr-2">
                                        <b><h3>Date of Baptism:</h3></b>
                                    </div>
                                    <div class="col-auto flex-grow-1 pl-1 ">
                                    <h3> <?= date("F d, Y",strtotime($date)) ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto pr-2">
                                        <b><h3>Sponsors</h3></b>
                                    </div>
                                    <?php
                                        $witnesses = $conn->query("SELECT * FROM `cwitness_list` where confirmation_id = '{$id}'");
                                        while($row = $witnesses->fetch_assoc()):
                                    ?>
                                    <div class="col-auto flex-grow-1 pl-1 ">
                                    <h3> <u><?= ucwords($row['fullname']) ?>,</h3><?php endwhile; ?></u></h3>
                                    </div>
                                </div>
                            </div>
                        </div><br><br><br><br>

                       
                       <div class="row">
                            <div class="col-12">
                            <center><h3><u><?= strtoupper($_settings->info('priest'))  ?></u><br>Pariest Priest</h3></center>
                                <!-- <div class="d-flex align-items-end">
                                <div class="form-group col-auto my-0">
                                <label for="" class="control-label text-info"></label><u class="px-3"><br><br><?= strtoupper($_settings->info('priest'))  ?></u><br>
                                <label for="" class="control-label text-info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Parish Priest</label> -->
                            </div>
                        </div>
                        
                    </fieldset>
                    <hr class="">
                    <div><br>
                        <font size = 4><p>To Parents or Guardian:</p>
                        <p>Any incorrect information in this certificate should be reported to the Parish Registrar's Office
                            for the correction within three (3) days from the date of baptism.</font>
                        </p>
                    </div>
                </div>
                <div class="rounded-0 text-center mt-3">
                        <button class="btn btn-sm btn-success btn-flat" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                        <a class="btn btn-sm btn-primary btn-flat" href="./?confirmation=records/manage_entry&id=<?= $id ?>"><i class="fa fa-edit"></i> Edit</a>
                        <button class="btn btn-sm btn-danger btn-flat" type="button" id="delete_data"><i class="fa fa-trash"></i> Delete</button>
                        <a class="btn btn-light border btn-flat btn-sm" href="./?confirmation=records" ><i class="fa fa-angle-left"></i> Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#delete_data').click(function(){
			_conf("Are you sure to delete <b><?= $code ?>\'s</b> from baptismal records permanently?","delete_entry",[$(this).attr('data-id')])
		})
        $('#print').click(function(){
            var _h = $("head").clone()
            var _p = $('#outprint').clone()
            var el = $("<div>")
            start_loader()
            $('script').each(function(){
                if(_h.find('script[src="'+$(this).attr('src')+'"]').length <= 0){
                    _h.append($(this).clone())
                }
            })
            _h.find('title').text("Certificate of Baptism - Print View")
            _p.prepend("<hr class='border-navy '>")
            _p.prepend("<div class='mx-5 py-4'>"+
                        "<h1 class='text-center mb-1'><?= $_settings->info('diocese') ?></h1>"+
                        "<h2 class='text-center mb-1'><?= $_settings->info('church_name') ?></h2>"+
                        "<h2 class='text-center mb-1'><?= $_settings->info('address') ?></h2>")+
            _p.prepend("<img src='<?= validate_image($_settings->info('logo')) ?>' id='print-logo' />")
            el.append(_h)
            el.append(_p)

            var nw = window.open("","_blank","height=800,width=1200,left=200")
                nw.document.write(el.html())
                nw.document.close()
                setTimeout(()=>{
                    nw.print()
                    setTimeout(() => {
                        nw.close()
                        end_loader()
                    }, 300);
                },300)
        })
    })
    function delete_entry($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Confirmation.php?f=delete_entry",
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
					location.replace= './?confirmation=records';
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>