<?php include 'header.php'; ?>

<!-- Carousel Start -->
<div class="container-fluid p-0">
  <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
      <li data-target="#header-carousel" data-slide-to="1"></li>
      <li data-target="#header-carousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="img-fluid" src="img/carousel-1.jpg" alt="Image" />
        <div class="carousel-caption d-flex align-items-center justify-content-center">
          <div class="p-5" style="width: 100%; max-width: 900px;">
            <h5 class="text-primary text-uppercase mb-md-3">Household Services</h5>
            <h1 class="display-3 text-white mb-md-4">Best Quality In Home Services</h1>
            <a href="#" class="btn btn-primary">Get A Quote</a>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="img-fluid" src="img/carousel-2.jpg" alt="Image" />
        <div class="carousel-caption d-flex align-items-center justify-content-center">
          <div class="p-5" style="width: 100%; max-width: 900px;">
            <h5 class="text-primary text-uppercase mb-md-3">Cleaning Services</h5>
            <h1 class="display-3 text-white mb-md-4">Highly Professional Cleaning Services</h1>
            <a href="#" class="btn btn-primary">Get A Quote</a>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="img-fluid" src="img/carousel-3.jpg" alt="Image" />
        <div class="carousel-caption d-flex align-items-center justify-content-center">
          <div class="p-5" style="width: 100%; max-width: 900px;">
            <h5 class="text-primary text-uppercase mb-md-3">Cleaning Services</h5>
            <h1 class="display-3 text-white mb-md-4">Experienced & Expert Cleaners</h1>
            <a href="#" class="btn btn-primary">Get A Quote</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Carousel End -->

<!-- Contact Info Start -->
<div class="container-fluid pb-5 contact-info">
  <div class="row">
    <div class="col-lg-4 p-0">
      <div class="contact-info-item d-flex align-items-center justify-content-center bg-primary text-white py-4 py-lg-0">
        <i class="fa fa-3x fa-map-marker-alt text-secondary mr-4"></i>
        <div>
          <h5 class="mb-2">Our Office</h5>
          <p class="m-0"><?php echo $location; ?></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 p-0">
      <div class="contact-info-item d-flex align-items-center justify-content-center bg-secondary text-white py-4 py-lg-0">
        <i class="fa fa-3x fa-envelope-open text-primary mr-4"></i>
        <div>
          <h5 class="mb-2">Email Us</h5>
          <p class="m-0"><?php echo $contact_email; ?></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 p-0">
      <div class="contact-info-item d-flex align-items-center justify-content-center bg-primary text-white py-4 py-lg-0">
        <i class="fa fa-3x fa-phone-alt text-secondary mr-4"></i>
        <div>
          <h5 class="mb-2">Call Us</h5>
          <p class="m-0"><?php echo $contact_phone; ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Contact Info End -->

<!-- About Start -->
<div class="container-fluid py-5 mb-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-5">
        <div class="d-flex flex-column align-items-center justify-content-center bg-about rounded h-100 py-5 px-3">
          <i class="fa fa-5x fa-award text-primary mb-4"></i>
          <h1 class="display-2 text-white mb-2" data-toggle="counter-up">0</h1>
          <h2 class="text-white m-0">Years Experience</h2>
        </div>
      </div>
      <div class="col-lg-7 pt-5 pb-lg-5">
        <h6 class="text-secondary font-weight-semi-bold text-uppercase mb-3">Learn About Us</h6>
        <h1 class="mb-4 section-title">We Provide The Best Home Services</h1>
        <h5 class="text-muted font-weight-normal mb-3">Established in 2024, our mission is to have a one stop solution for all household needs.</h5>
        <p>We understand that in today’s busy world it’s very difficult to manage time for ourselves even, let alone fixing things at home.</p>
        <p>Our founder Mr. Sunit Sukhadia once faced similar issues in a new city. That gave rise to the idea behind Surat Home Service.</p>
        <div class="d-flex align-items-center pt-4">
          <a href="#" class="btn btn-primary mr-5">Learn More</a>
          <button type="button" class="btn-play" data-toggle="modal" data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-target="#videoModal">
            <span></span>
          </button>
          <h5 class="font-weight-normal text-white m-0 ml-4 d-none d-sm-block">Play Video</h5>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- About End -->

<!-- Services Start -->
<div class="container-fluid py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h6 class="text-secondary font-weight-semi-bold text-uppercase mb-3">Our Services</h6>
        <h1 class="mb-4 section-title">Awesome Household Services For You</h1>
        <p>Bharuch Home Services offers a range of household solutions including Electrician, Plumbing, Cleaning, Cooking, Gardening, Appliance Repairs, and more.</p>
        <a href="#" class="btn btn-primary mt-3 py-2 px-4">More Services</a>
      </div>
      <div class="col-lg-6 pt-5 pt-lg-0">
        <div class="owl-carousel service-carousel position-relative">
          <?php
          $services = [
            ["icon" => "fa-hotel", "title" => "Home Cleaning", "img" => "img/home_cleaning.jpeg"],
            ["icon" => "fa-city", "title" => "Cooking", "img" => "img/cooking.jpeg"],
            ["icon" => "fa-spa", "title" => "Gardening", "img" => "img/gardening.jpg"],
            ["icon" => "fa-plug", "title" => "Electrician", "img" => "img/Electrician.jpeg"],
            ["icon" => "fa-tools", "title" => "Plumbing", "img" => "img/Plumbing.jpeg"],
            ["icon" => "fa-wrench", "title" => "Carpenter", "img" => "img/Carpenter.jpeg"],
          ];
          foreach ($services as $service) {
            echo '<div class="d-flex flex-column align-items-center text-center bg-light rounded overflow-hidden pt-4">';
            echo '<div class="icon-box bg-light text-secondary shadow mt-2 mb-4">';
            echo '<i class="fa fa-2x ' . $service["icon"] . '"></i>';
            echo '</div>';
            echo '<h5 class="font-weight-bold mb-4 px-4">' . $service["title"] . '</h5>';
            echo '<img src="' . $service["img"] . '" alt="' . $service["title"] . '" />';
            echo '</div>';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Services End -->

<!-- Features Start -->
<div class="container-fluid bg-light py-5">
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-7 pt-lg-5 pb-3">
        <h6 class="text-secondary font-weight-semi-bold text-uppercase mb-3">Why Choose Us</h6>
        <h1 class="mb-4 section-title">What Makes Us Stand Out</h1>
        <p class="mb-4">
          As Bharuch’s first start-up of its kind, we aim to be the No.1 home services provider. We’re known for trust, security, and efficiency.
        </p>
        <div class="row">
          <div class="col-sm-4">
            <h1 class="text-secondary mb-2" data-toggle="counter-up">0</h1>
            <h6 class="font-weight-semi-bold mb-sm-4">Our Cleaners</h6>
          </div>
          <div class="col-sm-4">
            <h1 class="text-secondary mb-2" data-toggle="counter-up">0</h1>
            <h6 class="font-weight-semi-bold mb-sm-4">Happy Clients</h6>
          </div>
          <div class="col-sm-4">
            <h1 class="text-secondary mb-2" data-toggle="counter-up">0</h1>
            <h6 class="font-weight-semi-bold mb-sm-4">Projects Done</h6>
          </div>
        </div>
      </div>
      <div class="col-lg-5" style="min-height: 400px;">
        <div class="position-relative h-100 rounded overflow-hidden">
          <img class="position-absolute w-100 h-100" src="img/feature.jpg" style="object-fit: cover;" />
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Features End -->

<?php include 'footer.php'; ?>
