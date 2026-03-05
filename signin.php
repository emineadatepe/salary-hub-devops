<?php 
include "header.php"; 
include "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password_hash"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        header("Location: index.php"); // Ana sayfaya veya entersalary.php'ye yönlendir
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<style>
    .auth-card {
        max-width: 400px;
        margin: 4rem auto;
        background: white;
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        border: 1px solid #f0f0f0;
    }

    .auth-header h2 {
        font-weight: 800;
        color: #1a1c20;
        margin-bottom: 10px;
        text-align: center;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.9rem;
        color: #495057;
    }

    .form-control {
        padding: 12px 15px;
        border-radius: 12px;
        border: 1px solid #dee2e6;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #38b000;
        box-shadow: 0 0 0 4px rgba(56, 176, 0, 0.1);
    }

    .btn-login {
        background: #1a1c20;
        color: white;
        padding: 12px;
        border-radius: 12px;
        font-weight: 600;
        width: 100%;
        border: none;
        margin-top: 10px;
        transition: 0.3s;
    }

    .btn-login:hover {
        background: #38b000;
        transform: translateY(-2px);
    }

    .error-box {
        background: #fff5f5;
        color: #e53e3e;
        padding: 12px;
        border-radius: 10px;
        font-size: 0.85rem;
        margin-bottom: 20px;
        border: 1px solid #feb2b2;
        text-align: center;
    }

    .auth-footer {
        text-align: center;
        margin-top: 25px;
        font-size: 0.9rem;
        color: #6c757d;
    }

    .auth-footer a {
        color: #38b000;
        text-decoration: none;
        font-weight: 600;
    }
</style>

<div class="auth-card">
    <div class="auth-header">
        <h2>Welcome Back</h2>
        <p class="text-center text-muted small mb-4">Please enter your details to sign in</p>
    </div>

    <?php if ($error): ?>
        <div class="error-box animate__animated animate__shakeX">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input class="form-control" name="username" placeholder="Enter your username" required>
        </div>
        
        <div class="mb-4">
            <label class="form-label">Password</label>
            <input class="form-control" type="password" name="password" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn btn-login">Sign In</button>
    </form>

    <div class="auth-footer">
        Don't have an account? <a href="signup.php">Create one</a>
    </div>
</div>

<?php include "footer.php"; ?>
