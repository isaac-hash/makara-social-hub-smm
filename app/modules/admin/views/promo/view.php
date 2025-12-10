<?php
  $form_url = admin_url($controller_name."/store/");
  $form_attributes = array('class' => 'form promo-upload-form', 'id' => 'promo-upload-form', 'data-redirect' => admin_url($controller_name), 'method' => "POST", 'enctype' => 'multipart/form-data');
  
  $class_element = app_config('template')['form']['class_element'];
  $class_element_editor = app_config('template')['form']['class_element_editor'];
  $config_status = app_config('config')['status'];

  $current_config_status = (in_array($controller_name, $config_status)) ? $config_status[$controller_name] : $config_status['default'];
  $form_status = array_intersect_key(app_config('template')['status'], $current_config_status); 
  $form_status = array_combine(array_keys($form_status), array_column($form_status, 'name')); 
?>

<div id="main-modal-content" class="promo_view">
  <div class="">
    <div class="" role="document">
      <div class="mb-3">
        <h4 class=""><i class="fe fe-award"></i> <?=lang("promo")?></h4>
      </div>
      <div class="row">
        
        <!-- Existing Promos List -->
        <div class="col-12 col-lg-6 mb-3 mb-lg-0">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-list"></i> Existing Promos</h3>
            </div>
            <div class="card-body" style="max-height: 600px; overflow-y: auto;">
              <?php
                if (!empty($items)) {
              ?>
              <?php
                $i = 0;
                foreach ($items as $key => $item) {
              ?>
                <div class="promo-item mb-3">
                  <div class="card">
                    <div class="card-header d-flex flex-column flex-sm-row align-items-start align-items-sm-center">
                      <div class="flex-grow-1 mb-2 mb-sm-0">
                        <h3 class="card-title mb-1"><?=$item['title']?></h3>
                        <small class="text-muted"><?=date("d/m/Y" , strtotime(convert_timezone($item['created'], 'user')))?></small>
                      </div>
                      <div class="card-options d-flex flex-wrap">
                        <a href="<?=admin_url($controller_name . '/update/' . $item['id'])?>" class="btn btn-sm btn-primary mr-1 mb-1"><i class="fa fa-edit"></i> <span class="d-none d-sm-inline">Edit</span></a>
                        <a href="<?=admin_url($controller_name . '/delete/' . $item['id'])?>" class="btn btn-sm btn-danger ajaxModal mb-1"><i class="fa fa-trash"></i> <span class="d-none d-sm-inline">Delete</span></a>
                      </div>
                    </div>
                    <div class="card-body desc">
                      <?php if (!empty($item['image'])): ?>
                        <div class="promo-image mb-3">
                          <img src="<?=BASE?><?=$item['image']?>" alt="<?=htmlspecialchars($item['alt'] ?? $item['title'], ENT_QUOTES)?>" class="img-fluid rounded" style="max-height: 400px;">
                        </div>
                      <?php endif; ?>
                      <?=htmlspecialchars_decode($item['description'], ENT_QUOTES)?>
                    </div>
                  </div>
                </div>
              <?php }}else{ 
                echo show_empty_item(); 
              }?>
            </div>
          </div>
        </div>
        
        <!-- Upload Form -->
        <div class="col-12 col-lg-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-upload"></i> Upload New Promo</h3>
            </div>
            <div class="card-body">
              <?php echo form_open($form_url, $form_attributes); ?>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="promo">Promo Image <span class="text-danger">*</span></label>
                    <input type="file" name="promo" id="promo" class="form-control" accept="image/*" required>
                    <small class="form-text text-muted">Maximum file size: 10MB. Allowed formats: JPG, PNG, GIF</small>
                  </div>

                  <div class="col-12 form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="<?=$class_element?>" required>
                  </div>

                  <div class="col-12 form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="<?=$class_element_editor?>" rows="4"></textarea>
                  </div>

                  <div class="col-12 form-group">
                    <label for="alt">Image Alt Text</label>
                    <input type="text" name="alt" id="alt" class="<?=$class_element?>" placeholder="Alternative text for the image">
                  </div>

                  <div class="col-12 form-group">
                    <label for="status">Status</label>
                    <?php echo form_dropdown('status', $form_status, '1', ['class' => $class_element, 'id' => 'status']); ?>
                  </div>

                  <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-min-width mr-1 mb-1 btn-submit-promo">
                      <i class="fa fa-save"></i> Upload Promo
                    </button>
                    <button type="reset" class="btn btn-secondary mb-1">
                      <i class="fa fa-undo"></i> Reset
                    </button>
                  </div>
                </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    plugin_editor('.plugin_editor', {height: 200});
    
    // Custom AJAX handler for promo upload with file
    $(document).on("submit", ".promo-upload-form", function(e) {
      e.preventDefault();
      pageOverlay.show();
      
      var form = $(this);
      var formData = new FormData(this);
      var redirect = form.data('redirect');
      var submitBtn = form.find('.btn-submit-promo');
      
      // Add token
      formData.append('token', token);
      
      // Disable submit button
      submitBtn.prop('disabled', true).addClass('btn-loading');
      
      $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
          setTimeout(function() {
            pageOverlay.hide();
            submitBtn.prop('disabled', false).removeClass('btn-loading');
            
            if (response.status == 'success') {
              notify(response.message, response.status);
              setTimeout(function() {
                if (typeof redirect != "undefined") {
                  reloadPage(redirect);
                }
              }, 1500);
            } else {
              notify(response.message, response.status);
            }
          }, 1000);
        },
        error: function(xhr, status, error) {
          setTimeout(function() {
            pageOverlay.hide();
            submitBtn.prop('disabled', false).removeClass('btn-loading');
            notify('An error occurred while uploading the promo. Please try again.', 'error');
          }, 1000);
        }
      });
      
      return false;
    });
  });
</script>
