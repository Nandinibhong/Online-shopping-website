<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <div class="background">
    <nav class="navbar">
      <img src="NariKalakariLogo.png" alt="Nari Kalakari Logo" height="5%" width="8%">
      <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li><a href="signup.php">Sign Up</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="feedback.php">Feedback</a></li><li>
    <li>
            <a href="cart.php">
                <i class="fa fa-opencart" style="font-size:20px"></i> 
                <span id="cart-item" class="badge badge-danger"></span>
            </a>
        </li>

      </ul>
      <div class="search-container">
        <input type="text" id="search-bar" placeholder="Search...">
        <ul id="suggestions-list"></ul>
      </div>
    </nav>
    <div class="para">
      <p><strong>Exciting Offer Alert!</strong><br>
        The first 20 customers will receive an exclusive 20% discount and free gifts! 🎁</p>
       <p><strong>Click the button below to start shopping:</strong></p>
      <button class="button" onclick="location.href='shop.php';">
        <span></span> Shop Now
      </button>
    </div>
  </div>
  <footer class="footer">
    <div class="container">
      <div class="footer-about">
        <h2>Nari Kalakari</h2><br><br>
        <p>Celebrating the spirit and essence of womanhood through exquisite clothing.</p>
      </div>
      <div class="footer-links">
        <h3>Quick Links</h3><br><br>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About Us</a></li>
          <li><a href="signup.php">Sign UP</a></li>
          <li><a href="feedback.php">Feedback</a></li>
        </ul>
      </div>
      <div class="footer-contact">
        <h3>Contact Us</h3><br><br>
        <p>Email: ✉️ <a href="mailto:nandinibhong@gmail.com">nandinibhong@gmail.com</a></p>
        <p>Phone: 📞 <br><a href="tel:+919322242051">+91 9322242051</a></p>
      </div>
      <div class="footer-social">
        <h4>Follow Us</h4><br><br>
        <p>Instagram Page:📸</p>
        <a href="https://www.instagram.com/nari__kalakari?igsh=aTJudWV2aXR5dTVx">Nari__kalakari</a><br><br>
        <p>LinkedIn:📊</p>
        <a href="https://www.linkedin.com/in/nandini-bhong-970923273/">Nandini__bhong</a><br><br>
      </div>
    </div>
  </footer>
  <script src="index.js"></script>
</body>
</html>