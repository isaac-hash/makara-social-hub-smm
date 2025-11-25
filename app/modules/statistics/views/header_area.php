<?php
  if ($header_area) :
?>

<?php
$user = current_logged_user();
$user_name = $user->first_name . ' ' . $user->last_name;

$hour = date('G');
$period_of_day = '';

if ($hour >= 5 && $hour <= 11) {
    $period_of_day = "Good Morning";
} else if ($hour >= 12 && $hour <= 17) {
    $period_of_day = "Good Afternoon";
} else {
    $period_of_day = "Good Evening";
}

// Get user balance - adjust this based on your actual data structure
$user_balance = isset($user->balance) ? number_format($user->balance, 2) : '0.00';
?>
  <!-- Banner Section -->
  <div class="banner-section mb-5 mt-2" style="background: linear-gradient(135deg, 
        var(--makara-blue) 0%, 
        var(--makara-blue-dark) 50%, 
        #1a0a4e 100%
    ); border-radius: 15px; overflow: hidden; position: relative;">
    <div class="row align-items-center p-3 p-sm-4 p-md-5 m-0">
      <!-- Left Content -->
      <div class="col-md-6 col-lg-7 mb-4 mb-md-0 px-2 px-sm-3">
        <h2 class="text-white mb-2 mb-sm-3 banner-title">
          <?php echo $period_of_day; ?>, <?php echo isset($user->first_name) ? $user->first_name : 'User'; ?>!
        </h2>
        <p class="text-white mb-3 mb-sm-4 banner-description">
          Welcome to Makara Social Hub! - One platform for all your social media needs. 
          Grow your audience, boost engagement, and manage campaigns across Instagram, Facebook, 
          Twitter, TikTok, YouTube, and more.
        </p>
        
        <!-- Action Buttons -->
        <div class="banner-buttons d-flex flex-column flex-sm-row flex-wrap">
          <a 
            href="<?=cn('new_order'); ?>" 
            id="btnPlaceOrder" 
            class="btn btn-light px-3 px-sm-4 py-2 mb-2 mb-sm-0 banner-btn-order"
          >
            <i class="fe fe-shopping-cart mr-1 mr-sm-2"></i> Place Order
          </a>
            <!-- href="<?=cn($header_elements['add_funds']['route-name']); ?>" -->
          <a 
            href="<?=cn('add_funds'); ?>"

            id="btnFundWallet" 
            class="btn btn-outline-light px-3 px-sm-4 py-2 banner-btn-fund"
          >
            <i class="fa-solid fa-naira-sign mr-1 mr-sm-2"></i> Fund Wallet
          </a>
        </div>
      </div>
      
      <!-- Right Balance Card -->
      <div class="col-md-6 col-lg-5 text-center px-2 px-sm-3">
        <div class="balance-card">
          <div class="balance-card-header">
            <span class="account-label">ACCOUNT NAME</span>
            <h3 class="account-name"><?php echo $user_name; ?></h3>
          </div>
          
          <div class="balance-card-body">
            <span class="balance-label">ACCOUNT BALANCE</span>
            <div class="balance-display-wrapper">
              <h2 class="balance-amount" id="balanceAmount" data-balance="<?php echo $user_balance; ?>">₦********</h2>
              <button class="balance-toggle-btn" id="toggleBalance" type="button">
                <i class="fe fe-eye" id="eyeIcon"></i>
              </button>
            </div>
          </div>
          
          <div class="balance-card-footer">
            <span class="bank-label">BANK NAME</span>
            <h4 class="bank-name">Makara Social Hub</h4>
          </div>
          
          <!-- Card decoration dots -->
          <div class="card-dots card-dots-left"></div>
          <div class="card-dots card-dots-right"></div>
        </div>
      </div>
    </div>
    
    <!-- Decorative Wave Pattern -->
    <div class="banner-wave"></div>
  </div>

  <!-- Stats Cards Row -->
  <div class="row stats-row">
    <?php
      foreach ($header_area as $key => $item) {
    ?>
      <div class="col-sm-6 col-lg-5 mb-3 mb-sm-4">
        <div class="card shadow-sm border-0 h-100 stats-card">
          <div class="card-body p-3 p-sm-4">
            <div class="d-flex align-items-center flex-column flex-sm-row text-center text-sm-left">
              <span class="stamp stamp-md <?=$item['class'];?> text-white mb-2 mb-sm-0 mr-sm-3 stats-icon">
                <i class="<?=$item['icon'];?>"></i>
              </span>
              <div class="flex-grow-1 text-sm-right stats-content">
                <h3 class="mb-1 font-weight-bold number stats-value"><?=$item['value'];?></h3>
                <small class="text-muted text-uppercase stats-label"><?=$item['name'];?></small>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

  <!-- Mobile Responsive Styles -->
  <style>
    /* Banner Title */
    .banner-title {
      font-size: 1.5rem;
      font-weight: 700;
    }
    
    /* Banner Description */
    .banner-description {
      font-size: 0.85rem;
      line-height: 1.5;
      opacity: 0.95;
    }
    
    /* Banner Buttons */
    .banner-buttons {
      gap: 0.75rem;
    }
    
    .banner-buttons .btn {
      font-size: 0.9rem;
      white-space: nowrap;
      border-radius: 8px;
      font-weight: 600;
    }
    
    .banner-btn-fund {
      border: 2px solid white;
    }
    
    /* Balance Card Styles */
    .balance-card {
      background: linear-gradient(135deg, #2c2c2c 0%, #1a1a1a 100%);
      border-radius: 20px;
      padding: 1.5rem 1.5rem;
      color: white;
      position: relative;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
      max-width: 450px;
      margin: 0 auto;
    }
    
    .balance-card-header {
      margin-bottom: 1.25rem;
      text-align: left;
    }
    
    .account-label {
      font-size: 0.65rem;
      color: rgba(255,255,255,0.6);
      letter-spacing: 1px;
      font-weight: 600;
      display: block;
      margin-bottom: 0.4rem;
    }
    
    .account-name {
      font-size: 0.85rem;
      font-weight: 600;
      margin: 0;
      color: white;
    }
    
    .balance-card-body {
      margin-bottom: 1.25rem;
      text-align: left;
    }
    
    .balance-label {
      font-size: 0.65rem;
      color: rgba(255,255,255,0.6);
      letter-spacing: 1px;
      font-weight: 600;
      display: block;
      margin-bottom: 0.4rem;
    }
    
    .balance-display-wrapper {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }
    
    .balance-amount {
      font-size: 1.5rem;
      font-weight: 700;
      margin: 0;
      color: white;
      letter-spacing: 2px;
    }
    
    .balance-toggle-btn {
      background: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.2);
      border-radius: 8px;
      padding: 0.4rem 0.6rem;
      cursor: pointer;
      transition: all 0.3s ease;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .balance-toggle-btn:hover {
      background: rgba(255,255,255,0.2);
      border-color: rgba(255,255,255,0.3);
    }
    
    .balance-toggle-btn i {
      font-size: 1.1rem;
    }
    
    .balance-card-footer {
      text-align: left;
    }
    
    .bank-label {
      font-size: 0.65rem;
      color: rgba(255,255,255,0.6);
      letter-spacing: 1px;
      font-weight: 600;
      display: block;
      margin-bottom: 0.4rem;
    }
    
    .bank-name {
      font-size: 0.8rem;
      font-weight: 600;
      margin: 0;
      color: white;
    }
    
    /* Card decoration dots */
    .card-dots {
      position: absolute;
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 2px, transparent 2px);
      background-size: 10px 10px;
    }
    
    .card-dots-left {
      bottom: 20px;
      left: -20px;
    }
    
    .card-dots-right {
      top: 20px;
      right: -20px;
    }
    
    /* Decorative Wave */
    .banner-wave {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 60px;
      background: linear-gradient(45deg, rgba(255,255,255,0.1) 25%, transparent 25%, transparent 75%, rgba(255,255,255,0.1) 75%), 
                  linear-gradient(45deg, rgba(255,255,255,0.1) 25%, transparent 25%, transparent 75%, rgba(255,255,255,0.1) 75%);
      background-size: 40px 40px;
      background-position: 0 0, 20px 20px;
      opacity: 0.3;
    }
    
    /* Banner Decorative Background */
    .banner-section::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -10%;
      width: 300px;
      height: 300px;
      background: rgba(255,255,255,0.1);
      border-radius: 50%;
      filter: blur(80px);
    }
    
    /* Stats Row */
    .stats-row {
      margin-top: 2rem;
    }
    
    /* Stats Card */
    .stats-card {
      border-radius: 12px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .stats-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }
    
    .stats-icon {
      border-radius: 10px;
    }
    
    .stats-value {
      color: #2c3e50;
      font-size: 1.5rem;
    }
    
    .stats-label {
      font-weight: 600;
      letter-spacing: 0.5px;
      font-size: 0.75rem;
    }
    
    /* Tablet Screens (768px and up) */
    @media (min-width: 768px) {
      .banner-title {
        font-size: 2rem;
      }
      
      .banner-description {
        font-size: 0.9rem;
        line-height: 1.6;
      }
      
      .banner-buttons .btn {
        font-size: 1rem;
      }
      
      .balance-card {
        padding: 2.5rem 2rem;
      }
      
      .account-name {
        font-size: 1.5rem;
      }
      
      .balance-amount {
        font-size: 2.8rem;
      }
      
      .bank-name {
        font-size: 1.2rem;
      }
      
      .banner-wave {
        height: 80px;
        background-size: 50px 50px;
        background-position: 0 0, 25px 25px;
      }
      
      .banner-section::before {
        width: 400px;
        height: 400px;
      }
      
      .stats-row {
        margin-top: 3rem;
      }
      
      .stats-value {
        font-size: 1.75rem;
      }
      
      .stats-label {
        font-size: 0.8rem;
      }
    }
    
    /* Desktop Screens (992px and up) */
    @media (min-width: 992px) {
      .banner-title {
        font-size: 2.25rem;
      }
      
      .banner-description {
        font-size: 0.95rem;
      }
      
      .balance-card {
        padding: 3rem 2.5rem;
      }
      
      .account-name {
        font-size: 1.6rem;
      }
      
      .balance-amount {
        font-size: 3rem;
      }
      
      .banner-wave {
        height: 100px;
        background-size: 60px 60px;
        background-position: 0 0, 30px 30px;
      }
      
      .stats-value {
        font-size: 2rem;
      }
    }
    
    /* Large Desktop Screens (1200px and up) */
    @media (min-width: 1200px) {
      .banner-title {
        font-size: 2.5rem;
      }
      
      .banner-description {
        font-size: 1rem;
      }
    }
    
    /* Extra Small Screens (below 576px) */
    @media (max-width: 575.98px) {
      .banner-section {
        border-radius: 10px;
        margin-left: 0.5rem;
        margin-right: 0.5rem;
      }
      
      .banner-title {
        font-size: 1.3rem;
      }
      
      .banner-description {
        font-size: 0.8rem;
        line-height: 1.4;
      }
      
      .banner-buttons .btn {
        width: 100%;
        font-size: 0.85rem;
        padding: 0.65rem 1rem !important;
      }
      
      .balance-card {
        padding: 1.5rem 1.25rem;
        border-radius: 15px;
        margin-top: 1rem;
      }
      
      .account-name {
        font-size: 1.1rem;
      }
      
      .balance-amount {
        font-size: 2rem;
      }
      
      .bank-name {
        font-size: 0.95rem;
      }
      
      .banner-wave {
        height: 50px;
        background-size: 30px 30px;
        background-position: 0 0, 15px 15px;
      }
      
      .banner-section::before {
        width: 200px;
        height: 200px;
        filter: blur(60px);
      }
      
      .stats-row {
        margin-top: 1.5rem;
        margin-left: 0.5rem;
        margin-right: 0.5rem;
      }
      
      .stats-card .card-body {
        padding: 1rem !important;
      }
      
      .stats-value {
        font-size: 1.3rem;
      }
      
      .stats-label {
        font-size: 0.7rem;
      }
      
      .stats-icon {
        width: 40px !important;
        height: 40px !important;
        font-size: 1.2rem;
      }
    }
  </style>

<?php endif;?>