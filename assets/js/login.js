document.addEventListener('DOMContentLoaded', function() {
const urlParams = new URLSearchParams(window.location.search).toString();
console.log(urlParams);
if(urlParams==='login=failed'){
    alert('Login failed. Please try again');
}
});