<?php include "header.php"; ?>
<?php include "config.php"; ?>

<style>
    /* Hero bölümünü dikeyde ortalamak için */
    .hero-wrapper {
        min-height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-section {
        background: white;
        padding: 60px 40px;
        border-radius: 32px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
        text-align: center;
        width: 100%;
        border: 1px solid rgba(0,0,0,0.02);
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        /* Renk geçişi efekti */
        background: linear-gradient(45deg, #1a1c20, #38b000);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 2rem;
        letter-spacing: -1px;
    }

    .cta-buttons .btn {
        padding: 14px 35px;
        font-weight: 700;
        border-radius: 14px;
        margin: 10px;
        transition: all 0.3s ease;
        font-size: 1.1rem;
    }

    /* Ana Aksiyon Butonu (Yeşil) */
    .btn-main {
        background-color: #38b000;
        color: white;
        border: none;
    }

    .btn-main:hover {
        background-color: #2d8a00;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(56, 176, 0, 0.2);
    }

    /* İkincil Buton (Koyu/Outline) */
    .btn-outline-custom {
        background-color: transparent;
        border: 2px solid #1a1c20;
        color: #1a1c20;
    }

    .btn-outline-custom:hover {
        background-color: #1a1c20;
        color: white;
        transform: translateY(-3px);
    }
</style>

<div class="container hero-wrapper">
    <div class="row justify-content-center w-100">
        <div class="col-lg-10">
            <div class="hero-section">
                <h1 class="hero-title">Welcome to MY Salary Hub System</h1>
                
                <div class="cta-buttons">
                    <?php if (!isset($_SESSION["user_id"])): ?>
                        <a href="signin.php" class="btn btn-main">Sign In Now</a>
                        <a href="signup.php" class="btn btn-outline-custom">Create Account</a>
                    <?php else: ?>
                        <a href="entergrade.php" class="btn btn-main">Enter New Data</a>
                        <a href="result.php" class="btn btn-outline-custom">View My Results</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
