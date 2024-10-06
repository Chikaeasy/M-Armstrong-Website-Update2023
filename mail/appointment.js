document.addEventListener('DOMContentLoaded', function() {
  $('#datepicker').datetimepicker({
      format: 'L',
      minDate: moment().startOf('day')
  });
  $('#timepicker').datetimepicker({
      format: 'LT'
  });

  document.getElementById('appointmentForm').addEventListener('submit', function(e) {
      e.preventDefault();

      // Client-side validation
      const name = document.getElementById('name').value.trim();
      const email = document.getElementById('email').value.trim();
      const date = document.querySelector('#datepicker input').value.trim();
      const time = document.querySelector('#timepicker input').value.trim();
      const service = document.getElementById('service').value;

      let isValid = true;
      let messageElement = document.getElementById('formMessage');

      if (name === "") {
          isValid = false;
          messageElement.textContent = "Please enter your name.";
          messageElement.style.color = 'red';
          return;
      }

      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email)) {
          isValid = false;
          messageElement.textContent = "Please enter a valid email address.";
          messageElement.style.color = 'red';
          return;
      }

      if (date === "") {
          isValid = false;
          messageElement.textContent = "Please select a date.";
          messageElement.style.color = 'red';
          return;
      }

      if (time === "") {
          isValid = false;
          messageElement.textContent = "Please select a time.";
          messageElement.style.color = 'red';
          return;
      }

      if (service === "Select A Service") {
          isValid = false;
          messageElement.textContent = "Please select a service.";
          messageElement.style.color = 'red';
          return;
      }

      if (isValid) {
          let formData = new FormData(this);
          fetch('submit_form.php', {
              method: 'POST',
              body: formData
          })
          .then(response => response.json())
          .then(data => {
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
              messageElement.textContent = 'An error occurred. Please try again later.';
              messageElement.style.color = 'red';
          });
      }
  });
});