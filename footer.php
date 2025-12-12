<!-- Footer Start -->
<div class="container-fluid bg-dark text-white mt-5 py-5 px-sm-3 px-md-5">
  <div class="row justify-content-center pt-5">
    <div class="col-lg-3 col-md-6 mb-5 text-center">
      <a href="index.php" class="navbar-brand">
        <h1 class="m-0 mt-n3 display-4 text-primary"><?php echo $site_title ?? 'Clean'; ?></h1>
      </a>
      <p>
        Bharuch's Home Services provide various Home services in Bharuch
        like Electrician services, Plumbing services, Carpenter service.
        DOOR TO DOOR HOME SERVICES
      </p>
    </div>
    <div class="col-lg-3 col-md-6 mb-5 text-center">
      <h4 class="font-weight-semi-bold text-primary mb-4">Get In Touch</h4>
      <p><i class="fa fa-map-marker-alt text-primary mr-2"></i><?php echo $location; ?></p>
      <p><i class="fa fa-phone-alt text-primary mr-2"></i><?php echo $contact_phone; ?></p>
      <p><i class="fa fa-envelope text-primary mr-2"></i><?php echo $contact_email; ?></p>
      <div class="d-flex justify-content-center mt-4">
        <a class="btn btn-light btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
        <a class="btn btn-light btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
        <a class="btn btn-light btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
        <a class="btn btn-light btn-social" href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-5 text-center">
      <h4 class="font-weight-semi-bold text-primary mb-4">Quick Links</h4>
      <div class="d-flex flex-column justify-content-start align-items-center">
        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About Us</a>
        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Services</a>
        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Projects</a>
        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Book Now</a>
      </div>
    </div>
  </div>
</div>
<!-- Footer End -->

<!-- Back to Top -->
<a href="#" class="btn btn-primary px-3 back-to-top">
  <i class="fa fa-angle-double-up"></i>
</a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/isotope/isotope.pkgd.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>

<!-- Contact Javascript File -->
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>

<!-- jQuery (required for Owl Carousel) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- Initialize Carousel -->
<script>
  $(document).ready(function(){
    $('.service-carousel').owlCarousel({
      loop: true,
      margin: 30,
      nav: true,
      dots: false,
      autoplay: true,
      autoplayTimeout: 3000,
      smartSpeed: 1000,
      responsive: {
        0:    { items: 1 },
        576:  { items: 1 },
        768:  { items: 2 },
        992:  { items: 3 }
      }
    });
  });
</script>


<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>
</html>
