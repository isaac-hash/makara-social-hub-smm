<style>
  /* Desktop - with sidebar offset */
  .responsive-section-header {
    margin-top: 9rem;
    margin-left: 9rem;
  }
  
  .responsive-content-row {
    margin-left: 6rem;
  }
  
  /* Tablet Screens (768px to 991px) */
  @media (max-width: 991px) {
    .responsive-section-header {
      margin-left: 5rem;
      margin-top: 7rem;
    }
    
    .responsive-content-row {
      margin-left: 2.5rem;
      margin-right: 1rem;
    }
  }
  
  /* Mobile Screens (below 768px) */
  @media (max-width: 767px) {
    .responsive-section-header {
      margin-left: 0;
      margin-right: 0;
      margin-top: 6rem;
      padding-left: 1rem;
      padding-right: 1rem;
    }
    
    .responsive-content-row {
      margin-left: 0;
      margin-right: 0;
      padding-left: 0.5rem;
      padding-right: 0.5rem;
    }
    
    .responsive-content-row .card {
      margin-bottom: 1rem;
    }
  }
  
  /* Extra Small Screens (below 576px) */
  @media (max-width: 575px) {
    .responsive-section-header {
      margin-top: 6rem;
      padding-left: 0.75rem;
      padding-right: 0.75rem;
    }
    
    .responsive-section-header .page-title {
      font-size: 1.25rem;
    }
    
    .responsive-content-row {
      padding-left: 0.25rem;
      padding-right: 0.25rem;
    }
    
    .responsive-content-row .card-body {
      padding: 1rem;
    }
    
    /* Adjust search area on mobile */
    .search-area {
      margin-top: 1rem;
    }
    
    .search-area .input-group {
      width: 100%;
    }
  }
  
  /* When sidebar is collapsed or hidden */
  @media (min-width: 768px) {
    body.sidebar-collapsed .responsive-section-header,
    body.sidebar-hidden .responsive-section-header {
      margin-left: 1rem;
    }
    
    body.sidebar-collapsed .responsive-content-row,
    body.sidebar-hidden .responsive-content-row {
      margin-left: 0.5rem;
    }
  }
</style>



<?php
  if ($active_payments) : ?>
<section class="add-funds m-t-30 responsive-section-header" >   
  <div class="container-fluid">
    <div class="row justify-content-md-center" id="result_ajaxSearch">
      <div class="col-md-12 responsive-content-row">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <div class="tabs-list">
              <ul class="nav nav-tabs">
                <?php
                  $i = 0;
                  foreach ($active_payments as $key => $row) {
                    if ($row) {
                      $i++;
                ?>
                <li class="m-t-10">
                  <a class="<?php echo ($i == 1) ? 'active show' : ''?>" data-toggle="tab" href="#<?php echo $row['type'] ?>"><i class="fa fa-credit-card"></i> <?= esc($row['name']); ?></a>
                </li>
                <?php }} ?>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <?php
                $i = 0;
                foreach ($active_payments as $key => $row) {
                  $i++;
              ?>
                <div id="<?php echo $row['type']; ?>" class="tab-pane fade  <?php echo ($i == 1) ? 'in active show' : ''?>">
                  <?php
                    $this->load->view($row['type'].'/index', ['payment_id' => $row['id'], 'payment_params' => $row['params']]);
                  ?>
                </div>  
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<style>
  .page-title h1{
    margin-bottom: 5px; }
    .page-title .border-line {
      height: 5px;
      width: 270px;
      background: #eca28d;
      background: -webkit-linear-gradient(45deg, #eca28d, #f98c6b) !important;
      background: -moz- oldlinear-gradient(45deg, #eca28d, #f98c6b) !important;
      background: -o-linear-gradient(45deg, #eca28d, #f98c6b) !important;
      background: linear-gradient(45deg, #eca28d, #f98c6b) !important;
      position: relative;
      border-radius: 30px; }
    .page-title .border-line::before {
      content: '';
      position: absolute;
      left: 0;
      top: -2.7px;
      height: 10px;
      width: 10px;
      border-radius: 50%;
      background: #fa6d7e;
      -webkit-animation-duration: 6s;
      animation-duration: 6s;
      -webkit-animation-timing-function: linear;
      animation-timing-function: linear;
      -webkit-animation-iteration-count: infinite;
      animation-iteration-count: infinite;
      -webkit-animation-name: moveIcon;
      animation-name: moveIcon; }

  @-webkit-keyframes moveIcon {
    from {
      -webkit-transform: translateX(0);
    }
    to { 
      -webkit-transform: translateX(215px);
    }
  }
</style>
<?php
  if (get_option("is_active_manual")) {
?>
<section class="add-funds m-t-30">   
  <div class="container-fluid">
    <div class="row justify-content-center m-t-50">
      <div class="col-md-8">
        <div class="page-title m-b-30">
          <h1><i class="fa fa-hand-o-right"></i> 
            <?php echo lang('manual_payment'); ?>
          </h1>
          <div class="border-line"></div>
        </div>
        <div class="content m-t-30">
          <?php echo htmlspecialchars_decode(get_option('manual_payment_content', ''), ENT_QUOTES)?>
        </div>
      </div> 
    </div>

  </div>
</section>
<?php }?>


