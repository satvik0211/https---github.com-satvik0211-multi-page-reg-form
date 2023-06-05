document.addEventListener('DOMContentLoaded', function() {
  const firstForm = document.querySelector('.formfirst');
  const secondForm = document.querySelector('.formsecond');
  const thirdForm = document.querySelector('.formthird');
  const nextButton = document.querySelector('.firstbtn');
  const nextButton1 = document.querySelector('.next1');
  const prevButton = document.querySelector('.prev');
  const prevButton1 = document.querySelector('.prev1');

  //second form hide
  secondForm.style.display = 'none';
  thirdForm.style.display = 'none';

  nextButton.addEventListener('click', function(e) {
    e.preventDefault();
    // Validate the first form inputs
    const formInputs = firstForm.querySelectorAll('input[required]');
    let isValid = true;
    let errorFields = [];

    formInputs.forEach(function(input) {
      if (input.value.trim() === '') {
        input.classList.add('error');
        isValid = false;
        errorFields.push(input.name);
      } else {
        input.classList.remove('error');
      }
    });

    // check if it is filled or not
    if (isValid) {
      firstForm.style.opacity = 0;
      setTimeout(function() {
        firstForm.style.display = 'none';
        secondForm.style.display = 'block';
        setTimeout(function() {
          secondForm.style.opacity = 1;
        }, 100);
      }, 200);
    } else {
      alert('Please fill in the required fields: ' + errorFields.join(', '));
    }
  });

  nextButton1.addEventListener('click', function(e) {
    e.preventDefault();
    const formInputs = secondForm.querySelectorAll('input[required], select[required]');
    let isValid = true;
    let errorFields = [];

    formInputs.forEach(function(input) {
      if (input.value.trim() === '') {
        input.classList.add('error');
        isValid = false;
        errorFields.push(input.name);
      } else {
        input.classList.remove('error');
      }
    });

    // Proceed to the third form if inputs are valid
    if (isValid) {
      secondForm.style.opacity = 0;
      setTimeout(function() {
        secondForm.style.display = 'none';
        thirdForm.style.display = 'block';
        setTimeout(function() {
          thirdForm.style.opacity = 1;
        }, 100);
      }, 200);
    } else {
      alert('Please fill in the required fields: ' + errorFields.join(', '));
    }
  });

  prevButton.addEventListener('click', function(e) {
    e.preventDefault();
    secondForm.style.opacity = 0;
    setTimeout(function() {
      secondForm.style.display = 'none';
      firstForm.style.display = 'block';
      setTimeout(function() {
        firstForm.style.opacity = 1;
      }, 100);
    }, 200);
  });

  prevButton1.addEventListener('click', function(e) {
    e.preventDefault();
    thirdForm.style.opacity = 0;
    setTimeout(function() {
      thirdForm.style.display = 'none';
      secondForm.style.display = 'block';
      setTimeout(function() {
        secondForm.style.opacity = 1;
      }, 100);
    }, 200);
  });
});
