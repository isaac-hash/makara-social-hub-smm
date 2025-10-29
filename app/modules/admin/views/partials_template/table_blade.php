<?php
  $is_sortable =  false;
  $sortable_attr =  null;
  if (in_array($controller_name, ['category', 'blog_category', 'payments'])) {
    $is_sortable = true;
    $sortable_attr = 'data-sort_table_url="'. admin_url($controller_name . '/' . 'sort_table') .'"';
  }
?>

<style> 

  @media (min-width: 769px) {
    .table-responsive td,
    .table-responsive td a {
      white-space: normal !important;
      word-break: break-word !important;
      overflow-wrap: break-word !important;
      max-width: 300px;
    }
  }
  @media (max-width: 767px) {
    .no-wrap-mobile {
      white-space: nowrap !important;
    }
  }
  .table-responsive .dropdown-menu > a {
    white-space: nowrap !important;
  }
</style>

<div class="row">
  
  <div class="col-md-12 col-xl-12">
    <div class="card">
      <!-- Card headers -->
      <?php include('list_card_header.php'); ?>

      <div class="table-responsive <?= $is_sortable ? 'sortable-content' : ''?>">
        <table class="<?= get_table_class(); ?>" <?= $is_sortable ? $sortable_attr : ''?>>
          <?php echo $table_thead_html; ?>
          <tbody id="table-body">
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
  <div id="pagination">
  </div>
  
</div>

