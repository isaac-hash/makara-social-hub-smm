<?php
  $min_amount = get_value($payment_params, 'min');
  $type       = get_value($payment_params, 'type');
?>
<div class="add-funds-form-content">
  <form class="form actionAddFundsForm" action="#" method="POST">
    
    <div class="row">
      <div class="col-md-12">
        
        <div class="form-group">
            <label class="form-label">Card Number HELLO</label>
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
        
        <div class="form-actions left">
          <input type="hidden" name="payment_id" value="<?php echo $payment_id; ?>">
          <input type="hidden" name="payment_method" value="<?php echo $type; ?>">
          <button type="submit" class="btn round btn-primary btn-min-width mr-1 mb-1">
            <?=lang("Pay")?>
          </button>
        </div>
      </div>  
    </div>
  </form>
</div>
