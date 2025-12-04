<?php
$form_url = admin_url($controller_name . "/store/");
$form_attributes = ['class' => 'form actionForm', 'data-redirect' => admin_url($controller_name), 'method' => "POST", 'enctype' => 'multipart/form-data'];
?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= lang("update_promo") ?></h3>
        <div class="card-options">
            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
        <?php echo form_open($form_url, $form_attributes); ?>
        <div class="form-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title"><?= lang("Title") ?></label>
                        <input class="form-control" type="text" name="title" id="title" placeholder="Enter title">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="alt"><?= lang("Image_Alt_Text") ?></label>
                        <input class="form-control" type="text" name="alt" id="alt" placeholder="Enter image alt text">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description"><?= lang("Description") ?></label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter description"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="promo"><?= lang("Promo_Image") ?></label>
                        <input type="file" class="form-control" name="promo" id="promo">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status"><?= lang("Status") ?></label>
                        <select name="status" id="status" class="form-control">
                            <option value="1"><?= lang("Active") ?></option>
                            <option value="0"><?= lang("Inactive") ?></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-min-width mr-1 mb-1"><?= lang("Save") ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
