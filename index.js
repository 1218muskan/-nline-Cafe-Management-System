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





/********************************about us testimonials *********************/
var imgperson =document.getElementsByClassName("img-person");
var aboutperson =document.getElementsByClassName("about-person");
var f =document.getElementsById("f");
var m =document.getElementsById("m");
var l =document.getElementsById("l");
var test=document.getElementsByClassName("testimonial");
var changeicon=document.getElementsByClassName("change-icon");
var p1=document.getElementsById("p1");
var p2=document.getElementsById("p2");
var p3=document.getElementsById("p3");
l.addEventListener('click',function(){
var last= `<div class="person" id="p3">
<div class="img-person">
    <img src="assets/person3.png">
</div>
<div class="about-person">
    Lorem, ipsum dolor sit amet consectetur
    architecto ipsum assumenda! Non, omnis. Ad, nostrum eligendi. Repellendus cupiditate accusamus et
    voluptatibus quas velit inventore necessitatibus quo vitae corrupti. Incidunt aperiam asperiores
    harum sequi ab!
</div>
<div class="name-t">Fatty hpuguvb </div>
</div>`
if(p1){
    p1.remove();
}
if(p2){
    p2.remove();
}
test.append(last);
changeicon.style.backgroundColor = 'grey';
l.style.backgroundColor = 'brown';

});


m.addEventListener('click',function(){
    var last= `<div class="person" id="p2">
    <div class="img-person">
        <img src="assets/person2.png">
    </div>
    <div class="about-person">
        Lorem, ipsum dolor sit amet consectetur
        architecto ipsum assumenda! Non, omnis. Ad, nostrum eligendi. Repellendus cupiditate accusamus et
        voluptatibus quas velit inventore necessitatibus quo vitae corrupti. Incidunt aperiam asperiores
        harum sequi ab!
    </div>
    <div class="name-t">Fatty hpuguvb </div>
    </div>`
    if(p1){
        p1.remove();
    }
    if(p3){
        p3.remove();
    }
    test.append(last);
    changeicon.style.backgroundColor = 'grey';
    l.style.backgroundColor = 'brown';
    
    });
    
    



