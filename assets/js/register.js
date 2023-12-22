document.addEventListener('DOMContentLoaded', function() {
    //PASSWORD VALIDATION
    const form = document.querySelector('form');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    const urlParams = new URLSearchParams(window.location.search).toString();

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

    //EMAIL VALIDATION
    
    console.log(urlParams);
    if(urlParams==='register=failed&error=emailTaken'){
        alert('Registration Failed. Email already registered');
    }

});