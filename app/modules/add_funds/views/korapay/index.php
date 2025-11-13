<style>
    #account-details-container {
        max-width: 600px;
        margin: 0 auto;
    }
    
    #account-details-container .card {
        border-radius: 12px;
    }
    
    #account-details-container .alert {
        border-radius: 8px;
    }
    
    #account-details-container .badge {
        border-radius: 20px;
        font-weight: 600;
    }
</style>

<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card" id="korapay-bank-transfer-card">
        <div class="card-header">
          Korapay Bank Transfer
        </div>
        <div class="card-body">
          <!-- Amount Input Form -->
          <div id="bank-transfer-form-container">
            <form id="korapay-bank-transfer-form" action="<?php echo cn('add_funds/korapay/charge_with_bank_transfer'); ?>" method="POST">
              <div class="form-group">
                <label for="amount">Amount (NGN)</label>
                <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount" required>
              </div> 
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
              <input type="hidden" name="module" value="add_funds">
              <button type="submit" class="btn btn-primary w-100 mt-3" id="generate-account-btn">
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                Get Account Number
              </button>
            </form>
          </div>

          <!-- Account Details Display -->
          <div id="account-details-container" class="d-none">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <!-- Header Section -->
            <div class="text-center mb-4">
                <div class="mb-3">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: inline-block;">
                        <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="#0D0BD1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 22V12H15V22" stroke="#0D0BD1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h4 class="fw-bold mb-2" style="color: #0D0BD1;">Bank Transfer Payment</h4>
                <p class="text-muted mb-2">Transfer to the account details below to complete your payment</p>
                
                <!-- Alert Box -->
                <div class="alert alert-warning border-0 d-flex align-items-start gap-2 mb-0" style="background-color: #FFF4E6; border-left: 4px solid #FF9933 !important;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0; margin-top: 2px;">
                        <path d="M12 2L2 19.5H22L12 2Z" stroke="#FF9933" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 9V13" stroke="#FF9933" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="12" cy="17" r="1" fill="#FF9933"/>
                    </svg>
                    <div class="text-start">
                        <small class="d-block fw-semibold" style="color: #CC7A29;">Important Notice</small>
                        <small style="color: #996633;">This account is temporary and will expire. Please pay the exact amount shown.</small>
                    </div>
                </div>
            </div>

            <!-- SANDBOX MODE BADGE -->
            <?php if (isset($korapay_debug_mode) && $korapay_debug_mode): ?>
                <div class="text-center mb-3">
                    <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #FFC107 0%, #FF9933 100%); color: #fff; font-size: 0.85rem; letter-spacing: 0.5px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: inline-block; margin-right: 4px; vertical-align: text-top;">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                            <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        SANDBOX MODE
                    </span>
                </div>
            <?php else: ?>
                <div class="text-center mb-3">
                    <!-- <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #0D0BD1 0%, #0908A0 100%); color: #fff; font-size: 0.85rem; letter-spacing: 0.5px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: inline-block; margin-right: 4px; vertical-align: text-top;">
                            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        LIVE MODE
                    </span> -->
                </div>
            <?php endif; ?>

            <!-- Account Details Section (Placeholder) -->
            <div class="border rounded-3 p-4 mt-3" style="background-color: #F8F9FA; border-color: #E9ECEF !important;">
                <div class="row g-3">
                    <!-- Add your account details rows here -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small">Account details will appear here</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Note -->
            <div class="text-center mt-4">
                <small class="text-muted">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: inline-block; vertical-align: text-top; margin-right: 2px;">
                        <path d="M12 16V12M12 8H12.01M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Payment confirmation may take a few minutes after transfer
                </small>
            </div>
        </div>
    </div>
</div>



    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span>Bank Name:</span>
            <strong id="detail-bank-name"></strong>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span>Account Name:</span>
            <strong id="detail-account-name"></strong>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span>Account Number:</span>
            <strong id="detail-account-number"></strong>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span>Amount:</span>
            <strong>₦<span id="detail-amount"></span></strong>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span>Fee:</span>
            <strong>A fee of ₦50 will be charged</span></strong>
        </li>
        
        <li id="expires-at-container" class="list-group-item d-flex justify-content-between align-items-center d-none">
            <span>Expires At:</span>
            <strong id="detail-expires-at"></strong>
        </li>
    </ul>

    <div class="alert alert-success mt-3">
        We will automatically detect your payment and credit your wallet.
    </div>

    <div class="mt-2 text-center" id="manual-redirect-button-container">
        <a href="#" id="continue-to-success-btn" class="btn btn-info d-none">YES, I HAVE PAID</a>
    </div>

    <!-- Hidden field to store the reference -->
    <span id="detail-reference" class="d-none"></span>

    <div id="test-button-container"></div>
</div>

          <!-- Error Display -->
          <div id="error-container" class="alert alert-danger d-none mt-3"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function copyToClipboard(elementId, button) {
    const text = document.getElementById(elementId).innerText;
    navigator.clipboard.writeText(text).then(() => {
      const originalText = button.innerHTML;
      button.innerHTML = 'Copied!';
      setTimeout(() => {
        button.innerHTML = originalText;
      }, 2000);
    }).catch(err => {
      console.error('Failed to copy text: ', err);
      alert('Failed to copy text.');
    });
  }

  $(document).ready(function() {

    // Polling for bank transfer status
    function startPollingTransactionStatus(reference) {
      const pollInterval = 5000; // Poll every 5 seconds
      let pollAttempts = 0;
      const maxPollAttempts = 60; // Max 5 minutes (60 * 5 seconds)

      const poll = setInterval(() => {
        pollAttempts++;
        if (pollAttempts > maxPollAttempts) {
          clearInterval(poll);
          console.log('Max poll attempts reached for transaction ' + reference);
          // Optionally, show a message to the user or suggest manual refresh
          return;
        }

        $.ajax({
          url: '<?php echo cn('add_funds/korapay/check_transaction_status'); ?>',
          type: 'POST',
          dataType: 'json',
          data: {
            reference: reference,
            '<?php echo $this->security->get_csrf_token_name();?>': '<?php echo $this->security->get_csrf_hash();?>'
          },
          success: function(response) {
            if (response.status === 'success' && response.transaction_status == 1) { // Assuming 1 is 'completed'
              clearInterval(poll);
              window.location.href = '<?php echo cn("add_funds/success"); ?>?transaction_id=' + response.transaction_id;
            } else if (response.status === 'error') {
              console.error('Polling error:', response.message);
              clearInterval(poll); // Stop polling on error
            }
          },
          error: function(xhr) {
            console.error('Polling AJAX error:', xhr.responseText);
            // Optionally, stop polling after a few errors or on specific HTTP codes
          }
        });
      }, pollInterval);
    }
    
    $('#korapay-bank-transfer-form').submit(function(event) {
      event.preventDefault();
      
      var form = $(this);
      var btn = $('#generate-account-btn');
      var spinner = btn.find('.spinner-border');
      var errorContainer = $('#error-container');

      // Disable button and show spinner
      btn.attr('disabled', true);
      spinner.removeClass('d-none');
      errorContainer.addClass('d-none');

      $.ajax({
        url: form.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: form.serialize(),
        success: function(response) {
          var amount = parseFloat($('#amount').val());
          if (!isNaN(amount)) {
            amount += 50;
          }

          if (response.status === 'success' && response.account_details) {
            var details = response.account_details;

            // Populate details
            $('#detail-bank-name').text(details.bank_name);
            $('#detail-account-name').text(details.account_name);
            $('#detail-account-number').text(details.account_number);
            $('#detail-amount').text(details.amount.toFixed(2));
            $('#detail-reference').text(details.reference); // This is the reference we need

            // Update the manual redirect button with the transaction reference
            $('#continue-to-success-btn').attr('href', '<?php echo cn("add_funds/success"); ?>?transaction_id=' + details.reference); 
            $('#continue-to-success-btn').removeClass('d-none'); // Show the button

            // Start polling for bank transfer status
            startPollingTransactionStatus(details.reference);

            // Dynamically add the test button only if in debug mode
            <?php if (isset($korapay_debug_mode) && $korapay_debug_mode): ?>
            var testButtonHtml = `
              <div class="text-center mt-3">
                  <button id="credit-test-btn" class="btn btn-warning"> 
                      <span class="spinner-border spinner-border-sm d-none"></span>
                      Credit ₦<span id="test-amount">${details.amount.toFixed(2)}</span> (Test Only)
                  </button>
                  <small class="text-muted d-block">Simulates payment instantly</small>
              </div>
            `;
            $('#test-button-container').html(testButtonHtml);
            <?php endif; ?>

            if (details.expires_at) {
              $('#detail-expires-at').text(new Date(details.expires_at).toLocaleString());
              $('#expires-at-container').removeClass('d-none');
            }

            // Switch views
            $('#bank-transfer-form-container').addClass('d-none');
            $('#account-details-container').removeClass('d-none');

          } else {
            // Show error message
            var message = response.message || 'An unknown error occurred.';
            errorContainer.text(message).removeClass('d-none');
          }
        },
        error: function(xhr) {
          var message = 'An error occurred while communicating with the server. Please try again.';
          try {
            var response = JSON.parse(xhr.responseText);
            if (response.message) {
              message = response.message;
            }
          } catch (e) {
            // silent catch
          }
          errorContainer.text(message).removeClass('d-none');
        },
        complete: function() {
          // Re-enable button and hide spinner
          btn.attr('disabled', false);
          spinner.addClass('d-none');
        }
      });
    });

    // Handler for the test credit button
    $(document).on('click', '#credit-test-btn', function() {
      var btn = $(this);
      var spinner = btn.find('.spinner-border');
      var errorContainer = $('#error-container');
      var reference = $('#detail-reference').text();

      btn.attr('disabled', true);
      spinner.removeClass('d-none');
      errorContainer.addClass('d-none');

      $.ajax({
        url: '<?php echo cn('add_funds/korapay/simulate_bank_transfer_success'); ?>',
        type: 'POST',
        dataType: 'json',
        data: {
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
          module: 'add_funds',
          reference: reference
        },
        success: function(response) {
          if (response.status === 'success') {
            // Redirect to success page
            window.location.href = response.redirect_url;
          } else {
            errorContainer.text(response.message || 'An unknown error occurred.').removeClass('d-none');
          }
        },
        error: function() {
          errorContainer.text('A server error occurred. Please try again.').removeClass('d-none');
        },
        complete: function() {
          // Re-enable button and hide spinner
          btn.attr('disabled', false);
          spinner.addClass('d-none');
        }
      });
    });

  });
</script>
<script>
  $(document).ready(function() {
    $('#korapay-form').submit(function(event) {
    });
  });
</script>
