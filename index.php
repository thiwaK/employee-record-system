

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Employee Record System - NRMC</title>
  <meta name="description" content="Employee Record System - NRMC">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="/favicon.ico">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link
	href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
	rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="/ERS/css/bootstrap.min.css">
  <link href="/ERS/css/font-awesome.min.css" type="text/css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

  <link href="/ERS/css/theme.css" rel="stylesheet" id="style-default">
  <link rel="stylesheet" type="text/css" href="/ERS/css/style.css" />

  <script src="/ERS/js/jquery.slim.min.js"></script>
  <script src="/ERS/js/bootstrap.bundle.min.js"></script>

  <style>
    html, body, .container, .row {
      height: 100%;
    }

    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      background-image: url('images/bg1.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background-color: rgba(255, 255, 255, 0.55); /* Set opacity to 0.5 */
    }

    .card-img-top {
      max-width: 250px;
      max-height: 250px;
      min-width: 200px;
      min-height: 200px;
    }

    .card {
      background-color: rgba(255, 255, 255, 0.8);
    }
    .card-body {
      margin: 25px;
    }
    

  </style>

</head>

<body>
  <div class="overlay"></div>

  <div class="container justify-content-center align-items-center">
	  <div class="row justify-content-center align-items-center">
	    <div class="col-4"></div>
	    <div class="col-4 card">
        <div class="row justify-content-center mb-0 mt-4">
          <div class="col-auto">
            <img class="card-img-top" src="images/agri_logo.png" alt="Institute Logo">
          </div>
          <!-- <div class="col-auto">
            <img class="card-img-top" src="images/logo.png" alt="Institute Logo">
          </div> -->
        </div>
        <div class="card-body">
          <p class="card-title text-center mb-3 ml-2 mr-2">Employee Record System</p>
          <h5 class="card-title text-center mb-5">Natural Resources Management Center</h5>
          <div id="errorMessage" class="text-center mt-3 mb-4"></div>
          <form id="loginForm" class="form" method="post" action="/ERS/dashboard/login.php" novalidate>
            
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user-circle-o fa-fw"></i></span>
                </div>
                <label for="username" class="sr-only">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                <div class="invalid-feedback">Please enter your username.</div>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-key fa-fw"></i></span>
                </div>
                <label for="password" class="sr-only">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password"
                required>
                <div class="invalid-feedback">Please enter your password.</div>
              </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-lock mr-2"></i>Login</button>
            </div>
          </form>
          <div class="text-center mt-3 mb-4">
            <!-- <a href="#">Forgot password?</a> -->
          </div>
        </div>
	    </div>
	    <div class="col-4"></div>
	  </div>
  </div>



  <script>
    document.getElementById("loginForm").addEventListener("submit", function(event) {
       
      event.preventDefault();
        var formData = new FormData(this);

        fetch("/ERS/dashboard/login.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {

            var errorMessageContainer = document.getElementById("errorMessage");
            if (data.response === 100) {
                // errorMessageContainer.innerHTML = "<div class='alert alert-success' role='alert'>Login Success</div>";
                // fadeIn(errorMessageContainer);
                // setTimeout(function() {
                //     fadeOut(errorMessageContainer);
                // }, 3000);
                window.location.href = "/ERS/dashboard/index.php";
            } else {

                errorMessageContainer.innerHTML = "<div class='alert alert-danger' role='alert'>" + data.response + "</div>";
                fadeIn(errorMessageContainer);
                setTimeout(function() {
                    fadeOut(errorMessageContainer);
                }, 3000);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            var errorMessageContainer = document.getElementById("errorMessage");
            errorMessageContainer.innerHTML = "<div class='alert alert-danger' role='alert'>An error occurred. Please try again later.</div>";
            fadeIn(errorMessageContainer);
            setTimeout(function() {
                fadeOut(errorMessageContainer);
            }, 2500);
        });
    });

    function fadeIn(element) {
        element.classList.remove("fade-out", "hide");
        element.classList.add("fade-in", "show");
    }

    function fadeOut(element) {
        element.classList.remove("fade-in", "show");
        element.classList.add("fade-out", "hide");

        element.addEventListener('transitionend', function() {
            while (element.firstChild) {
                element.removeChild(element.firstChild);
            }
        }, { once: true });
    }
</script>




  <?php //include ("./inc/footer.php"); ?>