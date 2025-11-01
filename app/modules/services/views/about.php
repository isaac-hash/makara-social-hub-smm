<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makara Social Hub - Services</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
    <link href="<?php echo BASE; ?>themes/nico/assets/css/bootstrap.css" rel="stylesheet">
    <!-- <link href="<?php echo BASE; ?>assets/css/new_style.css" rel="stylesheet"> -->
    <!-- <link href="<?php echo BASE; ?>themes/nico/assets/css/sections.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>themes/nico/assets/css/utilities.css" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
        <?php
    require_once 'themes/nico/views/nav.php';
    ?>

    <?php
  $items_category = array_column($items_category, 'id', 'name');
  $items_category = array_flip(array_intersect_key($items_category, array_flip(array_keys($items))));
?>
    
    <style>
        :root {
            /* Makara Social Hub Brand Colors */
            --makara-blue: #0D0BD1;
            --makara-orange: #FF9933;
        }

        .bg-makara-blue {
            background-color: var(--makara-blue) !important;
        }

        .text-makara-blue {
            color: var(--makara-blue) !important;
        }

        .text-makara-orange {
            color: var(--makara-orange) !important;
        }

        .border-makara-orange {
            border-left: 5px solid var(--makara-orange);
            padding-left: 1rem;
        }
        
        /* Custom card style for services */
        .service-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            min-height: 100%; /* Ensures all cards in a row are same height */
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
        body{
         background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(236, 246, 255, 0.9));
        /*  backdrop-filter: blur(10px); */
        }
    </style>

    <!-- Responsive Styles -->
<style>
  /* Desktop - with sidebar offset */
  .responsive-section-header {
    /* margin-top: 9rem; */
    /* margin-left: 9rem; */
    width: 80%;
    margin: auto;
  }
  
  .responsive-content-row {
    margin-left: 6rem;
  }
  
  /* Tablet Screens (768px to 991px) */
  @media (max-width: 991px) {
    .responsive-section-header {
      margin-left: 5rem;
      /* margin-top: 7rem; */
    }
    
    .responsive-content-row {
      margin-left: 2.5rem;
      margin-right: 1rem;
    }
  }
  
  /* Mobile Screens (below 768px) */
  @media (max-width: 767px) {
    .responsive-section-header {
      margin-left: 0;
      margin-right: 0;
      /* margin-top: 6rem; */
      padding-left: 1rem;
      padding-right: 1rem;
    }
    
    .responsive-content-row {
      margin-left: 0;
      margin-right: 0;
      padding-left: 0.5rem;
      padding-right: 0.5rem;
    }
    
    .responsive-content-row .card {
      margin-bottom: 1rem;
    }
  }
  
  /* Extra Small Screens (below 576px) */
  @media (max-width: 575px) {
    .responsive-section-header {
      /* margin-top: 6rem; */
      padding-left: 0.75rem;
      padding-right: 0.75rem;
    }
    
    .responsive-section-header .page-title {
      font-size: 1.25rem;
    }
    
    .responsive-content-row {
      padding-left: 0.25rem;
      padding-right: 0.25rem;
    }
    
    .responsive-content-row .card-body {
      padding: 1rem;
    }
    
    /* Adjust search area on mobile */
    .search-area {
      margin-top: 1rem;
    }
    
    .search-area .input-group {
      width: 100%;
    }
  }
  
  /* When sidebar is collapsed or hidden */
  @media (min-width: 768px) {
    body.sidebar-collapsed .responsive-section-header,
    body.sidebar-hidden .responsive-section-header {
      margin-left: 1rem;
    }
    
    body.sidebar-collapsed .responsive-content-row,
    body.sidebar-hidden .responsive-content-row {
      margin-left: 0.5rem;
    }
  }
</style>
<!-- </head>
<body> -->




    <section class="py-5 bg-light " style="margin-top: 6rem; ">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto text-center">
                    <h1 class="display-4 fw-bolder text-makara-blue">Our Services: Fueling Your Digital Success</h1>
                    <p class="lead mt-3">At Makara Social Hub, we provide premium engagement, advertising, and branding solutions designed to help businesses, influencers, and creators boost visibility, grow audiences, and maximize impact across all digital platforms. We don't just offer services; we deliver measurable growth.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="page-title">
  <div class="row justify-content-between responsive-section-header">
    <div class="col-md-6">
      <h1 class="page-title">
        <i class="fe fe-list" aria-hidden="true"> </i> 
        <p>Price and services</p>
      </h1>
    </div>
    <div class="col-md-3">
      <!-- <div class="form-group">
        <select  name="status" class="form-control search-by-category">
          <option value="0"> <?=lang("all")?></option>
          <?php 
            if (!empty($items_category)) {
              foreach ($items_category as $key => $category) {
          ?>
          <option value="<?=$key?>"><?=$category?></option>
          <?php }}?>
        </select>
      </div> -->
    </div>
    <div class="col-md-3">
      <!-- <div class="form-group">
        <input type="text" name="query" class="form-control " id="service-search" placeholder="<?= lang("Search_for_") ?>" value=""> -->
      </div>          
    </div>
  </div>
</section>
<div class="row m-t-5 responsive-content-row" id="result_ajaxSearch">
  <?php 
    if(!empty($items)){
      $data = array(
        "controller_name"     => $controller_name,
        "params"              => $params,
        "columns"             => $columns,
        "items"               => $items,
      );
      $this->load->view('child/index', $data);
    } else {
      echo show_empty_item();
    }
  ?>
</div>

    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold text-makara-blue">Core Growth Solutions</h2>
            
            <div class="row mb-5">
                <div class="col-12">
                    <h3 class="fw-bold text-makara-orange border-makara-orange">Social Media Growth & Engagement</h3>
                    <p class="lead text-muted mb-4">Skyrocket your brand's presence with authentic engagement and follower growth across the platforms that matter.</p>
                </div>
                
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card service-card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-makara-blue">Multi-Platform Reach</h5>
                            <p class="card-text">We drive growth across Instagram, Facebook, TikTok, YouTube, Twitter (X), Telegram, Threads, & LinkedIn.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card service-card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-makara-blue">Engagement Metrics</h5>
                            <p class="card-text">Increase your Likes, Followers, Comments, Views, Shares, & Retweets.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card service-card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-makara-blue">WhatsApp & Live Growth</h5>
                            <p class="card-text">Get real, targeted Status Views and specialized Live Stream Engagement & Custom Interactions.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-12">
                    <h3 class="fw-bold text-makara-orange border-makara-orange">Reseller API & White-Label Solutions</h3>
                    <p class="lead text-muted mb-4">Launch your own successful social media growth business effortlessly with our reliable infrastructure.</p>
                </div>
                
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card service-card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-makara-blue">Seamless API Integration</h5>
                            <p class="card-text">Easy integration allows you to sell our services under your own brand with minimal effort.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card service-card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-makara-blue">Bulk Growth Packages</h5>
                            <p class="card-text">Offer your clients likes, followers, views, and more at competitive, scalable rates.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card service-card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-makara-blue">Automated Processing</h5>
                            <p class="card-text">Guarantee fast and efficient service delivery for all your reseller orders with automated processing.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-12">
                    <h3 class="fw-bold text-makara-orange border-makara-orange">Advertising & Brand Promotion</h3>
                    <p class="lead text-muted mb-4">Turn attention into action with highly targeted campaigns that drive tangible results.</p>
                </div>
                
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card service-card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-makara-blue">Targeted Social Ads</h5>
                            <p class="card-text">Precision advertising on platforms including Instagram, Facebook, TikTok, YouTube, Twitter, and more.</p>
                        </div>
                    </div>
                </div>
                


   
   
    </section>

    

<script>
  $(document).ready(function() {
    function filterServices() {
      const keyword = $('#service-search').val().trim().toLowerCase();
      const selectedCate = $('.search-by-category').val();
      $('.card').each(function() {
        let anyVisible = false;

        $(this).find('tbody tr.service-item').each(function() {
          const name = $(this).data('name').toLowerCase();
          const id = String($(this).data('id')).toLowerCase();
          const cateId = String($(this).data('cate-id'));

          const matchKeyword = name.includes(keyword) || id.includes(keyword);
          const matchCategory = selectedCate === "0" || cateId === selectedCate;
          if (matchKeyword && matchCategory) {
            $(this).show();
            anyVisible = true;
          } else {
            $(this).hide();
          }
        });
        $(this).toggle(anyVisible);
      });
    }
    $('#service-search').on('input', filterServices);
    $('.search-by-category').on('change', filterServices);
  });

</script>

    
 <?php
require_once 'themes/nico/views/footer.php';

?>




