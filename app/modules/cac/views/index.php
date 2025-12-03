<?php
require_once 'themes/nico/views/nav.php';
?>
<style>
    .header{
        margin-top: 5rem;
    }
    @media (max-width:768px) {
        .header{
            margin-top: 8rem;
        }
    }
</style>
<div class="p-5 header" >    
    <h2>Register your business with CAC</h2>
    <p>
        Get your business registered with the Corporate Affairs Commission (CAC) fast and stress-free. Whether you're a startup or a growing brand, we've got you covered. Let Makara Social help you register your business name with CAC quick, easy, and affordable.+
    </p>
    <b>Get your certificate in days. No stress. Just results.</b>
    
    
    <h2 class="mt-4">
        What We Offer:
    </h2>
    
    <ul>
        <li>Business Name Reservation</li>
        <li>Tax Identification Number (TIN)</li>
        <li>Status Report</li>
        <li>Corporate Bank Account number</li>
    </ul>


    <h2>Pricing:</h2>
<p>₦35,000 Only</p>
<p>Delivery: 0-7 working days.</p>
<p>You’ll be contacted on WhatsApp within 3hrs of payment to send your registration details.</p>

<h2>How to Get Started:</h2>
<p>Click the button below to make a CAC order .</p>
<!-- <p>We'll guide you and collect your details to get started right away!</p> -->

<a href="<?= cn("new_order") ?>" class="btn px-4 py-3 container-md mx-auto rounded-pill fw-medium shadow-sm hover-lift" style="color:white;background-color:#0D0BD1;">Make Order</a>
</div>

<?php
require_once 'themes/nico/views/footer.php'
?>