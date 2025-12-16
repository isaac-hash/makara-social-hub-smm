<section class="page-title responsive-section-header">
  <div class="row justify-content-between">
    <div class="col-md-6">
      <h1 class="page-title d-flex">
        <a href="<?=cn($controller_name . "/add")?>" class="d-inline-block d-sm-none ajaxModal "><span class="add-new" data-toggle="tooltip" data-placement="bottom" title="<?=lang("add_new")?>" data-original-title="Add new"><i class="fe fe-plus-square text-primary" aria-hidden="true"></i></span></a> 
        <span class="d-none d-sm-block"><i class="fa fa-comments-o text-primary" aria-hidden="true"></i></span> 
        &nbsp;<h1>Notifications</h1>
      </h1>
    </div>
    <div class="col-md-3">
      <div class="form-group search-area">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="<?=lang('Search_for_')?>" value="">
            <button class="btn btn-primary btn-square btn-search" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Search" type="button"><span class="fe fe-search"></span></button>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="row justify-content-end responsive-content-row">

  <div class="col-12">
    <div class="row" id="result_ajaxSearch">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="color: black;"><i class="fe fe-list"></i> <?=lang("Lists")?></h3>
            <div class="card-options">
              <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
              <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
            </div>
          </div>
          <div class="card-body o-auto" style="height: calc(100vh - 180px); background-color: var(--background-color); color: var(--text-color);">
            <?php if(!empty($items)){?>
              <div class="ticket-lists">
                <?php
                  foreach ($items as $key => $item) {
                    $this->load->view('child/index', ['controller_name' => $controller_name, 'item' => $item]);
                  }
                ?>
              </div>
            <?php }else{
              echo show_empty_item();
            }?>  
          </div>
        </div>
      </div>
      <?php echo show_pagination($pagination); ?> 
    </div>
  </div>
</div>

<!-- Responsive Styles -->
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