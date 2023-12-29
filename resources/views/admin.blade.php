<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .login-form {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="login-form">
    <h2>Login</h2>
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
    </div>

    <button onclick="login()">Login</button>
</div>

<script>
    function login() {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;

        // You can perform AJAX request to handle login logic
        // For simplicity, we'll just log the values to the console
        console.log('Username:', username);
        console.log('Password:', password);
    }
</script>

</body>
</html>
