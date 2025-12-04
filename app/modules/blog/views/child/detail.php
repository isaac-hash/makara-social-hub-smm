<style>
    .header{
        margin-top: 3rem;
        background: var(--background-color);
        outline: 2px solid var(--text-color);
    }
    @media (max-width:768px) {
        .header{
            margin-top: 5rem;
        }
    }
</style>




<?php
  $item_link_related_category = cn('blog/category/'                    . $item['category_url_slug']);
  $item_released              = show_item_post_released_time($item['released']);
  $author                     = get_option('website_name');
  $item_category_name         = show_category_name_by_lang_code($item, $lang_code);
?>
<div class="blog-content header">
  <div class="image-thumbnail text-center">
    <img src="<?= $item['image']; ?>" alt="<?= esc($item['name']); ?>" style="max-width: 100%; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
  </div>
  <h1 class="title" style="color:var(--text-color)"><?= esc($item['name']); ?></h1>
  <div class="post-info">
    <p>
      <span>
        <i class="fa fa-user"></i>
        <a href="javascript:void(0)" title="<?= esc($author); ?>" rel="author"><?= esc($author); ?></a>
      </span>
      <span style="color:var(--text-color)">
        <i class="fa fa-calendar"></i> <?= $item_released; ?> </span>
      <span style="color:var(--text-color)">
        <i class="fa fa-tag"></i>
        <a href="<?= $item_link_related_category; ?>"><?= $item_category_name; ?></a>
      </span>
    </p>
  </div>
  <div class="details" style="color:var(--text-color)">
    <?= $item['content']; ?>
  </div>
</div>
<div class="blog-back text-center">
  <a href="<?= cn('blog'); ?>" class="btn btn-outline-primary btn-pill btn-back-blog btn-min-width mr-1 mb-1">
    <span>
      <i class="fe fe-arrow-left"></i>
    </span> <?=lang('back_to_blog')?> </a>
</div>