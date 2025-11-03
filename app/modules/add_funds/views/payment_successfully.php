<style>
  /* Desktop - with sidebar offset */
  .responsive-section-header {
    margin-top: 9rem;
    margin-left: 9rem;
  }
  
  .responsive-content-row {
    margin-left: 6rem;
  }
  
  /* Tablet Screens (768px to 991px) */
  @media (max-width: 991px) {
    .responsive-section-header {
      margin-left: 5rem;
      margin-top: 7rem;
    }
    
    .responsive-content-row {
      margin-left: 2.5rem;
      margin-right: 1rem;
    }
  }
  
  /* Mobile Screens (below 768px) */
  @media (max-width: 767px) {
    .responsive-section-header {
      margin-left: 0;
      margin-right: 0;
      margin-top: 6rem;
      padding-left: 1rem;
      padding-right: 1rem;
    }
    
    .responsive-content-row {
      margin-left: 0;
      margin-right: 0;
      padding-left: 0.5rem;
      padding-right: 0.5rem;
    }
    
    .responsive-content-row .card {
      margin-bottom: 1rem;
    }
  }
  
  /* Extra Small Screens (below 576px) */
  @media (max-width: 575px) {
    .responsive-section-header {
      margin-top: 6rem;
      padding-left: 0.75rem;
      padding-right: 0.75rem;
    }
    
    .responsive-section-header .page-title {
      font-size: 1.25rem;
    }
    
    .responsive-content-row {
      padding-left: 0.25rem;
      padding-right: 0.25rem;
    }
    
    .responsive-content-row .card-body {
      padding: 1rem;
    }
    
    /* Adjust search area on mobile */
    .search-area {
      margin-top: 1rem;
    }
    
    .search-area .input-group {
      width: 100%;
    }
  }
  
  /* When sidebar is collapsed or hidden */
  @media (min-width: 768px) {
    body.sidebar-collapsed .responsive-section-header,
    body.sidebar-hidden .responsive-section-header {
      margin-left: 1rem;
    }
    
    body.sidebar-collapsed .responsive-content-row,
    body.sidebar-hidden .responsive-content-row {
      margin-left: 0.5rem;
    }
  }
</style>


<section class="add-funds m-t-50 responsive-section-header">   
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

            <?php if(!empty($transaction) && $transaction['type'] == '2checkout'){?>
            <div class="for-group text-center">
              <img src="<?=BASE?>/assets/images/2checkout.svg" alt="2checkout icon">
            </div>
            <?php }?>

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
</section>

