<?php
  $columns = array(
    "id"            => ['name' => lang("Name"),    'class' => ''],
    "order_details" => ['name' => lang("rate_per_1000"), 'class' => 'text-center'],
    "created"       => ['name' => lang("min__max_order"), 'class' => 'text-center'],
    "status"        => ['name' => lang("Description"),  'class' => 'text-center'],
  );
?>

<style>
  :root {
    --makara-blue: #0D0BD1;
    --makara-orange: #FF9933;
    --makara-blue-light: rgba(13, 11, 209, 0.08);
    --makara-orange-light: rgba(255, 153, 51, 0.08);
  }

  .bestsellers-card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    overflow: hidden;
  }

  .bestsellers-header {
    background: linear-gradient(135deg, var(--makara-blue) 0%, #1a17e6 100%);
    color: white;
    padding: 1.5rem;
    border: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .bestsellers-header h3 {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 600;
    letter-spacing: 0.3px;
  }

  .bestsellers-table {
    margin: 0;
  }

  .bestsellers-table thead {
    background: var(--makara-blue-light);
    border-bottom: 2px solid var(--makara-blue);
  }

  .bestsellers-table thead th {
    padding: 1rem;
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--makara-blue);
    border: none;
  }

  .bestsellers-table tbody tr {
    border-bottom: 1px solid #f0f0f0;
    transition: all 0.2s ease;
  }

  .bestsellers-table tbody tr:hover {
    background: var(--makara-blue-light);
    transform: translateX(4px);
  }

  .bestsellers-table tbody tr:last-child {
    border-bottom: none;
  }

  .bestsellers-table tbody td {
    padding: 1rem;
    vertical-align: middle;
    color: #333;
  }

  .item-id-badge {
    display: inline-block;
    background: var(--makara-blue-light);
    color: var(--makara-blue);
    padding: 0.375rem 0.75rem;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.875rem;
  }

  .item-title {
    font-weight: 600;
    font-size: 1rem;
    color: #1a1a1a;
    margin: 0;
  }

  .price-badge {
    display: inline-flex;
    align-items: center;
    background: var(--makara-orange-light);
    color: var(--makara-orange);
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 700;
    font-size: 1rem;
  }

  .price-badge::before {
    content: "₦";
    margin-right: 2px;
    opacity: 0.7;
  }

  .min-max-badge {
    display: inline-block;
    background: #f8f9fa;
    border: 1px solid #e0e0e0;
    color: #666;
    padding: 0.5rem 0.875rem;
    border-radius: 6px;
    font-size: 0.875rem;
    font-weight: 500;
  }

  .action-btn {
    background: var(--makara-blue);
    color: white;
    border: none;
    padding: 0.5rem 1.25rem;
    border-radius: 6px;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .action-btn:hover {
    background: #0a09a8;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(13, 11, 209, 0.2);
  }

  .card-options {
    display: flex;
    gap: 0.5rem;
  }

  .card-options a {
    color: white;
    opacity: 0.9;
    transition: opacity 0.2s ease;
    text-decoration: none;
    padding: 0.25rem;
  }

  .card-options a:hover {
    opacity: 1;
  }

  @media (max-width: 768px) {
    .bestsellers-table {
      font-size: 0.875rem;
    }
    
    .bestsellers-table thead th,
    .bestsellers-table tbody td {
      padding: 0.75rem 0.5rem;
    }
  }
</style>

<?php if ($items_top_best_seller) { ?>
  <div class="row justify-content-center">
    <div class="col-md-12 col-xl-12">
      <div class="card bestsellers-card">
        <div class="card-header bestsellers-header">
          <h3 class="card-title"><?php echo lang("top_bestsellers"); ?></h3>
          <div class="card-options">
            <a href="#" class="card-options-collapse" data-toggle="card-collapse">
              <i class="fe fe-chevron-up"></i>
            </a>
            <a href="#" class="card-options-remove" data-toggle="card-remove">
              <i class="fe fe-x"></i>
            </a>
          </div>
        </div>
        <div class="table-responsive">
          <table class="<?= get_table_class(); ?> bestsellers-table">
            <?php echo render_table_thead($columns, false, true, false, []); ?>
            <tbody>
              <?php foreach ($items_top_best_seller as $key => $item) {
                $show_item_view = show_item_details('services', $item);
              ?>
                <tr class="tr_<?php echo esc($item['id']); ?>">
                  <td class="text-center">
                    <span class="item-id-badge">#<?=esc($item['id']);?></span>
                  </td>
                  <td>
                    <div class="item-title"><?=esc($item['name']);?></div>
                  </td>
                  <td class="text-center">
                    <span class="price-badge"><?=(double)$item['price'];?></span>
                  </td>
                  <td class="text-center">
                    <span class="min-max-badge"><?=$item['min'] . ' / ' . $item['max']?></span>
                  </td>
                  <td class="text-center">
                    <?php echo $show_item_view;?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php } ?>