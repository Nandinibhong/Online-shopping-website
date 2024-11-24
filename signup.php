<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="signup.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</head>

<body>
    <div class="background">
        <fieldset>
            <div class="whitebg">
                <h1>Sign Up</h1>
                <p>Enter your details...!!!</p> <br>
                <form id="signupForm" method="post">
                    <div class="icon">
                        <h4> Enter Username :</h4><i class="fas fa-user user-icon"></i>
                        <input type="text" name="username" id="username" required>
                        <h4> Enter Email :</h4><i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="email" required>
                        <h4> Enter Password :</h4><i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" required>
                        <h4> Repeat Password :</h4><i class="fas fa-lock"></i>
                        <input type="password" name="repeat_password" id="repeat_password" required>
                        <h4> Enter Address :</h4><i class="fas fa-map-marker-alt"></i>
                        <input type="text" name="address" id="address" required>
                        <h4> Enter your mobile number :</h4><i class="fas fa-mobile-alt"></i>
                        <input type="number" name="Mnumber" id="Mnumber" required>
                    </div>
                    <button type="submit" class="button-28" role="button">Submit</button>
                </form>
            </div>
        </fieldset>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#signupForm').on('submit', function (e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: 'loginBackend.php',
                    data: formData,
                    success: function (response) {
                        alert('Sign Up Successful!');
                        console.log(response);
                    },
                    error: function () {
                        alert('Error in sign up.');
                    }
                });
            });
        });
    </script>
</body>

</html>