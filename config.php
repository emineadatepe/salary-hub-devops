<?php
// Render üzerindeki Environment Variable'lardan (Ortam Değişkenleri) bilgileri alıyoruz
// Eğer bulutta değilsek (yereldeysek) varsayılan değerleri kullanır
$host = getenv('DB_HOST') ?: 'dpg-d6kdrbma2pns738sdfdg-a'; 
$db   = getenv('DB_NAME') ?: 'salary_db_85cc';
$user = getenv('DB_USER') ?: 'salary_db_85cc_user';
$port = getenv('DB_PORT') ?: '5432';
// Şifre için Render panelindeki "Password" kısmındaki göz simgesine tıklayıp kopyaladığın şifreyi buraya yazmalısın
$pass = getenv('DB_PASS') ?: '8zFVHE8yRnQvUEGoCfcgo42iF3A5wQTI'; 

try {
    // PostgreSQL bağlantı dizisi (DSN)
    $dsn = "pgsql:host=$host;port=$port;dbname=$db";
    
    // PDO bağlantısını kuruyoruz
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    
    // Bağlantı başarılı!
} catch (PDOException $e) {
    // Hata oluşursa ekrana basar
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}
?>