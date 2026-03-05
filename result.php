<?php 
include "header.php"; 
include "auth.php"; 

$user_id = $_SESSION["user_id"];

// 1. Kullanıcının maaş verilerini ve ilgili mesleklerin genel ortalamasını çek
$results = $pdo->prepare("
    SELECT j.name, s.salary,
           (SELECT AVG(salary) FROM salaries WHERE job_id = j.id) AS job_avg
    FROM salaries s
    JOIN jobs j ON s.job_id = j.id
    WHERE s.user_id = ?
");
$results->execute([$user_id]);
$data = $results->fetchAll();

// 2. SADECE senin girdiğin maaşların ortalamasını hesapla
$user_avg_query = $pdo->prepare("SELECT AVG(salary) FROM salaries WHERE user_id = ?");
$user_avg_query->execute([$user_id]);
$my_average = $user_avg_query->fetchColumn();
?>

<style>
    .results-container {
        max-width: 900px;
        margin: 2rem auto;
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        border: 1px solid #f0f0f0;
        height: 100%;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 800;
        color: #38b000;
        margin: 10px 0;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .custom-table-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border: none;
        margin-top: 2rem;
    }

    .table { margin-bottom: 0; }
    .table thead { background-color: #1a1c20; color: white; }
    .table thead th { padding: 15px 20px; font-weight: 500; border: none; }
    .table tbody td { padding: 15px 20px; vertical-align: middle; }

    .badge-salary {
        background: rgba(56, 176, 0, 0.1);
        color: #38b000;
        font-weight: 700;
        padding: 8px 12px;
        border-radius: 8px;
    }
</style>

<div class="results-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Analysis Results</h2>
        <a href="entergrade.php" class="btn btn-outline-dark btn-sm rounded-pill px-3">
            + Update Data
        </a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="stat-card" style="border-top: 4px solid #38b000;">
                <div class="stat-label">Your Salary Average</div>
                <div class="stat-value">₺<?= number_format($my_average ?? 0, 2, ',', '.') ?></div>
                <p class="text-muted small mb-0">Based on your personal entries</p>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="stat-card" style="border-top: 4px solid #1a1c20;">
                <div class="stat-label">Total Jobs Entered</div>
                <div class="stat-value"><?= count($data) ?></div>
                <p class="text-muted small mb-0">Number of positions recorded</p>
            </div>
        </div>
    </div>

    <div class="custom-table-card">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Your Monthly Net</th>
                        <th>Market Average</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data)): ?>
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                No data found. <a href="entergrade.php">Click here to enter your salary.</a>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($data as $row): ?>
                            <tr>
                                <td class="fw-bold text-dark"><?= htmlspecialchars($row["name"]) ?></td>
                                <td><span class="badge-salary">₺<?= number_format($row["salary"], 2, ',', '.') ?></span></td>
                                <td class="text-secondary">₺<?= number_format($row["job_avg"], 2, ',', '.') ?></td>
                                <td>
                                    <?php if ($row["salary"] >= $row["job_avg"]): ?>
                                        <span class="text-success small fw-bold">▲ Above Market</span>
                                    <?php else: ?>
                                        <span class="text-danger small fw-bold">▼ Below Market</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
