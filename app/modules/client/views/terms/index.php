<?php
require_once 'themes/nico/views/nav.php';
?>
<style>
        :root {
            --makara-blue: #0D0BD1;
            --makara-orange: #FF9933;
            --makara-blue-light: rgba(13, 11, 209, 0.08);
            --makara-orange-light: rgba(255, 153, 51, 0.08);
        }

        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--makara-blue-light) 0%, var(--makara-orange-light) 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .page-header {
            text-align: center;
            margin-bottom: 2.5rem;
            padding: 2rem 1rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .page-header h1 {
            color: var(--makara-blue);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--makara-blue) 0%, var(--makara-orange) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-header p {
            color: #666;
            font-size: 1rem;
            margin: 0;
        }

        .document-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }

        .document-toolbar {
            background: linear-gradient(135deg, var(--makara-blue) 0%, #1a18e0 100%);
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .document-title {
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .document-title svg {
            width: 24px;
            height: 24px;
            fill: white;
        }

        .toolbar-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .toolbar-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .toolbar-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            color: white;
        }

        .toolbar-btn svg {
            width: 18px;
            height: 18px;
            fill: white;
        }

        .pdf-viewer-wrapper {
            position: relative;
            background: #f5f5f5;
            min-height: 80vh;
        }

        .pdf-viewer {
            width: 100%;
            height: 80vh;
            border: none;
            display: block;
        }

        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            z-index: 10;
        }

        .loading-overlay.hidden {
            display: none;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 4px solid var(--makara-blue-light);
            border-top: 4px solid var(--makara-blue);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-text {
            color: var(--makara-blue);
            font-size: 1.1rem;
            font-weight: 500;
        }

        .fallback-message {
            padding: 3rem 2rem;
            text-align: center;
            display: none;
        }

        .fallback-message.active {
            display: block;
        }

        .fallback-message svg {
            width: 80px;
            height: 80px;
            fill: var(--makara-blue);
            margin-bottom: 1.5rem;
        }

        .fallback-message h3 {
            color: var(--makara-blue);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .fallback-message p {
            color: #666;
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        .fallback-btn {
            background: linear-gradient(135deg, var(--makara-blue) 0%, var(--makara-orange) 100%);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .fallback-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 11, 209, 0.4);
            color: white;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--makara-blue);
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: var(--makara-orange);
            transform: translateX(-5px);
        }

        .back-link svg {
            width: 20px;
            height: 20px;
            fill: currentColor;
        }
        .content{
            width: 60rem;
            margin: 0 auto;
        
        }

        @media (max-width: 768px) {
            .content{
                width: 30rem;
            }
            .page-header h1 {
                font-size: 1.8rem;
            }

            .document-toolbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .toolbar-actions {
                width: 100%;
                justify-content: flex-start;
            }

            .pdf-viewer {
                height: 70vh;
            }
        }
        @media (max-width: 480px) {
            .content{
                width: 20rem;
            }
        }
        .mx-auto > .card {
  width: 100%; /* or remove this rule entirely */
  margin: 0 auto;
}

    </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <a href="#" class="back-link" onclick="window.history.back(); return false;">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
            </svg>
            Back
        </a>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div>
                    </div>
                    <div class="page-header">
                    <img src="https://res.cloudinary.com/dlkfqsjgg/image/upload/v1760352921/logo_famnk2.png" width="30%" alt="">
                    <h1>Terms & Conditions & Privacy Policy</h1>
                    <p>Please read our terms and conditions carefully</p>
                </div>

<div class="content my-5" style="">
    <div class="row">
            <div class="mx-auto">
                <div class="card shadow-lg">
                    <div class="card-body p-4">
                        <div class="mb-4 text-center">
                            <h2 class="h5 text-secondary">Welcome to Makara Social Hub!</h2>
                            <p class="text-muted">By using our website and services, you agree to these Terms and Conditions and our Privacy Policy. Please read them carefully. If you do not agree with any part of these terms, <strong class="text-danger">DO NOT USE THIS SITE</strong>.</p>
                        </div>

                        <div class="mb-4">
                            <h3 class="h5 text-primary border-bottom pb-2 mb-3">1. General Terms</h3>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item">By placing an order with Makara Social Hub, you automatically accept these terms, whether you have read them or not.</li>
                            <li class="list-group-item">We reserve the right to modify these terms at any time without prior notice. You are responsible for checking updates before placing an order.</li>
                            <li class="list-group-item">You agree to use Makara Social Hub in compliance with the Terms of Service of all social media platforms (Instagram, Facebook, Twitter/X, TikTok, YouTube, etc.).</li>
                            <li class="list-group-item">Our rates may change at any time without prior notice. The refund policy remains valid regardless of rate adjustments.</li>
                            <li class="list-group-item">Makara Social Hub does not guarantee a specific delivery time for services. Estimated delivery times are subject to variations, and refunds will not be issued for processing delays.</li>
                            <li class="list-group-item">We reserve the right to modify service types when necessary to complete an order.</li>
                            </ul>
                        </div>

                        <div class="mb-4">
                            <h3 class="h5 text-primary border-bottom pb-2 mb-3">2. Service Disclaimer & Risks Involved</h3>
                            <p class="text-muted">By using Makara Social Hub, you acknowledge and accept the following:</p>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item">We are not responsible for any account suspensions, content deletions, or penalties imposed by social media platforms after using our services.</li>
                            <li class="list-group-item">Our services do not guarantee engagement, interaction, or permanent retention of followers, likes, or views.</li>
                            <li class="list-group-item">We procure services from third-party suppliers, and order fulfillment depends on their response. If a supplier does not refund an incorrectly placed order, we cannot issue a refund either.</li>
                            <li class="list-group-item">Social media algorithms change frequently, which may affect service efficiency, speed, or retention.</li>
                            <li class="list-group-item">You are expected to read service descriptions carefully before placing an order. We do not guarantee the quality or longevity of low-cost services.</li>
                            <li class="list-group-item">Private accounts will not receive services or refunds. Ensure your account is public before ordering.</li>
                            <li class="list-group-item">Uploading inappropriate content (nudity, hate speech, violence, fraud, etc.) is strictly prohibited.</li>
                            </ul>
                        </div>

                        <div class="mb-4">
                            <h3 class="h5 text-primary border-bottom pb-2 mb-3">3. Refund & Dispute Policy</h3>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item">No refunds will be issued to your original payment method after a deposit has been made. Funds must be used for future orders within Makara Social Hub.</li>
                            <li class="list-group-item">If an order is undeliverable, a refund will be credited to your Makara Social wallet.</li>
                            <li class="list-group-item">Incorrect, misplaced, or private account orders are non-refundable. Double-check all details before placing an order.</li>
                            <li class="list-group-item">Filing a chargeback or dispute against us will result in account suspension and service revocation without refund.</li>
                            <li class="list-group-item">Fraudulent activities (such as using stolen payment methods) will lead to account termination without exception.</li>
                            <li class="list-group-item">Do not place duplicate or overlapping orders for the same service/link, as we cannot guarantee accurate results. Such orders will not be refunded.</li>
                            </ul>
                        </div>

                        <div class="mb-4">
                            <h3 class="h5 text-primary border-bottom pb-2 mb-3">4. Privacy Policy</h3>
                            <div class="mb-3">
                            <h4 class="h6 text-dark">How We Use Your Information</h4>
                            <p class="text-muted">Makara Social Hub collects and processes user data solely for the purpose of providing services and improving user experience. We use your data to:</p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Process orders and manage your account</li>
                                <li class="list-group-item">Provide customer support and service updates</li>
                                <li class="list-group-item">Improve website performance and user experience</li>
                                <li class="list-group-item">Prevent fraudulent activity and unauthorized access</li>
                                <li class="list-group-item">Send promotional materials (if opted in)</li>
                            </ul>
                            </div>
                            <div class="mb-3">
                            <h4 class="h6 text-dark">Data Protection & Sharing</h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Your personal information is never sold, rented, or shared with third parties without consent.</li>
                                <li class="list-group-item">We may share data with trusted third-party service providers to facilitate order processing and payment security.</li>
                                <li class="list-group-item">In cases of legal requirements, Makara Social Hub may disclose data to comply with law enforcement requests or prevent fraudulent activities.</li>
                            </ul>
                            </div>
                            <div>
                            <h4 class="h6 text-dark">Cookies & Tracking</h4>
                            <p class="text-muted">Makara Social Hub uses cookies and tracking technologies to enhance your browsing experience. By using our website, you agree to the collection of data through cookies. You can disable cookies in your browser settings, but some features may not function properly.</p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h3 class="h5 text-primary border-bottom pb-2 mb-3">5. Prohibited Activities</h3>
                            <p class="text-muted">By using Makara Social Hub, you agree NOT to:</p>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item">Use the platform for illegal or deceptive activities.</li>
                            <li class="list-group-item">Violate the Terms of Service of any social media platform.</li>
                            <li class="list-group-item">Engage in spamming, hacking, or fraudulent transactions.</li>
                            <li class="list-group-item">Attempt to manipulate Makara Social Hub's pricing, services, or operations.</li>
                            <li class="list-group-item">Disrupt the security of the platform or any affiliated networks.</li>
                            </ul>
                        </div>

                        <div class="mb-4">
                            <h3 class="h5 text-primary border-bottom pb-2 mb-3">6. Account Termination & Service Discretion</h3>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item">Makara Social Hub reserves the right to terminate any account found in violation of these terms.</li>
                            <li class="list-group-item">We may refuse service to anyone at our discretion if we detect fraudulent or abusive behavior.</li>
                            </ul>
                        </div>

                        <div class="mb-4">
                            <h3 class="h5 text-primary border-bottom pb-2 mb-3">7. Contact & Complaints</h3>
                            <p class="text-muted">For inquiries, complaints, or disputes, contact our support team:</p>
                            <ul class="list-unstyled">
                            <li><i class="far fa-envelope text-primary me-2"></i>Email: <a href="mailto:Makarasocialhub@gmail.com">Makarasocialhub@gmail.com</a></li>
                            <li><i class="fab fa-whatsapp text-success me-2"></i>WhatsApp Support: <a href="https://wa.me/2348120054028">+234 812 005 4028</a></li>
                            </ul>
                        </div>

                        <div class="text-center text-muted">
                            <p>By using Makara Social Hub, you agree to these terms and acknowledge that we are not responsible for any risks or consequences arising from the use of our services.</p>
                            <p class="fw-bold">Thank you for choosing Makara Social Hub</p>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
    <script>
        function hideLoading() {
            setTimeout(() => {
                document.getElementById('loadingOverlay').classList.add('hidden');
            }, 500);
        }

        function showFallback() {
            document.getElementById('loadingOverlay').classList.add('hidden');
            document.getElementById('pdfViewer').style.display = 'none';
            document.getElementById('fallbackMessage').classList.add('active');
        }

        function printDocument() {
            const iframe = document.getElementById('pdfViewer');
            if (iframe && iframe.contentWindow) {
                try {
                    iframe.contentWindow.print();
                } catch (e) {
                    window.open('assets/uploads/Docs/Terms And Conditions.pdf', '_blank');
                }
            }
        }

        function toggleFullscreen() {
            const wrapper = document.querySelector('.pdf-viewer-wrapper');
            if (!document.fullscreenElement) {
                wrapper.requestFullscreen().catch(err => {
                    console.log('Error attempting to enable fullscreen:', err);
                });
            } else {
                document.exitFullscreen();
            }
        }

        // Handle fullscreen changes
        document.addEventListener('fullscreenchange', function() {
            const viewer = document.getElementById('pdfViewer');
            if (document.fullscreenElement) {
                viewer.style.height = '100vh';
            } else {
                viewer.style.height = '80vh';
            }
        });
    </script>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
<?php
require_once 'themes/nico/views/footer.php';
?>