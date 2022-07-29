<div class="content py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-outline card-primary rounded-0 shadow">
                <div class="card-header rounded-0">
                        <h4 class="card-title">Search Confirmation Record</h4>
                </div>
                <div class="card-body">
                    <form action="" id="search_record">
                        
                        <div class="form-group">
                            <label for="name" class="control-label text-navy">Child's Name</label>
                            <input type="text" class="form-control form-control-border" placeholder="Search by Child's Name" name="name">
                            <small class="px-2 text-muted"><em>Format: (Last Name, First Name Middle Name)</em></small>
                        </div>
                        <div class="form-group mt-3 text-center">
                            <button class="btn btn-primary btn-flat col-4"><i class="fa fa-search"></i> Search Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#search_record').submit(function(e){
            e.preventDefault()
            if($('[name="code"]').val() == '' && $('[name="name"]').val() == ''){
                alert_toast("Search Fields are empty","error");
                return false;
            }
            location.href="./?page=confirmation_result&"+$(this).serialize();
        })
    })
</script>