
<style>
  /* .page-title h1{
    margin-bottom: 5px; }
    .page-title .border-line {
      height: 5px;
      width: 300px;
      background: #eca28d;
      background: -webkit-linear-gradient(45deg, #eca28d, #f98c6b) !important;
      background: -moz- oldlinear-gradient(45deg, #eca28d, #f98c6b) !important;
      background: -o-linear-gradient(45deg, #eca28d, #f98c6b) !important;
      background: linear-gradient(45deg, #eca28d, #f98c6b) !important;
      position: relative;
      border-radius: 30px; }
    .page-title .border-line::before {
      content: '';
      position: absolute;
      left: 0;
      top: -2.7px;
      height: 10px;
      width: 10px;
      border-radius: 50%;
      background: #fa6d7e;
      -webkit-animation-duration: 6s;
      animation-duration: 6s;
      -webkit-animation-timing-function: linear;
      animation-timing-function: linear;
      -webkit-animation-iteration-count: infinite;
      animation-iteration-count: infinite;
      -webkit-animation-name: moveIcon;
      animation-name: moveIcon; }

  @-webkit-keyframes moveIcon {
    from {
      -webkit-transform: translateX(0);
    }
    to { 
      -webkit-transform: translateX(300px);
    }
  } */
</style>

<!-- <div class="row justify-content-center">

  <div class="col-md-8">
    <div class="page-title m-b-30">
      <h1>
        <?php echo lang('Terms__Privacy_Policy'); ?>
      </h1>
      <div class="border-line"></div>
    </div>
    <div class="content">
      <div class="title">
        <h2><?=lang("Terms")?></h2>
      </div>
      <?php echo get_option("terms_content", ""); ?>
    </div>
  </div> 

  <div class="col-md-8">
    <div class="content m-t-30">
      <div class="title">
        <h2><?=lang("Privacy_Policy")?></h2>
      </div>
      <?php echo get_option("policy_content", ""); ?>
    </div>
  </div> 

</div> -->

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

        @media (max-width: 768px) {
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
    </style>
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
            <div class="col-lg-10">
                <div class="page-header">
                    <h1>Terms & Conditions</h1>
                    <p>Please read our terms and conditions carefully</p>
                </div>

                <div class="document-container">
                    <div class="document-toolbar">
                        <h2 class="document-title">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                            </svg>
                            Makara Social Hub - Terms of Service
                        </h2>
                        <div class="toolbar-actions">
                            <a href="assets/uploads/Docs/Terms And Conditions.pdf" download class="toolbar-btn">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5,20H19V18H5M19,9H15V3H9V9H5L12,16L19,9Z"/>
                                </svg>
                                Download
                            </a>
                            <button onclick="printDocument()" class="toolbar-btn">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18,3H6V7H18M19,12A1,1 0 0,1 18,11A1,1 0 0,1 19,10A1,1 0 0,1 20,11A1,1 0 0,1 19,12M16,19H8V14H16M19,8H5A3,3 0 0,0 2,11V17H6V21H18V17H22V11A3,3 0 0,0 19,8Z"/>
                                </svg>
                                Print
                            </button>
                            <button onclick="toggleFullscreen()" class="toolbar-btn">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5,5H10V7H7V10H5V5M14,5H19V10H17V7H14V5M17,14H19V19H14V17H17V14M10,17V19H5V14H7V17H10Z"/>
                                </svg>
                                Fullscreen
                            </button>
                        </div>
                    </div>

                    <div class="pdf-viewer-wrapper">
                        <div class="loading-overlay" id="loadingOverlay">
                            <div class="spinner"></div>
                            <div class="loading-text">Loading document...</div>
                        </div>

                        <iframe 
                            id="pdfViewer"
                            class="pdf-viewer" 
                            src="assets/uploads/Docs/Terms And Conditions.pdf"
                            onload="hideLoading()"
                            onerror="showFallback()">
                        </iframe>

                        <div class="fallback-message" id="fallbackMessage">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20M10,19L12,15H9V10H13V12L11,16H14V19H10Z"/>
                            </svg>
                            <h3>Unable to Display PDF</h3>
                            <p>Your browser doesn't support inline PDF viewing. Please download the document to view it.</p>
                            <a href="assets/uploads/Docs/Terms And Conditions.pdf" download class="fallback-btn">
                                Download Terms & Conditions
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="p-5">

</div>
<div class="p-5">

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

<?php
require_once 'themes/nico/views/footer.php';
?>


