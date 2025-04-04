


<!DOCTYPE html>
<html>

<head>
    <title>Tyne Brew Coffee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Permanent+Marker&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>





<body>
    <div class="navbar">
        <div class="logo"> <img src="">

        </div>
        <ul class="nav-list">
            <li><a href="index.php"><i class="fa fa-fw fa-home"></i>Home</a></li>
            <li><a href="login.php"><i class="fa fa-address-book"> </i> LOGIN</a></li>
            <li><a href="register.php"><i class="fa fa-sign-in"></i> REGISTER</a></li>


            <li><a href="basket.php">
                    <div class="itemgroup">
                        <img src="Images/basket.png" height="50px" width="50px">
                        <?php
                        $itemCount = 0;
                        $totalPrice = 0;

                        foreach ($_SESSION['basket'] as $item) {
                            $itemCount += $item['quantity'];
                            $totalPrice += $item['quantity'] * $item['price'];
                        } ?>
                        Items: <?= $itemCount ?> || £<?= number_format($totalPrice, 2) ?>
                    </div>
                </a></li>
            <?php if ($_SESSION['loggedin']): ?>
                <li style="float:right"><a href="signout.php">Sig Out</a></li>
                <li style="float:right"><a href="register.php">Account</a></li>

            <?php else: ?>
                <li style="float:right"><a href="register.php">Sign up</a></li>
                <li style="float:right"><a href="login.php">Login</a></li>

            <?php endif; ?>

        </ul>
    </div>
    </body>
</html>
