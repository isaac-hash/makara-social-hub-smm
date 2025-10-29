<?php 
  $show_search_area = show_search_area($controller_name, $params);
?>
<div class="lists-index-ajax">
  <?php include('ajax_index_overplay.php'); ?>
  <div class="page-title m-b-20">
    <div class="row justify-content-between">
      <div class="col-md-2">
        <h1 class="page-title">
            <span class="fa fa-list-ul"></span> <?php echo ucfirst($controller_name)?>
        </h1>
      </div>
      
      <div class="col-md-12">
        <div class="row justify-content-between">
          <div class="col-md-8" id="btn-filter-group">
            <?php 
            
              // echo $show_filter_status_button; 
            
            ?>
          </div>
          <div class="col-md-4 search-area">
            <?php echo $show_search_area; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php 
    $this->load->view('../partials_template/table_blade.php'); 
  ?>
</div>
