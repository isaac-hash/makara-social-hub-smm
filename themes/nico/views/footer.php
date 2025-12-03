<!-- Sticky Button Component - Add this anywhere in your body -->
<!-- Light/Dark Mode Toggle Button -->
<!-- <div class="sticky-bottom-left-btn">
    <a href="#" class="sticky-btn" onclick="toggleTheme(event)">
        <i id="theme-icon" class="fas fa-moon"></i>
    </a>
</div> -->


<style>
   .sticky-bottom-left-btn {
    position: fixed;
    bottom: 20px;
    left: 8px;
    z-index: 9999;
}

.sticky-btn {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 50px;
    height: 50px;

    padding: 0;

    background: var(--toggle-bg, #2e2e2eff);
    color: var(--makara-blue);
    text-decoration: none;
    border-radius: 50%;

    box-shadow: 0 4px 15px rgba(13, 11, 209, 0.3);
    transition: all 0.3s ease;
}

.sticky-btn:hover {
    transform: translateY(-3px);
}

.sticky-btn i {
    font-size: 1.8rem;
}

/* Mobile responsive */
@media (max-width: 768px) {
    .sticky-bottom-left-btn {
        position: static !important; /* or relative */
        bottom: auto;
        left: auto;
        margin: 20px 0; /* optional */
    }

    .sticky-btn {
        width: 33px;
        height: 33px;
        padding: 14px;
        justify-content: center;
    }

    .sticky-btn i {
        font-size: 1.3rem;
    }
}

</style>

<script>
    // Load theme on start
    document.addEventListener("DOMContentLoaded", () => {
        const savedTheme = localStorage.getItem("theme");
        if (savedTheme === "light") {
            document.documentElement.classList.add("light");
            document.getElementById("theme-icon").className = "fas fa-sun";
        } else {
            document.documentElement.classList.remove("light");
            document.getElementById("theme-icon").className = "fas fa-moon";
        }
    });

    function toggleTheme(event) {
        event.preventDefault();

        const html = document.documentElement;
        const icon = document.getElementById("theme-icon");

        if (html.classList.contains("light")) {
            // Switch to dark mode
            html.classList.remove("light");
            icon.className = "fas fa-moon";
            localStorage.setItem("theme", "dark");
        } else {
            // Switch to light mode
            html.classList.add("light");
            icon.className = "fas fa-sun";
            localStorage.setItem("theme", "light");
        }
    }
</script>

  <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0" style="color: #FFF;">
                    <div style="height: 120px; overflow: hidden;">

                        <img src="https://res.cloudinary.com/dlkfqsjgg/image/upload/v1760352921/logo_famnk2.png" alt="Makara Logo" style="height: 100px; width: 300px;" class="footer-logo mb-4">
                    </div>
                    <p class="mb-4">Premium social media growth solutions for brands that want to stand out and succeed in the digital world.</p>
                    <div class="footer-social">
                        <a href="https://www.facebook.com/profile.php?id=61572953819089&mibextid=wwXIfr" target="_blank" style="color: #0D0BD1; text-decoration: none;" class="me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://x.com/makarasocialhub?s=21" style="color: #0D0BD1; text-decoration: none;" class="me-3"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/makarasocialhub?igsh=eDA5MGR1b3VjbGJl" target="_blank" style="color: #0D0BD1; text-decoration: none;" class="me-3"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/company/makarasocialhub/" style="color: #0D0BD1; text-decoration: none;" target="_blank"class="me-3"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.tiktok.com/@makarasocialhub?_r=1&_d=ecf2hdem7bi0hg&sec_uid=MS4wLjABAAAAqgni1MQ5BeGFAl4X3wMQsdxs3dyHb3Lkj67QtqEJBm-1JCUcYrT-2JmHq4mZ4orL&share_author_id=6667708048776626182&sharer_language=en&source=h5_m&u_code=d55lff70k0f6m0&ug_btm=b8727,b0&social_share_type=4&utm_source=copy&sec_user_id=MS4wLjABAAAAqgni1MQ5BeGFAl4X3wMQsdxs3dyHb3Lkj67QtqEJBm-1JCUcYrT-2JmHq4mZ4orL&tt_from=copy&utm_medium=ios&utm_campaign=client_share&enable_checksum=1&user_id=6667708048776626182&share_link_id=EE22C52F-7B8F-45C9-A091-26894181DA39&share_app_id=1233" target="_blank" style="color: #0D0BD1; text-decoration: none;" class="me-3"><i class="fab fa-tiktok"></i></a>
                        <a href="https://youtube.com/@makarasocialhub?si=Sfm6A9WWLcShyrAD" style="color: #0D0BD1; text-decoration: none;" target="_blank" class="me-3"><i class="fab fa-youtube"></i></a>
                        <a href="https://t.me/makarasocialhub" style="color: #0D0BD1; text-decoration: none;" target="_blank" class="me-3"><i class="fab fa-telegram"></i></a>
                        <a href="https://chat.whatsapp.com/CsXMbFKkU5d3xHZgRG5Yji?mode=wwt" style="color: #0D0BD1; text-decoration: none;" target="_blank" class="me-3"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h4>Company</h4>
                    <ul class="footer-links">
                        <li><a href="<?=cn('about-services')?>" style="text-decoration: none; color: #FFF;">About Us</a></li>
                        <!-- <li><a href="#" style="text-decoration: none; color: #FFF;">Features</a></li>
                        <li><a href="#" style="text-decoration: none; color: #FFF;">Pricing</a></li> -->
                        
                        <li><a href="<?= cn('blog') ?> " style="text-decoration: none; color: #FFF;">Blog</a></li>
                        <li><a href="<?=cn('terms')?>" style="text-decoration: none; color: #FFF;">Terms and Conditions</a></li>
                        <li><a href="<?=cn('terms')?>" style="text-decoration: none; color: #FFF;">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h4>Support</h4>
                    <ul class="footer-links">
                        <li><a href="<?=cn('home/contact')?>" style="text-decoration: none; color: #FFF;">Contact Us</a></li>
                        <!-- <li><a href="#" style="text-decoration: none; color: #FFF;">FAQ</a></li> -->
                        
                        <li><a href="<?=cn('api-page')?>" style="text-decoration: none; color: #FFF;">API Docs</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <h4>Newsletter</h4>
                    <p class="mb-4">Subscribe to get the latest news and updates.</p>
                    <form class="footer-subscribe">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email">
                            <button class="btn btn-secondary" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="mt-5 mb-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; <?=date('Y')?> Makara Social Hub. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <!-- <a href="<?=cn('privacy')?>" class="text-white me-3">Privacy Policy</a>
                    <a href="<?=cn('terms')?>" class="text-white">Terms of Service</a> -->
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
     <!-- ✅ Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
  crossorigin="anonymous"></script>

<!-- Font Awesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="<?php echo BASE; ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
    <script src="<?php echo BASE; ?>themes/nico/assets/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/f94c035ae6.js" crossorigin="anonymous"></script>
    <script src="<?php echo BASE; ?>themes/nico/assets/js/navbar-scroll.js"></script>
    
    <!-- Initialize Font Awesome -->
    <script>
        // Ensure Font Awesome is loaded
        window.onload = function() {
            if (typeof FontAwesome !== 'undefined') {
                FontAwesome.dom.watch();
            }
        };
    </script>

    <script src="<?php echo BASE; ?>themes/nico/assets/js/widget-manager.js"></script>

</body>





</html>