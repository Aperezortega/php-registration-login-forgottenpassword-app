document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        if(password.value===''||confirmPassword.value===''){
            alert('Password cannot be empty');
    }else if(password.value!==confirmPassword.value){
            alert('Password does not match');
    }else{
        form.submit();
    }
    });


});