

const pass = document.getElementById('signUpPass');
const check = document.getElementById('signUpConfirm');

function confirmPassword(event) {
  if (pass.value != check.value) {
    event.preventDefault();

  }
  else {
    alert('sign up succesful!');
  }
}


document.getElementById('submit-form').addEventListener('click', confirmPassword);