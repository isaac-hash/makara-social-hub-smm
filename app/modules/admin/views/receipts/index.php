<div class="page-header">
  <h1 class="page-title">
    <i class="fe fe-file-text"></i> <?php echo $controller_title; ?>
  </h1>
</div>

<div class="row" id="result_ajaxSearch">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><?=lang("Lists")?></h3>
      </div>
      <div class="table-responsive">
        <table class="table table-hover table-bordered table-vcenter card-table">
          <?php echo render_table_thead($columns); ?>
          <tbody>
            <?php if (!empty($items)) {
              foreach ($items as $key => $item) {
            ?>
            <tr class="tr_<?php echo esc($item['ids']); ?>">
              <td><?php echo show_item_check_box('check_item', $item['ids']); ?></td>
              <td><?php echo $key + 1; ?></td>
              <td><?php echo esc($item['user_email']); ?></td>
              <td class="text-center"><?php echo currency_format($item['amount'], get_option("currency_code", "USD")); ?></td>
              <td class="text-center">
                <a href="<?php echo base_url($item['receipt_path']); ?>" target="_blank">View Receipt</a>
              </td>
              <td class="text-center">
                <?php echo show_item_status($controller_name, $item['id'], $item['status'], 'receipt'); ?>
              </td>
              <td class="text-center"><?php echo convert_timezone($item['created_at'], 'user'); ?></td>
              <td class="text-center">
                <?php if ($item['status'] == 'pending') { ?>
                  <div class="btn-group">
                    <a href="<?php echo admin_url($controller_name . '/ajax_update_status/approved/' . $item['ids']); ?>" class="btn btn-icon btn-sm btn-success ajaxUpdateStatus" data-toggle="tooltip" data-placement="bottom" title="Approve"><i class="fe fe-check"></i></a>
                    <a href="<?php echo admin_url($controller_name . '/ajax_update_status/rejected/' . $item['ids']); ?>" class="btn btn-icon btn-sm btn-danger ajaxUpdateStatus" data-toggle="tooltip" data-placement="bottom" title="Reject"><i class="fe fe-x"></i></a>
                  </div>
                <?php } ?>
              </td>
              <td>
                <a href="<?php echo admin_url($controller_name . '/view/' . $item['ids']); ?>" class="btn btn-icon btn-sm btn-primary ajaxModal" data-toggle="tooltip" data-placement="bottom" title="View"><i class="fe fe-eye"></i></a>
              </td>
            </tr>
            <?php }} else { ?>
            <?php echo show_empty_item(); ?>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- AJAX Modal Container -->
<div class="modal fade" id="ajaxReceiptModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Content will be injected here via AJAX -->
        </div>
    </div>
</div>
      <div class="card-footer">
        <?php echo $pagination; ?>
      </div>
    </div>
  </div>
</div>

<script>
// $(document).on('click', '.ajaxUpdateStatus', function(e) {
//     e.preventDefault();
    
//     var _that = $(this);
//     var _url = _that.attr('href');
    
//     if (!confirm("Are you sure you want to proceed?")) {
//         return;
//     }

//     pageOverlay.show();

//     $.ajax({
//         url: _url,
//         type: 'GET',
//         // dataType: 'json',
//         success: function(response) {
//             pageOverlay.hide();
//             notify(response.message, response.status);
//             // Reload the page to see the status change
//             if (response.status == 'success') {
//                 window.location.reload();
//             }
//         },
//         error: function(xhr, status, error) {
//             pageOverlay.hide();
//             notify('An error occurred: ' + error, 'error');
//         }
//     });
//     // console.log(_url);
//     // console.log('AJAX request is commented out for testing purposes.');

// });

$(document).on('click', '.ajaxUpdateStatus', function(e) {
    e.preventDefault();

    var _that = $(this);
    var _url = _that.attr('href');

    if (!confirm("Are you sure you want to proceed?")) {
        return;
    }

    pageOverlay.show();

    $.ajax({
        url: _url,
        type: 'GET',
        dataType: 'json',  // BACK ON — expect clean JSON
        success: function(response) {
            pageOverlay.hide();

            // Show toast
            notify(response.message, response.status);

            // RELOAD PAGE ON SUCCESS
            if (response.status === 'success') {
                setTimeout(function() {
                    window.location.reload();
                }, 800); // Small delay so user sees toast
            }
        },
        error: function(xhr) {
            pageOverlay.hide();

            var msg = 'An error occurred';
            try {
                var err = JSON.parse(xhr.responseText);
                msg = err.message || msg;
            } catch (e) {
                msg = xhr.responseText || msg;
            }

            notify(msg, 'error');
        }
    });
});
</script>
