<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `brgy_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }

        $details_qry = $conn->query("SELECT * FROM `members_details` where members_id = '{$id}'");
        while($row = $details_qry->fetch_assoc()){
            ${$row['meta_field']} = $row['meta_value'];
        }
    }else{
    echo "<script>alert('Unknown members ID'); location.replace('./?page=brgy');</script>";
    }
}
else{
    echo "<script>alert('members ID is required'); location.replace('./?page=brgy');</script>";
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
            <h5 class="card-title text-primary">Member Details of <?= isset($code) ? $code : "" ?></h5>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div id="outprint">
                    <fieldset>
                        <div class="row justify-content-end show-print" >
                            <div class="form-group col-auto my-0">
                            <label for="" class="control-label text-info">Member Code: </label><u class="px-3"><?= $code ?></u>
                            </div>
                        </div>
                        
                    </fieldset>
                    <fieldset>
                        <legend class="text-info">Members's Information</legend>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto pr-2">
                                        <b>Name:</b>
                                    </div>
                                    <div class="col-auto flex-grow-1 pl-1 border-bottom border-dark">
                                        <?= ucwords($fullname) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto pr-2">
                                        <b>Sex:</b>
                                    </div>
                                    <div class="col-auto px-4 border-bottom border-dark">
                                        <?= ucwords($gender) ?>
                                    </div>
                                    <div class="col-auto px-2">
                                        <b>Date of Birth:</b>
                                    </div>
                                    <div class="col-auto flex-grow-1 border-bottom border-dark">
                                        <?= date("F d, Y",strtotime($dob)) ?>
                                        <?= ($brgy) ?>
                                    </div>
                                    <div class="col-auto px-2">
                                        <b>Barangay:</b>
                                    </div>
                                    <div class="col-auto flex-grow-1 border-bottom border-dark">
                                        <?= ($brgy) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <hr class="">
                    <fieldset>
                        <legend class="text-info">Contact Information</legend>
                        
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto pr-2">
                                        <b>Telephone/Contact #:</b>
                                    </div>
                                    <div class="col-auto flex-grow-1 pl-1 border-bottom border-dark">
                                        <?= ($telephone) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </fieldset>
                    <hr class="">
                    

                    



                </div>
                <div class="rounded-0 text-center mt-3">
                        
                        <a class="btn btn-sm btn-primary btn-flat" href="./?page=members/manage_entry&id=<?= $id ?>"><i class="fa fa-edit"></i> Edit</a>
                        <button class="btn btn-sm btn-danger btn-flat" type="button" id="delete_data"><i class="fa fa-trash"></i> Delete</button>
                        <a class="btn btn-light border btn-flat btn-sm" href="./?page=members" ><i class="fa fa-angle-left"></i> Back to List</a>
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
                        "<h1 class='text-center mb-1'>Certificate of Baptism</h1>"+
                        "<h3 class='text-center mb-1'><?= $_settings->info('church_name') ?></h3>"+
                        "<center><small class='text-muted'><?= $_settings->info('address') ?></small></center></div>")+
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
			url:_base_url_+"classes/Members.php?f=delete_entry",
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
					location.replace= './?page=members';
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>