<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Hub System</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-custom {
            background-color: #1a1c20; /* Daha modern, derin koyu gri */
            padding: 15px 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }

        .nav-btn {
            color: #e0e0e0 !important;
            padding: 8px 18px;
            border-radius: 8px;
            margin-left: 5px;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-block;
        }

        .nav-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff !important;
            transform: translateY(-2px);
        }

        /* Aktif veya Öne Çıkan Buton (Giriş Yap/Kaydol gibi) */
        .nav-btn-primary {
            background-color: #38b000; /* Canlı yeşil */
            color: white !important;
            border: none;
        }

        .nav-btn-primary:hover {
            background-color: #70e000;
            transform: translateY(-2px);
        }

        .nav-btn-danger {
            border: 1px solid #ff4d4d;
            color: #ff4d4d !important;
        }

        .nav-btn-danger:hover {
            background-color: #ff4d4d;
            color: white !important;
        }

        .user-badge {
            background: rgba(255, 193, 7, 0.15);
            color: #ffc107;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom sticky-top mb-5">
    <div class="container">
        <a class="navbar-brand text-white fw-bold" href="index.php">
            <span style="color: #38b000;">Salary</span>Hub
        </a>
        
        <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="ms-auto d-flex align-items-center flex-wrap">
                <a class="nav-btn" href="index.php">Home</a>

                <?php if (isset($_SESSION["user_id"])): ?>
                    <a class="nav-btn" href="entergrade.php">Enter Salary</a>
                    <a class="nav-btn" href="result.php">Results</a>
                    <a class="nav-btn" href="contact.php">Contact</a>
                    
                    <div class="ms-lg-3 my-2 my-lg-0 user-badge fw-bold">
                        Hi, <?= htmlspecialchars($_SESSION["username"]) ?>
                    </div>

                    <a class="nav-btn nav-btn-danger ms-lg-2" href="logout.php">Logout</a>
                <?php else: ?>
                    <a class="nav-btn" href="contact.php">Contact</a>
                    <a class="nav-btn" href="signin.php">Sign-in</a>
                    <a class="nav-btn nav-btn-primary ms-lg-2" href="signup.php">Sign-up</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<div class="container pb-5">
