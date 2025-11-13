<style>
    :root {
        --makara-blue: #0D0BD1;
        --makara-orange: #FF9933;
        --success-green: #28a745;
        --light-gray-bg: #f8f9fa;
    }

    .payment-success-container {
        padding-top: 5rem;
        padding-bottom: 5rem;
        background-color: var(--makara-blue);
        color: white;
    }

    .success-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border-top: 5px solid var(--makara-orange);
    }

    .success-icon-wrapper {
        background-color: var(--makara-orange);
        color: white;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: -40px auto 20px;
        position: relative;
        z-index: 2;
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
    }

    .success-icon-wrapper .fe {
        font-size: 40px;
    }

    .success-card-header {
        text-align: center;
        padding: 2rem 1.5rem 1.5rem;
        background-color: #fff;
    }

    .success-card-header h3 {
        font-weight: 700;
        color: #000000ff;
        font-size: 1.75rem;
    }

    .success-card-header p {
        color: #000000ff;
        margin-bottom: 0;
    }

    .success-card-body {
        padding: 2rem;
        background-color:var(--makara-blue);
    }

    .transaction-details-list {
        list-style: none;
        padding: 0;
    }

    .transaction-details-list li {
        display: flex;
        justify-content: space-between;
        padding: 1rem 0;
        border-bottom: 1px solid #e9ecef;
        font-size: 0.95rem;
    }

    .transaction-details-list li:last-child {
        border-bottom: none;
    }

    .transaction-details-list .detail-label {
        color: #fff;
    }

    .transaction-details-list .detail-value {
        font-weight: 600;
        color: #fff;
        word-break: break-all;
        text-align: right;
    }

    .detail-value .badge {
        font-size: 0.9rem;
        padding: 0.4em 0.7em;
    }

    .success-card-footer {
        background-color: var(--makara-blue);
        padding: 1.5rem;
        text-align: center;
    }
    .button{
        background: var(--makara-blue);
        outline: 1px solid var(--makara-orange);
        padding: 1rem;
        color: white;
    }
</style>

<div class="payment-success-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="card success-card">
                    <div class="success-icon-wrapper">
                        <i class="fe fe-check"></i>
                    </div>
                    <div class="success-card-header">
                        <h3>Payment Successful</h3>
                        <p>Your transaction has been completed successfully.</p>
                    </div>
                    <div class="success-card-body">
                        <ul class="transaction-details-list">
                            <li>
                                <span class="detail-label">Transaction ID</span>
                                <span class="detail-value"><?php echo esc($transaction['transaction_id']); ?></span>
                            </li>
                            <li>
                                <span class="detail-label">Amount Paid</span>
                                <span class="detail-value"><?php echo currency_format($transaction['amount'], get_option("currency_code", "NGN")); ?></span>
                            </li>
                            <li>
                                <span class="detail-label">Fee</span>
                                <span class="detail-value">₦ 50</span>
                                <!-- <span class="detail-value"><?php echo currency_format($transaction['txn_fee'], get_option("currency_code", "NGN")); ?></span> -->
                            </li>
                            <li>
                                <span class="detail-label">Payment Method</span>
                                <span class="detail-value"><?php echo esc(ucwords(str_replace('_', ' ', $transaction['type']))); ?></span>
                            </li>
                            <li>
                                <span class="detail-label">Date & Time</span>
                                <span class="detail-value"><?php echo convert_timezone($transaction['created'], 'user'); ?></span>
                            </li>
                            <li>
                                <span class="detail-label">Status</span>
                                <span class="detail-value"><span class="badge bg-green-lt">Completed</span></span>
                            </li>
                        </ul>
                    </div>
                    <div class="success-card-footer">
                        <a href="<?php echo cn('statistics'); ?>" class="btn button">
                            <i class="fe fe-home"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <section class="add-funds m-t-50 responsive-section-header">   
  <div class="container-fluid">
    <div class="row justify-content-md-center">
      <div class="col-md-5">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="m-t-10"><i class="fe fe-check-circle text-primary"></i> <?=lang("payment_sucessfully")?></h3>
          </div>
          <div class="card-body">
            <?php if(!empty($transaction) && $transaction['type'] == 'paypal'){?>
            <div class="for-group text-center">
	            <img src="<?=BASE?>/assets/images/paypal.svg" alt="Paypay icon">
          	</div>
            <?php }?> 
    .success-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border-top: 5px solid var(--success-green);
    }

            <?php if(!empty($transaction) && $transaction['type'] == '2checkout'){?>
            <div class="for-group text-center">
              <img src="<?=BASE?>/assets/images/2checkout.svg" alt="2checkout icon">
            </div>
            <?php }?>
    .success-icon-wrapper {
        background-color: var(--success-green);
        color: white;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: -40px auto 20px;
        position: relative;
        z-index: 2;
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
    }

          	<div class="detail">
	            <p class="p-t-10"><?=lang("your_payment_has_been_processed_here_are_the_details_of_this_transaction_for_your_reference")?></p>
	            <ul>
	            	<li><?=lang("Transaction_ID")?>: <strong><?=(!empty($transaction) && $transaction['transaction_id'] == 'empty') ? $transaction['transaction_id'] . lang("transaction_id_was_sent_to_your_email") : $transaction['transaction_id'] ?></strong></li>
	            	<li><?=lang("Amount_paid_includes_fee")?>: <strong><?=(!empty($transaction)) ? $transaction['amount'] : ''?> <?=get_option("currency_code", "USD")?></strong> </li>
	            </ul>
          	</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> -->
