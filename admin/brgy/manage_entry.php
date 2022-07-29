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
                            <legend class="text-info">Barangay Name</legend>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <small class="text-muted">Barangay</small>
                                    <textarea name="brgy" id="brgy" rows="2" style="resize:none" class="form-control form-control-sm rounded-0" placeholder="Barangay"><?= isset($brgy) ? $brgy : "" ?></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <hr class="bg-navy">
                        <center>
                            <button class="btn btn-sm bg-primary btn-flat mx-2 col-3">Save</button>
                            <?php if(isset($id)): ?>
                                <a class="btn btn-sm btn-light border btn-flat mx-2 col-3" href="./?page=brgy/view_details&id=<?= $id ?>">Cancel</a>
                            <?php else: ?>
                                <a class="btn btn-sm btn-light border btn-flat mx-2 col-3" href="./?page=brgy">Cancel</a>
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
                url:_base_url_+"classes/brgy.php?f=save_entry",
				data: new FormData($("#entry-form")[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
                success:function(resp){
                    if(resp.status == 'success'){
                        location.href="./?page=brgy/view_details&id="+resp.id;
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