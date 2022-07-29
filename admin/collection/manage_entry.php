<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `collection_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }

        $details_qry = $conn->query("SELECT * FROM `collection_details` where collection_id = '{$id}'");
        while($row = $details_qry->fetch_assoc()){
            ${$row['meta_field']} = $row['meta_value'];
        }
    }
}
?>
<div class="content py-3">
    <div class="container-fluid">
        <div class="card card-outline card-info rounded-0 shadow">
            <div class="card-header rounded-0">
                <h4 class="card-title"><?= isset($code) ? "Update ".$code."'s Entry Details" : "New Entry" ?></h4>
            </div>
            <div class="card-body rounded-0">
                <div class="container-fluid">
                    <form action="" id="entry-form">
                        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
                        
                        <fieldset>
                            <legend class="text-info">Collection's Information</legend>
                            
                            
                                <div class="form-group col-md-4">
                                    <input type="date" id="date" name="date" autofocus class="form-control form-control-sm form-control-border" placeholder="Collection Date" required value="<?= isset($date) ? $date : "" ?>">
                                    <small class="text-muted px-4">Collection Date</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                <?php 
                                    $resultSet = $conn->query("SELECT brgy FROM brgy_list");
                                        ?>
                                        <select name="brgy"  id="brgy">
                                            <?php
                            
                                                while($rows = $resultSet->fetch_assoc()){
                                                    $brgyName = $rows['brgy'];
                                                    echo "<option value = $brgyName>$brgyName</option>";
                                                }
                                            ?>

                                        </Select>
                                        </Select>
                                    <!-- <textarea name="brgy" id="brgy" rows="2" style="resize:none" class="form-control form-control-sm rounded-0" placeholder="Barangay"><?= isset($brgy) ? $brgy : "" ?></textarea> -->
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="text-info">Amount</legend>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <input type="number" id="amount" name="amount" class="form-control form-control-sm form-control-border" placeholder="Amount" value="<?= isset($amount) ? $amount : "" ?>"required>
                                    <small class="text-muted px-4">Collection Amount</small>
                                </div>
                            </div>
                        </fieldset>
                        <hr class="bg-navy">
                        <center>
                            <button class="btn btn-sm bg-primary btn-flat mx-2 col-3">Save</button>
                            <?php if(isset($id)): ?>
                                <a class="btn btn-sm btn-light border btn-flat mx-2 col-3" href="./?page=collection/view_details&id=<?= $id ?>">Cancel</a>
                            <?php else: ?>
                                <a class="btn btn-sm btn-light border btn-flat mx-2 col-3" href="./?page=collection">Cancel</a>
                            <?php endif; ?>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
    function submit_entry(){
        var _this = $("#entry-form")
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Collection.php?f=save_entry",
				data: new FormData($("#entry-form")[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("Success",'success');
					end_loader();
				},
                success:function(resp){
                    if(resp.status == 'success'){
                        location.href="./?page=collection/view_details&id="+resp.id;
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }else{
                        el.addClass("alert-danger")
                        el.text("An error occurred due to unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html, body').animate({scrollTop:0},'fast')
                    end_loader();
                }
            })
    }
    $(function(){
        $('.select2').each(function(){
            var _this = $(this)
            _this.select2({
                placeholder:_this.attr('data-placeholder') || 'Please Select Here',
                width:'100%'
            })
        })
        $('.witness_remove').click(function(){
            if($('#witnesses .row').length > 1){
                $(this).closest('.row').remove()
            }
        })
        $('#add_witness').click(function(){
            var item = $('#witnesses>.row').first().clone()
                item.find('input[name="witness_name[]"]').val('')
                item.find('input[name="witness_address[]"]').val('')
                $('#witnesses').append(item)
                item.find('.witness_remove').click(function(){
                    if($('#witnesses .row').length > 1){
                        item.remove()
                    }
                })
        })
        $('#entry-form').submit(function(e){
            e.preventDefault()
            _conf("Please make sure that you have reviewed the form before you continue to submit the entry.","submit_entry",[])
            
        })
    })
</script>