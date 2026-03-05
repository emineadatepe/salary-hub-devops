<?php 
// 1. ADIM: PHP mantığını ve oturum yönetimini en başa alıyoruz.
include "config.php";
session_start(); // Eğer config.php içinde yoksa mutlaka ekle

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Veritabanı işlemleri
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password_hash"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        
        // 2. ADIM: Hiçbir HTML çıktısı (header.php gibi) verilmeden yönlendirme yapıyoruz.
        header("Location: index.php"); 
        exit;
    } else {
        $error = "Invalid username or password";
    }
}

// 3. ADIM: HTML çıktılarını (header.php) yönlendirme ihtimali bittikten sonra dahil ediyoruz.
include "header.php"; 
?>

<style>
    /* CSS kodların aynen kalabilir */
    .auth-card {
        max-width: 400px;
        margin: 4rem auto;
        background: white;
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        border: 1px solid #f0f0f0;
    }
    /* ... diğer stiller ... */
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