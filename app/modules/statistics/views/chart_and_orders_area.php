<?php
if ($chart_and_orders_area) {
?>
  <!-- Orders Statistics Cards -->
  <div class="row g-4 mb-4 rounded chart-orders-statistics">
    <?php
      foreach ($chart_and_orders_area['orders_statistics'] as $key => $item) {
    ?>
      <div class="col-sm-6 col-xl-3">
        <div class="stats-card card border-0 shadow-sm h-100">
          <div class="card-body p-4">
            <div class="d-flex align-items-start justify-content-between">
              <div class="stats-content flex-grow-1">
                <p class="stats-label text-muted mb-2 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                  <?=$item['name'];?>
                </p>
                <h2 class="stats-value mb-0 fw-bold" style="font-size: 2rem; color: #2c3e50;">
                  <?=$item['value'];?>
                </h2>
              </div>
              <div class="stats-icon-wrapper">
                <div class="stats-icon <?=$item['class'];?> rounded-circle d-flex align-items-center justify-content-center" 
                     style="width: 56px; height: 56px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                  <i class="<?=$item['icon'];?> text-white" style="font-size: 1.5rem;"></i>
                </div>
              </div>
            </div>
            <!-- Optional: Add a small trend indicator -->
            <div class="stats-footer mt-3 pt-3 border-top border-light">
              <small class="text-muted">
                <i class="fa-solid fa-chart-line me-1"></i>
                <span>View details</span>
              </small>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
<?php
  }
?>

<!-- Chart Area -->
<div class="row g-4">
  <div class="col-12">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white border-bottom py-3">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <h3 class="card-title mb-1 fw-bold" style="color: #2c3e50; font-size: 1.25rem;">
              <?=lang("recent_orders")?>
            </h3>
            <p class="text-muted mb-0" style="font-size: 0.875rem;">
              Order trends and distribution analytics
            </p>
          </div>
          <div class="chart-controls d-flex gap-2">
            <button class="btn btn-sm btn-outline-secondary">
              <i class="fa-solid fa-calendar-days me-1"></i>
              Last 7 Days
            </button>
            <button class="btn btn-sm btn-outline-secondary">
              <i class="fa-solid fa-download"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="card-body p-4">
        <div class="row g-4">
          <!-- Spline Chart -->
          <div class="col-lg-12">
            <div class="chart-container">
              <div class="chart-header mb-3">
                <h5 class="fw-semibold text-muted" style="font-size: 0.95rem;">
                  <i class="fa-solid fa-chart-line text-primary me-2"></i>
                  Orders Timeline
                </h5>
              </div>
              <div id="orders_chart_spline" style="height: 24rem;"></div>
            </div>
          </div>
          
          <!-- Pie Chart -->
          <div class="col-lg-12">
            <div class="chart-container">
              <div class="chart-header mb-3">
                <h5 class="fw-semibold text-muted" style="font-size: 0.95rem;">
                  <i class="fa-solid fa-chart-pie text-info me-2"></i>
                  Status Distribution
                </h5>
              </div>
              <div id="orders_chart_pie" style="height: 24rem;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  :root {
      --makara-blue: #0D0BD1;
      --makara-blue-dark: #020133;
      --makara-orange: #FF9933;
      --makara-blue-light: rgba(13, 11, 209, 0.08);
      --makara-orange-light: rgba(255, 153, 51, 0.08);
  }

  /* Main Statistics Container with Enhanced Gradient */
  .chart-orders-statistics {
      background: linear-gradient(135deg, 
          var(--makara-blue) 0%, 
          var(--makara-blue-dark) 50%, 
          #1a0a4e 100%
      );
      padding: 2.5rem 1.5rem;
      border-radius: 20px;
      position: relative;
      overflow: hidden;
      box-shadow: 0 10px 40px rgba(13, 11, 209, 0.3);
  }

  /* Animated gradient overlay */
  .chart-orders-statistics::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(135deg, 
          transparent 0%, 
          rgba(255, 153, 51, 0.1) 50%, 
          transparent 100%
      );
      opacity: 0;
      transition: opacity 0.5s ease;
  }

  .chart-orders-statistics:hover::before {
      opacity: 1;
  }

  /* Decorative elements */
  .chart-orders-statistics::after {
      content: '';
      position: absolute;
      top: -50%;
      right: -20%;
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, 
          rgba(255, 153, 51, 0.15) 0%, 
          transparent 70%
      );
      border-radius: 50%;
      pointer-events: none;
  }

  /* Enhanced Stats Cards with Glass Morphism */
  .stats-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border-radius: 16px;
      overflow: hidden;
      position: relative;
  }

  .stats-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, 
          var(--makara-blue) 0%, 
          var(--makara-orange) 100%
      );
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.4s ease;
  }

  .stats-card:hover::before {
      transform: scaleX(1);
  }

  .stats-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 35px rgba(13, 11, 209, 0.25);
      background: rgba(255, 255, 255, 1);
  }

  /* Stats Content Styling */
  .stats-label {
      color: rgba(14, 13, 13, 0.9) !important;
      font-weight: 600;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .stats-value {
      color: black !important;
      text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
  }

  /* Enhanced Icon Wrapper */
  .stats-icon-wrapper {
      position: relative;
  }

  .stats-icon {
      position: relative;
      z-index: 1;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .stats-icon::before {
      content: '';
      position: absolute;
      inset: -4px;
      border-radius: 50%;
      background: inherit;
      opacity: 0.3;
      filter: blur(8px);
      transition: all 0.4s ease;
  }

  .stats-card:hover .stats-icon {
      transform: rotate(15deg) scale(1.15);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
  }

  .stats-card:hover .stats-icon::before {
      opacity: 0.5;
      inset: -8px;
  }

  /* Updated Gradient Classes with Makara Theme */
  .bg-gradient-primary {
      background: linear-gradient(135deg, var(--makara-blue) 0%, #1a18e0 100%);
  }

  .bg-gradient-success {
      background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
  }

  .bg-gradient-info {
      background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
  }

  .bg-gradient-warning {
      background: linear-gradient(135deg, var(--makara-orange) 0%, #ff6b35 100%);
  }

  .bg-gradient-secondary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  }

  .bg-gradient-purple {
      background: linear-gradient(135deg, #667eea 0%, var(--makara-blue) 100%);
  }

  .bg-gradient-danger {
      background: linear-gradient(135deg, #ff0844 0%, #ff5e62 100%);
  }

  .bg-gradient-dark {
      background: linear-gradient(135deg, var(--makara-blue-dark) 0%, #000000 100%);
  }

  /* Stats Footer Enhancement */
  .stats-footer {
      border-top: 1px solid rgba(255, 255, 255, 0.2) !important;
      opacity: 0.8;
      transition: all 0.3s ease;
  }

  .stats-footer small {
      color: rgba(15, 15, 15, 0.9) !important;
      text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  }

  .stats-card:hover .stats-footer {
      opacity: 1;
      border-top-color: rgba(255, 255, 255, 0.4) !important;
  }

  /* Responsive Adjustments */
  @media (max-width: 1200px) {
      .chart-orders-statistics {
          padding: 2rem 1.25rem;
      }
      
      .chart-orders-statistics::after {
          width: 350px;
          height: 350px;
      }
  }

  @media (max-width: 768px) {
      .chart-orders-statistics {
          padding: 1.5rem 1rem;
          border-radius: 16px;
      }
      
      .chart-orders-statistics::after {
          display: none;
      }
      
      .stats-value {
          font-size: 1.75rem !important;
      }
      
      .stats-icon {
          width: 48px !important;
          height: 48px !important;
      }
      
      .stats-icon i {
          font-size: 1.25rem !important;
      }
  }

  @media (max-width: 576px) {
      .chart-orders-statistics {
          padding: 1.25rem 0.75rem;
      }
      
      .stats-card .card-body {
          padding: 1.25rem !important;
      }
  }

  /* Animation for cards on load */
  @keyframes slideInUp {
      from {
          opacity: 0;
          transform: translateY(30px);
      }
      to {
          opacity: 1;
          transform: translateY(0);
      }
  }

  .stats-card {
      animation: slideInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
  }

  .stats-card:nth-child(1) { animation-delay: 0.1s; opacity: 0; }
  .stats-card:nth-child(2) { animation-delay: 0.2s; opacity: 0; }
  .stats-card:nth-child(3) { animation-delay: 0.3s; opacity: 0; }
  .stats-card:nth-child(4) { animation-delay: 0.4s; opacity: 0; }
  .stats-card:nth-child(5) { animation-delay: 0.5s; opacity: 0; }
  .stats-card:nth-child(6) { animation-delay: 0.6s; opacity: 0; }
  .stats-card:nth-child(7) { animation-delay: 0.7s; opacity: 0; }
  .stats-card:nth-child(8) { animation-delay: 0.8s; opacity: 0; }

  /* Glow effect on hover */
  @keyframes glow {
      0%, 100% {
          box-shadow: 0 10px 40px rgba(13, 11, 209, 0.3);
      }
      50% {
          box-shadow: 0 10px 40px rgba(255, 153, 51, 0.4);
      }
  }

  .chart-orders-statistics:hover {
      animation: glow 3s ease-in-out infinite;
  }
</style>