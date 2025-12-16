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
    $item_created  = show_item_datetime($item['created'], 'long');
    $item_status        = show_item_status($controller_name, $item['id'], $item['status'], '');
?>
<div class="row responsive-section-header">
    <div class="col-12 col-md-4 mb-3 mb-md-0">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="color: black;">
                    <i class="fe fe-info-circle text-primary"></i> Notification #<?php echo $item['id']; ?>
                </h3>
            </div>
            <div class="card-body">
                <div class="notification-details">
                    <div class="table-responsive">
                        <table class="table table-borderless table-sm mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted" style="width: 40%;"><?=lang("Status")?></td>
                                    <td><?php echo $item_status; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><?=lang("Name")?></td>
                                    <td><?php echo esc($item['first_name'] . ' ' .$item['last_name']); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><?=lang("Email")?></td>
                                    <td class="text-break"><?php echo esc($item['email']); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><?=lang("Created")?></td>
                                    <td><?php echo $item_created; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="color: black;">
                    <i class="fe fe-bell text-primary" style="color: black;"></i> <?php echo esc($item['subject']); ?>
                </h3>
                <div class="card-options">
                    <span class="text-muted small">
                        <i class="fe fe-clock"></i> <?php echo show_item_datetime($item['created'], 'long'); ?>
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="notification-content" style="color: black;">
                    <?php echo nl2br(esc($item['description'])); ?>
                </div>
            </div>
        </div>
    </div>
</div>
