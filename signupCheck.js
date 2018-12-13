// Client side validates sign up form

function validate(form) {
    alert("adf")
    fail = ""

    fail += checkFirstName(form.username.value)
    fail += checkLastName(form.password.value)
    fail += checkUserName(form.username.value)
    fail += checkPassword(form.passord.value)
    //fail += checkEmail(form.email.value)

    if(fail == "")
        return true;
    else {
        alert(fail)
        return false
    }
}

function checkFirstName(first) {
    if(first == "")
        return "First name cannot be empty\n"
    else if(/[^\s+$]/.test(first))
        return "First name cannot be empty spaces\n"
    else if(/[^a-zA-Z.]/.test(first))
        return "First name can only have characters \"a-z\", \"A-Z\" and \".\"\n";
    else
        return ""    
}

function checkLastName(last) {
    if(last == "")
        return "Last name cannot be empty\n"
    else if(/[^\s+$]/.test(last))
        return "Last name cannot be empty spaces\n"
    else if(/[^a-zA-Z.]/.test(last))
        return "Last name can only have characters \"a-z\", \"A-Z\" and \".\"\n";
    else
        return ""  
}

function checkUserName(username) {
    if(username == "")
        return "User name cannot be empty\n"
    else if(/[^\s+$]/.test(username))
        return "User name cannot be empty spaces\n"
    else if(/[^\w-_.]/.test(usernae))
        return "User name can only have characters \"a-z\", \"A-Z\", \"0-9\", \"-\", \"_\" or \".\"\n";
    else
        return ""  
}

function checkPassword(password) {
    var minLength = 5
    var maxLength = 12

    if(password == "")
        return "Password name cannot be empty\n"
    else if(/[^\s+$]/.test(password))
        return "Passsword cannot be empty spaces\n"
    else if (password.length < minLength)
        return "Password must be at least " + minLength + " characters long\n";
    else if(password.length < maxLength && /[^\W] /.test(passord))
        return "Passwords less than " + maxLength + " must contain a non-alphanumeric character\n"  
    else
        return ""  
}

function checkEmail(email) {
    if(email == "")
        return "Email cannot be empty\n"
    else if(/[^\s+$]/.test(email))
        return "Email cannot be empty spaces\n"
    else if(!/[\w-_.]+@[\w-_.]+\.[\w]+/.test(email))
        return "Email must be in the format first@second.third\n"
    else
        return ""  
}