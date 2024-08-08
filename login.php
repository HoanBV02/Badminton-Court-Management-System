<!DOCTYPE html>
<html>
<head>
  <title>Badminton booking</title>
  
  <!-- Import CSS -->
  <link rel="stylesheet" type="text/css" href="css/login.css">
  
  <style>
    /* Your additional styles here */
    .error-message {
      font-size: smaller;
      color: red;
      margin-top: 5px;
    }
    
    .input.error {
      border-color: red;
    }
  </style>
</head>
<body>
  <div class="login-wrap">
    <div class="login-html">
      <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Đăng nhập</label>
      <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Đăng kí</label>
      <div class="login-form">
        <form id="loginForm" action="action\login_action.php" method="POST" onsubmit="return validateLoginForm()">
          <div class="sign-in-htm">
            <div class="group">
              <label for="userlg" class="label">Tên đăng nhập</label>
              <input id="userlg" type="text" class="input" name="username">
              <span id="userError" class="error-message"></span>
            </div>
            <div class="group">
              <label for="passlg" class="label">Mật khẩu</label>
              <input id="passlg" type="password" class="input" data-type="password" name="password">
              <span id="passError" class="error-message"></span>
            </div>
            <div class="group">
              <input type="submit" class="button" name="login" value="Đăng nhập">
            </div>
            <div class="hr"></div>
          </div>
        </form>
        <form id="signupForm" action="action/register_action.php" method="POST" onsubmit="return validateSignupForm()">
          <div class="sign-up-htm">
            <div class="group">
              <label for="user" class="label">Tên đăng nhập</label>
              <input id="user" type="text" class="input" name="username">
              <span id="signupUserError" class="error-message"></span>
            </div>
            <div class="group">
              <label for="pass" class="label">Mật khẩu</label>
              <input id="pass" type="password" class="input" data-type="password" name="password">
              <span id="signupPassError" class="error-message"></span>
            </div>
            <div class="group">
              <label for="name" class="label">Họ và tên</label>
              <input id="fname" type="text" class="input" name="fname">
              <span id="fnameError" class="error-message"></span>
            </div>
            <div class="group">
              <label for="phoneNumber" class="label">Số điện thoại</label>
              <input id="phoneNumber" type="text" class="input" name="phoneNumber">
              <span id="phoneError" class="error-message"></span>
            </div>
            <div class="group">
    <label for="addr" class="label">Địa chỉ</label>
    <input id="addr" type="text" class="input" name="addr">
    <span id="addrError" class="error-message"></span>
</div>

<br>
            <div class="group">
              <input type="submit" class="button" value="Đăng kí" name ="register">
            </div>
            <div class="hr"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="js/login.js"></script>
</body>
</html>