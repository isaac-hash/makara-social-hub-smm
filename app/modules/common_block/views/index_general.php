<?php 
  $show_search_area = show_search_area($controller_name, $params, 'user');
?>
<style>
  /* Desktop - with sidebar offset */
  .responsive-section-header {
    margin-top: 6rem;
    margin-left: 7rem;
  }
  
  .responsive-content-row {
    margin-left: 6rem;
  }
  
  /* Tablet Screens (768px to 991px) */
  @media (max-width: 991px) {
    .responsive-section-header {
      margin-left: 3rem;
      margin-top: 5rem;
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
      margin-top: 4rem;
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
      margin-top: 3.5rem;
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
<div class="lists-index-ajax">
  <?php include('ajax_index_overplay.php'); ?>

  <div class="page-title m-b-20">
    <div class="row justify-content-between responsive-section-header">
      <div class="col-md-2">
        <h1 class="page-title">
          <span class="fe fe-calendar"></span> <?=lang($controller_name)?>
        </h1>
      </div>
      <div class="col-md-4">
        <div class="d-flex">
          <a href="<?=cn("add_funds")?>" class="ml-auto btn btn-outline-primary">
            <span class="fe fe-plus"></span>
              <?=lang("add_new")?>
          </a>
        </div>
      </div>
    </div>
  </div>
 
  <?php 
    $this->load->view('table_blade.php'); 
  ?>
</div>
