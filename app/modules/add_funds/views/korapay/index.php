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
    .card-header{
      background-color: var(--makara-blue);
      color: white;
    }
</style>

<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card" id="korapay-bank-transfer-card">
        <div class="card-header" >
          Select Payment Method
        </div>
        <div class="card-body">
          <div class="mb-4" style="color: gray;">

            <p>Click the button below to fund your wallet. </p>
            <span>
              <strong>Note:</strong> A service fee of ₦50 applies to each transaction across all payment methods. The minimum deposit amount is ₦1,000, bringing the total charge to ₦1,050.
            </span>
            <br>
            <span>
              <strong>Important:</strong> Please ensure the amount you transfer matches the exact amount you entered for deposit, including the transaction fee. Any difference may cause delays in processing your payment.
            </span>
            <br>
            <!-- <span>
              <strong>
                Note:</strong> The fees and requirements apply to both korapay and manual payment methods.
              </strong>
            </span>  -->
            <br>
          </div>
          

          <!-- Account Details Modal -->
          <div class="modal fade" id="accountDetailsModal" tabindex="-1" role="dialog" aria-labelledby="accountDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" style="color: black;" id="accountDetailsModalLabel">Fund with Bank Transfer</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body-content">
                  <!-- Initial state: Amount input -->
                  <div id="amount-input-container">
                    <form id="korapay-bank-transfer-form" action="<?php echo cn('add_funds/korapay/charge_with_bank_transfer'); ?>" method="POST">
                       <div class="form-group">
                          <div style="width: 70%; height: 8.5rem; margin:auto;">
                            <img src="assets\images\payments\korapay.png" style=" object-fit: contain;" alt=""> 
                          </div>
                            <label for="amount" style="color: black;">Amount (NGN)</label>
                            <input type="number" class="form-control" id="amount" name="amount" placeholder="1000" min="1000" required value="1000">
                        </div>

                        <div class="note-section mt-4 mb-4" style="color: black;">
                            <p><strong>Note:</strong></p>
                            <ul class="" style="padding-left: 15px;">
                                <li>Minimum Payment Amount: ₦1000</li>
                                <li>Maximum Payment Amount: ₦1000000</li>
                                <li>Do Not Click <span style="color:#c65102; font-weight:bold">Cancel Button</span> after payment has been successfully completed, you will be redirected automatically.
                                </li>
                            </ul>
                        </div>

                        <div class="form-group mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="agreement-checkbox" required>
                                <label class="form-check-label" style="color: black;" for="agreement-checkbox">
                                    YES, I UNDERSTAND AFTER THE FUNDS ADDED I WILL NOT ASK FRAUDULENT DISPUTE OR CHARGE-BACK!
                                </label>
                            </div>
                        </div>
                        
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                        <input type="hidden" name="module" value="add_funds">
                        
                        <button type="submit" class="btn btn-primary w-100" id="make-payment-btn">
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            Make Payment
                        </button>

                    </form>
                  </div>

                  <!-- Second state: Account details (to be populated by JS) -->
                  <div id="account-details-display" class="d-none">
                  <div class="text-center mb-3">
                    <p class="text-muted">Transfer to the account details below to complete your payment.</p>
                  </div>
                  
                  <?php if (isset($korapay_debug_mode) && $korapay_debug_mode): ?>
                  <div class="text-center mb-3">
                      <span class="badge bg-warning text-dark">SANDBOX MODE</span>
                  </div>
                  <?php endif; ?>

                  <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span>Bank Name:</span>
                      <strong id="detail-bank-name"></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span>Account Name:</span>
                      <div>
                        <strong id="detail-account-name" class="me-2" style="font-size: 0.9rem;"></strong>
                        <button class="btn btn-sm btn-outline-secondary" onclick="copyToClipboard('detail-account-name', this)"><i class="fe fe-copy"></i></button>
                      </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span>Account Number:</span>
                      <div>
                        <strong id="detail-account-number" style="font-size: 0.9rem;" class="me-2"></strong>
                        <button class="btn btn-sm btn-outline-secondary" onclick="copyToClipboard('detail-account-number', this)"><i class="fe fe-copy"></i></button>
                      </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span>Amount to Pay:</span>
                      <strong style="font-size: 0.9rem;">₦<span id="detail-amount"></span></strong>
                      <strong id="detail-amount" class="me-2" style="font-size: 0.9rem;"></strong>
                        <button class="btn btn-sm btn-outline-secondary" onclick="copyToClipboard('detail-amount', this)"><i class="fe fe-copy"></i></button>
                    </li>
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Fee:</span>
                        <strong style="font-size: 0.9rem;">A fee of ₦50 will be charged</strong>
                    </li>
                    <li id="expires-at-container" class="list-group-item d-flex justify-content-between align-items-center d-none">
                      <span>Expires At:</span>
                      <strong id="detail-expires-at" style="font-size: 0.9rem;"></strong>
                    </li>
                  </ul>

                  <div class="alert alert-info mt-3">
                    We will automatically detect your payment and credit your wallet. This may take a few minutes.
                  </div>
                  
                  <div id="test-button-container" class="mt-3"></div>

                  <!-- Hidden field to store the reference -->
                  <span id="detail-reference" class="d-none"></span>
                  </div>
                </div>

                <div class="modal-footer">
                  <a href="#" id="continue-to-success-btn" class="btn btn-info d-none">I Have Paid, Continue</a>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
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
    navigator.clipboard.writeText(text).then(function() {
      var originalHtml = button.innerHTML;
      button.innerHTML = 'Copied!';
      setTimeout(() => {
        button.innerHTML = originalHtml;
      }, 1500);
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
            $('#amount-input-container').addClass('d-none');
            $('#account-details-display').removeClass('d-none');

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
