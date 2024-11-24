<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cart.css">
    <title>CART</title>
</head>

<body>
    <section class="menu">
        <a href="shop.php">Shopping 🛍️</a>
        <a href="cart.php">View cart 🛒</a>
    </section>
    <div class="container">
        <div class="row">
            <div class="alert alert-success alert-dismissible" style="display:<?php
            if (isset($_SESSION['showAlert'])) {
                echo $_SESSION['showAlert'];
            } else {
                echo 'none';
            }
            unset($_SESSION['showAlert']);
            ?>">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }
                unset($_SESSION['message']);
                ?></strong>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th colspan="7">Products in your cart to buy...!!</th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>PRODUCT IMAGE</th>
                        <th>NAME</th>
                        <th>PRICE</th>
                        <th>QUANTITY</th>
                        <th>TOTAL PRICE</th>
                        <th><a href="action.php?clear=all" class="remove-trash"
                                onclick="return confirm('Are you sure you want to clear your cart?');">Clear trash</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'shopDBconn.php';
                    $stmt = $conn->prepare("SELECT * FROM cart");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $grand_total = 0;
                    while ($row = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <input type="hidden" name="pid" class="pid" value="<?= $row['id'] ?>">
                            <td><img src="<?= $row['product_image'] ?>" width="50" alt="Product Image"></td>
                            <td><?= $row['product_name'] ?></td>
                            <input type="hidden" name="pprice" class="pprice" value="<?= $row['product_price'] ?>">
                            <td>₹<?= number_format($row['product_price'], 2); ?>/-</td>
                            <td><input type="number" class="itemQty" value="<?= $row['qty'] ?>" style="width: 75px;"></td>
                            <td>₹<?= number_format($row['total_price'], 2); ?>/-</td>
                            <td><a href="action.php?remove=<?= $row['id'] ?>" class="remove-icon"
                                    onclick="return confirm('Are you sure you want to remove it from the cart?');">Remove
                                    &times;</a></td>
                        </tr>
                        <?php $grand_total += $row['total_price']; ?>
                    <?php endwhile; ?>
                    <tr>
                        <td colspan="4">
                            <a href="shop.php">
                                <button class="button-57" role="button"><span
                                        class="text">Continue</span><span>Shopping</span></button>
                            </a>
                        </td>
                        <td><b>Total :</b></td>
                        <td><b>₹<?= number_format($grand_total, 2); ?>/-</b></td>
                        <td><a href="checkout.php">
                                <button class="button-59 <?= ($grand_total > 1) ? "" : "disabled"; ?>"
                                    role="button">Checkout</button>
                            </a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>