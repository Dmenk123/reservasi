<!-- Start Contact Section -->
<section class="st-contact-wrap st-gray-bg st-section" id="contact">
    <div class="container">
      <div class="st-section-heading st-style2 text-center">
        <h2>Contact Us</h2>
        <div class="st-seperator">
          <div class="st-seperator-left-bar wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s"></div>
          <img src="{{asset('assets/fo/img/light-img/seperator-icon.png')}}" alt="demo" class="st-seperator-icon">
          <div class="st-seperator-right-bar wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s"></div>
        </div>
        <p>News websites and blogs are common sources for web feeds, but feeds are also <br>used to deliver structured</p>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div id="cf-msg"></div>
          <form action="assets/php/mail.php" method="post" class="st-contact-form" id="cf">
            <input type="text" placeholder="Full Name" id="name" name="name">
            <input type="text" placeholder="Email Address" id="email" name="email">
            <input type="text" placeholder="Subject" id="subject" name="subject">
            <textarea cols="30" rows="10" placeholder="Your Message" id="msg" name="msg"></textarea>
            <button class="st-btn st-style1 st-size1 st-color1" type="submit" id="submit" name="submit">Send Message</button>
          </form>
        </div>
        <div class="col-lg-6">
          <div class="st-contact-info st-style1">
            <div class="st-contact-info-in">
              <h3 class="st-contact-info-title">Contact Info</h3>
              <div class="st-contact-info-text">Contact is the most important part of businessess. If you need any information about our business, contact the information provided below</div>
              <h3 class="st-contact-info-title">Corporate Office</h3>
              <ul>
                <li><i class="fas fa-map-signs"></i>111 Camino Del Rio Suite 300 San Diego</li>
                <li><i class="fas fa-phone"></i>+00 222- 333 -7889</li>
                <li><i class="fas fa-envelope"></i><a href="#">support@limty.com</a></li>
                <li><i class="fas fa-globe"></i><a href="#">www.limty.com</a></li>
              </ul>
            </div>
            <div class="st-svg-animation1">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="590px" height="436px">
                <defs>
                  <filter filterUnits="userSpaceOnUse" id="Filter_0" x="0px" y="0px" width="590px" height="436px"  >
                      <feOffset in="SourceAlpha" dx="0" dy="5" />
                      <feGaussianBlur result="blurOut" stdDeviation="3.162" />
                      <feFlood flood-color="rgb(106, 106, 106)" result="floodOut" />
                      <feComposite operator="atop" in="floodOut" in2="blurOut" />
                      <feComponentTransfer><feFuncA type="linear" slope="0.15"/></feComponentTransfer>
                      <feMerge>
                      <feMergeNode/>
                      <feMergeNode in="SourceGraphic"/>
                    </feMerge>
                  </filter>
                </defs>
                <g filter="url(#Filter_0)">
                  <path fill-rule="evenodd"  fill="rgb(255, 255, 255)" d="M359.506,400.811 C311.350,416.741 266.303,427.200 215.885,416.924 C166.065,406.770 119.155,382.030 83.358,345.883 C32.880,294.910 5.320,222.074 9.403,150.433 C11.889,106.817 27.202,61.676 61.083,34.027 C101.026,1.428 158.043,-0.486 208.701,8.960 C259.358,18.407 308.226,37.556 359.592,41.763 C414.001,46.218 473.787,34.861 519.488,64.652 C532.722,73.279 543.780,84.912 553.231,97.563 C563.583,111.419 572.219,126.797 576.587,143.532 C584.814,175.056 577.226,208.904 563.417,238.444 C538.267,292.240 493.162,335.144 441.630,364.721 C415.638,379.639 387.934,391.407 359.506,400.811 Z"/>
                </g>
              </svg>
            </div><!-- .st-svg-animation1 -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Contact Section -->
