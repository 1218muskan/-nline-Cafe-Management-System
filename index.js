var loginBtn = document.querySelector(".loginBtn");
var loginForm = document.getElementById("login");
var signupForm = document.getElementById("signup");
var FormCloseBtn = document.getElementsByClassName("closeBtn");
var login_signup_switch = document.querySelectorAll(".signup-login > a")


// ********************** Popping up login form *****************************
loginBtn.addEventListener("click", function(){
    document.querySelector("main").style.filter = "blur(3px)";
    document.querySelector("nav").style.filter = "blur(3px)";
    loginForm.style.display="block";
    
});
// ********************** Closing forms *************************************
FormCloseBtn[0].addEventListener("click", function(){
    loginForm.style.display = "none";
    document.querySelector("main").style.filter = "none";
    document.querySelector("nav").style.filter = "none";
});
FormCloseBtn[1].addEventListener("click", function(){
    signupForm.style.display = "none";
    document.querySelector("main").style.filter = "none";
    document.querySelector("nav").style.filter = "none";
});
// ************** switching btw login and signup forms ******************
login_signup_switch[0].addEventListener("click", function(){
    loginForm.style.display = "none";
    signupForm.style.display = "block";
});
login_signup_switch[1].addEventListener("click", function(){
    signupForm.style.display = "none";
    loginForm.style.display = "block";
});

//******************************* */ payment*/////////////////////
var payment_close=document.getElementById('payment_close')
var payment=document.getElementsByClassName("payment")
payment_close.addEventListener("click", function(){
    payment.style.display = "none";
    
});

