'use strict';

/////////////////////////////////////////////////
/////////////////////////////////////////////////
// Connectpay APP



const change_password_modal2 = document.querySelector('.change_password_modal2');
const change_email = document.querySelector('.changeEmail_modal2');
const change_phoneNumber = document.querySelector('.changePhoneNumber_modal2');
const msg = document.querySelector('.errorShow');


const btnOpenChangePassword = document.querySelectorAll('.btn--showChangepassword--modal');
const btnOpenChangeEmail = document.querySelectorAll('.btn--showEmail--modal');
const btnOpenChangePhoneNumber = document.querySelectorAll('.btn--showPhoneNumber--modal');
const btnOpenChangePasswordbtn = document.querySelectorAll('.btn11');

 

const btnCloseModalchange = document.querySelector('.btn--close-modal-change');
const btnCloseModalChangeEmail = document.querySelector('.btn--close-modal-Email');
const btnCloseModalChangePhoneNumber = document.querySelector('.btn--close-modal-PhoneNumber');
const btnCloseModalCloseMsg = document.querySelector('.btn--close-modal-closeMsg');


const overlay = document.querySelector('.overlay');

  const msgg = function () {
 /*  e.preventDefault(); */
   msg.classList.add('hidden');
   overlay.classList.add('hidden'); 
   console.log("clicked");
 }
 btnCloseModalCloseMsg.addEventListener('click', msgg);
 overlay.addEventListener('click', msgg);


const openModalChangePassword = function (e) {
  e.preventDefault();
  change_password_modal2.classList.remove('hidden');
  overlay.classList.remove('hidden');
  console.log("click");
}
btnOpenChangePassword.forEach(btn => btn.addEventListener('click',openModalChangePassword ));
  
const closeModalChangePassword = function () {
  change_password_modal2.classList.add('hidden');
   overlay.classList.add('hidden'); 
}
btnCloseModalchange.addEventListener('click', closeModalChangePassword);
overlay.addEventListener('click', closeModalChangePassword);


/* Change enail modal */

const openModalChangeEmail = function (e) {
  e.preventDefault();
  change_email.classList.remove('hidden');
  overlay.classList.remove('hidden');
  console.log("click");
}
btnOpenChangeEmail.forEach(btn => btn.addEventListener('click',openModalChangeEmail ));

const closeModalChangeEmail  = function () {
  change_email.classList.add('hidden');
  overlay.classList.add('hidden');
}
btnCloseModalChangeEmail.addEventListener('click', closeModalChangeEmail);
overlay.addEventListener('click', closeModalChangeEmail);

/* Change phone number */

const openModalChangePhoneNumber = function (e) {
  e.preventDefault();
  change_phoneNumber.classList.remove('hidden');
  overlay.classList.remove('hidden');
  console.log("click");
}
btnOpenChangePhoneNumber.forEach(btn => btn.addEventListener('click',openModalChangePhoneNumber ));

const closeModalChangePhoneNumber  = function () {
  change_phoneNumber.classList.add('hidden');
  overlay.classList.add('hidden');
}
btnCloseModalChangeEmail.addEventListener('click', closeModalChangePhoneNumber);
overlay.addEventListener('click', closeModalChangePhoneNumber);
