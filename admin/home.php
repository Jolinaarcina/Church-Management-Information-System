<style>
    #cover-img{
        object-fit:cover;
        object-position:center center;
        width: 100%;
        height: 100%;
    }
</style>
<h1>Welcome to <?php echo $_settings->info('church_name') ?>'s - Admin Panel</h1>
<hr class="border-info">
<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-book-open"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Baptismal Records</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `baptismal_list` ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
            
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-heart"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Matrimony Records</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `matrimony_list` ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
</div>

<hr>
<div class="w-100" style="height:50vh">
    <img src="<?= validate_image($_settings->info('cover')) ?>" alt="System Cover Image" id="cover-img" class="img-fluid h-100 bg-gradient-dark">
</div>