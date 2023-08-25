<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <!-- Add your CSS and other meta tags here -->

    <script>
        function validateForm() {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;

            // Clear previous error messages
            document.getElementById('nameError').textContent = "";
            document.getElementById('emailError').textContent = "";
            document.getElementById('phoneError').textContent = "";
            
            var isValid = true;

            if (name== "") {
                document.getElementById('nameError').textContent = "Name is required";
                isValid = false;
            }

            if (email== "") {
                document.getElementById('emailError').textContent = "Email is required";
                isValid = false;
            } else {
                var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                if (!email.match(emailPattern)) {
                    document.getElementById('emailError').textContent = "Invalid Email format";
                    isValid = false;
                }
            }

            if (phone== "") {
                document.getElementById('phoneError').textContent = "Phone is required";
                isValid = false;
            }

            var phonePattern = /^[0-9]+$/;
            if (!phone.match(phonePattern)) {
                document.getElementById('phoneError').textContent = "Allows only numbers";
                isValid = false;
            }

            return isValid;
        }
    </script>
</head>
<body>
    <h1>Add User</h1>
    <div class="container">
        <form method="POST" onsubmit="return validateForm();">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                <div id="nameError" style="color: red;"></div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                <div id="emailError" style="color: red;"></div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" name="gender">Gender:</label>
                <div class="col-sm-6">
                    <input type="radio" name="gender" id="male" value="Male" checked><label for="male">Male</label>
                    <input type="radio" name="gender" id="female" value="Female"><label for="female">Female</label>
                    
                </div>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone Number">
                <div id="phoneError" style="color: red;"></div>
            </div>
            <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="Submit">
        </form>
    </div>
</body>
</html>