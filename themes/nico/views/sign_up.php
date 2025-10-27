<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD
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
            margin: 0;
            padding: 0;
            min-height: 100vh;
            /* background-image: url('<?=BASE?>assets/images/auth.png'); */
            background: #0D0BD1;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /* background: linear-gradient(135deg, #ffffff4b, #0D0BD1); */
            opacity: 0.85;
            z-index: 1;
        }
        
        .signup-container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .signup-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2.5rem 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 480px;
        }
        
        .logo-container {
            width: 70px;
            height: 70px;
            /* background: #0D0BD1; */
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
        
        .signup-title {
            color: #333;
            font-size: 1.1rem;
            font-weight: 500;
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 1rem;
        }
        
        .form-control {
            padding: 0.7rem 1rem 0.7rem 2.5rem;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 0.95rem;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
            border-color: #0D0BD1;
        }
        
        .form-check {
            font-size: 0.85rem;
            color: #666;
        }
        
        .form-check-input:checked {
            background-color: #0D0BD1;
            border-color: #0D0BD1;
        }
        
        .form-check a {
            color: #0D0BD1;
            text-decoration: none;
        }
        
        .form-check a:hover {
            text-decoration: underline;
        }
        
        .btn-signup {
            /* background: linear-gradient(135deg, #0D0BD1, #ff9933); */
            background: #0D0BD1;
            border: none;
            color: white;
            padding: 0.85rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 1rem;
            width: 100%;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.4);
            color: white;
        }
        
        .signin-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #666;
        }
        
        .signin-link a {
            color: #0D0BD1;
            text-decoration: none;
            font-weight: 600;
        }
        
        .signin-link a:hover {
            text-decoration: underline;
        }
        
        .row-compact {
            margin-left: -0.5rem;
            margin-right: -0.5rem;
        }
        
        .row-compact > [class*='col-'] {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
    </style>

    <script type="text/javascript">
      var token = '<?=$this->security->get_csrf_hash()?>',
          PATH  = '<?php echo PATH; ?>',
          BASE  = '<?php echo BASE; ?>';
    </script>
</head>
<body>

    <div class="signup-container">
        <div class="signup-card">
            <div class="logo-container">
                <img src="<?=BASE?>assets/images/makara_IMG_1670.PNG" alt="Logo" style="max-width: 110px; max-height: 110px;">
=======
  <?php 
    include_once 'blocks/head.blade.php';
    $form_url        = cn("/auth/ajax_sign_up");
    $form_attributes = [
      'id'            => 'signUpForm', 
      'data-focus'    => 'false', 
      'class'         => 'actionFormWithoutToast', 
      'data-redirect' => cn('new_order'), 
      'method'        => "POST"  
    ];
  ?>
  <body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
      <div class="container">
        <div class="card login-card">
          <div class="row no-gutters">
            <div class="col-md-6 left-image mx-auto">
              <a href="<?=cn();?>"><img src="<?php echo BASE; ?>themes/nico/assets/images/login.png" alt="login" class="login-card-img"></a>
>>>>>>> ede5ab0910aae871f4de1584a8f3133cd28ebb9f
            </div>
            
            <h2 class="signup-title">Create Account To Access Your Personal Dashboard</h2>
            
            <form class="actionForm" action="<?=cn("auth/ajax_sign_up")?>" data-redirect="<?=cn('statistics')?>" method="POST">
                <div class="row row-compact">
                    <div class="col-6">
                        <div class="form-group">
                            <div class="input-with-icon">
                                <span class="input-icon">👤</span>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <div class="input-with-icon">
                                <span class="input-icon">👤</span>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-with-icon">
                        <span class="input-icon">✉</span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-with-icon">
                        <span class="input-icon">🔒</span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-with-icon">
                        <span class="input-icon">🔒</span>
                        <input type="password" class="form-control" id="confirm_password" name="re_password" placeholder="Confirm Password" required>
                    </div>
                </div>

                <?php echo form_close(); ?>
                <p class="login-card-footer-text"><?=lang("already_have_account")?> <a href="<?=cn('/auth/login')?>"><?=lang("Login")?></a></p>
              </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?php echo BASE; ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <script>
    // Force AJAX requests to be recognized by CodeIgniter
    $.ajaxSetup({
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    });

    $(document).ready(function(){
        $(".actionForm").on("submit", function(e){
            e.preventDefault();

            var form = $(this);
            var actionUrl = form.attr("action");
            var redirectUrl = form.data("redirect");

            $.ajax({
                url: actionUrl,
                type: "POST",
                data: form.serialize(),
                dataType: "json",
                success: function(response){
                    if(response.status === "success"){
                        window.location.href = redirectUrl;
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr){
                    console.error(xhr.responseText);
                    alert("Something went wrong. Please try again.");
                }
            });
        });
    });
    </script>
</body>
</html>