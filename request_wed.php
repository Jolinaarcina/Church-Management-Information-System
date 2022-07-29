<div class="col-12">
    <div class="row my-5 ">
        <div class="col-md-5">
            <div class="card card-outline card-navy rounded-0 shadow">
                <div class="card-header">
                    <h4 class="card-title">Contact Information</h4>
                </div>
                <div class="card-body rounded-0">
                    <dl>
                        <dt class="text-muted"><i class="fa fa-envelope"></i> Email</dt>
                        <dd class="pr-4"><?= $_settings->info('email') ?></dd>
                        <dt class="text-muted"><i class="fa fa-phone"></i> Contact #</dt>
                        <dd class="pr-4"><?= $_settings->info('contact') ?></dd>
                        <dt class="text-muted"><i class="fa fa-map-marked-alt"></i> Location</dt>
                        <dd class="pr-4"><?= $_settings->info('address') ?></dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card rounded-0 card-outline card-navy shadow" >
                <div class="card-body rounded-0">
                    <h2 class="text-center">Matrimony Records Request</h2>
                    <center><hr class="bg-navy border-navy w-25 border-2"></center>
                    <?php if($_settings->chk_flashdata('pop_msg')): ?>
                        <div class="alert alert-success">
                            <i class="fa fa-check mr-2"></i> <?= $_settings->flashdata('pop_msg') ?>
                        </div>
                        <script>
                            $(function(){
                                $('html, body').animate({scrollTop:0})
                            })
                        </script>
                    <?php endif; ?>
                    <form action="bap.php" method="POST">
                    <?php  $code = uniqid('TICKET_'); ?>
                        <input type="hidden" name="id"> 
                        <input type="hidden" name="type" value = "Matrimony">
                        <div>
                       
                        <input type="text" class="form-control form-control-sm form-control-border" readonly id="code" name="code" value = <?php echo $code ;?>>
                                <small class="px-3 text-muted">Ticket Code</small>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-sm form-control-border" id="fullname" name="fullname" required placeholder="John Smith">
                                <small class="px-3 text-muted">Requestee's Name</small>
                            </div>
                            <div class="col-md-6">
                                
                                <input type="text" class="form-control form-control-sm form-control-border" id="contact" name="contact" required placeholder="xxxxxxxxxxxxx">
                                <small class="px-3 text-muted">Contact #</small>
                            </div>
                        </div>
                        <div><br></div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-sm form-control-border" id="baptizee" name="baptizee" required placeholder="John Doe">
                                <small class="px-3 text-muted">Husband's Name</small>
                            </div>
                            <div class="col-md-6">
                                <input type="date" id="dob" name="dob" autofocus class="form-control form-control-sm form-control-border" placeholder="Date of Birth" required value="<?= isset($dob) ? $dob : "" ?>">
                                <small class="text-muted px-4">Date of Birth</small>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-sm form-control-border" id="wife" name="wife" required placeholder="Jane Doe">
                                <small class="px-3 text-muted">Wife's Name</small>
                            </div>
                            <div class="col-md-6">
                                <input type="date" id="wdob" name="wdob" autofocus class="form-control form-control-sm form-control-border" placeholder="Date of Birth" required value="<?= isset($dob) ? $dob : "" ?>">
                                <small class="text-muted px-4">Date of Birth</small>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <small class="text-muted">Message</small>
                                <textarea name="message" id="message" rows="4" class="form-control form-control-sm rounded-0" required placeholder="Write your message here"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 text-center">
                            <button type="submit" name="insertrequest" class="btn btn-primary">Request Record</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    $(function(){
        $('#message-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_message",
				data: new FormData($(this)[0]),
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
                        location.reload();
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
        })
    })
</script> -->