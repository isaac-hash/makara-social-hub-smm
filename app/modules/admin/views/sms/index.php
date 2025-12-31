<?php
  $form_url = admin_url($controller_name."/send/");
  $form_attributes = array('class' => 'form actionForm', 'id' => 'sms-send-form', 'data-redirect' => '', 'method' => "POST");
  $class_element = app_config('template')['form']['class_element'];
?>

<div class="page-header">
  <h1 class="page-title">
    <i class="fe fe-smartphone" aria-hidden="true"></i> <?php echo lang("Send SMS"); ?>
  </h1>
</div>

<div class="row">
  <div class="col-12 col-lg-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fe fe-send"></i> Compose Message</h3>
      </div>
      <div class="card-body">
        <?php if (!$api_configured): ?>
          <div class="alert alert-warning">
            <i class="fe fe-alert-triangle"></i> <strong>API Key Not Configured!</strong>
            <p class="mb-0 mt-2">Please add your Brevo API key in Settings > Other to send SMS messages.</p>
          </div>
        <?php endif; ?>

        <?php echo form_open($form_url, $form_attributes); ?>
          <div class="form-group">
            <label class="form-label">Sender Name <span class="text-danger">*</span></label>
            <input type="text" name="sender" class="<?=$class_element?>" maxlength="11" value="<?=get_option('website_name', 'MyShop')?>" required>
            <small class="form-text text-muted">Max 11 characters</small>
          </div>

          <div class="form-group">
            <label class="form-label">Phone Number <span class="text-danger">*</span></label>
            <input type="text" name="recipient" class="<?=$class_element?>" placeholder="e.g. 2348012345678" required>
            <small class="form-text text-muted">Include country code without + sign</small>
          </div>

          <div class="form-group">
            <label class="form-label">Message <span class="text-danger">*</span></label>
            <textarea name="content" id="sms-content" class="<?=$class_element?>" rows="4" maxlength="160" placeholder="Enter your message here..." required></textarea>
            <small class="form-text text-muted"><span id="char-count">0</span>/160 characters</small>
          </div>

          <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block" <?=!$api_configured ? 'disabled' : ''?>>
              <i class="fe fe-send"></i> Send SMS
            </button>
          </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>

  <div class="col-12 col-lg-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fe fe-info"></i> Quick Links</h3>
      </div>
      <div class="card-body">
        <div class="list-group">
          <a href="<?=admin_url('sms/history')?>" class="list-group-item list-group-item-action">
            <i class="fe fe-bar-chart-2"></i> View SMS History & Statistics
          </a>
          <a href="<?=admin_url('settings/other')?>" class="list-group-item list-group-item-action">
            <i class="fe fe-settings"></i> Configure Brevo API Key
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  $('#sms-content').on('input', function() {
    var count = $(this).val().length;
    $('#char-count').text(count);
    if (count > 140) {
      $('#char-count').addClass('text-warning');
    } else {
      $('#char-count').removeClass('text-warning');
    }
  });
});
</script>
