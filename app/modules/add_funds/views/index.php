<style>
  .page-title h1{
    margin-bottom: 5px; }
    .page-title .border-line {
      height: 5px;
      width: 270px;
      background: #eca28d;
      background: -webkit-linear-gradient(45deg, #eca28d, #f98c6b) !important;
      background: -moz- oldlinear-gradient(45deg, #eca28d, #f98c6b) !important;
      background: -o-linear-gradient(45deg, #eca28d, #f98c6b) !important;
      background: linear-gradient(45deg, #eca28d, #f98c6b) !important;
      position: relative;
      border-radius: 30px; }
    .page-title .border-line::before {
      content: '';
      position: absolute;
      left: 0;
      top: -2.7px;
      height: 10px;
      width: 10px;
      border-radius: 50%;
      background: #fa6d7e;
      -webkit-animation-duration: 6s;
      animation-duration: 6s;
      -webkit-animation-timing-function: linear;
      animation-timing-function: linear;
      -webkit-animation-iteration-count: infinite;
      animation-iteration-count: infinite;
      -webkit-animation-name: moveIcon;
      animation-name: moveIcon; }

  @-webkit-keyframes moveIcon {
    from {
      -webkit-transform: translateX(0);
    }
    to { 
      -webkit-transform: translateX(215px);
    }
  }
</style>

    <style>
        :root {
            --makara-blue: #0D0BD1;
            --makara-orange: #FF9933;
            --makara-border: #020c68ff;
            --makara-blue-bg: #020c6867;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

    

        .payment-card {
            background: white;
            border-radius: 20px;
            /* padding: 20rem; */
            margin: 0 auto;
            max-width: 70%;
            font-size: large;
            width: 100%;
            /* box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); */
            position: relative;
            overflow: hidden;
        }

        .payment-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--makara-blue), var(--makara-orange));
        }

        .header {
            text-align: center;
            margin-bottom: 35px;
        }

        .header h2 {
            color: #2d3748;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .header p {
            color: #718096;
            font-size: 14px;
        }

        /* .bank-logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--makara-blue), var(--makara-orange));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 24px;
            font-weight: bold;
            color: white;
            box-shadow: 0 8px 16px rgba(13, 11, 209, 0.2);
        } */

        .payment-details {
            background: #f7fafc;
            border-radius: 12px;
            padding: 25px;
            border: 2px solid #e2e8f0;
        }

        .detail-row {
            margin-bottom: 20px;
            transition: transform 0.2s;
        }

        .detail-row:last-child {
            margin-bottom: 0;
        }

        .detail-row:hover {
            transform: translateX(4px);
        }

        .detail-label {
            font-size: 12px;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            font-weight: 600;
        }

        .detail-value {
            font-size: 18px;
            color: #2d3748;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .copy-btn {
            background: var(--makara-blue);
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
        }

        .copy-btn:hover {
            background: var(--makara-orange);
            transform: scale(1.05);
        }

        .copy-btn:active {
            transform: scale(0.95);
        }

        .copy-btn.copied {
            background: #48bb78;
        }

        .footer-note {
            margin-top: 25px;
            text-align: center;
            font-size: 13px;
            color: #718096;
            padding: 15px;
            background: #fff5e6;
            border-radius: 8px;
            border-left: 4px solid var(--makara-orange);
        }

        .responsive-content-row{
          width: 40%;
          margin: 0 auto 15px;
        }

        @media (max-width: 767px) {
            .payment-card {
                max-width: 95%;
            }
            .responsive-content-row{
          width: 80%;
          margin: 0 auto 15px;
        }
        }

        @media (max-width: 480px) {
            .payment-card {
                padding: 30px 20px;
            }

            .header h2 {
                font-size: 24px;
            }

            .detail-value {
                font-size: 16px;
            }
        }
    </style>

<div class="col-lg-8 col-md-10 mx-auto" style="margin-top: 6rem;">
  <!-- Header Section -->
  <div style="text-align: center; margin-bottom: 2rem;">
    <h2 style="
      font-size: 1.75rem;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 0.5rem;
      line-height: 1.3;
    ">
      Fund Your Wallet
    </h2>
    <p style="
      font-size: 1rem;
      color: #666;
      margin: 0;
    ">
      Choose from our various secure payment methods
    </p>
  </div>

  <!-- background: linear-gradient(135deg, var(--makara-blue-bg) 0%, rgba(59, 130, 246, 0.05) 100%); -->
  <!-- Info Card -->
  <div style="
    background: var(--makara-blue);
    border: 1px solid var(--makara-blue-bg);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  ">
    <!-- Icon and Title -->
    <div style="display: flex; align-items: start; gap: 12px; margin-bottom: 12px;">
      <div style="
        background: var(--makara-blue);
        color: white;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
      ">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="16" x2="12" y2="12"></line>
          <line x1="12" y1="8" x2="12.01" y2="8"></line>
        </svg>
      </div>
      <div>
        <h4 style="
          font-size: 1rem;  
          font-weight: 600;
          color: white;
          margin: 0 0 8px 0;
        ">
          Important Information
        </h4>
        <p style="
          font-size: 0.925rem;
          color: #fff;
          line-height: 1.6;
          margin: 0;
        ">
          Your wallet will be credited instantly after successful payment. All transactions are secured with industry-standard encryption. For manual bank transfers, please allow 10-30 minutes for verification and processing.
        </p>
      </div>
    </div>
  </div>

  <!-- Payment Methods Section Header -->
  <div style="
    font-size: 1.1rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 1rem;
  ">
    <!-- Select Payment Method -->
  </div>
</div>
<?php if (!empty($active_payments)): ?>
  <div class="responsive-section-header">    
    <?php
      $i = 0;
      foreach ($active_payments as $key => $row) {
        $i++;
    ?>
      <div id="<?php echo $row['type']; ?>" class="tab-pane fade  <?php echo ($i == 1) ? 'in active show' : ''?>">
        <?php
          $this->load->view($row['type'].'/index', ['payment_id' => $row['id'], 'payment_params' => $row['params']]);
        ?>
      </div>  
    <?php } ?>
  </div>
<?php endif; ?>



<?php
  if (get_option("is_active_manual")) {
?>
<section class="add-funds m-t-30">

<button type="button" style="
           
           background:var(--makara-orange);
           color:#ffffff;
           outline:2px solid black;
           border:2px solid oldlace;
           
           /*#e68f1dff  */
           border-radius:8px;
           cursor:pointer;
           font-family:Arial, sans-serif;
           font-size:13px;
           
           gap:8px;
           transition:background 0.3s ease;
         "
         class="text-center text-lg-left d-flex align-items-center justify-content-center justify-content-lg-start btn col-lg-7 col-md-7 col-10 mx-auto p-3 mb-4"
         onmouseover="this.style.background='#1a1a1a'"
         onmouseout="this.style.background='var(--makara-orange)'" data-toggle="modal" data-target="#accountDetailsModal">
            <i class="fe fe-credit-card"></i> Fund with Korapay
          </button>

<div style=" margin:0 auto; margin-bottom:20px;">
  <!-- <div class="responsive-content-row">
    <b>Note:</b> A fee of ₦50 is charged for each transaction. <br>
    <b>Note:</b> Minimum deposit amount is ₦1,000.
  </div> -->
    <div id="manualcard" 
         data-toggle="modal" 
         data-target="#manualPaymentModal" 
         style="
           
           background:var(--makara-orange);
           color:#ffffff;
           outline:2px solid black;
           border:2px solid oldlace;
           
           /*#e68f1dff  */
           border-radius:8px;
           cursor:pointer;
           font-family:Arial, sans-serif;
           font-size:13px;
           
           gap:8px;
           transition:background 0.3s ease;
         "
         class="text-center text-lg-left d-flex align-items-center justify-content-center justify-content-lg-start btn col-lg-7 col-md-7 col-10 mx-auto p-3"
         onmouseover="this.style.background='#1a1a1a'"
         onmouseout="this.style.background='var(--makara-orange)'">
      <!-- <svg width="20" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
        <line x1="1" y1="10" x2="23" y2="10"></line>
      </svg> -->
      <i class="fa-solid fa-credit-card"></i>
      <span>Fund With manual bank transfer</span>
    </div>
  
</div>


  <!-- Manual Payment Modal -->
  <div class="modal fade" id="manualPaymentModal" tabindex="-1" role="dialog" aria-labelledby="manualPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content payment-card">
          <div class="p-2" style="">
              <div class=""></div>
              <h2>Manual Payment</h2>
              <p>Transfer funds to the account below</p>
          </div>

          <div class="payment-details">
              <div class="detail-row">
                  <div class="detail-label">Account Number</div>
                  <div class="detail-value">
                      <span id="accountNumber">3002544156</span>
                      <button class="copy-btn" onclick="copyToClipboard('accountNumber', this)">Copy</button>
                  </div>
              </div>

              <div class="detail-row">
                  <div class="detail-label">Account Name</div>
                  <div class="detail-value">
                      <span id="accountName">Makara Social Hub</span>
                      <button class="copy-btn" onclick="copyToClipboard('accountName', this)">Copy</button>
                  </div>
              </div>

              <div class="detail-row">
                  <div class="detail-label">Bank Name</div>
                  <div class="detail-value">
                      <span>Kuda Bank</span>
                  </div>
              </div>
          </div>

          <div class="footer-note">
              💡 After payment, please upload your receipt for verification
          </div>

          <div class="text-center mt-2 mt-md-3 p-2">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#uploadReceiptModal" data-dismiss="modal">
                  <i class="fe fe-upload"></i> Upload Receipt
              </button>
          </div>
      </div>
    </div>
  </div>


    <!-- Upload Receipt Modal -->
<div class="modal fade" id="uploadReceiptModal" tabindex="-1" role="dialog" aria-labelledby="uploadReceiptModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="uploadReceiptForm" action="<?=cn('add_funds/upload_receipt')?>" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="uploadReceiptModalLabel">Upload Payment Receipt</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="amount" class="form-label">Amount Sent (<?php echo $currency_code; ?>)</label>
            <input type="number" class="form-control" id="amount" name="amount" placeholder="e.g., 5000" required>
          </div>
          <div class="form-group">
            <label for="receipt" class="form-label">Receipt (Image or PDF)</label>
            <input type="file" class="form-control-file" id="receipt" name="receipt" accept="image/*,application/pdf" required>
          </div>
          <div id="alert-message"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-submit">Submit Receipt</button>
        </div>
      </form>
    </div>
  </div>
</div>   
  <div class="container-fluid">
    <!-- <div class="row justify-content-center m-t-50">
      <div class="col-md-8">
        <div class="page-title m-b-30">
          <h1><i class="fa fa-hand-o-right"></i> 
            <?php echo lang('manual_payment'); ?>
          </h1>
          <div class="border-line"></div>
        </div>
        <div class="content m-t-30">
          <?php echo htmlspecialchars_decode(get_option('manual_payment_content', ''), ENT_QUOTES)?>
        </div>
      </div> 
    </div> -->

  </div>
</section>
<?php }?>

<script>
  $(document).ready(function() {
    let transactionReference = null;
    let originalReference = null;

    // Handle the main payment form submission
    $(document).on('submit', '.actionAddFundsForm', function(e) {
        e.preventDefault();
        pageOverlay.show();

        var form = $(this);
        var formData = new FormData(this);
        
        if (typeof token !== 'undefined') {
            formData.append('token', token);
        }

        $.ajax({
            url: '<?= cn("add_funds/process") ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                pageOverlay.hide();

                if (response.status === 'success' && response.redirect_url) {
                    window.location.href = response.redirect_url;
                } else if (response.status === 'requires_pin') {
                    transactionReference = response.transaction_reference;
                    originalReference = response.reference;
                    $('#pinModal').modal('show');
                    if (response.message) {
                      notify(response.message, 'info');
                    }
                } else if (response.status === 'requires_otp') {
                    transactionReference = response.transaction_reference;
                    originalReference = response.reference;
                    $('#otpModal').modal('show');
                     if (response.message) {
                      notify(response.message, 'info');
                    }
                } else {
                    var message = response.message || 'An unknown error occurred.';
                    notify(message, 'error');
                }
            },
            error: function(xhr, status, error) {
                pageOverlay.hide();
                console.error("Payment Error:", xhr.responseText);
                notify("An unexpected error occurred. Please try again.", "error");
            }
        });
    });

    // Handle PIN submission
    $('#submitPinBtn').on('click', function() {
        var pin = $('#pinInput').val();
        if (!pin) {
            notify('Please enter your PIN.', 'error');
            return;
        }
        pageOverlay.show();
        $('#pinModal').modal('hide');

        $.post('<?= cn("add_funds/korapay/validate_charge") ?>', {
            transaction_reference: transactionReference,
            type: 'pin',
            value: pin,
            token: token 
        }, function(response) {
            pageOverlay.hide();
            if (response.status === 'success' && response.redirect_url) {
                window.location.href = response.redirect_url;
            } else {
                var message = response.message || 'PIN validation failed.';
                notify(message, 'error');
            }
        }, 'json').fail(function(xhr) {
            pageOverlay.hide();
            console.error("PIN Validation Error:", xhr.responseText);
            notify('An error occurred during PIN validation.', 'error');
        });
    });

    // Handle OTP submission
    $('#submitOtpBtn').on('click', function() {
        var otp = $('#otpInput').val();
        if (!otp) {
            notify('Please enter the OTP.', 'error');
            return;
        }
        pageOverlay.show();
        $('#otpModal').modal('hide');

        $.post('<?= cn("add_funds/korapay/validate_charge") ?>', {
            transaction_reference: transactionReference,
            type: 'otp',
            value: otp,
            token: token
        }, function(response) {
            pageOverlay.hide();
            if (response.status === 'success' && response.redirect_url) {
                window.location.href = response.redirect_url;
            } else {
                var message = response.message || 'OTP validation failed.';
                notify(message, 'error');
            }
        }, 'json').fail(function(xhr) {
            pageOverlay.hide();
            console.error("OTP Validation Error:", xhr.responseText);
            notify('An error occurred during OTP validation.', 'error');
        });
    });

    // Use event delegation for the form inside the modal
    $(document).on('submit', '#uploadReceiptForm', function(e) {
        e.preventDefault();
        pageOverlay.show();

        var form = $(this);
        var actionUrl = form.attr('action');
        var formData = new FormData(this);
        
        // Add CSRF token to FormData if it exists
        if (typeof token !== 'undefined') {
          formData.append('token', token);
        }

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                pageOverlay.hide();
                if (response.status === 'success') {
                    $('#uploadReceiptModal').modal('hide');
                    form[0].reset();
                }
                notify(response.message, response.status);
            },
            error: function(xhr, status, error) {
                pageOverlay.hide();
                console.error("Upload Error:", xhr.responseText);
                notify("An unexpected error occurred. Please try again.", "error");
            }
        });
    });
  });
</script>
