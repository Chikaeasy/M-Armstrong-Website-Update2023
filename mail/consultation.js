$(document).ready(function() {
  // Initialize datetime pickers
  $('#datepicker').datetimepicker({
      format: 'L'
  });

  $('#timepicker').datetimepicker({
      format: 'LT'
  });

  $('form').on('submit', function(event) {
      event.preventDefault(); // Prevent default form submission

      // Validate and sanitize form inputs
      const name = $('#name').val().trim();
      const email = $('#email').val().trim();
      const date = $('#date').val().trim();
      const time = $('#time').val().trim();
      const service = $('#service').val();

      let isValid = true;

      if (name === "") {
          isValid = false;
          alert("Please enter your name.");
      }

      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email)) {
          isValid = false;
          alert("Please enter a valid email address.");
      }

      if (date === "") {
          isValid = false;
          alert("Please select a date.");
      }

      if (time === "") {
          isValid = false;
          alert("Please select a time.");
      }

      if (service === "Select A Service") {
          isValid = false;
          alert("Please select a service.");
      }

      if (isValid) {
          $.ajax({
              url: 'submit_form.php',
              type: 'POST',
              data: $(this).serialize(),
              success: function(response) {
                  alert(response); // Display response from PHP script
              },
              error: function() {
                  alert('An error occurred. Please try again.'); // Display error message
              }
          });
      }
  });
});
