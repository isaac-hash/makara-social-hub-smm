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
                <b>Note:</b> A fee of ₦50 is charged for each transaction.
                
              </div> 
              <div class="form-group">
                <label for="amount">Amount (NGN)</label>
                <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount" min="1000" required>
              </div> 
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
              <input type="hidden" name="module" value="add_funds">
              <button type="submit" class="btn btn-primary w-100 mt-3" id="generate-account-btn">
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                Get Account Number
              </button>
            </form>
          </div>

          <!-- Account Details Modal -->
          <div class="modal fade" id="accountDetailsModal" tabindex="-1" role="dialog" aria-labelledby="accountDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="accountDetailsModalLabel">Bank Transfer Payment</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                        <strong id="detail-account-name" class="me-2" style="font-size: 0.7rem;"></strong>
                        <button class="btn btn-sm btn-outline-secondary" onclick="copyToClipboard('detail-account-name', this)"><i class="fe fe-copy"></i></button>
                      </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span>Account Number:</span>
                      <div>
                        <strong id="detail-account-number" style="font-size: 0.7rem;" class="me-2"></strong>
                        <button class="btn btn-sm btn-outline-secondary" onclick="copyToClipboard('detail-account-number', this)"><i class="fe fe-copy"></i></button>
                      </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span>Amount to Pay:</span>
                      <strong style="font-size: 0.9rem;">₦<span id="detail-amount"></span></strong>
                    </li>
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Fee:</span>
                        <strong style="font-size: 0.9rem;">A fee of ₦50 will be charged</strong>
                    </li>
                    <li id="expires-at-container" class="list-group-item d-flex justify-content-between align-items-center d-none">
                      <span>Expires At:</span>
                      <strong  id="detail-expires-at" style="font-size: 0.7rem;"></strong>
                    </li>
                  </ul>

                  <div class="alert alert-info mt-3">
                    We will automatically detect your payment and credit your wallet. This may take a few minutes.
                  </div>

                  <div id="test-button-container" class="mt-3"></div>

                  <!-- Hidden field to store the reference -->
                  <span id="detail-reference" class="d-none"></span>

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
            $('#accountDetailsModal').modal('show');

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
