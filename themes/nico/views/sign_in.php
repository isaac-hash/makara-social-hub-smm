<?php 
// // Using the session library
// $user_id = $this->session->userdata('uid');

// // Or directly via the $_SESSION superglobal
// // $user_id = $_SESSION['uid'];

// if ($user_id) {
//     echo "The User ID is: " . $user_id;
// } else {
//     echo "User ID not found in session.";
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=get_option('website_title', "Makara - Social Hub")?></title>
    <meta name="description" content="<?=get_option('website_desc', "Your one-stop solution for social media management.")?>">
    <meta name="keywords" content="<?=get_option('website_keywords', "social media, smm, panel, marketing")?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?=get_option('website_favicon', BASE."assets/images/favicon.ico")?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }
        .form-control-underline {
            border: none;
            border-bottom: 2px solid #e0e0e0;
            border-radius: 0;
            padding-left: 0;
            padding-bottom: 0.5rem;
            background-color: transparent;
        }
        .form-control-underline:focus {
            box-shadow: none;
            border-color: #0D0BD1;
        }
        .form-check-input:checked {
            background-color: #0D0BD1;
            border-color: #0D0BD1;
        }
    </style>

    <script type="text/javascript">
      var token = '<?=$this->security->get_csrf_hash()?>',
          PATH  = '<?php echo PATH; ?>',
          BASE  = '<?php echo BASE; ?>';
    </script>
</head>
<body>

    <div class="container-fluid">
        <div class="row" style="min-height: 100vh;">
            <!-- Left Column -->
            <div class="col-lg-7 d-none d-lg-flex flex-column align-items-center justify-content-center" style="background: linear-gradient(135deg, #0D0BD1, #00C6FF); color: white; position: relative;">
                <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-image: url('<?=BASE?>assets/images/bg-01.jpg'); background-size: cover; background-position: center; opacity: 0.1;"></div>
                <div class="text-center p-5" style="z-index: 1;">
                    <a href="<?=BASE?>">
                        <img src="<?=BASE?>assets/images/makara_IMG_1670.PNG" alt="Makara Logo" style="height: 60px; margin-bottom: 2rem;">
                    </a>
                    <h1 class="display-4 fw-bold mb-4">
                        <span class="d-block"># Accelerate</span>
                        <span class="d-block"># Your Social</span>
                        <span class="d-block"># Growth</span>
                    </h1>
                    <p class="lead">
                        Premium social media solutions for brands that want to stand out. 
                        <span class="d-block">Grow, engage, and convert with Makara.</span>
                    </p>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-5 d-flex align-items-center justify-content-center py-5">
                <div class="w-100" style="max-width: 400px;">
                    <div class="text-center">
                        <a href="<?=BASE?>">
                            <img src="<?=BASE?>assets/images/makara_IMG_1670.PNG" alt="Makara Logo" style="height: 50px;">
                        </a>
                        <h2 class="mt-4" style="color: #0D0BD1; font-weight: 700;">Sign In</h2>
                        <p class="text-muted">Welcome back! Please enter your details.</p>
                    </div>
                    
                    <form class="actionForm" action="<?=cn("auth/ajax_sign_in")?>" data-redirect="<?=cn('statistics')?>" method="POST">
                        <div class="mb-4">
                            <input type="email" class="form-control form-control-lg form-control-underline" id="email" name="email" placeholder="Email" required>
                        </div>

                        <div class="mb-4">
                            <input type="password" class="form-control form-control-lg form-control-underline" id="password" name="password" placeholder="Password" required>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                            <a href="<?=cn("auth/forgot_password")?>" style="color: #0D0BD1; text-decoration: none; font-weight: 500;">Forgot password?</a>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-lg fw-bold rounded-pill" style="background-color: #0D0BD1; color: white; padding: 0.75rem; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#0a099e'" onmouseout="this.style.backgroundColor='#0D0BD1'">
                                Sign In
                            </button>
                        </div>
                         <div class="d-grid">
                             <a href="<?=cn("auth/google")?>" class="btn btn-lg fw-medium rounded-pill" style="background-color: #fff; color: #212529; border: 1px solid #ddd; padding: 0.75rem;">
                                <img src="<?=BASE?>assets/images/google-logo.png" alt="Google" style="height: 20px; margin-right: 10px;">
                                Sign In with Google
                            </a>
                        </div>
                        
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>">
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted">Don't have an account? <a href="<?=cn("auth/signup")?>" style="color: #FF9933; font-weight: 600; text-decoration: none;">Sign Up for free</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="<?php echo BASE; ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
</body>
</html>