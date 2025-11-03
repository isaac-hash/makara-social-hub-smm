<?php
  $min_amount = get_value($payment_params, 'min');
  $type       = get_value($payment_params, 'type');
?>
<div class="add-funds-form-content mb-5">
  <form id="actionAddFundsForm" class="form actionAddFundsForm" action="#" method="POST">

    
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


    <style>
        :root {
            --makara-blue: #0D0BD1;
            --makara-orange: #FF9933;
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
            max-width: 100%;
            font-size: large;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
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

    <div class="payment-card">
        <div class="p-5">
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

<script>
$(document).ready(function () {

    console.log("✅ Inline payment JS LOADED");

    // Add Funds Form Handler
    $(document).on("submit", ".actionAddFundsForm", function (event) {

        event.preventDefault();
        pageOverlay.show();

        let _that = $(this);
        let _action = PATH + 'add_funds/process';
        let _redirect = _that.data("redirect");
        let _dataObj = _that.serializeArray();
        let _data = _that.serialize() + '&' + $.param({ token: token });

        console.log("✅ Form Submitted");
        console.log("✅ Data Sent:", _dataObj);

        $.post(_action, _data, function (_result) {

            setTimeout(() => pageOverlay.hide(), 800);

            console.log("✅ Server Response:", _result);

            if (!is_json(_result)) {
                $(".add-funds-form-content").html(_result);
                return;
            }

            _result = JSON.parse(_result);
            console.log("Initial Response Parsed:", _result);
         


            // ✅ PIN REQUIRED
            if (_result.status === "requires_pin") {
                console.log("🟦 PIN HANDLER REACHED");
                window.korapayTransactionReference = _result.transaction_reference;
                window.korapayReference = _result.reference;
                console.log("Transaction Reference set for PIN:", window.korapayTransactionReference);
                console.log("Original Reference set for PIN:", window.korapayReference);
                $("#pinModal").modal("show");

                return;
            }

            // ✅ OTP REQUIRED
            if (_result.status === "requires_otp") {
                console.log("🟩 OTP HANDLER REACHED");
                window.korapayTransactionReference = _result.transaction_reference;
                window.korapayReference = _result.reference;

                $("#otpModal").modal("show");
                return;
            }

            // ✅ Normal success
            if (_result.status === "success" && _result.redirect_url) {
                window.location.href = _result.redirect_url;
                return;
            }

            notify(_result.message, _result.status);
        });

        return false;
    });

    // ✅ PIN Submit
$(document).on("click", "#submitPinBtn", function () {
    let pin = $("#pinInput").val().trim();
    if (!pin || pin.length !== 4) {
        notify("Enter a 4-digit PIN", "error");
        return;
    }

    pageOverlay.show();

    $.post(PATH + "add_funds/korapay/validate_charge", {
        transaction_reference: window.korapayTransactionReference,
        type: "pin",
        value: pin,
        token: token
    }, function (res) {
        pageOverlay.hide();
        handleValidationResponse(res);
    });
});

// ✅ OTP Submit
$(document).on("click", "#submitOtpBtn", function () {
    let otp = $("#otpInput").val().trim();
    if (!otp) {
        notify("OTP is required", "error");
        return;
    }

    pageOverlay.show();

    $.post(PATH + "add_funds/korapay/validate_charge", {
        transaction_reference: window.korapayTransactionReference,
        type: "otp",
        value: otp,
        token: token
    }, function (res) {
        pageOverlay.hide();
        handleValidationResponse(res);
    });
});

// Helper to avoid duplication
function handleValidationResponse(res) {
    if (!is_json(res)) return;

    res = JSON.parse(res);

    if (res.status === "requires_otp") {
        $("#pinModal").modal("hide");
        $("#otpModal").modal("show");
        return;
    }

    if (res.status === "success" && res.redirect_url) {
        window.location.href = res.redirect_url;
        return;
    }

    notify(res.message || "Validation failed", "error");
}

});
</script>
