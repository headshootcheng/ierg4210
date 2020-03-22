var username= document.getElementById('username');
var email= document.getElementById('email');
var password= document.getElementById('password');
var password2= document.getElementById('password2');

username.oninvalid = function(event) {
    event.target.setCustomValidity('Wrong Format');
}
email.oninvalid = function(event) {
    event.target.setCustomValidity('Wrong Format');
}
password.oninvalid = function(event) {
    event.target.setCustomValidity('Wrong Format');
}
password2.oninvalid = function(event) {
    event.target.setCustomValidity('Wrong Format');
}

function clear(){
    localStorage.clear();
  }
