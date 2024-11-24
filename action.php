<?php
session_start();
include 'shopDBconn.php';

if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pimage = $_POST['pimage'];
    $pcode = $_POST['pcode'];
    $pqty = 1;

    $stmt = $conn->prepare("SELECT product_code FROM cart WHERE product_code = ?");
    if (!$stmt) {
        die("Error in preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $pcode);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $code = isset($r['product_code']) ? $r['product_code'] : '';

    if (empty($code)) {
        $stmt_insert = $conn->prepare("INSERT INTO cart (product_name, product_price, product_image, qty, total_price, product_code) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt_insert) {
            die("Error in preparing insert statement: " . $conn->error);
        }
        $stmt_insert->bind_param("sssiis", $pname, $pprice, $pimage, $pqty, $pprice, $pcode);
        $stmt_insert->execute();

        echo '<div class="alert alert-success alert-dismissible" style="background-color:#8cba51; color: white;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Item added to your cart...!!!</strong>
              </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible" style="background-color: #ff5d6c; color: white;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Item already exists in your cart...!!!</strong>
              </div>';
    }
}

if (isset($_GET['cartItem']) && $_GET['cartItem'] == 'cart_item') {
    $stmt = $conn->prepare("SELECT * FROM cart");
    if (!$stmt) {
        die("Error in preparing statement: " . $conn->error);
    }
    $stmt->execute();
    $stmt->store_result();
    $row = $stmt->num_rows();
    echo $row;
}

if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    $stmt = $conn->prepare("DELETE FROM cart WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $_SESSION['showAlert'] = "block";
    $_SESSION['message'] = "Item removed from the cart";
    header('Location: cart.php');
}

if (isset($_GET['clear'])) {
    $stmt = $conn->prepare("DELETE FROM cart");
    $stmt->execute();
    header('Location: cart.php');
    $_SESSION['showAlert'] = "block";
    $_SESSION['message'] = "All items removed from the cart";
}

if (isset($_POST['qty'])) {
    $qty = $_POST['qty'];
    $pid = $_POST['pid'];
    $pprice = $_POST['pprice'];
    $tprice = $qty * $pprice;
    $stmt = $conn->prepare("UPDATE cart SET qty=?, total_price=? WHERE id=?");
    $stmt->bind_param("isi", $qty, $tprice, $pid);
    $stmt->execute();
}

if (isset($_POST['action']) && $_POST['action'] == 'order') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $products = $_POST['products'];
    $grand_total = $_POST['grand_total'];
    $address = $_POST['address'];
    $pmode = $_POST['pmode'];
    $data = '';

    $stmt = $conn->prepare("INSERT INTO orders (name, email, phone, address, pmode, products, amount_paid) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $phone, $address, $pmode, $products, $grand_total);
    $stmt->execute();

    $data .= '<head><style>
    .confirm-message {
        font-family: "Arial", sans-serif;
        color: #333;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
        max-width: 600px;
        text-align: center;
    }
    
    .confirm-message h1 {
        color: #28a745;
        font-size: 2.5em;
        margin-bottom: 10px;
    }
    
    .confirm-message h2 {
        color: #17a2b8;
        font-size: 2em;
        margin-bottom: 20px;
    }
    
    .confirm-message h4 {
        color: #495057;
        font-size: 1.2em;
        margin-bottom: 10px;
    }
    
    .confirm-message h4::before {
        content: "• ";
        color: #007bff;
    }
    
    .confirm-message .amount-paid {
        font-weight: bold;
        color: #dc3545;
    }
    
    .confirm-message .payment-mode {
        font-style: italic;
        color: #6c757d;
    }
    </style></head>
    <div class="confirm-message"> 
        <h1>Thank You..!!!</h1>
        <h2>Order Placed Successfully..!!!</h2>
        <h4>Items Purchased: ' . $products . '</h4>
        <h4>Your Name: ' . $name . '</h4>
        <h4>Your E-mail: ' . $email . '</h4>
        <h4>Your Phone: ' . $phone . '</h4>
        <h4>Delivery Address: ' . $address . '</h4>
        <h4 class="amount-paid">Amount Paid: ' . number_format($grand_total, 2) . '</h4>
        <h4 class="payment-mode">Payment Mode: ' . $pmode . '</h4>
    </div>';
    echo $data;
}
?>