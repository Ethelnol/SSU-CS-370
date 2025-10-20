if (document.getElementById("submitLogin") == null && document.getElementById("submitSignup") == null) {
    // Session timeout config
    const SESSION_TIMEOUT =  5 * 60 * 1000; // ms
    let sessionTimer;

    function resetSessionTimer() {
        clearTimeout(sessionTimer);
        sessionTimer = setTimeout(forceLogout, SESSION_TIMEOUT);
    }

    function forceLogout() {
        window.location.href = 'logout.php?timeout=1';
    }

    document.addEventListener('mousemove', resetSessionTimer);
    document.addEventListener('keypress', resetSessionTimer);
    document.addEventListener('click', resetSessionTimer);
    document.addEventListener('scroll', resetSessionTimer);
    document.addEventListener('DOMContentLoaded', resetSessionTimer);
}




// *** Creating Login Page **************************************
const LoginPage = document.getElementById("loginPage");         // Gets login page wrapper

document.getElementById("userProfile").onclick = toggleLoginPage;       // Makes login page visible / invisible

const emailTextBox = document.getElementById("Email");        // Email text tag in login page

const passwordTextBox = document.getElementById("Password");        // password text tag in login page

let loginPressed = false;       // Holds true when user submits login information

// If the user has not logged in then this element exist otherwise it does not
if (document.getElementById("submitLogin") != null) {
    document.getElementById("submitLogin").addEventListener('click', function () {      // Event listener for login submit
        if ((emailTextBox.value != "") && ((passwordTextBox.value).length >= passwordTextBox.minLength)) {
            loginPressed = true;
        }
    });
}

//If when page loads the login form is opened it is closed
if (LoginPage.classList.contains('show')) {
    toggleLoginPage();
}

if (document.getElementById("submitSignUp") != null){
    document.getElementById("signUpButton").onclick = function(){
        document.loginForm.classList.toggle('hidden');
        document.signUpForm.classList.toggle('hidden');   

        // If login form is not visible
        if (document.loginForm.classList.contains('hidden')) {
            // The signUp form is visible so a different message is shown
            document.getElementById("signUpButton").innerHTML = 'Login';
            document.getElementById("signUpText").childNodes[0].nodeValue = 'Already have an account? ';
        } else {
            // The login form is visible so a different message is shown
            document.getElementById("signUpButton").innerHTML = 'SignUp';
            document.getElementById("signUpText").childNodes[0].nodeValue = 'Don\'t have an account? ';
        }
    }

    document.signUpForm.onsubmit = function(){
     document.signUpForm.cubeCount.value = outputCounter.innerHTML;         // Gets current counter value
     document.signUpForm.firstItemCount.value = itemIdArray[0].itemCount;   // Gets amount of item
     document.signUpForm.secondItemCount.value = itemIdArray[1].itemCount;  // Gets amount of item
     document.signUpForm.thirdCount.value = itemIdArray[2].itemCount;       // Gets amount of item
     document.signUpForm.fourthCount.value = itemIdArray[3].itemCount;      // Gets amount of item
     return true;   // Allows for normal submission protocol
 }
}



 function toggleLoginPage() {
    loginPressed = false;       // Rests flag when login menu is opened
    LoginPage.classList.toggle('hidden');   // Removes class to make it visible

    // Generates darker background
    const tempSpan = document.createElement('span');
    tempSpan.id = "tempSpan";
    document.getElementById("tempElements").appendChild(tempSpan);

    tempSpan.addEventListener("click", function (event) {
        // If login is visible 
        if (!LoginPage.classList.contains('hidden')) {
            // If submit was not clicked reset text fields
            if (!loginPressed && emailTextBox != null) {
                emailTextBox.value = "";
                passwordTextBox.value = "";
            }

            // If you click outside the menu then it is closed
            if (!LoginPage.contains(event.target) && event.target != document.getElementById("loginPage")) {
                LoginPage.classList.toggle('hidden');
                tempSpan.remove();    //Removes background element
            }
        }
    })
}
