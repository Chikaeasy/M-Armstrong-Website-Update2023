document.addEventListener('DOMContentLoaded', function() {
  // Initialize date and time pickers
  $('#datepicker').datetimepicker({
      format: 'L',
      minDate: moment().startOf('day')
  });
  $('#timepicker').datetimepicker({
      format: 'LT'
  });

  // Form submission
  document.getElementById('appointmentForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      let formData = new FormData(this);
      
      fetch('submit_form.php', {
          method: 'POST',
          body: formData
      })
      .then(response => response.json())
      .then(data => {
          let messageElement = document.getElementById('formMessage');
          if (data.success) {
              messageElement.textContent = data.success;
              messageElement.style.color = 'green';
              this.reset();
          } else if (data.error) {
              messageElement.textContent = data.error;
              messageElement.style.color = 'red';
          }
      })
      .catch(error => {
          console.error('Error:', error);
          document.getElementById('formMessage').textContent = 'An error occurred. Please try again later.';
          document.getElementById('formMessage').style.color = 'red';
      });
  });
});