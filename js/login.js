function validateLoginForm() {
    var username = document.forms["loginForm"]["username"].value;
    var password = document.forms["loginForm"]["password"].value;
    var valid = true;

    if (username === "") {
        document.getElementById("userlg").classList.add("error");
        document.getElementById("userError").textContent = "Vui lòng nhập tên đăng nhập";
        valid = false;
    } else {
        document.getElementById("userlg").classList.remove("error");
        document.getElementById("userError").textContent = "";
    }

    if (password === "") {
        document.getElementById("passlg").classList.add("error");
        document.getElementById("passError").textContent = "Vui lòng nhập mật khẩu";
        valid = false;
    } else {
        document.getElementById("passlg").classList.remove("error");
        document.getElementById("passError").textContent = "";
    }

    return valid;
}

function validateSignupForm() {
    var username = document.forms["signupForm"]["username"].value;
    var password = document.forms["signupForm"]["password"].value;
    var fname = document.forms["signupForm"]["fname"].value;
    var phoneNumber = document.forms["signupForm"]["phoneNumber"].value;
    var addr = document.forms["signupForm"]["addr"].value;
    var valid = true;

    if (username === "") {
        document.getElementById("user").classList.add("error");
        document.getElementById("signupUserError").textContent = "Vui lòng nhập tên đăng nhập";
        valid = false;
    } else {
        document.getElementById("user").classList.remove("error");
        document.getElementById("signupUserError").textContent = "";
    }

    if (password === "") {
        document.getElementById("pass").classList.add("error");
        document.getElementById("signupPassError").textContent = "Vui lòng nhập mật khẩu";
        valid = false;
    } else {
        document.getElementById("pass").classList.remove("error");
        document.getElementById("signupPassError").textContent = "";
    }

    if (fname === "") {
        document.getElementById("fname").classList.add("error");
        document.getElementById("fnameError").textContent = "Vui lòng nhập họ và tên";
        valid = false;
    } else {
        document.getElementById("fname").classList.remove("error");
        document.getElementById("fnameError").textContent = "";
    }
    if (addr === "") {
        document.getElementById("addr").classList.add("error");
        document.getElementById("addrError").textContent = "Vui lòng nhập địa chỉ";
        valid = false;
    } else {
        document.getElementById("addr").classList.remove("error");
        document.getElementById("addrError").textContent = "";
    }
    if (phoneNumber === "") {
        document.getElementById("phoneNumber").classList.add("error");
        document.getElementById("phoneError").textContent = "Vui lòng nhập số điện thoại";
        valid = false;
    } else {
        // Regular expression pattern for a valid phone number format
        var phoneRegex = /^0\d{9}$/;

        if (!phoneRegex.test(phoneNumber)) {
            document.getElementById("phoneNumber").classList.add("error");
            document.getElementById("phoneError").textContent = "Số điện thoại không hợp lệ";
            valid = false;
        } else {
            document.getElementById("phoneNumber").classList.remove("error");
            document.getElementById("phoneError").textContent = "";
        }
    }
  
    return valid;
}