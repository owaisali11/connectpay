const msg = document.querySelector('.errorShow');
const btnCloseModalCloseMsg = document.querySelector('.btn--close-modal-closeMsg');
/* const overlay = document.querySelector('.overlay');
 */


const msgg = function () {
    /*  e.preventDefault(); */
      msg.classList.add('hidden');
      overlay.classList.add('hidden'); 
      console.log("clicked");
    }
    btnCloseModalCloseMsg.addEventListener('click', msgg);
    overlay.addEventListener('click', msgg);