<?php include "header.php"; ?>

<style>
    .contact-card {
        max-width: 600px;
        margin: 4rem auto;
        background: white;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
        border: 1px solid #f0f0f0;
        text-align: center;
    }

    .contact-header h2 {
        font-weight: 800;
        color: #1a1c20;
        margin-bottom: 10px;
    }

    .contact-header p {
        color: #6c757d;
        margin-bottom: 40px;
    }

    .info-list {
        text-align: left;
        display: inline-block;
        margin: 0 auto;
    }

    .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
        padding: 15px 20px;
        background: #f8f9fa;
        border-radius: 15px;
        transition: transform 0.2s ease;
        width: 100%;
        min-width: 320px;
    }

    .info-item:hover {
        transform: scale(1.02);
        background: #f1f3f5;
    }

    .info-icon {
        font-size: 1.5rem;
        margin-right: 20px;
        background: white;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.03);
    }

    .info-text h6 {
        margin-bottom: 2px;
        font-weight: 700;
        color: #38b000;
    }

    .info-text p {
        margin-bottom: 0;
        color: #495057;
        font-size: 0.95rem;
    }
</style>

<div class="container">
    <div class="contact-card">
        <div class="contact-header">
            <h2>Contact Us</h2>
        </div>

        <div class="info-list">
            <div class="info-item">
                <div class="info-icon">🏢</div>
                <div class="info-text">
                    <h6>Company</h6>
                    <p>Adatepe Technology</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">📍</div>
                <div class="info-text">
                    <h6>Location</h6>
                    <p>Maltepe / Istanbul / Turkey</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">📞</div>
                <div class="info-text">
                    <h6>Phone</h6>
                    <p>+90 555 555 55 55</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">📧</div>
                <div class="info-text">
                    <h6>Email</h6>
                    <p>info@adatepetechnology.com</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
