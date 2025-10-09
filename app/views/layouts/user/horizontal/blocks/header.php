<?php
  $balance = current_logged_user()->balance;
  if (empty($balance) || $balance == 0) {
    $balance = 0.00;
  } else {
    $balance = currency_format($balance);
  }
  $current_balance = get_option('currency_symbol',"") . $balance;
  $nav_item_user_title = sprintf('%s! <span class="text-uppercase">%s</span>', lang('Hi'), current_logged_user()->first_name);
?>

<header class="header">
    <div class="header-left">
        <button class="menu-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <a href="<?php echo cn(); ?>" class="logo">
            <img src="<?php echo get_option('website_logo', BASE.'assets/images/logo.png'); ?>" alt="Website Logo" style="max-height: 40px;">
        </a>
    </div>
    <div class="header-right">
        <?php
            if (get_option("enable_news_announcement") &&  get_option('news_announcement_button_position', "header") == 'header') {
        ?>
        <div class="header-icon">
            <a class="ajaxModal" href="<?=cn("news-annoucement")?>">
                <i class="fas fa-bell"></i>
                <?php if(!(isset($_COOKIE["news_annoucement"]) && $_COOKIE["news_annoucement"] == "clicked")) { ?>
                <span class="notification-badge"></span>
                <?php } ?>
            </a>
        </div>
        <?php }?>

        <?php
            $redirect = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $this->load->model('model');
            $items_languages = $this->model->fetch('id, ids, country_code, code, is_default', LANGUAGE_LIST, ['status' => 1]);
            $lang_current = get_lang_code_defaut();
        ?>
        <div class="dropdown">
            <a class="header-icon" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-globe"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
            <?php 
                foreach ($items_languages as $key => $item) {
            ?>
            <a class="dropdown-item ajaxChangeLanguageSecond" href="javascript:void(0)" data-url="<?php echo cn('set-language'); ?>" data-redirect="<?php echo strip_tags($redirect); ?>" data-ids="<?php echo strip_tags($item->ids); ?>"><i class="flag-icon flag-icon-<?php echo strtolower($item->country_code); ?>"></i> <?php echo language_codes($item->code); ?>
            </a>
            <?php }?>
            </div>
        </div>

        <div class="user-profile" onclick="toggleUserDropdown(event)">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <span><?= $nav_item_user_title ?></span>
            <i class="fas fa-chevron-down" style="font-size: 0.75rem;"></i>
            
            <div class="user-dropdown" id="userDropdown">
                <div class="dropdown-header">
                    <div class="dropdown-user-name"><?= $nav_item_user_title ?></div>
                    <div class="dropdown-user-email">Balance: <?= $current_balance ?></div>
                </div>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo cn('profile'); ?>" class="dropdown-item">
                            <i class="fas fa-user"></i>
                            <span><?php echo lang('Profile'); ?></span>
                        </a>
                    </li>
                </ul>
                <div class="dropdown-divider"></div>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo cn('auth/logout'); ?>" class="dropdown-item" style="color: var(--primary-orange);">
                            <i class="fas fa-sign-out-alt"></i>
                            <span><?php echo lang('Logout'); ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>