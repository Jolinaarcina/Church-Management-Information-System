<?php 
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `message_list` where id ='{$_GET['id']}' ");
    if($qry->num_rows > 0 ){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k=$v;
            }
        }
        if(isset($id) && isset($status) && $status != 1)
        $conn->query("UPDATE `message_list` set status = 1 where id = '{$id}'");
    }
}
?>

<form action="?page=inquiries/updatecode" method="POST">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12">
            <div class="card card-registration card-registration-2" style="border-radius: 15px;">
            <div class="card-body p-0">
                <div class="row g-0">
                <div class="col-lg-6">
                    <div class="p-5">
                    <h3 class="fw-normal mb-5" style="color: #4835d4;">Requestee Infomation</h3>
                    <input type="hidden" name="code" value="<?php echo $code ;?>">
                    <input type="hidden" name="contact" value="<?php echo $contact ;?>">
                    <input type="hidden" name="fullname" value="<?php echo $fullname ;?>">
                    <div class="row">
                        <div class="col-md-12 mb-4 pb-2">

                        <div class="form-outline">
                            <label class="form-label" name="code"><?= isset($code) ? $code : "" ?></label>
                        </div>

                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-4 pb-2">

                        <div class="form-outline">
                            <label class="form-label">Requestee: <?= isset($fullname) ? $fullname : "" ?></label>
                        </div>

                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-4 pb-2">

                        <div class="form-outline">
                            <label class="form-label">Contact #: <?= isset($contact) ? $contact : "" ?></label>
                        </div>

                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-4 pb-2">

                        <div class="form-outline">
                            <label class="form-label">Request Type: <?= isset($type) ? $type : "" ?></label>
                        </div>

                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-4 pb-2">

                        <div class="form-outline">
                            <label class="form-label">Person Requested: <?= isset($baptizee) ? $baptizee : "" ?></label>
                        </div>

                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 mb-4 pb-2">

                        <div class="form-outline">
                            <label class="form-label">Date of Birth: <?= isset($dob) ? $dob : "" ?></label>
                        </div>

                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-4 pb-2">

                        <div class="form-outline">
                            <label class="form-label">Person Requested: <?= isset($wife) ? $wife : "" ?></label>
                        </div>

                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-4 pb-2">

                        <div class="form-outline">
                            <label class="form-label">Date of Birth: <?= isset($wdob) ? $wdob : "" ?></label>
                        </div>

                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-4 pb-2">

                        <div class="form-outline">
                            <label class="form-label">Message: <?= isset($message) ? $message : "" ?></label>
                        </div>

                        </div>
                        
                    </div>

                    </div>
                </div>
                <div class="col-lg-6 bg-indigo text-white">
                    <div class="p-5">
                    <h3 class="fw-normal mb-5">Findings</h3>

                    <div class="mb-8 pb-2">
                        <select class="select" name="decide" id="decide">
                        <option >Resolution</option>
                        <option value="1">Approved</option>
                        <option value="2">Disapproved</option>
                        </select>
                    </div><br><br>

                    <div class="mb-4 pb-2">
                        <div class="form-outline form-white">
                        <textarea name="remarks" id="remarks" rows="8" class="form-control form-control-sm rounded-0" required ></textarea>
                        <label class="form-label" for="form3Examplea2">Remarks</label>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="update">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>


</form>

