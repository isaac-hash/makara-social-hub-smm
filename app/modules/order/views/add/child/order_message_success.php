<style>
  .order-success-modal .modal-header {
    background-color: #005c68;
    color: #fff;
  }
  .order-success-modal .modal-header .close {
    color: #fff;
    opacity: 0.8;
  }
  .order-success-modal .modal-header .close:hover {
    opacity: 1;
  }
  .order-success-modal .modal-body {
    box-shadow: rgb(29 39 59 / 4%) 0 2px 4px 0 !important;
  }
  .order-success-modal .order-detail-list {
    list-style: none;
    padding-left: 0;
  }
  .order-success-modal .order-detail-list li {
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
  }
  .order-success-modal .order-detail-list li:last-child {
    border-bottom: none;
  }
  .order-success-modal .order-detail-list li span {
    font-weight: 600;
    color: #005c68;
  }
</style>

<!-- Order Success Modal -->
<div class="modal fade order-success-modal" id="orderSuccessModal" tabindex="-1" role="dialog" aria-labelledby="orderSuccessModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderSuccessModalLabel">
          <i class="fe fe-check-circle"></i> <?php echo lang('order_received'); ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
          <p class="lead" style="color: black;"><?php echo lang('thank_you_your_order_has_been_received'); ?></p>
        </div>
        <ul class="order-detail-list">
          <li class="id" style="color: black;"><?php echo lang('order_id'); ?>: <span></span></li>
          <li class="service_name" style="color: black;"><?php echo lang('service_name'); ?>: <span></span></li>
          <li class="link" style="color: black;"><?php echo lang('Link'); ?>: <span></span></li>
          <li class="quantity" style="color: black;"><?php echo lang('Quantity'); ?>: <span></span></li>
          <li class="username" style="color: black;"><?php echo lang('Username'); ?>: <span></span></li>
          <li class="posts" style="color: black;"><?php echo lang('Posts'); ?>: <span></span></li>
          <li class="charge" style="color: black;"><?php echo lang('Charge'); ?>: <span></span></li>
          <li class="balance" style="color: black;"><?php echo lang('Balance'); ?>: <span></span></li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="window.location.href = '<?= cn('statistics') ?>';">Go back to dashboard</button>
      </div>
    </div>
  </div>
</div>

<script>
// Ensure modal close buttons work properly
$(document).ready(function() {
    // Handle close button clicks
    $(document).on('click', '#orderSuccessModal [data-bs-dismiss="modal"]', function(e) {
        e.preventDefault();
        $('#orderSuccessModal').modal('hide');
    });
    
    // Handle backdrop click
    $('#orderSuccessModal').on('click', function(e) {
        if ($(e.target).hasClass('modal')) {
            $(this).modal('hide');
        }
    });
    
    // Handle ESC key
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape' && $('#orderSuccessModal').hasClass('show')) {
            $('#orderSuccessModal').modal('hide');
        }
    });
});
</script>
