<?php include 'header.php'; ?>

<!-- Portfolio Start -->
<div class="container-fluid py-5">
  <div class="container">
    <div class="row align-items-end mb-4">
      <div class="col-lg-6">
        <h6 class="text-secondary font-weight-semi-bold text-uppercase mb-3">Our Projects</h6>
        <h1 class="section-title mb-3">Visit Our Awesome Household Projects</h1>
      </div>
      <div class="col-lg-6 text-center text-lg-right">
        <ul class="list-inline mb-2" id="portfolio-flters">
          <li class="btn btn-sm btn-outline-primary m-1 active" data-filter="*">All</li>
          <li class="btn btn-sm btn-outline-primary m-1" data-filter=".first">Complete</li>
          <li class="btn btn-sm btn-outline-primary m-1" data-filter=".second">Running</li>
          <li class="btn btn-sm btn-outline-primary m-1" data-filter=".third">Upcoming</li>
        </ul>
      </div>
    </div>

    <div class="row m-0 portfolio-container">
      <?php
      $projects = [
        ["name" => "Home Cleaning", "img" => "img/home_cleaning.jpeg", "category" => "first"],
        ["name" => "Cooking", "img" => "img/cooking.jpeg", "category" => "second"],
        ["name" => "Gardening", "img" => "img/gardening.jpg", "category" => "third"],
        ["name" => "Electrician", "img" => "img/Electrician.jpeg", "category" => "first"],
        ["name" => "Plumbing", "img" => "img/Plumbing.jpeg", "category" => "second"],
        ["name" => "Carpenter", "img" => "img/Carpenter.jpeg", "category" => "third"]
      ];

      foreach ($projects as $proj): ?>
        <div class="col-lg-4 col-md-6 col-sm-12 p-0 portfolio-item <?= $proj['category']; ?>">
          <div class="position-relative overflow-hidden">
            <div class="portfolio-img">
              <img class="img-fluid w-100" src="<?= $proj['img']; ?>" alt="<?= $proj['name']; ?>" />
            </div>
            <div class="portfolio-text bg-primary">
              <h4 class="font-weight-bold mb-4"><?= $proj['name']; ?></h4>
              <div class="d-flex align-items-center justify-content-center">
                <a class="btn btn-sm btn-secondary m-1" href="#">
                  <i class="fa fa-link"></i>
                </a>
                <a class="btn btn-sm btn-secondary m-1" href="<?= $proj['img']; ?>" data-lightbox="portfolio">
                  <i class="fa fa-eye"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<!-- Portfolio End -->

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
