<style>
:root {
            --makara-blue: #0D0BD1;
            --makara-orange: #FF9933;
            --makara-border: #020c68ff;
            --makara-blue-bg: #020c6867;
        }
</style> 


<div class="col-md-10 col-xl-10 mb-4 mx-auto" style="background: var(--makara-blue); padding: 10px; margin:1rem; border-radius: 8px;">
    <div class="card ">
      <div class="card-header" style="background: var(--makara-blue);">
        <h3 class="card-title" style="color: white;"><i class="fe fe-heart"></i> <?= lang('Choose_your_preferred_social_network')?></h3>
        <div class="card-options">
          <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
        </div>
      </div>
      <?php
        $social_media = filter_categories_by_keyword($filter_categories);
      ?>
      <div class="card-body social-cat" style="background: var(--makara-blue);">
        <div class="btn-list social-btn">
          <?php foreach ($social_media as $key => $item_social) : ?>
            <button class="brand-category btn round btn-outline-primary text-white" data-id="<?= esc($key); ?>">
              <?= $item_social['icon_class']; ?>
              <?= $item_social['name']; ?>
            </button>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
</div>