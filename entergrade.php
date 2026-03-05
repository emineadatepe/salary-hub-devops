<?php 
include "header.php"; 
include "auth.php"; // auth.php içinde zaten config.php/pdo olduğunu varsayıyorum

$success_msg = false;

// Job’ları çek
$jobs = $pdo->query("SELECT * FROM jobs")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_id  = $_POST["job_id"];
    $salary  = $_POST["salary"];
    $user_id = $_SESSION["user_id"];

    $stmt = $pdo->prepare("
        INSERT INTO salaries (user_id, job_id, salary)
        VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE salary = VALUES(salary)
    ");
    
    if($stmt->execute([$user_id, $job_id, $salary])) {
        $success_msg = true;
    }
}
?>

<style>
    .salary-card {
        max-width: 500px;
        margin: 2rem auto;
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        border: 1px solid #eee;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        padding: 12px 15px;
        border-radius: 10px;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #38b000;
        box-shadow: 0 0 0 0.25rem rgba(56, 176, 0, 0.1);
    }

    .btn-save {
        background-color: #1a1c20;
        color: white;
        padding: 12px;
        border-radius: 10px;
        font-weight: 600;
        width: 100%;
        border: none;
        margin-top: 10px;
        transition: background 0.3s;
    }

    .btn-save:hover {
        background-color: #38b000;
        color: white;
    }

    .alert-custom {
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 25px;
        border: none;
        background-color: #d2f4ea;
        color: #0f5132;
    }
</style>

<div class="salary-card">
    <div class="text-center mb-4">
        <h3 class="fw-bold">Update Salary</h3>
        <p class="text-muted small">Select your job and enter your current net salary.</p>
    </div>

    <?php if ($success_msg): ?>
        <div class="alert alert-custom text-center animate__animated animate__fadeIn" role="alert">
            ✅ Salary updated successfully!
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-4">
            <label class="form-label">Job Title</label>
            <select class="form-select" name="job_id" required>
                <option value="" selected disabled>Choose your job...</option>
                <?php foreach ($jobs as $j): ?>
                    <option value="<?= $j["id"] ?>">
                        <?= htmlspecialchars($j["name"]) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label for="salary" class="form-label">Monthly Net Salary (₺)</label>
            <div class="input-group">
                <span class="input-group-text bg-light">₺</span>
                <input type="number" 
                       class="form-control" 
                       name="salary" 
                       placeholder="e.g. 45000"
                       min="0" 
                       step="0.01" 
                       required>
            </div>
        </div>

        <button type="submit" class="btn btn-save">Save Changes</button>
    </form>

    <div class="mt-4 text-center">
        <a href="result.php" class="text-decoration-none small fw-bold" style="color: #38b000;">
            ← View My Results
        </a>
    </div>
</div>

<?php include "footer.php"; ?>
