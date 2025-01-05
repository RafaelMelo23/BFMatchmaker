        function validateForm() {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            if (email === "") {
                alert("Email cannot be empty.");
                return false;
            }
            if (password === "") {
                alert("Password cannot be empty.");
                return false;
            }
            return true;
        }
