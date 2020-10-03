<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Business, Service">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <title>Slick - Bootstrap 4 Template</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="img/2.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/nivo-lightbox.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css')}}">    
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css')}}">

  </head>
  
  <body>

  <!-- <div id="ln_page">
    <landing-page></landing-page>
  </div> -->

  <!-- Header Section Start -->
    <header id="home" class="hero-area">    
      <div class="overlay">
        <span></span>
        <span></span>
      </div>
      <nav class="navbar navbar-expand-md fixed-top scrolling-navbar">
        <div class="container">
          <a href="index.html" class="navbar-brand"><img src="img/logo.png" alt=""></a>       
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="lni-menu"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto w-100 justify-content-end">
              <li class="nav-item">
                <a class="nav-link page-scroll" href="#home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link page-scroll" href="#services">About</a>
              </li>  
              <li class="nav-item">
                <a class="nav-link page-scroll" href="#features">Services</a>
              </li>     
              <li class="nav-item">
                <a class="nav-link page-scroll" href="#team">Team</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link page-scroll" href="#contact">Contact</a>
              </li> 
              <li class="nav-item">
                @if (Route::has('login'))
                  @auth
                      <a href="{{ url('/dashboard') }}" class="btn btn-singin">Dashboard</a>
                  @else
                      <a href="{{ route('login') }}" class="btn btn-singin">Sign In</a>

                      @if (Route::has('register'))
                          <a href="{{ route('register') }}" class="btn btn-apple text-white">Sign Up</a>
                      @endif
                  @endif
                @endif
              </li>
            </ul>
          </div>
        </div>
      </nav>  
      <div class="container">      
        <div class="row space-100">
          <div class="col-lg-6 col-md-12 col-xs-12">
            <div class="contents">
              <h2 class="head-title">We helps teams work more collaboratively and get more done.</h2>
              <p>boards, lists, and cards enable teams to organize and prioritize projects in a fun, flexible, and rewarding way.</p>
              <div class="header-button">
                <a href="{{ route('register') }}" rel="nofollow" target="_blank" class="btn btn-border-filled">Sign Up Now</a>
                <a href="https://kltech-intl.odoo.com" rel="nofollow" target="_blank" class="btn btn-border page-scroll">Learn More</a>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-xs-12 p-0">
            <div class="intro-img">
              <img src="{{ asset('assets/img/intro.png')}}" alt="">
            </div>            
          </div>
        </div> 
      </div>             
    </header>
    <!-- Header Section End --> 


    <!-- Services Section Start -->
    <section id="services" class="section">
      <div class="container">

        <div class="row">
          <!-- Start Col -->
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="services-item text-center">
              <!-- <div class="icon"> -->
                <img src="{{asset('assets/img/service/create_team.png')}}" alt="create team" width="260" height="245">
              <!-- </div> -->
              <h4>The Team Playbook</h4>
              <p>It’s easy to get your team up and running. We’ve collected all of the boards and tools your team needs to succeed in one handy resource.</p>
            </div>
          </div>
          <!-- End Col -->
          <!-- Start Col -->
          <div class="col-lg-4 col-md-6 col-xs-12">

            <div class="services-item text-center">
              <img src="{{asset('assets/img/service/email_integration.png')}}" alt="create team" width="260" height="245">
              <h4>A Productivity Platform</h4>
              <p>Integrate email with your team members right into your workflow. we will send every notification automatically to your team member.</p>
            </div>
          </div>
          <!-- End Col -->
          <!-- Start Col -->
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="services-item text-center">
              <img src="{{asset('assets/img/service/sync_apps.png')}}" alt="create team" width="260" height="245">
              <h4>Always In Sync</h4>
              <p>We stays in sync across all of your devices. Collaborate with your team anywhere, from sitting on the bus to sitting on the beach.</p>
            </div>
          </div>
          <!-- End Col -->

        </div>
      </div>
    </section>
    <!-- Services Section End -->



    <!-- Business Plan Section Start -->
    <section id="business-plan">
      <div class="container">

        <div class="row">
          <!-- Start Col -->
          <div class="col-lg-6 col-md-12 pl-0 pt-70 pr-5">
            <div class="business-item-img">
              <img src="{{asset('assets/img/business/business-img.png')}}" class="img-fluid" alt="">
            </div>
          </div>
          <!-- End Col -->
          <!-- Start Col -->
          <div class="col-lg-6 col-md-12 pl-4">
            <div class="business-item-info">
              <h3>Start Planning Today</h3>
              <p>Sign up and join over 1,000,000 teams worldwide who are using Trello to get more done.</p>

              <a class="btn btn-common" href="{{ route('register') }}">Free Sign Up</a>
            </div>
          </div>
          <!-- End Col -->

        </div>
      </div>
    </section>
    <!-- Business Plan Section End -->



    <!-- Cool Fetatures Section Start -->
    <section id="features" class="section">
      <div class="container">
        <!-- Start Row -->
        <div class="row">
          <div class="col-lg-12">
            <div class="features-text section-header text-center">  
              <div>   
                <h2 class="section-title">Services We Provide</h2>
                <div class="desc-text">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do <br> eiusmod tempor incididunt ut labore et dolore.</p>
                </div>
              </div> 
            </div>
          </div>

        </div>
        <!-- End Row -->
        <!-- Start Row -->
        <div class="row featured-bg">
         <!-- Start Col -->
          <div class="col-lg-6 col-md-6 col-xs-12 p-0">
             <!-- Start Fetatures -->
            <div class="feature-item featured-border1">
               <div class="feature-icon float-left">
                 <i class="lni-coffee-cup"></i>
               </div>
               <div class="feature-info float-left">
                 <h4>Easy to Customize</h4>
                 <p>Producing long lasting organic SEO results for <br> brand of different kinds for more than a decade,<br> we understand that’s your.</p>
               </div>
            </div>
            <!-- End Fetatures -->
          </div>
           <!-- End Col -->
          
         <!-- Start Col -->
          <div class="col-lg-6 col-md-6 col-xs-12 p-0">
             <!-- Start Fetatures -->
            <div class="feature-item featured-border2">
               <div class="feature-icon float-left">
                 <i class="lni-briefcase"></i>
               </div>
               <div class="feature-info float-left">
                 <h4>Business Template</h4>
                 <p>Producing long lasting organic SEO results for <br> brand of different kinds for more than a decade,<br> we understand that’s your.</p>
               </div>
            </div>
            <!-- End Fetatures -->
          </div>
           <!-- End Col -->
          
         <!-- Start Col -->
          <div class="col-lg-6 col-md-6 col-xs-12 p-0">
             <!-- Start Fetatures -->
            <div class="feature-item featured-border1">
               <div class="feature-icon float-left">
                 <i class="lni-invention"></i>
               </div>
               <div class="feature-info float-left">
                 <h4>Clean & Trendy Design</h4>
                 <p>Producing long lasting organic SEO results for <br> brand of different kinds for more than a decade,<br> we understand that’s your.</p>
               </div>
            </div>
            <!-- End Fetatures -->
          </div>
           <!-- End Col -->
          
         <!-- Start Col -->
          <div class="col-lg-6 col-md-6 col-xs-12 p-0">
             <!-- Start Fetatures -->
            <div class="feature-item featured-border2">
               <div class="feature-icon float-left">
                <i class="lni-layers"></i>
               </div>
               <div class="feature-info float-left">
                 <h4>Tons of Sections</h4>
                 <p>Producing long lasting organic SEO results for <br> brand of different kinds for more than a decade,<br> we understand that’s your.</p>
               </div>
            </div>
            <!-- End Fetatures -->
          </div>
           <!-- End Col -->
          
         <!-- Start Col -->
          <div class="col-lg-6 col-md-6 col-xs-12 p-0">
             <!-- Start Fetatures -->
            <div class="feature-item featured-border3">
               <div class="feature-icon float-left">
                 <i class="lni-reload"></i>
               </div>
               <div class="feature-info float-left">
                 <h4>Free Future Updates</h4>
                 <p>Producing long lasting organic SEO results for <br> brand of different kinds for more than a decade,<br> we understand that’s your.</p>
               </div>
            </div>
            <!-- End Fetatures -->
          </div>
           <!-- End Col -->
          
         <!-- Start Col -->
          <div class="col-lg-6 col-md-6 col-xs-12 p-0">
             <!-- Start Fetatures -->
            <div class="feature-item">
               <div class="feature-icon float-left">
                 <i class="lni-support"></i>
               </div>
               <div class="feature-info float-left">
                 <h4>Premier Support</h4>
                 <p>Producing long lasting organic SEO results for <br> brand of different kinds for more than a decade,<br> we understand that’s your.</p>
               </div>
            </div>
            <!-- End Fetatures -->
          </div>
           <!-- End Col -->
          

        </div>
        <!-- End Row -->
      </div>
    </section>
    <!-- Cool Fetatures Section End --> 

    <!-- Team section Start -->
    <section id="team" class="section">
      <div class="container">
        <!-- Start Row -->
        <div class="row">
          <div class="col-lg-12">
            <div class="team-text section-header text-center">  
              <div>   
                <h2 class="section-title">Team Members</h2>
                <div class="desc-text">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</p>  
                  <p>eiusmod tempor incididunt ut labore et dolore.</p>
                </div>
              </div> 
            </div>
          </div>

        </div>
        <!-- End Row -->
        <!-- Start Row -->
        <div class="row">
          <!-- Start Col -->
          <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="single-team">
              <div class="team-thumb">
                <img src="img/team/01.jpg" class="img-fluid" alt="">
              </div>

              <div class="team-details">
              <div class="team-social-icons">
                  <ul class="social-list">
                    <li><a href="#"><i class="lni-facebook-filled"></i></a></li>
                    <li><a href="#"><i class="lni-twitter-filled"></i></a></li>
                    <li><a href="#"><i class="lni-google-plus"></i></a></li>
                  </ul>
                </div> 
                <div class="team-inner text-center">
                  <h5 class="team-title">Patric Green</h5>
                  <p>Lead Designer</p>
                </div>
              </div>
            </div>
          </div>
          <!-- Start Col -->
 
          <!-- Start Col -->
          <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="single-team">
              <div class="team-thumb">
                <img src="img/team/02.jpg" class="img-fluid" alt="">
              </div>

              <div class="team-details">
              <div class="team-social-icons">
                  <ul class="social-list">
                    <li><a href="#"><i class="lni-facebook-filled"></i></a></li>
                    <li><a href="#"><i class="lni-twitter-filled"></i></a></li>
                    <li><a href="#"><i class="lni-google-plus"></i></a></li>
                  </ul>
                </div>
                <div class="team-inner text-center">
                  <h5 class="team-title">Celina D Cruze</h5>
                  <p>Front-end Developer</p>
                </div>
              </div>
            </div>
          </div>
          <!-- Start Col -->
 
          <!-- Start Col -->
          <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="single-team">
              <div class="team-thumb">
                <img src="img/team/03.jpg" class="img-fluid" alt="">
              </div>

              <div class="team-details">
              <div class="team-social-icons">
                  <ul class="social-list">
                    <li><a href="#"><i class="lni-facebook-filled"></i></a></li>
                    <li><a href="#"><i class="lni-twitter-filled"></i></a></li>
                    <li><a href="#"><i class="lni-google-plus"></i></a></li>
                  </ul>
                </div>
                <div class="team-inner text-center">
                  <h5 class="team-title">Daryl Dixon</h5>
                  <p>Content Writer</p>
                </div>
              </div>
            </div>
          </div>
          <!-- Start Col -->
 
          <!-- Start Col -->
          <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="single-team">
              <div class="team-thumb">
                <img src="img/team/04.jpg" class="img-fluid" alt="">
              </div>

              <div class="team-details">
                <div class="team-social-icons">
                  <ul class="social-list">
                    <li><a href="#"><i class="lni-facebook-filled"></i></a></li>
                    <li><a href="#"><i class="lni-twitter-filled"></i></a></li>
                    <li><a href="#"><i class="lni-google-plus"></i></a></li>
                  </ul>
                </div>
                <div class="team-inner text-center">
                  <h5 class="team-title">Mark Parker</h5>
                  <p>Support Engineer</p>
                </div>
              </div>
            </div>
          </div>
          <!-- Start Col -->
 

        </div>
        <!-- End Row -->
      </div>
    </section>
    <!-- Team section End -->

    <!-- Contact Us Section -->
    <section id="contact" class="section">
      <!-- Container Starts -->
      <div class="container">
        <!-- Start Row -->
        <div class="row">
          <div class="col-lg-12">
            <div class="contact-text section-header text-center">  
              <div>   
                <h2 class="section-title">Get In Touch</h2>
                <div class="desc-text">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</p>  
                  <p>eiusmod tempor incididunt ut labore et dolore.</p>
                </div>
              </div> 
            </div>
          </div>

        </div>
        <!-- End Row -->
        <!-- Start Row -->
        <div class="row">
          <!-- Start Col -->
          <div class="col-lg-6 col-md-12">
          <form id="contactForm">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" class="form-control" id="name" name="name" placeholder="Name" required data-error="Please enter your name">
                  <div class="help-block with-errors"></div>
                </div>                                 
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" placeholder="Subject" id="msg_subject" class="form-control" name="msg_subject" required data-error="Please enter your subject">
                  <div class="help-block with-errors"></div>
                </div> 
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" class="form-control" id="email" name="email" placeholder="Email" required data-error="Please enter your Email">
                  <div class="help-block with-errors"></div>
                </div>                                 
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" placeholder="Budget" id="budget" class="form-control" name="budget" required data-error="Please enter your Budget">
                  <div class="help-block with-errors"></div>
                </div> 
              </div>
              <div class="col-md-12">
                <div class="form-group"> 
                  <textarea class="form-control" id="message"  name="message" placeholder="Write Message" rows="4" data-error="Write your message" required></textarea>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="submit-button">
                  <button class="btn btn-common" id="submit" type="submit">Submit</button>
                  <div id="msgSubmit" class="h3 hidden"></div> 
                  <div class="clearfix"></div> 
                </div>
              </div>
            </div>            
          </form>
          </div>
          <!-- End Col -->
          <!-- Start Col -->
          <div class="col-lg-1">
            
          </div>
          <!-- End Col -->
          <!-- Start Col -->
          <div class="col-lg-4 col-md-12">
            <div class="contact-img">
              <img src="{{asset('assets/img/contact/01.png')}}" class="img-fluid" alt="">
            </div>
          </div>
          <!-- End Col -->
          <!-- Start Col -->
          <div class="col-lg-1">
          </div>
          <!-- End Col -->

        </div>
        <!-- End Row -->
      </div>
    </section>
    <!-- Contact Us Section End -->

    <!-- Footer Section Start -->
    <footer>
      <!-- Footer Area Start -->
      <section id="footer-Content">
        <div class="container">
          <!-- Start Row -->
          <div class="row">

          <!-- Start Col -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
              
              <div class="footer-logo">
               <img src="img/footer-logo.png" alt="">
              </div>
            </div>
             <!-- End Col -->
              <!-- Start Col -->
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6 col-mb-12">
              <div class="widget">
                <h3 class="block-title">Company</h3>
                <ul class="menu">
                  <li><a href="#">  - About Us</a></li>
                  <li><a href="#">- Career</a></li>
                  <li><a href="#">- Blog</a></li>
                  <li><a href="#">- Press</a></li>
                </ul>
              </div>
            </div>
             <!-- End Col -->
              <!-- Start Col -->
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6 col-mb-12">
              <div class="widget">
                <h3 class="block-title">Product</h3>
                <ul class="menu">
                  <li><a href="#">  - Customer Service</a></li>
                  <li><a href="#">- Enterprise</a></li>
                  <li><a href="#">- Price</a></li>
                  <li><a href="#">- Scurity</a></li>
                  <li><a href="#">- Why SLICK?</a></li>
                </ul>
              </div>
            </div>
             <!-- End Col -->
              <!-- Start Col -->
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6 col-mb-12">
              <div class="widget">
                <h3 class="block-title">Download App</h3>
                <ul class="menu">
                  <li><a href="#">  - Android App</a></li>
                  <li><a href="#">- IOS App</a></li>
                  <li><a href="#">- Windows App</a></li>
                  <li><a href="#">- Play Store</a></li>
                  <li><a href="#">- IOS Store</a></li>
                </ul>
              </div>
            </div>
             <!-- End Col -->
              <!-- Start Col -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
              <div class="widget">
                <h3 class="block-title">Subscribe Now</h3>
                <p>Appropriately implement calysts for change visa wireless catalysts for change. </p>
                <div class="subscribe-area">
                  <input type="email" class="form-control" placeholder="Enter Email">
                  <span><i class="lni-chevron-right"></i></span>
                </div>
              </div>
            </div>
            <!-- End Col -->
          </div>
          <!-- End Row -->
        </div>
        <!-- Copyright Start  -->

        <div class="copyright">
          <div class="container">
            <!-- Star Row -->
            <div class="row">
              <div class="col-md-12">
                <div class="site-info text-center">
                  <p>Copyright © <a href="http://kltech-intl.odoo.com" rel="nofollow">kltech-intl</a></p>
                </div>              
                
              </div>
              <!-- End Col -->
            </div>
            <!-- End Row -->
          </div>
        </div>
      <!-- Copyright End -->
      </section>
      <!-- Footer area End -->
      
    </footer>
    <!-- Footer Section End --> 


    <!-- Go To Top Link -->
    <a href="#" class="back-to-top">
      <i class="lni-chevron-up"></i>
    </a> 

    <!-- Preloader -->
    <div id="preloader">
      <div class="loader" id="loader-1"></div>
    </div>
    <!-- End Preloader -->

  <script src="{{ asset('assets/js/jquery-min.js')}}"></script>
  <script src="{{ asset('assets/js/popper.min.js')}}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('assets/js/owl.carousel.js')}}"></script>      
  <script src="{{ asset('assets/js/jquery.nav.js')}}"></script>    
  <script src="{{ asset('assets/js/scrolling-nav.js')}}"></script>    
  <script src="{{ asset('assets/js/jquery.easing.min.js')}}"></script>     
  <script src="{{ asset('assets/js/nivo-lightbox.js')}}"></script>     
  <script src="{{ asset('assets/js/jquery.magnific-popup.min.js')}}"></script>     
  <script src="{{ asset('assets/js/form-validator.min.js')}}"></script>
  <script src="{{ asset('assets/js/contact-form-script.js')}}"></script>   
  <script src="{{ asset('assets/js/main.js')}}"></script>
    
  </body>
</html>