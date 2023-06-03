

'use strict';

const change_password_modal2 = document.querySelector('.change_password_modal2');
const addEmployeesModal = document.querySelector('.addEmployees');
const transferMoneyModal = document.querySelector('.transfer_money_modal');
const withdrawMoneyModel = document.querySelector('.withdraw_money_modal');
const withdrawSuccessful = document.querySelector('.withdraw_successful');
const updateDetails = document.querySelector('.updateDetailsModal')
const submitCash = document.querySelector('.submitCash');
const movements = document.querySelector('.movements');
const submitBank = document.querySelector('.submitBank');
const withdrawUnsuccessful = document.querySelector('.withdraw_unsuccessful');
const updateManager = document.querySelector('.updateManager');
const deleteManager = document.querySelector('.deleteManager');
const updateEmployee = document.querySelector('.updateEmployee');
const deleteEmployee = document.querySelector('.deleteEmployee');
const AddManager = document.querySelector('.AddManager');
const viewEmployee = document.querySelector('.viewEmployee');
const msg = document.querySelector('.errorShow');




const btnOpenModaladdEmployees = document.querySelectorAll('.btn--show-addEmployees-modal');
const btnOpenChangePassword = document.querySelectorAll('.btn--show-changePassword-modal');
const btnOpenTransferMoney = document.querySelectorAll('.btn--show-transfer-modal');
const btnOpenWithdrawMoney = document.querySelectorAll('.btn--show-withdraw-modal');
const btnOpenWithdrawSuccesssful = document.querySelectorAll('.withdrawMoney_modal_form button');
const btnOpenUpdateDetails = document.querySelectorAll('.btn--show-update-modal');
const btnOpenSubmitCash = document.querySelectorAll('.btn--show-submitCash-modal');
const btnOpenSubmitBank = document.querySelectorAll('.btn--show-submitBank-modal');
const btnOpenTransactionHistory = document.querySelectorAll('.btn--show-transactionHistory-modal')
const btnOpenUpdateManagerDetails = document.querySelectorAll('.btn--show-updateManager-modal');
const btnOpenDeleteManagerDetails = document.querySelectorAll('.btn--show-deleteManager-modal');
const btnOpenUpdateEmployeeDetails = document.querySelectorAll('.btn--show-updateEmployee-modal');
const btnOpenDeleteEmployeeDetails = document.querySelectorAll('.btn--show-deleteEmployee-modal');
const btnOpenViewEmployeeDetails = document.querySelectorAll('.btn--show-viewEmployee-modal');
const btnOpenAddManager = document.querySelectorAll('.btn--show-AddManager-modal');


const btnCloseModalchange = document.querySelector('.btn--close-modal-change');
const btnCloseModaladdEmployees = document.querySelector('.btn--close-modal-addEmployees');
const btnCloseModalTransferMoney = document.querySelector('.btn--close-modal-transferMoney')
const btnCloseModalWithdrawMoney = document.querySelector('.btn--close-modal-withdrawMoney');
const btnCloseModalUpdateDetails = document.querySelector('.btn--close-modal-updateDetails');
const btnCloseModalSubmitCash = document.querySelector('.btn--close-modal-submitCash');
const btnCloseModalSubmitBank = document.querySelector('.btn--close-modal-submitBank');
const btnCloseModalUpdateManager = document.querySelector('.btn--close-modal-updateManager');
const btnCloseModaldeleteManager = document.querySelector('.btn--close-modal-deleteManager');
const btnCloseModalUpdateEmployee = document.querySelector('.btn--close-modal-updateEmployee');
const btnCloseModaldeleteEmployee = document.querySelector('.btn--close-modal-deleteEmployee');
const btnCloseModalViewEmployee = document.querySelector('.btn--close-modal-viewEmployee');
const btnCloseModalCloseMsg = document.querySelector('.btn--close-modal-closeMsg');
const btnCloseModalAddManager = document.querySelector('.btn--close-modal-AddManager');


const overlay = document.querySelector('.overlay');

const msgg = function () {
    /*  e.preventDefault(); */
    msg.classList.add('hidden');
    overlay.classList.add('hidden');
    console.log("clicked");
}
btnCloseModalCloseMsg.addEventListener('click', msgg);
overlay.addEventListener('click', msgg);

// update employee

const openModalupdateEmployee = function (e) {
    e.preventDefault();
    updateEmployee.classList.remove('hidden');
    overlay.classList.remove('hidden');
}
btnOpenUpdateEmployeeDetails.forEach(btn => btn.addEventListener('click', openModalupdateEmployee));

const closeModalupdateEmployee = function () {
    updateEmployee.classList.add('hidden');
    overlay.classList.add('hidden');
}
btnCloseModalUpdateEmployee.addEventListener('click', closeModalupdateEmployee);
overlay.addEventListener('click', closeModalupdateEmployee);


// ADD MANAGER

const openModalAddManager = function (e) {
    e.preventDefault();
    AddManager.classList.remove('hidden');
    overlay.classList.remove('hidden');
}
btnOpenAddManager.forEach(btn => btn.addEventListener('click', openModalAddManager));

const closeModalAddManager = function () {
    AddManager.classList.add('hidden');
    overlay.classList.add('hidden');
}
btnCloseModalAddManager.addEventListener('click', closeModalAddManager);
overlay.addEventListener('click', closeModalAddManager);

// view employee

const openModalviewEmployee = function (e) {
    e.preventDefault();
    viewEmployee.classList.remove('hidden');
    overlay.classList.remove('hidden');
}
btnOpenViewEmployeeDetails.forEach(btn => btn.addEventListener('click', openModalviewEmployee));

const closeModalviewEmployee = function () {
    viewEmployee.classList.add('hidden');
    overlay.classList.add('hidden');
}
btnCloseModalViewEmployee.addEventListener('click', closeModalviewEmployee);
overlay.addEventListener('click', closeModalviewEmployee);
// delete employee

const openModalDeleteEmployee = function (e) {
    e.preventDefault();
    deleteEmployee.classList.remove('hidden');
    overlay.classList.remove('hidden');
}
btnOpenDeleteEmployeeDetails.forEach(btn => btn.addEventListener('click', openModalDeleteEmployee));

const closeModalDeleteEmployee = function () {
    deleteEmployee.classList.add('hidden');
    overlay.classList.add('hidden');
}
btnCloseModaldeleteEmployee.addEventListener('click', closeModalDeleteEmployee);
overlay.addEventListener('click', closeModalDeleteEmployee);

//view employee

/* const openModalDeleteManager = function (e) {
    e.preventDefault();
    deleteManager.classList.remove('hidden');
    overlay.classList.remove('hidden');
}
btnOpenDeleteManagerDetails.forEach(btn => btn.addEventListener('click', openModalDeleteManager));

const closeModalDeleteManager = function () {
    deleteManager.classList.add('hidden');
    overlay.classList.add('hidden');
}
btnCloseModaldeleteManager .addEventListener('click', closeModalDeleteManager);
overlay.addEventListener('click', closeModalDeleteManager);
 */

// delete manager 

const openModalDeleteManager = function (e) {
    e.preventDefault();
    deleteManager.classList.remove('hidden');
    overlay.classList.remove('hidden');
}
btnOpenDeleteManagerDetails.forEach(btn => btn.addEventListener('click', openModalDeleteManager));

const closeModalDeleteManager = function () {
    deleteManager.classList.add('hidden');
    overlay.classList.add('hidden');
}
btnCloseModaldeleteManager.addEventListener('click', closeModalDeleteManager);
overlay.addEventListener('click', closeModalDeleteManager);


// update manager details
const openModalUpdateManager = function (e) {
    e.preventDefault();
    updateManager.classList.remove('hidden');
    overlay.classList.remove('hidden');
}
btnOpenUpdateManagerDetails.forEach(btn => btn.addEventListener('click', openModalUpdateManager));

const closeModalUpdateManager = function () {
    updateManager.classList.add('hidden');
    overlay.classList.add('hidden');
}
btnCloseModalUpdateManager.addEventListener('click', closeModalUpdateManager);
overlay.addEventListener('click', closeModalUpdateManager);


const openModalChangePassword = function (e) {
    e.preventDefault();
    change_password_modal2.classList.remove('hidden');
    overlay.classList.remove('hidden');
}
btnOpenChangePassword.forEach(btn => btn.addEventListener('click', openModalChangePassword));

const closeModalChangePassword = function () {
    change_password_modal2.classList.add('hidden');
    overlay.classList.add('hidden');
}
btnCloseModalchange.addEventListener('click', closeModalChangePassword);
overlay.addEventListener('click', closeModalChangePassword);

document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !change_password_modal2.classList.contains('hidden')) {
        closeModal();
    }
});

// view balance modal 

const openModaladdEmployees = function (e) {
    e.preventDefault();
    addEmployeesModal.classList.remove('hidden');
    overlay.classList.remove('hidden');
};
const closeModaladdEmployees = function () {
    addEmployeesModal.classList.add('hidden');
    overlay.classList.add('hidden');
};

btnOpenModaladdEmployees.forEach(btn => btn.addEventListener('click', openModaladdEmployees));

btnCloseModaladdEmployees.addEventListener('click', closeModaladdEmployees);
overlay.addEventListener('click', closeModaladdEmployees);

document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !viewBalanceModal.contains('hidden')) {
        closeModal();
    }
});

// Transfer Money modal

const openModalTransferMoney = function (e) {
    e.preventDefault();
    transferMoneyModal.classList.remove('hidden');
    overlay.classList.remove('hidden');
};
const closeModalTransferMoney = function () {
    transferMoneyModal.classList.add('hidden');
    overlay.classList.add('hidden');
};

btnOpenTransferMoney.forEach(btn => btn.addEventListener('click', openModalTransferMoney));

btnCloseModalTransferMoney.addEventListener('click', closeModalTransferMoney);
overlay.addEventListener('click', closeModalTransferMoney);

// withdraw money

const openModalWithdrawMoney = function (e) {
    e.preventDefault();
    withdrawMoneyModel.classList.remove('hidden');
    overlay.classList.remove('hidden');
};
const closeModalWithdrawMoney = function () {
    withdrawMoneyModel.classList.add('hidden');
    overlay.classList.add('hidden');
};

btnOpenWithdrawMoney.forEach(btn => btn.addEventListener('click', openModalWithdrawMoney));

btnCloseModalWithdrawMoney.addEventListener('click', closeModalWithdrawMoney);
overlay.addEventListener('click', closeModalWithdrawMoney);

// withdraw succesful

const openModalWithdrawSuccessful = function (e) {
    e.preventDefault();
    withdrawSuccessful.classList.remove('hidden');
    overlay.classList.remove('hidden');
};
const closeModalWithdrawSuccessful = function () {
    withdrawSuccessful.classList.add('hidden');
    overlay.classList.add('hidden');
};

btnOpenWithdrawSuccesssful.forEach(btn => btn.addEventListener('click', openModalWithdrawSuccessful));

overlay.addEventListener('click', closeModalWithdrawSuccessful);

// Update details

const openModalUpdateDetails = function (e) {
    e.preventDefault();
    updateDetails.classList.remove('hidden');
    overlay.classList.remove('hidden');
};
const closeModalUpdateDetails = function () {
    updateDetails.classList.add('hidden');
    overlay.classList.add('hidden');
};

btnOpenUpdateDetails.forEach(btn => btn.addEventListener('click', openModalUpdateDetails));

btnCloseModalUpdateDetails.addEventListener('click', closeModalUpdateDetails);
overlay.addEventListener('click', closeModalUpdateDetails);

// Submit Cash

const openModalCashSubmit = function (e) {
    e.preventDefault();
    submitCash.classList.remove('hidden');
    overlay.classList.remove('hidden');
};
const closeModalSubmitCash = function () {
    submitCash.classList.add('hidden');
    overlay.classList.add('hidden');
};

btnOpenSubmitCash.forEach(btn => btn.addEventListener('click', openModalCashSubmit));

btnCloseModalSubmitCash.addEventListener('click', closeModalSubmitCash);
overlay.addEventListener('click', closeModalSubmitCash);


//Update Bank Branch
const openModalBankSubmit = function (e) {
    e.preventDefault();
    submitBank.classList.remove('hidden');
    overlay.classList.remove('hidden');
};
const closeModalSubmitBank = function () {
    submitBank.classList.add('hidden');
    overlay.classList.add('hidden');
};

btnOpenSubmitBank.forEach(btn => btn.addEventListener('click', openModalBankSubmit));

btnCloseModalSubmitBank.addEventListener('click', closeModalSubmitBank);
overlay.addEventListener('click', closeModalSubmitBank);

//////////////////////

// transaction history

const openModalTransactionHistory = function (e) {
    e.preventDefault();
    movements.classList.remove('hidden');
    overlay.classList.remove('hidden');
};
const closeModalTransactionHistory = function () {
    movements.classList.add('hidden');
    overlay.classList.add('hidden');
};

btnOpenTransactionHistory.forEach(btn => btn.addEventListener('click', openModalTransactionHistory));

overlay.addEventListener('click', closeModalTransactionHistory);

//const containerMovements = document.querySelector('.movements');

const closeModalwithdrawUnsuccessful = function () {
    withdrawUnsuccessful.classList.add('hidden');
};

/* const closeModalWithdrawSuccessful = function () {
    withdrawSuccessful.classList.add('hidden');

}; */
//document.getElementById("submit_btn").onclick = function(){

//const withdraw_amount = document.getElementById("withdraw").value;

//if (withdraw_amount < curr_bal){
    //withdraw successful
/* withdrawSuccessful.classList.remove('hidden');
overlay.classList.remove('hidden');

closeModalWithdrawSuccessful();  */
//}
/* else{
    //insufficient balance
    withdrawUnsuccessful.classList.remove('hidden');
    overlay.classList.remove('hidden');

    closeModalwithdrawUnsuccessful();
} */


