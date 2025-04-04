<div class="navbar">
        <div class="logo"> <img src="">

        </div>
        <ul class="nav-list">
            <li><a href="index.php"><i class="fa fa-fw fa-home"></i>Home</a></li>
            <li><a href="basket.php">
                <div class="itemgroup">
                <img src="Images/basket.png" height="50px" width="50px">
                <?php
                 $itemCount = 0;
                 $totalPrice= 0;

                foreach($_SESSION['basket'] as $item){
                    $itemCount += $item['quantity'];
                    $totalPrice += $item ['quantity'] * $item['price'];
                }?>
                Items: <?= $itemCount?> || £<?=number_format($totalPrice, 2) ?></div></a></li>
                <?php if($_SESSION['loggedin']): ?>
                    <li style="float:right"><a href="signout.php">Sig Out</a></li>
                    <li style="float:right"><a href="register.php">Account</a></li>

                <?php else: ?>
                    <li style="float:right"><a href="register.php">Sign up</a></li>
                    <li style="float:right"><a href="login.php">Login</a></li>

                <?php endif; ?>
    
        </ul>
    </div>