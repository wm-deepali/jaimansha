     <!-- Magnific Popup CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

<!-- jQuery (Magnific Popup के लिए ज़रूरी) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Magnific Popup JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

     
       <!--7.charity tourVideo One Start -->
       <section class="video-one">
    <div class="video-one__bg jarallax" data-jarallax data-speed="0.2" data-imgPosition="50% 0%"
        style="background-image: url(https://jaimansha.org/administrator/gallery/thumb/gallery_20180127105106.jpg);"></div>
    <div class="container">
        <div class="video-one__inner">
            <div class="video-one__single">
                <div class="video-one__title-box">
                    <p>Recent Updates</p>
                    <h2>Stay updated with our recent video's</h2>
                </div>
                <div class="video-one__video-link">
                    <a href="https://www.youtube.com/embed/Z6WocsW3N4Q?si=jD20vSG1UekZpHpP" class="video-popup">
                        <div class="video-one__video-icon">
                            <span class="icon-play"></span>
                            <i class="ripple"></i>
                        </div>
                        <div class="video-one__round-text">
                            <div class="video-one__curved-circle rotate-me">
                                Watch the Video Watch the Video
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

        <!--Video One End -->
<script>
$(document).ready(function() {
    $('.video-popup').magnificPopup({
        type: 'iframe',
        iframe: {
            patterns: {
                youtube: {
                    index: 'youtube.com/',
                    id: 'v=',
                    src: 'https://www.youtube.com/embed/Z6WocsW3N4Q?si=jD20vSG1UekZpHpP'
                }
            }
        }
    });
});
</script>
