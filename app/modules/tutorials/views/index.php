<style>
  .gallery{
    width: 80%;
    margin: auto;
    /* height: 100%; */
  }
  @media (max-width: 1024px) {
    .gallery{
      width: 70%;
    }
  }
  @media (max-width: 768px) {
    .gallery{
      width: 100%;
    }
  }
</style>

<style>
    .gallery-header {
      padding: 3rem 0 2rem;
    }

    .gallery-title {
      font-size: 2.5rem;
      font-weight: 700;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 1rem;
      letter-spacing: -0.5px;
    }

    .gradient-icon {
      font-size: 2.5rem;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .gallery-subtitle {
      font-size: 1.1rem;
      color: #6c757d;
      font-weight: 400;
    }

    .tutorials-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
      gap: 2rem;
      padding: 1rem 0;
    }

    .tutorial-card {
      position: relative;
      opacity: 0;
      transform: translateY(20px);
    }

    .fade-in {
      animation: fadeInUp 0.6s ease forwards;
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .tutorial-inner {
      background: var(--background-color);
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    .tutorial-inner:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 40px rgba(102, 126, 234, 0.25);
    }

    .video-container {
      position: relative;
      overflow: hidden;
      background: #000;
    }

    .video-wrapper {
      position: relative;
      padding-bottom: 56.25%; /* 16:9 aspect ratio */
      cursor: pointer;
    }

    .tutorial-video {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s ease;
    }

    .tutorial-inner:hover .tutorial-video {
      transform: scale(1.05);
    }

    .video-gradient {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 60%;
      background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 100%);
      pointer-events: none;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .tutorial-inner:hover .video-gradient {
      opacity: 1;
    }

    .play-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(0, 0, 0, 0.1);
      opacity: 0;
      transition: all 0.3s ease;
    }

    .tutorial-inner:hover .play-overlay {
      opacity: 1;
      background: rgba(0, 0, 0, 0.3);
    }

    .play-button {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      transform: scale(0.8);
      transition: all 0.3s ease;
      box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .tutorial-inner:hover .play-button {
      transform: scale(1);
    }

    .play-button i {
      font-size: 1.8rem;
      color: #fff;
      margin-left: 4px;
    }

    .tutorial-content {
      padding: 1.5rem;
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .tutorial-meta {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1rem;
    }

    .tutorial-date {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      font-size: 0.875rem;
      color: #667eea;
      font-weight: 500;
    }

    .tutorial-date i {
      font-size: 1rem;
    }

    .tutorial-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--text-color);
      margin-bottom: 0.75rem;
      line-height: 1.4;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .tutorial-description {
      font-size: 0.95rem;
      color: var(--text-color);
      line-height: 1.6;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
      flex: 1;
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 4rem 2rem;
      grid-column: 1 / -1;
    }

    .empty-icon {
      width: 100px;
      height: 100px;
      margin: 0 auto 1.5rem;
      border-radius: 50%;
      background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .empty-icon i {
      font-size: 3rem;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .empty-state h3 {
      font-size: 1.5rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 0.5rem;
    }

    .empty-state p {
      font-size: 1rem;
      color: #6c757d;
    }

    /* Click to play video */
    .video-wrapper:hover {
      cursor: pointer;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
      .tutorials-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }

      .gallery-title {
        font-size: 2rem;
      }

      .gallery-subtitle {
        font-size: 1rem;
      }

      .tutorial-title {
        font-size: 1.1rem;
      }

      .play-button {
        width: 60px;
        height: 60px;
      }

      .play-button i {
        font-size: 1.5rem;
      }
    }

    @media (max-width: 480px) {
      .gallery-header {
        padding: 2rem 0 1rem;
      }

      .gallery-title {
        font-size: 1.75rem;
      }

      .tutorial-content {
        padding: 1.25rem;
      }

      .tutorials-grid {
        gap: 1.25rem;
      }
    }

    /* Tablet */
    @media (min-width: 769px) and (max-width: 1024px) {
      .tutorials-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }
  </style>

<div class="row items-justified-center gallery">
  <div class="col-md-12">
    <!-- Gallery Header -->
    <div class="gallery-header text-center mb-5 fade-in">
      <h1 class="gallery-title">
        <i class="fe fe-video gradient-icon"></i>
        Video Tutorials
      </h1>
      <p class="gallery-subtitle">Master our platform with our comprehensive video guides</p>
    </div>

    <!-- Gallery Grid -->
    <div class="tutorials-grid">
      <?php if (!empty($items)): ?>
        <?php foreach ($items as $index => $item): ?>
          <div class="tutorial-card fade-in" style="animation-delay: <?= $index * 0.1 ?>s;">
            <div class="tutorial-inner">
              <?php if (!empty($item['link'])): ?>
                <div class="video-container">
                  <div class="video-wrapper">
                      <iframe class="tutorial-video" src="<?=$item['link']?>" allowfullscreen style="border:0;"></iframe>
                      <!-- Iframe handles its own controls, overlays might interfere so we can keep them simple or remove overlay for iframes -->
                  </div>
                </div>
              <?php elseif (!empty($item['video_file_path'])): ?>
                <div class="video-container">
                  <div class="video-wrapper">
                    <video class="tutorial-video" preload="metadata">
                      <source src="<?=BASE?><?=$item['video_file_path']?>#t=0.5" type="video/mp4">
                      Your browser does not support the video tag.
                    </video>
                    <div class="play-overlay">
                      <div class="play-button">
                        <i class="fe fe-play"></i>
                      </div>
                    </div>
                    <div class="video-gradient"></div>
                  </div>
                </div>
              <?php endif; ?>
              
              <div class="tutorial-content">
                <div class="tutorial-meta">
                  <span class="tutorial-date">
                    <i class="fe fe-calendar"></i>
                    <?= date("M d, Y", strtotime(convert_timezone($item['created'], 'user'))) ?>
                  </span>
                </div>
                <h3 class="tutorial-title"><?= htmlspecialchars($item['title']) ?></h3>
                <div class="tutorial-description">
                  <?= htmlspecialchars_decode($item['description'], ENT_QUOTES) ?>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="empty-state fade-in">
          <div class="empty-icon">
            <i class="fe fe-video"></i>
          </div>
          <h3>No Tutorials Yet</h3>
          <p>Check back soon for new video tutorials!</p>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <script>
    // Make videos play on click
    document.addEventListener('DOMContentLoaded', function() {
      const videoWrappers = document.querySelectorAll('.video-wrapper');
      
      videoWrappers.forEach(wrapper => {
        const video = wrapper.querySelector('.tutorial-video');
        const playOverlay = wrapper.querySelector('.play-overlay');
        
        wrapper.addEventListener('click', function() {
          if (video.paused) {
            video.play();
            video.setAttribute('controls', 'controls');
            playOverlay.style.opacity = '0';
            playOverlay.style.pointerEvents = 'none';
          }
        });

        video.addEventListener('pause', function() {
          if (!video.seeking && video.currentTime === 0) {
            playOverlay.style.opacity = '';
            playOverlay.style.pointerEvents = '';
          }
        });
      });
    });
  </script>
</div>
