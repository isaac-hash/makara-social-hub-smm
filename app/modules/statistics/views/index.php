<?php
$sections = [
  [
    'id' => 'header_area',
    'url' => cn($controller_name . '/load_header_area'),
  ],
  [
    'id' => 'chart_and_orders_area',
    'url' => cn($controller_name . '/load_chart_and_orders_area'),
    'callback' => 'chartCallback',
  ],
  [
    'id' => 'items_top_best_seller',
    'url' => cn($controller_name . '/load_items_top_best_seller'),
  ],
];
?>

<!-- Main Content Wrapper - This handles the sidebar spacing -->
<div class="main-content-wrapper">
  <div class="row justify-content-center row-card statistics">
    <?php foreach ($sections as $section): ?>
      <div class="col-sm-12" id="<?= $section['id']; ?>">
        <?= render_component_loader(); ?>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<script>
  const sectionCallbacks = {
    chartCallback: function(response) {
      Chart_template.chart_spline('#orders_chart_spline', JSON.parse(response.chart_spline));
      Chart_template.chart_pie('#orders_chart_pie', JSON.parse(response.chart_pie));

      // Attach event listeners after the header area is loaded
      const btnOrder = document.getElementById("btnPlaceOrder");
      const btnFund = document.getElementById("btnFundWallet");
      const toggleBalance = document.getElementById("toggleBalance");
      const balanceAmount = document.getElementById("balanceAmount");
      const eyeIcon = document.getElementById("eyeIcon");

      if (btnOrder) {
        btnOrder.addEventListener("click", (e) => {
          e.preventDefault();
          console.log("Place Order clicked");
          window.location.href = btnOrder.getAttribute("href");
        });
      }

      if (btnFund) {
        btnFund.addEventListener("click", (e) => {
          e.preventDefault();
          console.log("Fund Wallet clicked");
          window.location.href = btnFund.getAttribute("href");
        });
      }

      if (toggleBalance && balanceAmount && eyeIcon) {
        toggleBalance.addEventListener("click", (e) => {
          e.preventDefault();
          const isVisible = eyeIcon.classList.contains("fe-eye-off");
          if (isVisible) {
            balanceAmount.textContent = "₦**********";
            eyeIcon.classList.replace("fe-eye-off", "fe-eye");
          } else {
            const actualBalance = balanceAmount.getAttribute("data-balance");
            balanceAmount.textContent = "₦" + actualBalance;
            eyeIcon.classList.replace("fe-eye", "fe-eye-off");
          }
        });
      }
    }
  };

  const sections = <?= json_encode($sections); ?>;

  $(document).ready(function() {
    sections.forEach(section => {
      const cb = section.callback ? sectionCallbacks[section.callback] : null;
      loadSection(section.url, '#' + section.id, cb);
    });
  });
</script>

<?php
// require 'themes/nico/views/footer.php'
?>