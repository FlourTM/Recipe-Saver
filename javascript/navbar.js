//  Uses a GET PHP function to grab the 'navbar.php' file and place it in every page
function includeHTML() {
    var doc = document.getElementById('nav-ph')
    var grab = doc.getAttribute('w3-include-html')
    if (grab) {
        var http = new XMLHttpRequest();
        http.onreadystatechange = function () {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    doc.innerHTML = this.responseText;
                }
                if (this.status == 404) {
                    doc.innerHTML = "Page not found.";
                }
                doc.removeAttribute('w3-include-html')
                includeHTML();
            }
        }
        http.open('GET', grab, true)
        http.send()
        return;
    }

    // This section handles adding the active class to the active page
    const loginRegisterOverlay = document.getElementById('loginRegisterOverlay')
    var navbtns = document.querySelectorAll('.nav-item')
    navbtns.forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            if (btn.id != "acc") {
                window.location = btn.id
            } else {
                var loggedIn = sessionStorage.getItem('userid')
                if (loggedIn) {
                    // If logged in, directs to account page.
                    window.location = 'account'
                } else {
                    // If not logged in, displays the login/register popup.
                    loginRegisterOverlay.classList.remove('hidden')
                }
            }
        })
    })

    // This section handles the login and register forms
    const loginForm = document.getElementById('login'),
        registerForm = document.getElementById('register'),
        loginBtn = document.getElementById('loginBtn'),
        registerBtn = document.getElementById('registerBtn'),
        loginToReg = document.getElementById('loginToReg'),
        regToLogin = document.getElementById('regToLogin'),
        confirmMsg = document.getElementById('confirm-msg'),
        pwShowHide = document.querySelectorAll('.eyeIcon'),
        pwFields = document.querySelectorAll('.pwFields'),
        closeBtn = document.getElementById('close')

    var emailVerify = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var validPass = /^(?=.*\d)(?=.*[a-z]).{8,20}$/;
    var lemail = document.getElementById('lemail'),
        lpass = document.getElementById('lpass'),
        rfirstName = document.getElementById('rfirstName'),
        rlastName = document.getElementById('rlastName'),
        remail = document.getElementById('remail'),
        rpass = document.getElementById('rpass'),
        rconfirm = document.getElementById('rconfirm'),
        header = document.getElementById('header')

    // Function to handle changing password icons
    function changeText(icon) {
        pwFields.forEach(pwField => {
            if (pwField.type === "password" && pwField.className.match(icon.classList[2])) {
                pwField.type = "text";
                icon.innerHTML = "visibility";
            } else if (pwField.type === "text" && pwField.className.match(icon.classList[2])) {
                pwField.type = "password";
                icon.innerHTML = "visibility_off";
            }
        });
    }

    // Looping through each eye icon and creating an event listener
    pwShowHide.forEach(eyeIcon => {
        eyeIcon.addEventListener("click", () => {
            changeText(eyeIcon)
        })
    })

    // Allows for the user to click the close button on the login/register forms
    closeBtn.addEventListener('click', e => {
        loginRegisterOverlay.classList.add('hidden')
    })

    // If the user clicks off the login/register forms, it will hide the popup
    window.onclick = function (offOverlay) {
        if (offOverlay.target.id === 'loginRegisterOverlay'){
            offOverlay.target.classList.add('hidden')
        }
    }

    // Changes to the register form if the user clicks "Register here"
    loginToReg.addEventListener('click', e => {
        loginForm.classList.add('hidden')
        registerForm.classList.remove('hidden')
        header.textContent = 'Register'
        confirmMsg.textContent = ""
    })

    // Changes to the login form if the user clicks "Log in now"
    regToLogin.addEventListener('click', e => {
        registerForm.classList.add('hidden')
        loginForm.classList.remove('hidden')
        header.textContent = 'Login'
        confirmMsg.textContent = ""
    })

    // Verifies that the user is registering with correct email and password formats
    registerBtn.addEventListener('click', e => {
        var postRequest = new XMLHttpRequest()
        var url = './php/_account.php'
        var data = []
        e.preventDefault();
        if (rfirstName.value == "" || rlastName.value == "" || remail.value == "" || rpass.value == "") {
            confirmMsg.textContent = "Please enter in all fields."
        } else if (!remail.value.match(emailVerify)) {
            confirmMsg.textContent = "Email address is in wrong format."
        } else if (remail.value.match(emailVerify) && !rpass.value.match(validPass)) {
            confirmMsg.textContent = "Password must contain 1 letter, 1 number, and be between 8-20 characters."
        } else if (remail.value.match(emailVerify) && rpass.value.match(validPass) && (rpass.value != rconfirm.value)) {
            confirmMsg.textContent = "Passwords do not match."
        } else {
            for (var i = 0; i < pwFields.length; i++) {
                if (pwFields[i].parentElement.id == "register" || pwFields[i].parentElement.parentElement.id == "register" ||
                    pwFields[i].parentElement.parentElement.parentElement.id == "register") {
                    data.push(pwFields[i].name + '=' + pwFields[i].value + "&")
                }
            }
            postRequest.onreadystatechange = function () {
                if (postRequest.readyState == 4 && postRequest.status == 200) {
                    if (postRequest.responseText.includes("successful")) {
                        registerForm.classList.add('hidden')
                        loginForm.classList.remove('hidden')
                        header.textContent = 'Login'
                    }
                    confirmMsg.textContent = postRequest.responseText
                }
            }

            var tostr = data.toString();
            var slice = tostr.slice(0, -1)
            postRequest.open('POST', url, true)
            postRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            postRequest.send(slice.replaceAll(',', ''))
        }
    })

    // Verifies that the user is logging in with correct email and password formats
    loginBtn.addEventListener('click', e => {
        e.preventDefault();
        if (lemail.value == "" || lpass.value == "") {
            confirmMsg.textContent = "Please enter in all fields."
        } else {

            if (!lemail.value.match(emailVerify)) {
                confirmMsg.textContent = "Please enter a valid email address."
            } else {
                var postRequest = new XMLHttpRequest()
                var url = './php/_account.php'
                var data = []

                for (var i = 0; i < pwFields.length; i++) {
                    if (pwFields[i].parentElement.id == "login" || pwFields[i].parentElement.parentElement.id == "login") {
                        data.push(pwFields[i].name + '=' + pwFields[i].value + "&")
                    }
                }
                postRequest.onreadystatechange = function () {
                    if (postRequest.readyState == 4 && postRequest.status == 200) {
                        if (postRequest.responseText == "login_succ") {
                            sessionStorage.setItem("userid", 'loggedin')
                            confirmMsg.innerHTML = 'Login Successful!'
                            location.reload()
                        } else {
                            confirmMsg.innerHTML = postRequest.responseText
                        }
                    }
                }
            }

            var tostr = data.toString();
            var slice = tostr.slice(0, -1)

            postRequest.open('POST', url, true)
            postRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            postRequest.send(slice.replaceAll(',', ''))
        }
    })
}

includeHTML();