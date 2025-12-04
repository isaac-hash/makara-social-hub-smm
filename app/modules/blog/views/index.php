<?php
    require_once 'themes/nico/views/nav.php';
    ?>

    <style>
      @media (max-width:750px) {
        .blog{
          margin-top: 5rem;
          margin-left: 2rem;
        }
      }
    </style>


<section class="blog" style="padding: 4rem 0;  min-height: 100vh;">
  <div class="container">
    <!-- Header Section -->
    <div class="row justify-content-center mb-5">
      <div class="col-lg-8 text-center">
        <div class="blog-header" style="animation: fadeInUp 0.6s ease-out;">
          <span class="badge" style="background: rgba(99, 102, 241, 0.1); padding: 0.5rem 1.5rem; border-radius: 50px; font-weight: 600; margin-bottom: 1rem; margin-top: 4rem; color: var(--text-color); display: inline-block;">
            <?=lang('Blog')?>
          </span>
          <h1 class="title-name" style="font-size: 3rem; font-weight: 700; color: var(--text-color); margin-bottom: 1.5rem; line-height: 1.2;">
            <?=lang('Blog')?>
          </h1>
          <p class="lead" style="font-size: 1.1rem; color: var(--text-color); line-height: 1.8; max-width: 600px; margin: 0 auto;">
            <?php echo lang("we_bring_you_the_best_stories_and_articles_youll_find_tips_on_all_social_networks_growth_and_general_social_media_advice_as_well_as_latest_updates_related_to_our_services"); ?>
          </p>
        </div>
      </div>
    </div>

    <?php $author = get_option('website_name'); ?>
    
    <?php if (!empty($items)) : ?>
      <!-- Blog Grid -->
      <div class="row g-4">
        <?php foreach ($items as $key => $item) : ?>
          <?php 
            $item_link_detail = cn('blog/' . $item['url_slug']);
            $item_link_related_category = cn('blog/category/' . strip_tags($item['category_url_slug']));
            $limit_string = ($lang_code == 'en') ? 69 : 18;
            $item_title = truncate_string(strip_tags($item['name']), $limit_string);
            $limit_string = ($lang_code == 'en') ? 200 : 50;
            $item_content = truncate_string(strip_tag_css($item['content'], 'html'), $limit_string);
            $item_released = show_item_post_released_time($item['released']);
            $item_category_name = show_category_name_by_lang_code($item, $lang_code);
          ?>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <article class="card blog-item h-100 border-0 shadow-sm" style="transition: all 0.3s ease; border-radius: 16px; overflow: hidden; background: var(--background-color); outline: 2px solid var(--text-color);">
              <div class="box-image position-relative" style="overflow: hidden; height: 280px;">
                <a href="<?= $item_link_detail ?>" style="display: block; height: 100%;">
                  <img class="img-fluid w-100 h-100" src="<?= $item['image'] ?>" alt="<?= $item['url_slug'] ?>" 
                       style="object-fit: cover; transition: transform 0.4s ease;">
                </a>
                <div class="category-badge position-absolute" style="top: 1rem; left: 1rem;">
                  <a href="<?= $item_link_related_category ?>" 
                     style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); padding: 0.5rem 1rem; border-radius: 50px; color: #6366f1; font-weight: 600; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <i class="fa fa-tag" style="font-size: 0.75rem;"></i>
                    <?= $item_category_name ?>
                  </a>
                </div>
              </div>
              
              <div class="content d-flex flex-column" style="padding: 2rem;">
                <h4 class="title mb-3" style="font-size: 1.4rem; font-weight: 700; line-height: 1.4;">
                  <a href="<?= $item_link_detail ?>" style="color: var(--text-color); text-decoration: none; transition: color 0.3s ease;">
                    <?= $item_title ?>
                  </a>
                </h4>
                
                <div class="short-desc mb-4" style="color: var(--text-color); line-height: 1.7; flex-grow: 1;">
                  <?= $item_content ?>
                </div>
                
                <div class="meta d-flex align-items-center justify-content-between pt-3" style="border-top: 1px solid #e2e8f0; font-size: 0.9rem;">
                  <div class="author-info d-flex align-items-center" style="gap: 0.75rem;">
                    <div class="avatar" style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 0.9rem;">
                      <?= substr(esc($author), 0, 1) ?>
                    </div>
                    <div>
                      <div style="color: var(--text-color); font-weight: 600;">
                        <?= esc($author) ?>
                      </div>
                      <small class="text-muted d-flex align-items-center" style="gap: 0.25rem; color: var(--text-color);">
                        <i class="fa fa-calendar" style="font-size: 0.75rem;"></i> 
                        <?= $item_released ?>
                      </small>
                    </div>
                  </div>
                  
                  <a href="<?= $item_link_detail ?>" class="read-more" 
                     style="color: var(--primary-color); font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 0.5rem; transition: gap 0.3s ease;">
                    <?=lang('Read More')?>
                    <i class="fa fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </article>
          </div>
        <?php endforeach ?>
      </div>
      
      <!-- Pagination -->
      <div class="row mt-5">
        <div class="col-12">
          <div class="pagination-wrapper" style="display: flex; justify-content: center;">
            <?php echo show_pagination($pagination, ''); ?>
          </div>
        </div>
      </div>
      
    <?php else : ?>
      <div class="row">
        <div class="col-12">
          <div class="empty-state text-center" style="padding: 4rem 2rem; background: white; border-radius: 16px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <?= show_empty_item(); ?>
          </div>
        </div>
      </div>
    <?php endif ?>
  </div>
</section>

<style>
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.blog-item:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.12) !important;
}

.blog-item:hover .box-image img {
  transform: scale(1.05);
}

.blog-item .title a:hover {
  color: #6366f1 !important;
}

.blog-item .read-more:hover {
  gap: 0.75rem !important;
}

.category-badge a:hover {
  background: rgba(99, 102, 241, 0.95) !important;
  color: white !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .blog {
    padding: 2rem 0 !important;
  }
  
  .blog-header h1 {
    font-size: 2rem !important;
  }
  
  .box-image {
    height: 220px !important;
  }
  
  .content {
    padding: 1.5rem !important;
  }
}

/* Pagination styling */
.pagination-wrapper .pagination {
  gap: 0.5rem;
}

.pagination-wrapper .page-link {
  border-radius: 8px;
  border: none;
  padding: 0.5rem 1rem;
  color: #6366f1;
  font-weight: 600;
  transition: all 0.3s ease;
}

.pagination-wrapper .page-link:hover {
  background: #6366f1;
  color: white;
}

.pagination-wrapper .page-item.active .page-link {
  background: #6366f1;
  color: white;
}
</style>

<?php
    require_once 'themes/nico/views/footer.php';
    ?>