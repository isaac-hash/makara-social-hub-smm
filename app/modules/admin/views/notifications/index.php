<div class="page-header">
  <h1 class="page-title">
    <i class="fe fe-bell" aria-hidden="true"></i> <?php echo lang("Notifications"); ?>
  </h1>
</div>

<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Send Notification</h3>
        </div>
        <div class="card-body">
            <form class="actionForm" action="<?php echo admin_url($controller_name . '/send'); ?>" method="POST">
                <div class="form-group">
                    <label class="form-label">Select User</label>
                    <select name="uids" class="form-control ajaxSearchUser">
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Subject</label>
                    <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div>

                <div class="form-group">
                    <label class="form-label">Message</label>
                    <textarea class="form-control" name="message" rows="5" placeholder="Enter your message here..."></textarea>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Send Notification</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        if (typeof $.fn.select2 === 'undefined') {
            console.error('Select2 is not loaded!');
            return;
        }

        $(".ajaxSearchUser").select2({
            ajax: {
                url: "<?php echo admin_url("users/search"); ?>",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            placeholder: 'Search for a user (Email or Name)',
            minimumInputLength: 1,
            width: '100%' // Fix styling issue
        });
    });
</script>
