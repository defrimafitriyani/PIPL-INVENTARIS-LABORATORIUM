<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Inventaris Lab</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .signup-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .signup-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #555;
            text-align: center;
        }

        .signup-container label {
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
            color: #666;
        }

        .signup-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .signup-container input:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 5px rgba(59, 130, 246, 0.5);
        }

        .signup-container button {
            width: 100%;
            padding: 10px;
            background-color: #3b82f6;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .signup-container button:hover {
            background-color: #2563eb;
        }

        .signup-container .error {
            color: red;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
        }

        .signup-container .success {
            color: green;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Signup</h2>
        <?php if (validation_errors()): ?>
            <p class="error"><?php echo validation_errors(); ?></p>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <p class="error"><?php echo $this->session->flashdata('error'); ?></p>
        <?php endif; ?>
        <?php if ($this->session->flashdata('success')): ?>
            <p class="success"><?php echo $this->session->flashdata('success'); ?></p>
        <?php endif; ?>
        <form method="post" action="<?php echo base_url('auth/signup_action'); ?>">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Masukkan username" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            
            <label for="password_confirm">Konfirmasi Password</label>
            <input type="password" id="password_confirm" name="password_confirm" placeholder="Konfirmasi password" required>
            
            <button type="submit">Signup</button>
        </form>
        <p style="text-align: center; margin-top: 10px;">Sudah punya akun? <a href="<?php echo base_url('auth/login'); ?>">Login</a></p>
    </div>
</body>
</html>
