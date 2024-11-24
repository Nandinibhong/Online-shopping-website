<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="shop.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <section class="menu">
        <a href="shop.php">Shopping 🛍️</a>
        <a href="cart.php">View cart 🛒</a>
    </section>
    <div class="container">
        <div class="message"></div>
        <div class="row">
            <?php
            require 'shopDBconn.php';
            $stmt = $conn->prepare("SELECT * FROM product");
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()): ?>
                <div class="shopping-cart">
                    <img src="<?= htmlspecialchars($row['product_image']) ?>"
                        alt="<?= htmlspecialchars($row['Product_Name']) ?>" class="card-img-top" height="300" width="250">
                    <h5><?= htmlspecialchars($row['Product_Name']) ?></h5>
                    <h5>₹<?= number_format($row['price'], 2) ?>/-</h5>
                    <h5>Size: XS-XXL</h5>
                    <form action="" class="form-submit">
                        <input type="hidden" name="pid" value="<?= htmlspecialchars($row['pid']) ?>">
                        <input type="hidden" name="pname" value="<?= htmlspecialchars($row['Product_Name']) ?>">
                        <input type="hidden" name="pprice" value="<?= htmlspecialchars($row['price']) ?>">
                        <input type="hidden" name="pimage" value="<?= htmlspecialchars($row['product_image']) ?>">
                        <input type="hidden" name="pcode" value="<?= htmlspecialchars($row['product_code']) ?>">
                        <button type="submit" class="addItemBtn"><i class="fa fa-opencart" style="font-size:20px"></i> Add
                            to Cart</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".itemQty").on('change', function () {
                var $el = $(this).closest('tr');
                var pid = $el.find(".pid").val();
                var pprice = $el.find(".pprice").val();
                var qty = $el.find(".itemQty").val();

                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    cache: false,
                    data: { pid: pid, pprice: pprice, qty: qty },
                    success: function (response) {
                        location.reload(true);
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error: " + status + ": " + error);
                    }
                });
            });

            $(".addItemBtn").click(function (e) {
                e.preventDefault();
                var $form = $(this).closest(".form-submit");
                var pid = $form.find("input[name='pid']").val();
                var pname = $form.find("input[name='pname']").val();
                var pprice = $form.find("input[name='pprice']").val();
                var pimage = $form.find("input[name='pimage']").val();
                var pcode = $form.find("input[name='pcode']").val();

                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    data: { pid: pid, pname: pname, pprice: pprice, pimage: pimage, pcode: pcode },
                    success: function (response) {
                        $(".message").html(response);
                        load_cart_item_number();
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