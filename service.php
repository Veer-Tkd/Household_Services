<?php include 'header.php'; ?>

<!-- Services Start -->
<div class="container-fluid py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h6 class="text-secondary font-weight-semi-bold text-uppercase mb-3">Our Services</h6>
        <h1 class="mb-4 section-title">Awesome Household Services For You</h1>
        <p>
          Bharuch's Home Services provide various home services like Electrician services, Plumbing, Carpenter service,
          Home Appliance repair, Cooking, Gardening, Home Cleaning, Washing machine repair, Refrigerator repair,
          Microwave repair, Water Purifier repair, and more. DOOR TO DOOR HOME SERVICES.
        </p>
        <a href="#" class="btn btn-primary mt-3 py-2 px-4">More Services</a>
      </div>
      <div class="col-lg-6 pt-5 pt-lg-0">
        <div class="owl-carousel service-carousel position-relative">
          <?php
          $services = [
            ["icon" => "fa-hotel", "name" => "Home Cleaning", "img" => "img/home_cleaning.jpeg"],
            ["icon" => "fa-city", "name" => "Cooking", "img" => "img/cooking.jpeg"],
            ["icon" => "fa-spa", "name" => "Gardening", "img" => "img/gardening.jpg"],
            ["icon" => "fa-plug", "name" => "Electrician", "img" => "img/Electrician.jpeg"],
            ["icon" => "fa-tools", "name" => "Plumbing", "img" => "img/Plumbing.jpeg"],
            ["icon" => "fa-wrench", "name" => "Carpenter", "img" => "img/Carpenter.jpeg"]
          ];
          foreach ($services as $service): ?>
            <div class="d-flex flex-column align-items-center text-center bg-light rounded overflow-hidden pt-4">
              <div class="icon-box bg-light text-secondary shadow mt-2 mb-4">
                <i class="fa fa-2x <?= $service['icon']; ?>"></i>
              </div>
              <h5 class="font-weight-bold mb-4 px-4"><?= $service['name']; ?></h5>
              <img src="<?= $service['img']; ?>" alt="<?= $service['name']; ?>" />
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Services End -->

<!-- Contact Info Start -->
<div class="container-fluid py-5 contact-info">
  <div class="row">
    <div class="col-lg-4 p-0">
      <div class="contact-info-item d-flex align-items-center justify-content-center bg-primary text-white py-4 py-lg-0">
        <i class="fa fa-3x fa-map-marker-alt text-secondary mr-4"></i>
        <div>
          <h5 class="mb-2">Our Office</h5>
          <p class="m-0"><?= $location ?? 'Bharuch-392002,Gujarat'; ?></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 p-0">
      <div class="contact-info-item d-flex align-items-center justify-content-center bg-secondary text-white py-4 py-lg-0">
        <i class="fa fa-3x fa-envelope-open text-primary mr-4"></i>
        <div>
          <h5 class="mb-2">Email Us</h5>
          <p class="m-0"><?= $contact_email ?? 'info@bharuchservices.com'; ?></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 p-0">
      <div class="contact-info-item d-flex align-items-center justify-content-center bg-primary text-white py-4 py-lg-0">
        <i class="fa fa-3x fa-phone-alt text-secondary mr-4"></i>
        <div>
          <h5 class="mb-2">Call Us</h5>
          <p class="m-0"><?= $contact_phone ?? '+91 34525 67890'; ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Contact Info End -->

<!-- Counters Start -->
<div class="container-fluid bg-light py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <div class="row">
          <div class="col-sm-4 d-flex flex-column align-items-center">
            <h1 class="text-secondary mb-2" data-toggle="counter-up">0</h1>
            <h6 class="font-weight-semi-bold mb-sm-4">Site Inspections</h6>
          </div>
          <div class="col-sm-4 d-flex flex-column align-items-center">
            <h1 class="text-secondary mb-2" data-toggle="counter-up">0</h1>
            <h6 class="font-weight-semi-bold mb-sm-4">Projects Done</h6>
          </div>
          <div class="col-sm-4 d-flex flex-column align-items-center">
            <h1 class="text-secondary mb-2" data-toggle="counter-up">0</h1>
            <h6 class="font-weight-semi-bold mb-sm-4">Qualified Staff</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Counters End -->

<?php include 'footer.php'; ?>
