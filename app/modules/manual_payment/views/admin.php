<div class="page-header">
  <h1 class="page-title">
    Manual Payment Receipts
  </h1>
</div>

<div class="row" id="result_ajaxSearch">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Receipts List</h3>
      </div>
      <div class="table-responsive">
        <table class="table table-hover table-bordered table-vcenter card-table">
          <thead>
            <tr>
              <th>User ID</th>
              <th>Amount</th>
              <th>Receipt</th>
              <th>Status</th>
              <th>Created At</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($receipts)) {
                foreach ($receipts as $receipt) {
                    // echo $receipt;
                    echo "<script>console.log('Receipt:', " . json_encode($receipt) . ");</script>";
                }
            } else {
                echo '<script>console.log("No receipts found.");</script>';
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
