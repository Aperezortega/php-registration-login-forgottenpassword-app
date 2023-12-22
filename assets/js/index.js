document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search).toString();
    console.log(urlParams);
    if(urlParams==='logout=success'){
        alert('Log out successful');
    }else if(urlParams==='resetEmail=success'){
        alert('If your email is registered, you will receive an email to reset your password');
    }
    });