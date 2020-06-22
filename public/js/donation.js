const nameUI = document.getElementById('name');
const emailUI = document.getElementById('email');
const re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

document.getElementById('opendonationModal').addEventListener('click', () => {
    if (!nameUI.disabled) {
        nameUI.value = '';
        emailUI.value = '';
    }
    document.getElementById('amount').value = '5';

    $('#donationModal').modal('show');
})
document.querySelector('#modal-form').addEventListener('submit', (e) => {
    e.preventDefault();
    let emailResult = true;
    if (nameUI.value === '') {
        nameUI.classList.add('is-invalid');
    } else {
        nameUI.classList.remove('is-invalid');
    }
    if (emailUI.value === '') {
        emailUI.classList.add('is-invalid');
    } else if (!re.test(emailUI.value)) {
        emailResult = false;
        emailUI.classList.add('is-invalid');
    } else {
        emailUI.classList.remove('is-invalid');
    }
    if (nameUI.value !== '' && emailUI.value !== '' && emailResult) {
        document.querySelector('#modal-form').submit();
    }
})
document.querySelector('.amount').addEventListener('change', (e) => {
    // console.log(e.target.value);
    const displayAmountUI = document.querySelector('.selected-amount');
    displayAmountUI.innerHTML = `<strong>Nrs. ${e.target.value}</strong>`;
});