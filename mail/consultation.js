$(document).ready(function() {
  $('form').on('submit', function(event) {
      event.preventDefault();

      $.ajax({
          url: 'submit_form.php',
          type: 'POST',
          data: $(this).serialize(),
          success: function(response) {
              alert(response);
          },
          error: function() {
              alert('An error occurred. Please try again.');
          }
      });
  });
});
