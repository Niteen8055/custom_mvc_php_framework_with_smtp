<footer id="footer" class="footer">

  <div class="container footer-top">
    <div class="row gy-4">
      <div class="col-lg-4 col-md-6 footer-about">
        <a href="index.html" class="logo d-flex align-items-center">
          <span class="sitename">iLanding</span>
        </a>
        <div class="footer-contact pt-3">
          <p>A108 Adam Street</p>
          <p>New York, NY 535022</p>
          <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
          <p><strong>Email:</strong> <span>info@example.com</span></p>
        </div>
        <div class="social-links d-flex mt-4">
          <a href=""><i class="bi bi-twitter-x"></i></a>
          <a href=""><i class="bi bi-facebook"></i></a>
          <a href=""><i class="bi bi-instagram"></i></a>
          <a href=""><i class="bi bi-linkedin"></i></a>
        </div>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Useful Links</h4>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">About us</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Terms of service</a></li>
          <li><a href="#">Privacy policy</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Our Services</h4>
        <ul>
          <li><a href="#">Web Design</a></li>
          <li><a href="#">Web Development</a></li>
          <li><a href="#">Product Management</a></li>
          <li><a href="#">Marketing</a></li>
          <li><a href="#">Graphic Design</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Hic solutasetp</h4>
        <ul>
          <li><a href="#">Molestiae accusamus iure</a></li>
          <li><a href="#">Excepturi dignissimos</a></li>
          <li><a href="#">Suscipit distinctio</a></li>
          <li><a href="#">Dilecta</a></li>
          <li><a href="#">Sit quas consectetur</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Nobis illum</h4>
        <ul>
          <li><a href="#">Ipsam</a></li>
          <li><a href="#">Laudantium dolorum</a></li>
          <li><a href="#">Dinera</a></li>
          <li><a href="#">Trodelas</a></li>
          <li><a href="#">Flexo</a></li>
        </ul>
      </div>

    </div>
  </div>

  <div class="container copyright text-center mt-4">
    <p>© <span>Copyright</span> <strong class="px-1 sitename">iLanding</strong> <span>All Rights Reserved</span></p>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you've purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?= BaseRoot ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= BaseRoot ?>/assets/vendor/aos/aos.js"></script>
<script src="<?= BaseRoot ?>/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?= BaseRoot ?>/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?= BaseRoot ?>/assets/vendor/purecounter/purecounter_vanilla.js"></script>

<!-- Main JS File -->
<script src="<?= BaseRoot ?>/assets/js/main.js"></script>
<script src="<?= BaseRoot ?>/assets/js/jquery.min.js"></script>
<script src="<?= BaseRoot ?>/assets/js/jquery.validate.min.js"></script>
<script src="<?= BaseRoot ?>/assets/js/toastr.min.js"></script>
<script>
  $(document).ready(function() {

    //cutom validation for non-space character
    jQuery.validator.addMethod("noLeadingSpace", function(value, element) {
      // Check if the input does not start with a space
      return this.optional(element) || /^[^\s]/.test(value);
    }, "Input cannot start with a space.");

    // Custom validation method for letters only
    $.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "Please enter only letters.");

    // Custom validation method for unique email IDs
    $.validator.addMethod("unique", function(value, element) {
      let parentForm = $(element).closest("form");
      let timesRepeated = 0;
      if (value !== "") {
        $(parentForm.find("input[type='email']")).each(function() {
          if ($(this).val() === value) {
            timesRepeated++;
          }
        });
      }
      return timesRepeated <= 1;
    }, "Sender and recipient email IDs cannot be the same.");

    // Custom validation for alphanumeric punctuation in messages
    $.validator.addMethod("alphanumericPunctuation", function(value, element) {
      return this.optional(element) || /^[ A-Za-z0-9@!,?'./&]*$/.test(value);
    }, "Please enter a valid message. Only the following characters are allowed: @!,?'/&.");

    // Custom validation method for emails with TLD
    $.validator.addMethod("emailWithTLD", function(value, element) {
      return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
    }, "Please enter a valid email address.");

    // Initialize validation on the contact form
    $('#contactForm').validate({
      rules: {
        name: {
          required: true,
          minlength: 3,
          lettersonly: true,
          noLeadingSpace: true
        },
        email: {
          required: true,
          maxlength: 100,
          unique: true,
          emailWithTLD: true,
          noLeadingSpace: true
        },
        subject: {
          required: true,
          minlength: 3,
          noLeadingSpace: true
        },
        message: {
          required: true,
          maxlength: 300,
          alphanumericPunctuation: true,
          noLeadingSpace: true
        }
      },
      messages: {
        name: {
          required: "Name is mandatory",
          minlength: "Name must be at least 3 characters long",
          lettersonly: "Name should contain only letters and spaces"
        },
        email: {
          required: "Email is mandatory",
          emailWithTLD: "Please enter a valid email address",
          maxlength: "The email address cannot exceed 100 characters in length."
        },
        subject: {
          required: "Subject is mandatory",
          minlength: "Subject must be at least 3 characters long"
        },
        message: {
          required: "Message is mandatory",
          maxlength: "The message cannot exceed 300 characters.",
          alphanumericPunctuation: "Only the following characters are allowed: @!,?'/&."
        }
      },
      submitHandler: function(form) {
        jQuery('#msg').html('');
        jQuery('#submit').html('Please wait');
        jQuery('#submit').attr('disabled', true);

        jQuery.ajax({
          url: '<?= ROOT ?>/Home',
          type: 'post',
          data: jQuery('#contactForm').serialize(),
          dataType: 'json',
          success: function(result) {
            console.log(result.message);
            jQuery('#submit').html('Send Message');
            jQuery('#submit').attr('disabled', false);

            if (result.status === 'success') {
              toastr.success(result.status, result.message)
              $('#contactForm')[0].reset();
            } else {
              toastr.error(result.status, result.message)
            }
          },
          error: function(xhr, status, error) {
            jQuery('#submit').html('Send Message');
            jQuery('#submit').attr('disabled', false);
            jQuery('#msg').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
          }
        });
      }
    });
  });
</script>
<script>
  $(document).ready(function() {

    toastr.options = {
      'closeButton': true,
      'debug': false,
      'newestOnTop': true,
      'progressBar': false,
      'positionClass': 'toast-top-right',
      'preventDuplicates': false,
      'showDuration': '1000',
      'hideDuration': '1000',
      'timeOut': '5000',
      'extendedTimeOut': '1000',
      'showEasing': 'swing',
      'hideEasing': 'linear',
      'showMethod': 'fadeIn',
      'hideMethod': 'fadeOut',
    }

  });
</script>
</body>


</html>