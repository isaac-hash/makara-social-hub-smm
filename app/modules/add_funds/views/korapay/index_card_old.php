


<?php
  $min_amount = get_value($payment_params, 'min');
  $type       = get_value($payment_params, 'type');
?>
  
  <div id="korapayCardButton"
       data-toggle="modal"
       data-target="#addFundsModal"
       style="
         background:var(--makara-orange);
           color:#ffffff;
           outline:2px solid black;
           border:2px solid oldlace;
         border-radius:8px;
         cursor:pointer;
         font-family:Arial, sans-serif;
         font-size:13px;
         gap:8px;
         transition:background 0.3s ease;
       "
       class="text-center text-lg-left d-flex align-items-center justify-content-center justify-content-lg-start btn col-lg-8 col-md-8 col-11 mx-auto p-3"
       onmouseover="this.style.background='#1a1a1a'"
       onmouseout="this.style.background='var(--makara-orange)'">
      <i class="fa-solid fa-credit-card"></i>
      <span>Fund With Korapay</span>
    </div>
  
  </div>
  
  
  
  <div class="modal fade" id="addFundsModal" tabindex="-1" role="dialog" aria-labelledby="addFundsModalLabel" aria-hidden="true">
  
    <div class="modal-dialog" role="document">
  
      <div class="modal-content">
  
        <form id="actionAddFundsForm" class="form actionAddFundsForm" action="#" method="POST">
  
          <div class="modal-header">
  
            <h5 class="modal-title" id="addFundsModalLabel">Add Funds</h5>
  
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  
              <!-- <span aria-hidden="true">&times;</span> -->
  
            </button>
  
          </div>
  
          <div class="modal-body">
  
              <div class="row">
  
                <div class="col-md-12">
  
                  
  
                  <div class="form-group">
  
                      <label class="form-label">Card Number</label>
  
                      <input type="text" name="card_number" class="form-control" placeholder="1234 5678 1234 5678">
  
                  </div>
  
                  <div class="row">
  
                      <div class="col-sm-8">
  
                          <div class="form-group">
  
                              <label class="form-label">Expiration Date</label>
  
                              <div class="input-group">
  
                                  <input type="text" name="expiry_month" class="form-control" placeholder="MM">
  
                                  <input type="text" name="expiry_year" class="form-control" placeholder="YY">
  
                              </div>
  
                          </div>
  
                      </div>
  
                      <div class="col-sm-4">
  
                          <div class="form-group">
  
                              <label class="form-label">CVV</label>
  
                              <input type="text" name="cvv" class="form-control" placeholder="123">
  
                          </div>
  
                      </div>
  
                  </div>
  
  
  
                  <div class="form-group">
  
                    <label><?=sprintf(lang("amount_usd"), $currency_code)?></label>
  
                    <input class="form-control square" type="number" name="amount" placeholder="<?php echo $min_amount; ?>">
  
                  </div>                      
  
  
  
                  <div class="form-group">
  
                    <label class="custom-control custom-checkbox">
  
                      <input type="checkbox" class="custom-control-input" name="agree" value="1">
  
                      <span class="custom-control-label text-uppercase"><strong><?=lang("yes_i_understand_after_the_funds_added_i_will_not_ask_fraudulent_dispute_or_chargeback")?></strong></span>
  
                    </label>
  
                  </div>
  
                  
  
                  <input type="hidden" name="payment_id" value="<?php echo $payment_id; ?>">
  
                  <input type="hidden" name="payment_method" value="<?php echo $type; ?>">
  
                  
  
                </div>  
  
              </div>
  
          </div>
  
          <div class="modal-footer">
  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  
            <button type="submit" class="btn round btn-primary btn-min-width mr-1 mb-1">
  
              <?=lang("Pay")?>
  
            </button>
  
          </div>
  
        </form>
  
      </div>
  
    </div>
  
  </div>




    

      <!-- PIN Modal -->
<div class="modal fade" id="pinModal" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content p-3">
      <h5 class="mb-2 text-center">Enter Card PIN</h5>
      <input type="password" id="pinInput" class="form-control mb-3" placeholder="4-digit PIN">
      <button class="btn btn-primary btn-block" id="submitPinBtn">Submit PIN</button>
    </div>
  </div>
</div>

<!-- OTP Modal -->
<div class="modal fade" id="otpModal" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content p-3">
      <h5 class="mb-2 text-center">Enter OTP</h5>
      <input type="text" id="otpInput" class="form-control mb-3" placeholder="OTP sent to your phone">
      <button class="btn btn-primary btn-block" id="submitOtpBtn">Submit OTP</button>
    </div>
  </div>
</div>

<div class="modal fade" id="actionAddFundsFormModal" tabindex="-1" role="dialog" aria-labelledby="actionAddFundsFormModalLabel" aria-hidden="true">
  <div>Modal Content Here</div>
</div>




    <script>
        function copyToClipboard(elementId, button) {
            const text = document.getElementById(elementId).textContent;
            navigator.clipboard.writeText(text).then(() => {
                const originalText = button.textContent;
                button.textContent = 'Copied!';
                button.classList.add('copied');
                
                setTimeout(() => {
                    button.textContent = originalText;
                    button.classList.remove('copied');
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy:', err);
            });
        }
    </script>
