<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=get_option('website_title', "Makara - Social Hub")?></title>
    <meta name="description" content="<?=get_option('website_desc', "Your one-stop solution for social media management.")?>">
    <meta name="keywords" content="<?=get_option('website_keywords', "social media, smm, panel, marketing")?>">
    <link rel="shortcut icon" type="image/x-icon" href="https://res.cloudinary.com/dlkfqsjgg/image/upload/v1760352921/logo_famnk2.png">

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
            background:  #0D0BD1;
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
        
        .login-container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2.5rem 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 420px;
        }
        
        .logo-container {
            width: 70px;
            height: 70px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
        
        .login-title {
            color: #333;
            font-size: 1.1rem;
            font-weight: 500;
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.2rem;
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
        
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 1.1rem;
            padding: 0.25rem;
            transition: color 0.2s;
        }
        
        .password-toggle:hover {
            color: #0D0BD1;
        }
        
        .form-control {
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 0.95rem;
        }
        
        .form-control.with-toggle {
            padding-right: 2.5rem;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(13, 11, 209, 0.1);
            border-color: #0D0BD1;
        }
        
        .form-check {
            font-size: 0.9rem;
            color: #666;
        }
        
        .form-check-input:checked {
            background-color: #0D0BD1;
            border-color: #0D0BD1;
        }
        
        .forgot-link {
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .forgot-link:hover {
            color: #0D0BD1;
        }
        
        .btn-login {
            /* background: linear-gradient(135deg, #0D0BD1, #ff9933); */
            background:  #0D0BD1;
            border: none;
            color: white;
            padding: 0.85rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 1rem;
            width: 100%;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 11, 209, 0.4);
            color: white;
        }
        
        .signup-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #666;
        }
        
        .signup-link a {
            color: #0D0BD1;
            text-decoration: none;
            font-weight: 600;
        }
        
        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>

    <script type="text/javascript">
      var token = '<?=$this->security->get_csrf_hash()?>',
          PATH  = '<?php echo PATH; ?>',
          BASE  = '<?php echo BASE; ?>';
    </script>
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <div class="logo-container">
                <img src="<?=BASE?>assets/images/makara_IMG_1670.PNG" alt="Logo" style="max-width: 110px; max-height: 110px;">
            </div>
            
            <h2 class="login-title">Login To Access Your Personal Dashboard</h2>
            
            <form class="actionForm" action="<?=cn("auth/ajax_sign_in")?>" data-redirect="<?=cn('statistics')?>" method="POST">
                <div class="form-group">
                    <div class="input-with-icon">
                        <span class="input-icon">✉</span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-with-icon">
                        <span class="input-icon">🔒</span>
                        <input type="password" class="form-control with-toggle" id="password" name="password" placeholder="Password" required>
                        <button type="button" class="password-toggle" id="togglePassword">
                            👁️
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                    <a href="<?=cn("auth/forgot_password")?>" class="forgot-link">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-login">
                    🔐 Login
                </button>
                
                <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>">
            </form>

<<<<<<< HEAD
            <div class="signup-link">
                Don't have an account? <a href="<?=cn("auth/signup")?>">Sign Up</a>
=======
                <?php if (!session('uid')) : ?>
                  <p class="login-card-footer-text"><?=lang("dont_have_account_yet")?> <a href="<?=cn('/auth/signup')?>" class="text-reset"><?=lang("Sign_Up")?></a></p>
                <?php endif; ?> 

                <?php if (!session('uid')) : ?>
                  <nav class="login-card-footer-nav">
                    <a href="<?=cn("/auth/forgot_password")?>" class="text-reset"><?=lang("forgot_password")?>?</a>
                  </nav>
                <?php endif; ?>
              </div>
>>>>>>> ede5ab0910aae871f4de1584a8f3133cd28ebb9f
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="<?php echo BASE; ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
    <script>
$(document).ready(function(){
    // Password toggle functionality
    $("#togglePassword").on("click", function(){
        const passwordField = $("#password");
        const toggleButton = $(this);
        
        if (passwordField.attr("type") === "password") {
            passwordField.attr("type", "text");
            toggleButton.text("🙈");
        } else {
            passwordField.attr("type", "password");
            toggleButton.text("👁️");
        }
    });

    // Form submission
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