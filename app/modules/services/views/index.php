<?php
  $items_category = array_column($items_category, 'id', 'name');
  $items_category = array_flip(array_intersect_key($items_category, array_flip(array_keys($items))));
?>
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
<section class="page-title responsive-section-header">
  <div class="row justify-content-between ">
    <div class="col-md-6">
      <h1 class="page-title">
        <i class="fe fe-list" aria-hidden="true"> </i> 
        <?=lang("Services")?>
      </h1>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <select  name="status" class="form-control search-by-category">
          <option value="0"> <?=lang("all")?></option>
          <?php 
            if (!empty($items_category)) {
              foreach ($items_category as $key => $category) {
          ?>
          <option value="<?=$key?>"><?=$category?></option>
          <?php }}?>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <input type="text" name="query" class="form-control " id="service-search" placeholder="<?= lang("Search_for_") ?>" value="">
      </div>          
    </div>
  </div>
</section>
<div class="row m-t-5 responsive-content-row" id="result_ajaxSearch">
  <?php 
    if(!empty($items)){
      $data = array(
        "controller_name"     => $controller_name,
        "params"              => $params,
        "columns"             => $columns,
        "items"               => $items,
      );
      $this->load->view('child/index', $data);
    } else {
      echo show_empty_item();
    }
  ?>
</div>

<script>
  $(document).ready(function() {
    function filterServices() {
      const keyword = $('#service-search').val().trim().toLowerCase();
      const selectedCate = $('.search-by-category').val();
      $('.card').each(function() {
        let anyVisible = false;

        $(this).find('tbody tr.service-item').each(function() {
          const name = $(this).data('name').toLowerCase();
          const id = String($(this).data('id')).toLowerCase();
          const cateId = String($(this).data('cate-id'));

          const matchKeyword = name.includes(keyword) || id.includes(keyword);
          const matchCategory = selectedCate === "0" || cateId === selectedCate;
          if (matchKeyword && matchCategory) {
            $(this).show();
            anyVisible = true;
          } else {
            $(this).hide();
          }
        });
        $(this).toggle(anyVisible);
      });
    }
    $('#service-search').on('input', filterServices);
    $('.search-by-category').on('change', filterServices);
  });

</script>