<!DOCTYPE html>
<html lang="en">
  <?php include_once 'blocks/head.blade.php'; ?>
  <body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0" style="background-color: #0D0BD1">
      <div class="container col-md-5 mx-auto">
        <div class="card login-card">
          <div class="card-body">
            <div class="brand-wrapper">
              <a href="#"><img src="<?=get_option('website_logo', BASE."assets/images/logo.png")?>" alt="logo" class="logo"></a>
            </div>
            <p class="login-card-description" style="color: #fff"><?=lang("congratulations_your_registration_is_now_complete")?></p>
            <p><?=lang('congratulations_desc')?></p>
            <div class="form-group">
              <a class="btn btn-block login-btn mb-4" href="<?=cn('auth/login')?>" type="submit" style="background-color: #0D0BD1; color: #fff"><?=lang("get_start_now")?></a>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
  <?php include_once 'blocks/script.blade.php'; ?>
</html>
