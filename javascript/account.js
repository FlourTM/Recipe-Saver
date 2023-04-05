const btnEditDetail = document.getElementById('edit'),
    btnChangePass = document.getElementById('change'),
    detailsForm = document.getElementById('accountForm'),
    passForm = document.getElementById('passForm'),
    confirmMsg = document.getElementById('confirm-msg'),
    helloName = document.getElementById('helloName'),
    information = document.getElementById('information'),
    recipes = document.getElementById('recipes'),
    sections = document.querySelectorAll('.section')

var emailVerify = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
var phoneVerify = /^\d{10}$/;
var validPass = /^(?=.*\d)(?=.*[a-z]).{8,20}$/;
var editDetails = document.querySelectorAll('.input1'),
    firstName = document.getElementById('fName'),
    lastName = document.getElementById('lName'),
    emailAdd = document.getElementById('email'),
    phoneNum = document.getElementById('phone'),
    currentPass = document.getElementById('current'),
    newPass = document.getElementById('new'),
    confirmPass = document.getElementById('confirm');

var postRequest = new XMLHttpRequest();
var url = './php/_accountDetails.php';
var params = [];

var currentSection
sections.forEach(button => {
    button.addEventListener('click', e => {
        if (currentSection != button.id) {
            currentSection = button.id

            sections.forEach(btns => {
                if (btns.id != button.id) {
                    btns.classList.remove('active')
                }
            })
            button.classList.add('active')

            if (button.id == "myInfo") {
                information.classList.remove('hidden')
                recipes.classList.add('hidden')
            } else {
                information.classList.add('hidden')
                recipes.classList.remove('hidden')
            }
        }
    })
})

btnEditDetail.addEventListener('click', e => {
    e.preventDefault();
    // If edit details is clicked, it will open the input fields, change "Edit Details" to "Save Details,"
    // and remove the other button
    if (btnEditDetail.classList.contains('edit')) {
        btnEditDetail.classList.replace('edit', 'save')
        btnEditDetail.textContent = 'Save Details'
        btnEditDetail.type = "submit"
        btnChangePass.classList.add('hidden')
        confirmMsg.textContent = ""

        for (var i = 0; i < editDetails.length; i++) {
            editDetails[i].removeAttribute('readonly')
            editDetails[i].classList.add('border-b', 'border-LMtext1')
        }
    }
    // If save is clicked, it will close the input fields, change "Save Details" to "Edit Details,"
    // bring back the other buttons, and send the new information if successful.
    else {
        if (firstName.value.length == 0 || lastName.value.length == 0) {
            confirmMsg.textContent = "Names cannot be empty."
        }
        else if ((phoneNum.value.length == 0 || phoneNum.value.match(phoneVerify)) && !emailAdd.value.match(emailVerify)) {
            confirmMsg.textContent = "Email address is in wrong format."
        }
        else if (phoneNum.value.length != 0 && !phoneNum.value.match(phoneVerify) && emailAdd.value.match(emailVerify)) {
            confirmMsg.textContent = "Phone number is in wrong format."
        }
        else if (phoneNum.value.length != 0 && !phoneNum.value.match(phoneVerify) && !emailAdd.value.match(emailVerify)) {
            confirmMsg.textContent = "Email address and phone number are in wrong format."
        }
        else if (emailAdd.value == emailAdd.placeholder && phoneNum.value == phoneNum.placeholder &&
            firstName.value == firstName.placeholder && lastName.value == lastName.placeholder) {
            btnEditDetail.classList.replace("save", "edit")
            btnEditDetail.textContent = 'Edit Details'
            btnEditDetail.type = "button"
            btnChangePass.classList.remove('hidden')

            confirmMsg.textContent = "No changes made."

            for (var i = 0; i < editDetails.length; i++) {
                editDetails[i].setAttribute('readonly', 'readonly')
                editDetails[i].classList.remove('border-b', 'border-LMtext1')
            }
        }
        else {
            postRequest.onreadystatechange = function () {
                if (postRequest.readyState == 4 && postRequest.status == 200) {
                    confirmMsg.textContent = postRequest.responseText
                    if (postRequest.responseText.includes("saved")) {
                        btnEditDetail.classList.replace("save", "edit")
                        btnEditDetail.textContent = 'Edit Details'
                        btnEditDetail.type = "button"
                        btnChangePass.classList.remove('hidden')
                        emailAdd.placeholder = emailAdd.value
                        phoneNum.placeholder = phoneNum.value
                        firstName.placeholder = firstName.value
                        lastName.placeholder = lastName.value
                        helloName.innerHTML = `${firstName.value}`

                        for (var i = 0; i < editDetails.length; i++) {
                            editDetails[i].setAttribute('readonly', 'readonly')
                            editDetails[i].classList.remove('border-b', 'border-LMtext1')
                        }
                    }
                }
            }
            for (var i = 0; i < editDetails.length; i++) {
                params.push(editDetails[i].id + '=' + editDetails[i].value + '&')
            }

            postRequest.open('POST', url, true);
            postRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            var tostr = params.toString();
            postRequest.send(tostr.replaceAll(',', ''));
        }
    }
})

btnChangePass.addEventListener('click', e => {
    e.preventDefault();
    // If change password is clicked, it will open the input fields, change "Change Password" to "Save Password"
    // and remove the other buttons
    if (btnChangePass.classList.contains('change')) {
        btnChangePass.classList.replace("change", "savePW")
        btnChangePass.textContent = 'Save Password'
        btnChangePass.type = "submit"

        btnEditDetail.classList.add('hidden')
        detailsForm.classList.add('hidden')
        passForm.classList.remove('hidden')
        confirmMsg.textContent = ""
    }
    // If save is clicked, it will close the input fields, change "Save Password" to "Change Password,"
    // bring back the other buttons, and send the new information if successful.
    else {
        if (newPass.value != confirmPass.value) {
            confirmMsg.textContent = "Passwords do not match."
        } else if (!newPass.value.match(validPass) && !newPass.value == "") {
            confirmMsg.textContent = "Password must contain 1 letter, 1 number, and be between 8-20 characters."
        } else if (newPass.value == "" && confirmPass.value == "") {
            btnChangePass.classList.replace("savePW", "change")
            btnChangePass.textContent = 'Change Password'
            btnChangePass.type = "button"

            btnEditDetail.classList.remove('hidden')
            passForm.classList.add('hidden')
            detailsForm.classList.remove('hidden')
        } else {
            var postRequest = new XMLHttpRequest();
            var url = 'php/_accountDetails.php';

            postRequest.open('POST', url, true);

            postRequest.onreadystatechange = function () {
                if (postRequest.readyState == 4 && postRequest.status == 200) {
                    confirmMsg.textContent = postRequest.responseText
                    if (postRequest.responseText.includes("changed")) {
                        btnChangePass.classList.replace("savePW", "change")
                        btnChangePass.textContent = 'Change Password'
                        btnChangePass.type = "button"

                        btnEditDetail.classList.remove('hidden')
                        passForm.classList.add('hidden')
                        detailsForm.classList.remove('hidden')
                        confirmMsg.textContent = "Password successfully changed."
                        passForm.reset();
                    }
                }
            }

            postRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            postRequest.send("password=" + currentPass.value + "&" + "newpass=" + newPass.value);
        }
    }
})

// Logs out the user
const logoutButton = document.getElementById('logout')

logoutButton.onclick = function () {
    var postRequest = new XMLHttpRequest();
    var url = './php/_account.php';
    sessionStorage.removeItem("userid")
    window.location = 'index'
    postRequest.open('POST', url, true);
    postRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    postRequest.send('logout')
}