<?php 
include "header.php"; 
include "config.php";

$message = "";
$status = ""; // Mesajın rengini belirlemek için

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name       = $_POST["name"];
    $surname    = $_POST["surname"];
    $birth_date = $_POST["birth_date"];
    $username   = $_POST["username"];
    $password   = password_hash($_POST["password"], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("
            INSERT INTO users (name, surname, birth_date, username, password_hash)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$name, $surname, $birth_date, $username, $password]);
        $message = "Registration successful! You can now sign in.";
        $status = "success";
    } catch (PDOException $e) {
        $message = "This username is already taken.";
        $status = "error";
    }
}
?>

<style>
    .auth-card {
        max-width: 500px;
        margin: 2rem auto;
        background: white;
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        border: 1px solid #f0f0f0;
    }

    .auth-header h2 {
        font-weight: 800;
        color: #1a1c20;
        margin-bottom: 8px;
        text-align: center;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.85rem;
        color: #495057;
        margin-bottom: 5px;
    }

    .form-control {
        padding: 10px 15px;
        border-radius: 10px;
        border: 1px solid #dee2e6;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #38b000;
        box-shadow: 0 0 0 4px rgba(56, 176, 0, 0.1);
    }

    .btn-register {
        background: #1a1c20;
        color: white;
        padding: 12px;
        border-radius: 12px;
        font-weight: 600;
        width: 100%;
        border: none;
        margin-top: 20px;
        transition: 0.3s;
    }

    .btn-register:hover {
        background: #38b000;
        transform: translateY(-2px);
    }

    .alert-box {
        padding: 12px;
        border-radius: 10px;
        font-size: 0.9rem;
        margin-bottom: 20px;
        text-align: center;
        border: 1px solid;
    }

    .alert-success { background: #f0fff4; color: #2f855a; border-color: #c6f6d5; }
    .alert-error { background: #fff5f5; color: #e53e3e; border-color: #feb2b2; }

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
        <h2>Create Account</h2>
        <p class="text-center text-muted small mb-4">Join Salary Hub and track your career growth</p>
    </div>

    <?php if ($message): ?>
        <div class="alert-box <?= $status === 'success' ? 'alert-success' : 'alert-error' ?>">
            <?= $status === 'success' ? '✅' : '❌' ?> <?= $message ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">First Name</label>
                <input class="form-control" name="name" placeholder="John" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Last Name</label>
                <input class="form-control" name="surname" placeholder="Doe" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Birth Date</label>
            <input class="form-control" type="date" name="birth_date" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input class="form-control" name="username" placeholder="johndoe123" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input class="form-control" type="password" name="password" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn btn-register">Create Account</button>
    </form>

    <div class="auth-footer">
        Already have an account? <a href="signin.php">Sign In</a>
    </div>
</div>

<?php include "footer.php"; ?>
