<style>
  .user-img{
        position: absolute;
        height: 27px;
        width: 27px;
        object-fit: cover;
        left: -7%;
        top: -12%;
  }
  .btn-rounded{
        border-radius: 50px;
  }
</style>
<!-- Navbar -->
      <style>
        #login-nav {
          position: fixed !important;
          top: 0 !important;
          z-index: 1037;
          padding: 0.3em 2.5em !important;
        }
        #top-Nav{
          top: 2.3em;
        }
        .text-sm .layout-navbar-fixed .wrapper .main-header ~ .content-wrapper, .layout-navbar-fixed .wrapper .main-header.text-sm ~ .content-wrapper {
          margin-top: calc(3.6) !important;
          padding-top: calc(3.2em) !important
      }
      </style>
      <nav class="main-header navbar navbar-expand navbar-dark border-0 text-sm bg-gradient-lightblue" id='top-Nav'>
        
        <div class="container">
          <a href="./" class="navbar-brand">
            <img src="<?php echo validate_image($_settings->info('logo'))?>" alt="Site Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span><?= $_settings->info('church_name') ?></span>
          </a>

          <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a href="./" class="nav-link <?= isset($page) && $page =='home' ? "active" : "" ?>">Home</a>
              </li>

              <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Transactions</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item <?= isset($page) && $page =='search_record' ? "active" : "" ?>" href="./?page=search_record">Search Baptismal Records</a>
                  <a class="dropdown-item <?= isset($page) && $page =='search_wed' ? "active" : "" ?>" href="./?page=search_wed">Search Matrimony Records</a>
                  <a class="dropdown-item <?= isset($page) && $page =='search_confimation' ? "active" : "" ?>" href="./?page=search_confirmation">Search Confirmation Records</a>
                  <a class="dropdown-item <?= isset($page) && $page =='view_request' ? "active" : "" ?>" href="./?page=request">View Request</a>
                  
                </div>
              </li>
              <li class="nav-item">
                <a href="./?page=mass_guide" class="nav-link <?= isset($page) && $page =='mass_guide' ? "active" : "" ?>">Mass Guide</a>
              </li>
              <li class="nav-item">
                <a href="./calendar" class="nav-link <?= isset($page) && $page =='calendar' ? "active" : "" ?>">Calendar Events</a>
              </li>
              <li class="nav-item">
                <a href="./?page=about" class="nav-link <?= isset($page) && $page =='about' ? "active" : "" ?>">About Us</a>
              </li>
              <!-- <li class="nav-item">
                <a href="./?page=contact_us" class="nav-link <?= isset($page) && $page =='contact_us' ? "active" : "" ?>">Contact Us</a>
              </li> -->
              <!-- <li class="nav-item">
                <a href="#" class="nav-link">Contact</a>
              </li> -->
            </ul>

            
          </div>
          <!-- Right navbar links -->
          <div class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          </div>
        </div>
      </nav>
      <!-- /.navbar -->
      <script>
        $(function(){
          
        })
      </script>