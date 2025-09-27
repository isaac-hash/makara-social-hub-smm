<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=get_option('website_title', "Makara - Social Hub")?></title>
    <meta name="description" content="<?=get_option('website_desc', "Your one-stop solution for social media management.")?>">
    <meta name="keywords" content="<?=get_option('website_keywords', "social media, smm, panel, marketing")?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?=get_option('website_favicon', BASE."assets/images/favicon.png")?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo BASE; ?>themes/nico/assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>assets/css/new_style.css" rel="stylesheet">

    <script type="text/javascript">
      var token = '<?=$this->security->get_csrf_hash()?>',
          PATH  = '<?php echo PATH; ?>',
          BASE  = '<?php echo BASE; ?>';
    </script>
</head>
<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="<?=get_option('website_logo_white', BASE."assets/images/logo-white.png")?>" alt="Makara Logo" style="height: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=cn('auth/login')?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="<?=cn('auth/signup')?>" role="button">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container text-center">
            <h1 class="display-4">Dominate Social Media</h1>
            <p class="lead">The best social media panel in the market. Manage all your social media networks from a single panel.</p>
            <a href="<?=cn('auth/signup')?>" class="btn btn-primary btn-lg">Get Started Now</a>
        </div>
    </header>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="feature-card">
                        <h3>Feature One</h3>
                        <p>A brief description of this amazing feature that will surely entice users.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <h3>Feature Two</h3>
                        <p>Another great feature that highlights the product's capabilities and benefits.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <h3>Feature Three</h3>
                        <p>The third feature, making the product an irresistible offer for the target audience.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Image/Text Split Section -->
    <section class="split-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="https://via.placeholder.com/500x300" class="img-fluid rounded" alt="Placeholder Image">
                </div>
                <div class="col-md-6">
                    <h2>Powerful Analytics</h2>
                    <p>Our platform provides detailed analytics to help you understand your audience and grow your social media presence. Track your progress and make data-driven decisions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section text-center">
        <div class="container">
            <h2>Ready to Get Started?</h2>
            <p>Join us today and take your social media presence to the next level.</p>
            <a href="<?=cn('auth/signup')?>" class="btn btn-primary btn-lg">Sign Up for Free</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2025 Makara Social Hub. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="social-icon">FB</a>
                    <a href="#" class="social-icon">TW</a>
                    <a href="#" class="social-icon">IG</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="<?php echo BASE; ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
    <script src="<?php echo BASE; ?>themes/nico/assets/js/bootstrap.min.js"></script>
</body>
</html>