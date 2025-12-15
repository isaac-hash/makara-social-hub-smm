<?php
  $form_url = admin_url($controller_name."/store/");
  $form_attributes = array('class' => 'form tutorial-upload-form', 'id' => 'tutorial-upload-form', 'data-redirect' => admin_url($controller_name), 'method' => "POST", 'enctype' => 'multipart/form-data');
  
  $class_element = app_config('template')['form']['class_element'];
  $class_element_editor = app_config('template')['form']['class_element_editor'];
  $config_status = app_config('config')['status'];

  $current_config_status = (in_array($controller_name, $config_status)) ? $config_status[$controller_name] : $config_status['default'];
  $form_status = array_intersect_key(app_config('template')['status'], $current_config_status); 
  $form_status = array_combine(array_keys($form_status), array_column($form_status, 'name')); 
?>

<div id="main-modal-content" class="tutorial_view">
  <div class="">
    <div class="" role="document">
      <div class="mb-3">
        <h4 class=""><i class="fe fe-video"></i> Tutorials</h4>
      </div>
      <div class="row">
        
        <!-- Existing Tutorials List -->
        <div class="col-12 col-lg-6 mb-3 mb-lg-0">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-list"></i> Existing Tutorials</h3>
            </div>
            <div class="card-body" style="max-height: 800px; overflow-y: auto;">
              <?php
                if (!empty($items)) {
              ?>
              <?php
                $i = 0;
                foreach ($items as $key => $item) {
              ?>
                <div class="tutorial-item mb-3">
                  <div class="card">
                    <div class="card-header d-flex flex-column flex-sm-row align-items-start align-items-sm-center">
                      <div class="flex-grow-1 mb-2 mb-sm-0">
                        <h3 class="card-title mb-1"><?=$item['title']?></h3>
                        <small class="text-muted">
                            <?=date("d/m/Y" , strtotime(convert_timezone($item['created'], 'user')))?>
                            <span class="badge badge-<?= ($item['status'] == 1) ? 'success' : 'secondary' ?> ml-2"><?= ($item['status'] == 1) ? 'Active' : 'Inactive' ?></span>
                        </small>
                      </div>
                      <div class="card-options d-flex flex-wrap">
                        <a href="<?=admin_url($controller_name . '/update/' . $item['id'])?>" class="btn btn-sm btn-primary mr-1 mb-1"><i class="fa fa-edit"></i> <span class="d-none d-sm-inline">Edit</span></a>
                        <a href="<?=admin_url($controller_name . '/delete/' . $item['id'])?>" class="btn btn-sm btn-danger ajaxDelete mb-1"><i class="fa fa-trash"></i> <span class="d-none d-sm-inline">Delete</span></a>
                      </div>
                    </div>
                    <div class="card-body desc">
                      <?php if (!empty($item['link'])): ?>
                        <div class="tutorial-video mb-3">
                          <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="<?=$item['link']?>" allowfullscreen></iframe>
                          </div>
                        </div>
                      <?php elseif (!empty($item['video_file_path'])): ?>
                        <div class="tutorial-video mb-3">
                          <video controls class="img-fluid rounded" style="max-height: 400px; width: 100%;">
                              <source src="<?=BASE?><?=$item['video_file_path']?>" type="video/mp4">
                              Your browser does not support the video tag.
                          </video>
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
              <h3 class="card-title"><i class="fa fa-upload"></i> Upload New Tutorial</h3>
            </div>
            <div class="card-body">
              <?php echo form_open($form_url, $form_attributes); ?>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="link">YouTube Embed Link (Optional)</label>
                    <input type="text" name="link" id="link" class="form-control" placeholder="https://www.youtube.com/embed/...">
                    <small class="form-text text-muted">Paste the embed URL here. If provided, file upload will be ignored.</small>
                  </div>

                  <div class="col-12 form-group">
                    <label for="video">Tutorial Video (Optional)</label>
                    <input type="file" name="video" id="video" class="form-control" accept="video/mp4,video/x-m4v,video/*">
                    <small class="form-text text-muted">Maximum file size: 100MB. Allowed formats: MP4, MOV, AVI, WMV</small>
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
                    <label for="status">Status</label>
                    <?php echo form_dropdown('status', $form_status, '1', ['class' => $class_element, 'id' => 'status']); ?>
                  </div>

                  <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-min-width mr-1 mb-1 btn-submit-tutorial">
                      <i class="fa fa-save"></i> Upload Tutorial
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
    
    // Custom AJAX handler for tutorial upload with file
    $(document).on("submit", ".tutorial-upload-form", function(e) {
      e.preventDefault();
      pageOverlay.show();
      
      var form = $(this);
      var formData = new FormData(this);
      var redirect = form.data('redirect');
      var submitBtn = form.find('.btn-submit-tutorial');
      
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
            notify('An error occurred while uploading the tutorial. Please try again.', 'error');
          }, 1000);
        }
      });
      
      return false;
    });

    // Custom AJAX handler for delete
    $(document).on("click", ".ajaxDelete", function(e) {
      e.preventDefault();
      var _that = $(this);
      
      if (!confirm("Are you sure you want to delete this item?")) return false;
      
      var _url = _that.attr("href");
      var _data = $.param({token: token});
      
      pageOverlay.show();
      $.post(_url, _data, function(_result) {
        setTimeout(function() {
          pageOverlay.hide();
          notify(_result.message, _result.status);
          if (_result.status == 'success') {
            setTimeout(function() {
              window.location.reload();
            }, 1500);
          }
        }, 1000);
      }, 'json');
      
      return false;
    });
  });
</script>
