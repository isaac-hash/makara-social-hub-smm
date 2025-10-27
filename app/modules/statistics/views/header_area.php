<?php
  if ($header_area) :
?>

<?php
$user = current_logged_user();
$user_name = $user->first_name . ' ' . $user->last_name;
// echo $user_name;

$hour = date('G');
$period_of_day = '';

if ($hour >= 5 && $hour <= 11) {
    $period_of_day = "Good Morning";
} else if ($hour >= 12 && $hour <= 17) {
    $period_of_day = "Good Afternoon";
} else {
    $period_of_day = "Good Evening";
}
?>
  <!-- Banner Section -->
  <div class="banner-section mb-5 mt-6" style="background: linear-gradient(135deg, #0D0BD1 0%, #3b38eeff 100%); border-radius: 15px; overflow: hidden; position: relative;">
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

  <a 
    href="<?=cn($header_elements['add_funds']['route-name']); ?>" 
    id="btnFundWallet" 
    class="btn btn-outline-light px-3 px-sm-4 py-2 banner-btn-fund"
  >
    <i class="fe fe-dollar-sign mr-1 mr-sm-2"></i> Fund Wallet
  </a>
</div>



      </div>
      
      <!-- Right Logo/Image -->
      <div class="col-md-6 col-lg-5 text-center px-2 px-sm-3">
        <div class="banner-logo">
          <div class="banner-logo-inner">
            <!-- Replace with your logo -->
            <h1 class="text-white mb-0 logo-text">
              <i class="fe fe-zap"></i> Makara <span class="logo-social">Social</span>
            </h1>
          </div>
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
      <div class="col-sm-6 col-lg-3 mb-3 mb-sm-4">
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
    
    /* Banner Logo Container */
    .banner-logo {
      background: #ff9933;
      /* background: rgba(0,0,0,0.3); */
      border-radius: 15px;
      padding: 2rem 1.5rem;
      backdrop-filter: blur(10px);
    }
    
    .banner-logo-inner {
      background: rgba(0,0,0,0.3);
      /* background: rgba(0,0,0,0.3); */
      border-radius: 15px;
      padding: 1.5rem 1rem;
      display: inline-block;
      width: fit-content;
      margin: auto;
    }
    
    .logo-text {
      font-size: 1.3rem;
      font-weight: 500;
    }
    
    .logo-social {
      font-size: 1.3rem;
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
      
      .banner-logo {
        padding: 2.5rem 2rem;
      }
      
      .banner-logo-inner {
        padding: 1.75rem 1.5rem;
      }
      
      .logo-text {
        font-size: 1.4rem;
      }
      
      .logo-social {
        font-size: 1.4rem;
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
      
      .banner-logo {
        padding: 3rem;
      }
      
      .banner-logo-inner {
        padding: 2rem;
      }
      
      .logo-text {
        font-size: 1.5rem;
      }
      
      .logo-social {
        font-size: 1.5rem;
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
      
      .banner-logo {
        padding: 1.5rem 1rem;
        border-radius: 10px;
        margin-top: 1rem;
      }
      
      .banner-logo-inner {
        padding: 1.25rem 0.75rem;
        border-radius: 10px;
      }
      
      .logo-text {
        font-size: 1.1rem;
      }
      
      .logo-social {
        font-size: 1.1rem;
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

  <script>
  document.addEventListener("DOMContentLoaded", () => {
    const btnOrder = document.getElementById("btnPlaceOrder");
    const btnFund = document.getElementById("btnFundWallet");

    btnOrder.addEventListener("click", (e) => {
      e.preventDefault(); // Prevent default <a> redirect
      console.log("Place Order clicked");
      window.location.href = btnOrder.getAttribute("href"); // Redirect
    });

    btnFund.addEventListener("click", (e) => {
      e.preventDefault();
      console.log("Fund Wallet clicked");
      window.location.href = btnFund.getAttribute("href");
    });
  });
</script>

<?php endif;?>