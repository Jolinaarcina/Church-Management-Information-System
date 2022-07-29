<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `matrimony_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }

        $details_qry = $conn->query("SELECT * FROM `matrimony_details` where matrimony_id = '{$id}'");
        while($row = $details_qry->fetch_assoc()){
            ${$row['meta_field']} = $row['meta_value'];
        }
    }else{
    echo "<script>alert('Unknown Matrimony ID'); location.replace('./?page=matrimony');</script>";
    }
}
else{
    echo "<script>alert('Matrimony ID is required'); location.replace('./?page=matrimony');</script>";
}
?>
<style>
    @media screen {
        .show-print{
            display:none;
        }
    }
.style4 {
	font-size: 36px;
	font-weight: bold;
}
.style6 {font-size: 36px}
</style>
<div class="content py-3">
    <div class="card card-outline card-dark rounded-0">
        <div class="card-header rounded-0">
            <h5 class="card-title text-primary" )>Matrimony Details of <?= isset($code) ? $code : "" ?></h5>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div id="outprint">
                    <fieldset>
                        <div class="row justify-content-end my-0">
                          <div class="form-group col-auto">
                            <label for="" class="control-label text-info"></label>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                    </fieldset>
<br><br>
                                <br>
                                <br>
                                <br>
                    <fieldset>
					<table width="1297" border="0">
                        <tbody><?php
                                    $witnesses = $conn->query("SELECT * FROM `sponsor_list` where matrimony_id = '{$id}'");
                                    while($row = $witnesses->fetch_assoc()):
                                ?>  </tbody>
                            <tr>
                                <td width="1287" colspan="3"><center>
                                  <div align="center">
                                  <span class="style4">  <h1 style="font-family:Monotype Corsiva;">                                 This is to Certify that</span>                                  </p><span class="style6"></span>
                                  </span>
                                  <div class="row">                                  </div>
                                    <span class="style4"><span class="style1">
                                    <div>
                                    <div class="col-12">
                                    <div align="center">
                                    <u> 
                                    <span class="style6">
                                    <?= ucwords($fullname) ?> 
                                    </span></u><span class="style6">
                                  and 
                                  <u> 
                                  <?= ucwords($wife) ?>
                                  </u>
                                  <br>
                                Lawfully Married on <br>
                                <u> 
                                <?= date("F d, Y",strtotime($date)) ?>
                                </u>
                                According to the Rite of Roman Catholic Church <br>
                                and in conformity with the law of the Philippines <br>
                                <u> Rev. 
                                <?= ucwords($officient) ?> 
                                </u>
                                officiating <br>
                                in the presence of 
                                <u> 
                                <?= ucwords($row['fullname']) ?>
                                </u>
                                <br>
                                Witnesses, as appears from the Marriage Register on this Church.<br />
                                Dated<u> <?php echo date("jS \of F Y ") . "</u><br>";?> </h1>
                                
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <h2> <?= strtoupper($_settings->info('priest'))  ?>
                                 <br>
                              Parish Priest</h2>
                                    </span></div>
                                    </div>
                        </div>                             </td>
                      </tr>
                    
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                        
                    </fieldset>

                </div>
                <div class="rounded-0 text-center mt-3">
                        <button class="btn btn-sm btn-success btn-flat" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                        <a class="btn btn-sm btn-primary btn-flat" href="./?page=matrimony/manage_entry&id=<?= $id ?>"><i class="fa fa-edit"></i> Edit</a>
                        <button class="btn btn-sm btn-danger btn-flat" type="button" id="delete_data"><i class="fa fa-trash"></i> Delete</button>
                        <a class="btn btn-light border btn-flat btn-sm" href="./?page=matrimony" ><i class="fa fa-angle-left"></i> Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#delete_data').click(function(){
			_conf("Are you sure to delete <b><?= $code ?>\'s</b> from matrimony records permanently?","delete_entry",[$(this).attr('data-id')])
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
            _h.find('title').text("Certificate of Marriage - Print View")
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
			url:_base_url_+"classes/Masters.php?f=delete_entry",
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
					location.replace= './?page=matrimony';
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>