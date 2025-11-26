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


<div class="page-header responsive-section-header">
  <h1 class="page-title">
    My Payment Receipts
  </h1>
</div>

<div class="row responsive-content-row" id="result_ajaxSearch">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title" style="color: black;">My Receipts</h3>
      </div>
      <div class="table-responsive">
        <table class="table table-hover table-bordered table-vcenter card-table" style="background-color: var(--background-color); color: var(--text-color);">
          <thead>
            <tr>
              <th>Amount</th>
              <th>Receipt</th>
              <th>Status</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($receipts)) {
                foreach ($receipts as $receipt) {
                    // echo $receipt;
                    // echo "<script>console.log('Receipt:', " . json_encode($receipt) . ");</script>";
                }
            } else {
                // echo 'No receipts found.';
            } ?>
           
            <?php if (!empty($receipts)) {
                foreach ($receipts as $receipt) {
            ?>
            <tr>
              <td><?php echo $receipt['amount']; ?></td>
              <td><a href="<?php echo base_url($receipt['receipt_path']); ?>" target="_blank">View Receipt</a></td>
              <td><?php echo ucfirst($receipt['status']); ?></td>
              <td><?php echo $receipt['created_at']; ?></td>
            </tr>
            <?php } } else { ?>
            <tr>
              <td colspan="4" class="text-center">No receipts found.</td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
