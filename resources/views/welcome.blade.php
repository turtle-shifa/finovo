<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>finovo</title>

<link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  body {
    margin: 0;
    font-family: 'Kumbh Sans', sans-serif;
    background-color: #f8f8f8;
    color: #111;
  }


  .hero {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    text-align: center;
    padding: 120px 20px 60px 20px;
    gap: 20px;
  }

  .hero h1 {
    font-size: 3.5rem;
    font-weight: 600;
    line-height: 1.2;
    max-width: 550px;
    margin: 0;
  }

  .hero p {
    font-size: 1.25rem;
    margin: 0 0 10px 0; 
    max-width: 700px;
  }

  .btn-get-started {
    background-color: #C8EE44;
    color: #111;
    border: none;
    padding: 15px 40px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: transform 0.2s;
  }

  .btn-get-started:hover {
    transform: scale(1.05);
  }

  .hero img {
    max-width: 900px;
    width: 100%;
    border-radius: 15px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    margin-top: 20px;
  }

  @media(max-width: 900px) {
    .hero h1 {
      font-size: 2.5rem;
      max-width: 90%;
    }
    .hero img {
      max-width: 90%;
    }
  }

  .features {
    padding: 80px 20px;
    max-width: 1100px;
    margin: 0 auto;
  }

  .features h2 {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 40px;
    text-align: center;
  }

  .feature-group {
    margin-bottom: 60px;
  }

  .feature-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
  }

  .feature-item {
    background: #fff;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    text-align: center;
  }

  .feature-item i {
    font-size: 2rem;
    margin-bottom: 15px;
    color: #afda17ff;
  }

  .feature-item h3 {
    font-size: 1.25rem;
    margin-bottom: 10px;
  }

  .feature-item p {
    font-size: 0.95rem;
    line-height: 1.5;
    color: #555;
  }
</style>
</head>

<body>
    @include('partials.nav')
    <div class="hero">
    <h1>Your Business, Perfectly Organized</h1>
    <p>The all-in-one platform for your inventory, sales, and finances</p>
    <a href="/signup">
      <button class="btn-get-started">Get Started</button>
    </a>
    <img src="dashboard-screenshot.png" alt="Dashboard Screenshot">
    </div>


    <div class="features">
        <div class="feature-group">
            <h2>Core Features</h2>
            <div class="feature-list">
            <div class="feature-item">
                <i class="fas fa-cart-flatbed"></i>
                <h3>Inventory & Purchase Management</h3>
                <p>Take control of your stock. Easily manage product variants, track batch numbers, and see your inventory levels in real time.</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-file-invoice-dollar"></i>
                <h3>Sales & Invoicing</h3>
                <p>Streamline your sales process. Create and download professional PDF invoices with a few clicks, including taxes and delivery fees.</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-money-bill-transfer"></i>
                <h3>Transactions & Financials</h3>
                <p>Stay on top of your money. Record all financial activities, from sales and purchases to expenses and product returns, all in one place.</p>
            </div>
            </div>
        </div>

        <!-- Dashboard & Analytics -->
        <div class="feature-group">
            <h2>Dashboard & Analytics</h2>
            <div class="feature-list">
            <div class="feature-item">
                <i class="fas fa-list-check"></i>
                <h3>Real-time Financial Snapshot</h3>
                <p>See a clear overview of your business at a glance. Track total sales, costs, and revenue with a simple and intuitive dashboard.</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-file-shield"></i>
                <h3>Business Health Check</h3>
                <p>Get a complete picture of your company's performance. Monitor key metrics and evaluate your business health with a sales graph and other powerful insights.</p>
            </div>
            </div>
        </div>

        <!-- Additional Tools -->
        <div class="feature-group">
            <h2>Additional Tools</h2>
            <div class="feature-list">
            <div class="feature-item">
                <i class="fas fa-user-gear"></i>
                <h3>User & Company Management</h3>
                <p>Securely manage your founder account and easily update your company's profile whenever you need to.</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-sitemap"></i>
                <h3>Category & Product Management</h3>
                <p>Effortlessly organize your products by creating, editing, and deleting categories as your business grows.</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-arrow-rotate-left"></i>
                <h3>Return Logistics</h3>
                <p>Simplify returns. Our system helps you process returned products efficiently and update your stock automatically.</p>
            </div>
            </div>
        </div>
    </div>

     <footer class="footer text-center py-3" style="background:#111; color:#fff; font-size:0.9rem;">
        © 2025 finovo. All rights reserved.
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
