<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `baptismal_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }

        $details_qry = $conn->query("SELECT * FROM `baptismal_details` where baptismal_id = '{$id}'");
        while($row = $details_qry->fetch_assoc()){
            ${$row['meta_field']} = $row['meta_value'];
        }
    }else{
    echo "<script>alert('Unknown Baptismal ID'); location.replace('./?page=records');</script>";
    }
}
else{
    echo "<script>alert('Baptismal ID is required'); location.replace('./?page=records');</script>";
}
?>
<div class="content py-3">
    <div class="card card-outline card-dark rounded-0">
        <div class="card-header rounded-0">
            <h5 class="card-title text-primary">Baptismal Details</h5>
            
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div id="outprint">
                <img src='<?= validate_image($_settings->info('logo')) ?>' id='print-logo' />
                <div class='mx-5 py-4'>
                    <h1 class='text-center mb-1'>Certificate of Baptism</h1>
                    <h3 class='text-center mb-1'><?= $_settings->info('church_name') ?></h3>
                    <center><small class='text-muted'><?= $_settings->info('address') ?></small></center>
                </div>
                <hr class='border-navy '>
                    <fieldset>
                        <div class="row justify-content-end" >
                            <div class="form-group col-auto my-0">
                            <label for="" class="control-label text-info">Baptismal Code: </label><u class="px-3"><?= $code ?></u>
                            </div>
                        </div>
                        <div class="row justify-content-end my-0">
                            <div class="form-group col-auto">
                            <label for="" class="control-label text-info">Date Baptised: </label><u class="px-3"><?= date("F d, Y",strtotime($date)) ?></u>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend class="text-info">Baptizee's Information</legend>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto pr-2">
                                        <b>Place of Birth:</b>
                                    </div>
                                    <div class="col-auto flex-grow-1 pl-1 border-bottom border-dark">
                                        <?= ($place_of_birth) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <hr class="">
                    <fieldset>
                        <legend class="text-info">Parents Information</legend>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto pr-2">
                                        <b>Father's Name:</b>
                                    </div>
                                    <div class="col-auto flex-grow-1 pl-1 border-bottom border-dark">
                                        <?= ucwords($father_name) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto pr-2">
                                        <b>Mother's Maiden Name:</b>
                                    </div>
                                    <div class="col-auto flex-grow-1 pl-1 border-bottom border-dark">
                                        <?= ucwords($mother_name) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto pr-2">
                                        <b>Residence:</b>
                                    </div>
                                    <div class="col-auto flex-grow-1 pl-1 border-bottom border-dark">
                                        <?= ($address) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <hr class="">
                    <fieldset>
                        <legend class="text-info">Witnesses/Godparents</legend>
                        <table class="table table-bordered table-stripped">
                            <colgroup>
                                <col width="30%">
                                <col width="70%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="px-2 py-1 text-center">Name</th>
                                    <th class="px-2 py-1 text-center">Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $witnesses = $conn->query("SELECT * FROM `witness_list` where baptismal_id = '{$id}'");
                                    while($row = $witnesses->fetch_assoc()):
                                ?>
                                <tr>
                                    <td class="px-2 py-1 align-center"><?= ucwords($row['fullname']) ?></td>
                                    <td class="px-2 py-1 align-center text-center"><?= $row['address'] ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </fieldset>
                    <fieldset>
                        <legend class="text-info">Other Information</legend>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto pr-2">
                                        <b>Place of Baptism:</b>
                                    </div>
                                    <div class="col-auto flex-grow-1 pl-1 border-bottom border-dark">
                                        <?= ($place_of_baptism) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto pr-2">
                                        <b>Minister:</b>
                                    </div>
                                    <div class="col-auto flex-grow-1 pl-1 border-bottom border-dark">
                                        <?= ucwords($officient) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-end">
                                    <div class="col-auto pr-2">
                                        <b>Religion:</b>
                                    </div>
                                    <div class="col-auto flex-grow-1 pl-1 border-bottom border-dark">
                                        <?= strtoupper($_settings->info('religion')) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
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
            // _p.prepend("<hr class='border-navy '>")
            // _p.prepend("<div class='mx-5 py-4'><h1 class='text-center'><?= $_settings->info('church_name') ?></h1>"
            //             +"<center><small class='text-muted'><?= $_settings->info('address') ?></small></center></div>")
            // _p.prepend("<img src='<?= validate_image($_settings->info('logo')) ?>' id='print-logo' />")
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
</script>