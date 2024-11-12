
$(document).ready(() => {
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
        lettersonly: true
      },
      email: {
        required: true,
        maxlength: 100,
        unique: true,
        emailWithTLD: true
      },
      subject: {
        required: true,
        minlength: 3
      },
      message: {
        required: true,
        maxlength: 300,
        alphanumericPunctuation: true
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
        url: '<?=ROOT?>/Home',
        type: 'post',
        data: jQuery('#contactForm').serialize(),
        dataType: 'json',
        success: function(result) {
          jQuery('#submit').html('Send Message');
          jQuery('#submit').attr('disabled', false);

          if(result.status === 'success') {
            jQuery('#msg').html('<div class="alert alert-success">' + result.message + '</div>');
            $('#contactForm')[0].reset();  
          } else {
            jQuery('#msg').html('<div class="alert alert-danger">' + result.message + '</div>');
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


