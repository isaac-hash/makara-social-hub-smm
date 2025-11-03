<!-- receipt/view.php -->
<div class="modal-content" style="max-width: 90%; margin:auto;">
    <div class="modal-header border-bottom-0 pb-0">
        <h4 class="modal-title font-weight-bold">Receipt Details</h4>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> -->
        <a href="<?= cn('admin/receipts') ?>" style="font-size:larger;">X</a>
    </div>

    <div class="modal-body pt-2">
        <div class="row">
            <div class="col-12">
                <div class="form-group mb-3">
                    <label class="font-weight-bold">User:</label>
                    <p class="mb-0"><?= esc($item['user_email']) ?></p>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Amount:</label>
                    <p class="mb-0"><?= currency_format($item['amount']) ?></p>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Status:</label>
                    <p class="mb-0">
                        <span class="badge badge-<?= $item['status'] === 'pending' ? 'warning' : ($item['status'] === 'approved' ? 'success' : 'danger') ?>">
                            <?= ucfirst($item['status']) ?>
                        </span>
                    </p>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Submitted:</label>
                    <p class="mb-0"><?= convert_timezone($item['created_at'], 'user') ?></p>
                </div>

                <div class="form-group mb-0">
                    <label class="font-weight-bold">Receipt File:</label>
                    <div class="mt-2">
                        <?php
                        $receipt_url = base_url($item['receipt_path']);
                        if (strpos($item['receipt_path'], '.pdf') !== false) {
                            echo '<a href="' . $receipt_url . '" target="_blank" class="btn btn-info btn-sm">
                                    View PDF
                                  </a>';
                        } else {
                            echo '<a href="' . $receipt_url . '" data-toggle="lightbox" class="d-block">
                                    <img src="' . $receipt_url . '" class="img-fluid rounded shadow-sm" style="max-height: 400px;">
                                  </a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap 4 + jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Ekko Lightbox (for image zoom) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>

<script>
    $(document).on('click', '.ajaxModal', function (e) {
    e.preventDefault();

    const url = $(this).attr('href');
    const $modal = $('#ajaxReceiptModal');

    // Show loading
    $modal.find('.modal-content').html('<div class="p-5 text-center"><i class="fa fa-spinner fa-spin"></i> Loading...</div>');
    $modal.modal('show');

    // Load content
    $.get(url)
        .done(function (html) {
            $modal.find('.modal-content').html(html);

            // Re-init lightbox for images
            $modal.find('[data-toggle="lightbox"]').each(function () {
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });
        })
        .fail(function () {
            $modal.find('.modal-content').html('<div class="p-4 text-danger">Failed to load receipt.</div>');
        });
});

// Optional: Close on ESC
$(document).on('hidden.bs.modal', '#ajaxReceiptModal', function () {
    $(this).find('.modal-content').empty();
});
</script>