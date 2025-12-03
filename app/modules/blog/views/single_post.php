<?php
    require_once 'themes/nico/views/nav.php';
    ?>

<style>
  .blog-single{
    margin-top: 5rem;
  }
  .sidebar-wrapper{
    margin-top: 7rem;
  }
  .main-content-wrapper{
    padding: 4rem 0; 
    /* margin-top: 5rem;   */
    min-height: 100vh;
    
  }
  @media (max-width:320px){
    .blog-single{
    margin-top: 3rem;
  }
    .main-content-wrapper{
      /* margin-left: 3rem; */
      width: 19rem;
    }
  }
  @media (min-width:425px) and (max-width:768px){
    .blog-single{
      margin-top: 3rem;
    }
    .main-content-wrapper{
      /* margin-left: 3rem; */
      width: 25rem;
    }
  }
  @media (min-width:768px) and (max-width: 990px){
    .blog-single{
      margin-top: 3rem;
    }
    .main-content-wrapper{
      margin-left: 3rem;
      /* margin-top: 3rem; */
      width: auto;
    }
  }

</style>

<section class="blog-single" style="">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="row g-4">
          <!-- Main Content -->
          <div class="col-lg-8">
            <div class="main-content-wrapper" style="animation: fadeInUp 0.6s ease-out;">
              <?php $this->load->view('/child/detail.php', ['item' => $item, 'lang_code' => $lang_code]); ?>
            </div>
          </div>

          <!-- Sidebar -->
          <div class="col-lg-4">
            <div class="sidebar-wrapper" style="position: sticky; top: 2rem; animation: fadeInUp 0.6s ease-out 0.2s; animation-fill-mode: both;">
              
              <!-- Last Posts Widget -->
              <div class="sidebar-widget mb-4" style="background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); transition: all 0.3s ease;">
                <div class="widget-header mb-4" style="border-bottom: 3px solid #6366f1; padding-bottom: 1rem;">
                  <h3 class="widget-title" style="font-size: 1.3rem; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 0.75rem;">
                    <span style="width: 6px; height: 24px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 3px;"></span>
                    <?=lang('Recent Posts')?>
                  </h3>
                </div>
                <div class="widget-content">
                  <?php $this->load->view('/child/last_posts.php', ['items' => $items_related_posts, 'lang_code' => $lang_code]); ?>
                </div>
              </div>

              <!-- Categories Widget -->
              <div class="sidebar-widget mb-4" style="background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); transition: all 0.3s ease;">
                <div class="widget-header mb-4" style="border-bottom: 3px solid #6366f1; padding-bottom: 1rem;">
                  <h3 class="widget-title" style="font-size: 1.3rem; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 0.75rem;">
                    <span style="width: 6px; height: 24px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 3px;"></span>
                    <?=lang('Categories')?>
                  </h3>
                </div>
                <div class="widget-content">
                  <?php $this->load->view('/child/post_categories.php', ['count_items_by_category' => $count_items_by_category, 'lang_code' => $lang_code]); ?>
                </div>
              </div>

              <!-- Newsletter Widget (Optional Enhancement) -->
              <div class="sidebar-widget" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 16px; padding: 2rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
                <div class="text-center">
                  <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <i class="fa fa-envelope" style="font-size: 1.5rem;"></i>
                  </div>
                  <h4 style="font-weight: 700; margin-bottom: 0.5rem;"><?=lang('Stay Updated')?></h4>
                  <p style="font-size: 0.9rem; opacity: 0.9; margin-bottom: 1.5rem;">
                    <?=lang('Subscribe to our newsletter for latest updates')?>
                  </p>
                  <button class="btn btn-light btn-block" style="border-radius: 50px; padding: 0.75rem 1.5rem; font-weight: 600; border: none; transition: all 0.3s ease;">
                    <?=lang('Subscribe Now')?>
                  </button>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
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

  /* Main content card styling */
  .main-content-wrapper > * {
    background: white;
    border-radius: 16px;
    padding: 2.5rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    margin-bottom: 2rem;
  }

  /* Sidebar widget hover effects */
  .sidebar-widget:hover {
    box-shadow: 0 8px 16px rgba(0,0,0,0.1) !important;
    transform: translateY(-2px);
  }

  /* Newsletter button hover */
  .sidebar-widget .btn-light:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(255,255,255,0.3);
  }

  /* Responsive Design */
  @media (max-width: 992px) {
    .blog-single {
      padding: 2rem 0 !important;
    }
    
    .sidebar-wrapper {
      position: relative !important;
      top: 0 !important;
    }
    
    .main-content-wrapper > * {
      padding: 1.5rem !important;
    }
    
    .sidebar-widget {
      padding: 1.5rem !important;
    }
  }

  @media (max-width: 768px) {
    .widget-title {
      font-size: 1.1rem !important;
    }
    
    .main-content-wrapper > * {
      border-radius: 12px !important;
    }
    
    .sidebar-widget {
      border-radius: 12px !important;
    }
  }

  /* Sticky sidebar adjustment */
  @media (min-width: 992px) {
    .sidebar-wrapper {
      max-height: calc(100vh - 4rem);
      overflow-y: auto;
      scrollbar-width: thin;
      scrollbar-color: #6366f1 #f1f5f9;
    }
    
    .sidebar-wrapper::-webkit-scrollbar {
      width: 6px;
    }
    
    .sidebar-wrapper::-webkit-scrollbar-track {
      background: #f1f5f9;
      border-radius: 10px;
    }
    
    .sidebar-wrapper::-webkit-scrollbar-thumb {
      background: #6366f1;
      border-radius: 10px;
    }
    
    .sidebar-wrapper::-webkit-scrollbar-thumb:hover {
      background: #4f46e5;
    }
  }

  /* Smooth scroll behavior */
  html {
    scroll-behavior: smooth;
  }

  /* Widget content styling (for child views) */
  .widget-content ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .widget-content ul li {
    padding: 0.75rem 0;
    border-bottom: 1px solid #e2e8f0;
    transition: padding-left 0.3s ease;
  }

  .widget-content ul li:last-child {
    border-bottom: none;
  }

  .widget-content ul li:hover {
    padding-left: 0.5rem;
  }

  .widget-content a {
    color: #475569;
    text-decoration: none;
    transition: color 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .widget-content a:hover {
    color: #6366f1;
  }

  /* Category badges in widget */
  .widget-content .badge {
    background: rgba(99, 102, 241, 0.1);
    color: #6366f1;
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.75rem;
  }

  /* Post thumbnails in sidebar */
  .widget-content img {
    border-radius: 8px;
    transition: transform 0.3s ease;
  }

  .widget-content a:hover img {
    transform: scale(1.05);
  }
</style>

<?php
    require_once 'themes/nico/views/footer.php';
    ?>