<section class="page-title">
  <div class="row justify-content-between">
    <div class="col-md-6">
      <h1 class="page-title">
        <i class="fe fe-list" aria-hidden="true"> </i> 
        All Services
      </h1>
    </div>
  </div>
</section>
<div class="row m-t-5" id="result_ajaxSearch">
  <div class="col-md-12 col-xl-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Services</h3>
        <div class="card-options">
          <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
          <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-hover table-bordered table-vcenter card-table">
          <thead>
            <tr>
              <th class="text-center">ID</th>
              <th>Name</th>
              <th class="text-center">Rate per 1000</th>
              <th class="text-center">Min</th>
              <th class="text-center">Max</th>
              <th class="text-center">Description</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($items)) {
              foreach ($items as $key => $item) {
                $show_item_view     = show_item_details('services', $item);
                $item_price         = (double) $item['price'];
            ?>
              <tr class="tr_<?php echo esc($item['id']); ?>">
                <td class="text-center w-10p"><?=esc($item['id']);?></td>
                <td><div class="title"><?=esc($item['name']);?></div></td>
                <td class="text-center w-10p"><div><?=$item_price ;?></div></td>
                <td class="text-center w-10p text-muted"><?=esc($item['min']) ?></td>
                <td class="text-center w-10p text-muted"><?=esc($item['max'])?></td>
                <td class="text-center w-5p"> <?php echo $show_item_view;?></td>
              </tr>
            <?php }}?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
