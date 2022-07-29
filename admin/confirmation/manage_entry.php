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
                            <legend class="text-info">Confirmation Information</legend>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <input type="date" id="date" name="date" autofocus class="form-control form-control-sm form-control-border" placeholder="Date Baptised" required value="<?= isset($date) ? $date : "" ?>">
                                    <small class="text-muted px-4">Date of Confirmation</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <small class="text-muted">Place of Confirmation</small>
                                    <textarea name="place_of_baptism" id="place_of_baptism" rows="3" style="resize:none" class="form-control form-control-sm rounded-0" placeholder=""><?= isset($place_of_baptism) ? $place_of_baptism : "" ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <input type="text" id="officient" name="officient" class="form-control form-control-sm form-control-border" placeholder="Officiating Minister" required value="<?= isset($officient) ? $officient : "" ?>">
                                    <small class="text-muted px-4">Officiating Minister</small>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="text-info">Child's Information</legend>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <input type="text" id="firstname" name="firstname" class="form-control form-control-sm form-control-border" placeholder="Firstname" value="<?= isset($firstname) ? $firstname : "" ?>" required>
                                    <small class="text-muted px-4">First Name</small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" id="middlename" name="middlename" class="form-control form-control-sm form-control-border" placeholder="(optional)" value="<?= isset($middlename) ? $middlename : "" ?>">
                                    <small class="text-muted px-4">Middle Name</small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" id="lastname" name="lastname" class="form-control form-control-sm form-control-border" placeholder="Last Name" value="<?= isset($lastname) ? $lastname : "" ?>" required>
                                    <small class="text-muted px-4">Last Name</small>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-4 form-group">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <small class="text-muted">Gender</small>
                                        </div>
                                        <div class="form-group col-auto">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="genderMale" name="gender" value="Male" required  <?= isset($gender) && $gender == 'Male' ? "checked" : ""  ?> <?= !isset($gender) ? "checked" : ""  ?>>
                                                <label for="genderMale" class="custom-control-label">Male</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-auto">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="genderFemale" name="gender" value="Female" <?= isset($gender) && $gender == 'Female' ? "checked" : ""  ?>>
                                                <label for="genderFemale" class="custom-control-label">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="date" id="dob" name="dob" autofocus class="form-control form-control-sm form-control-border" placeholder="Date of Birth" required value="<?= isset($dob) ? $dob : "" ?>">
                                    <small class="text-muted px-4">Date of Birth</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <small class="text-muted">Place of Birth</small>
                                    <textarea name="place_of_birth" id="Place of Birth" rows="2" style="resize:none" class="form-control form-control-sm rounded-0" placeholder="Here Street, There City, Anywhere State, 2306"><?= isset($place_of_birth) ? $place_of_birth : "" ?></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="text-info">Parent's Information</legend>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <input type="text" id="father_name" name="father_name" class="form-control form-control-sm form-control-border" placeholder="Father's Name" value="<?= isset($father_name) ? $father_name : "" ?>" required>
                                    <small class="text-muted px-4">Father's Name</small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" id="mother_name" name="mother_name" class="form-control form-control-sm form-control-border" placeholder="Mother's Name" value="<?= isset($mother_name) ? $mother_name : "" ?>" required>
                                    <small class="text-muted px-4">Mother's Maiden Name</small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" id="telephone" name="telephone" class="form-control form-control-sm form-control-border" placeholder="Telephone #" value="<?= isset($telephone) ? $telephone : "" ?>">
                                    <small class="text-muted px-4">Telephone #</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <small class="text-muted">Parent's Residence</small>
                                    <textarea name="address" id="address" rows="3" style="resize:none" class="form-control form-control-sm rounded-0" placeholder="Here Street, There City, Anywhere State, 2306"><?= isset($address) ? $address : "" ?></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="text-info">Witnesses/Godparents</legend>
                            <div id="witnesses">
                                <?php 
                                    if(isset($id)):
                                ?>
                                <?php
                                    $witnesses = $conn->query("SELECT * FROM `cwitness_list` where confirmation_id = '{$id}'");
                                    while($row = $witnesses->fetch_assoc()):
                                ?>
                                    <div class="row align-items-center">
                                        <div class="form-group col-md-5">
                                            <input type="text" name="witness_name[]" class="form-control form-control-sm form-control-border" placeholder="Name" value="<?= $row['fullname'] ?>" required>
                                            <small class="text-muted px-4">Full Name</small>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <input type="text" name="witness_address[]" value="<?= $row['address'] ?>" class="form-control form-control-sm form-control-border" placeholder="Address" required>
                                            <small class="text-muted px-4">Address</small>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <button class="btn btn-sm btn-flat btn-danger witness_remove" type="button"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                <?php endwhile; ?>

                                <?php if($witnesses->num_rows <= 0): ?>
                                    <div class="row align-items-center">
                                        <div class="form-group col-md-5">
                                            <input type="text" name="witness_name[]" class="form-control form-control-sm form-control-border" placeholder="Name" required>
                                            <small class="text-muted px-4">Full Name</small>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <input type="text" name="witness_address[]" class="form-control form-control-sm form-control-border" placeholder="Address" required>
                                            <small class="text-muted px-4">Address</small>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <button class="btn btn-sm btn-flat btn-danger witness_remove" type="button"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php else: ?>
                                    <div class="row align-items-center">
                                        <div class="form-group col-md-5">
                                            <input type="text" name="witness_name[]" class="form-control form-control-sm form-control-border" placeholder="Name" required>
                                            <small class="text-muted px-4">Full Name</small>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <input type="text" name="witness_address[]" class="form-control form-control-sm form-control-border" placeholder="Address" required>
                                            <small class="text-muted px-4">Address</small>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <button class="btn btn-sm btn-flat btn-danger witness_remove" type="button"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <button class="btn btn-sm btn-primary btn-flat" type="button" id="add_witness"><i class="fa fa-plus"></i> Add Witness</button>
                                </div>
                            </div>
                        </fieldset>
                        <hr class="bg-navy">
                        <center>
                            <button class="btn btn-sm bg-primary btn-flat mx-2 col-3">Save</button>
                            <?php if(isset($id)): ?>
                                <a class="btn btn-sm btn-light border btn-flat mx-2 col-3" href="./?page=confirmation/view_details&id=<?= $id ?>">Cancel</a>
                            <?php else: ?>
                                <a class="btn btn-sm btn-light border btn-flat mx-2 col-3" href="./?page=confirmation">Cancel</a>
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
                url:_base_url_+"classes/Confirmation.php?f=save_entry",
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
                        location.href="./?page=confirmation/view_details&id="+resp.id;
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