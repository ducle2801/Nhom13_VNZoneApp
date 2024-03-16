
const buttons = document.querySelectorAll('.temrm-pay button');

buttons.forEach((button) => {
  button.addEventListener('click', () => {
    const parent = button.parentNode;
    const list = parent.querySelector('.temrm-pay-list');
    parent.classList.toggle('show');
    list.classList.toggle('show');
  })
})
const buttons2 = document.querySelectorAll('.temrm-connet button');

buttons2.forEach((button) => {
  button.addEventListener('click', () => {
    const parent = button.parentNode;
    const list = parent.querySelector('.temrm-connet-list');
    parent.classList.toggle('show');
    list.classList.toggle('show');
  })
})