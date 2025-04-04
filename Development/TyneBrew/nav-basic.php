<?php
session_start();
if(isset($_SESSION['username'])){
            echo "
            <div class='navbar'>
            <div class='logo'> <img src='Images/mainlogo1.JPG'></div>
                <ul class='nav-list'>
                    <li><a href='index.php'><i class='fa fa-fw fa-home'></i>HOME</a></li>
                    <li><a href='aboutus.php'><i class='fa fa-sign-in'></i> ABOUTUS</a></li>
                    <li><a href='loginn.php'><i class='fa fa-address-book'> </i> LOGIN</a></li>   
                    <li><a href='register.php'><i class='fa fa-sign-in'></i> REGISTER</a></li>                 
                    <li><a href='admin.php'><i class='fa fa-sign-in'></i> ADMIN</a></li>
                    <li><a href='logout.php'><i class='fa fa-sign-in'></i> Logout</a></li>
                    <li><a href='basket.php'><img src='Images/basket.png' height='30px' width='30px'></a></li>
                </ul>
                
            </div>
            ";
        }
        else{
            echo "
            <div class='navbar'>
            <div class='logo'> <img src='Images/mainlogo1.JPG'></div>
                <ul class='nav-list'>
                    <li><a href='index.php'><i class='fa fa-fw fa-home'></i>HOME</a></li>
                    <li><a href='aboutus.php'><i class='fa fa-sign-in'></i> ABOUTUS</a></li>
                    <li><a href='loginn.php'><i class='fa fa-address-book'> </i> LOGIN</a></li>
                    <li><a href='register.php'><i class='fa fa-sign-in'></i> REGISTER</a></li>
                    <li><a href='admin.php'><i class='fa fa-sign-in'></i> ADMIN</a></li>
                    <li><a href='basket.php'><img src='Images/basket.png' height='30px' width='30px'></a></li>
                </ul>
            </div>
            ";            
        }
    ?>