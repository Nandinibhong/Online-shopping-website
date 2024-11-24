<?php
require 'shopDBconn.php';
$grand_total = 0;
$allItems = '';
$items = array();
$sql = "SELECT CONCAT(product_name, '(', qty, ')') AS itemQty, total_price FROM cart";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $grand_total += $row['total_price'];
    $items[] = $row['itemQty'];
}
$allItems = implode(", ", $items);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="shop.css">
    <link rel="stylesheet" href="checkout.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <section class="menu">
        <a href="shop.php">Shopping 🛍️</a>
        <a href="cart.php">View cart 🛒</a>
    </section>
    <div class="container" id="order">
        <h3 class="head">Complete your order..!!!</h3>
        <div class="jumbotron">
            <h6><b>Product(s):</b> <?= $allItems ?></h6>
            <h6><b>Free shipping..!!</b></h6>
            <h4><b>Total Amount Payable:</b> ₹<?= number_format($grand_total, 2); ?></h4>
        </div>
        <form action="" method="post" id="placeOrder">
            <input type="hidden" name="products" value="<?= $allItems; ?>">
            <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
            <input type="text" name="name" class="form-control" placeholder="Enter name" required>
            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
            <input type="tel" name="phone" class="form-control" placeholder="Enter mobile no." required>
            <textarea name="address" id="add" cols="30" rows="5" placeholder="Enter delivery address here..!!"
                required></textarea>
            <h5>Select Payment Mode :</h5>
            <select name="pmode" required>
                <option value="" selected disabled>-Select payment mode-</option>
                <option value="cod">Cash On Delivery</option>
                <option value="netbanking">Net Banking</option>
                <option value="cards">Debit/Credit card</option>
            </select>
            <input type="submit" name="submit" value="Place Order" class="placeorderbtn">
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#placeOrder").submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    data: $(this).serialize() + "&action=order",
                    success: function (response) {
                        $("#order").html(response);
                    }
                });
            });
            function load_cart_item_number() {
                $.ajax({
                    url: 'action.php',
                    method: 'get',
                    data: { cartItem: "cart_item" },
                    success: function (response) {
                        $("#cart-item").html(response);
                    }
                });
            }
            load_cart_item_number();
        });
    </script>
</body>

</html>