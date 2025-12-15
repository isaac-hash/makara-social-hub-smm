<?php
$form_url = admin_url($controller_name . "/store/");
$form_attributes = ['class' => 'form actionForm', 'data-redirect' => admin_url($controller_name), 'method' => "POST", 'enctype' => 'multipart/form-data'];
$item = (isset($item)) ? $item : null;
$class_element_editor = app_config('template')['form']['class_element_editor'];
?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fe fe-edit"></i> Edit Tutorial</h3>
        <div class="card-options">
            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
        <?php echo form_open($form_url, $form_attributes); ?>
        <div class="form-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title"><?= lang("Title") ?></label>
                        <input class="form-control" type="text" name="title" id="title" placeholder="Enter title" value="<?=!empty($item['title']) ? $item['title'] : ''?>">
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description"><?= lang("Description") ?></label>
                        <textarea class="<?=$class_element_editor?>" name="description" id="description" rows="3" placeholder="Enter description"><?=!empty($item['description']) ? $item['description'] : ''?></textarea>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="link">YouTube Embed Link (Optional)</label>
                        <input class="form-control" type="text" name="link" id="link" placeholder="Enter YouTube Embed URL" value="<?=!empty($item['link']) ? $item['link'] : ''?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="video">Tutorial Video (optional)</label>
                        <input type="file" class="form-control" name="video" id="video" accept="video/mp4,video/x-m4v,video/*">
                        <small class="text-muted">Upload new video to replace the current one.</small>
                        
                        <?php if (!empty($item['link'])): ?>
                             <div class="mt-2">
                                <label>Current Content (YouTube):</label>
                                <div class="embed-responsive embed-responsive-16by9" style="max-width: 300px;">
                                    <iframe class="embed-responsive-item" src="<?=$item['link']?>" allowfullscreen></iframe>
                                </div>
                            </div>
                        <?php elseif (!empty($item['video_file_path'])): ?>
                            <div class="mt-2">
                                <label>Current Video:</label>
                                <div class="embed-responsive embed-responsive-16by9" style="max-width: 300px;">
                                    <video controls class="embed-responsive-item">
                                        <source src="<?=BASE . $item['video_file_path']?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status"><?= lang("Status") ?></label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" <?= (isset($item['status']) && $item['status'] == 1) ? 'selected' : '' ?>><?= lang("Active") ?></option>
                            <option value="0" <?= (isset($item['status']) && $item['status'] == 0) ? 'selected' : '' ?>><?= lang("Inactive") ?></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty($item['id'])): ?>
            <input type="hidden" name="id" value="<?=$item['id']?>">
        <?php endif; ?>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-min-width mr-1 mb-1"><?= lang("Save") ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        plugin_editor('.plugin_editor', {height: 200});
    });
</script>
