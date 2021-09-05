<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<header class="site-navbar js-sticky-header site-navbar-target" role="banner">

    <div class="container">
        <div class="row align-items-center position-relative">


            <div class="site-logo">
                <a href="../index.php" class="text-black"><span class="text-primary">Market online</a>
            </div>

            <div class="col-12">
                <nav class="site-navigation text-right ml-auto " role="navigation">

                    <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                        <li><a href="../vegetable/index.php" class="nav-link">Vegetable</a></li>
                        <li><a href="../cart/index.php" class="nav-link">Card</a></li>

                        <li><a href="../cart/history.php" class="nav-link">History</a></li>
                        <?php if(isset($_SESSION['fullName'])){echo "<li><a href=\"../logout.php\" class=\"nav-link\">Logout</a></li>";} else {echo "<li><a href=\"../login.php\" class=\"nav-link\">Login</a></li>";} ?>
                        <?php if(isset($_SESSION['fullName'])){
                echo "<li><a href=\"../index.php\" class=\"nav-link\"><i class=\"fa fa-user-circle\" aria-hidden=\"true\"></i><span
                style=\"padding-left: 10px;\">" . $_SESSION['fullName'] . "</span></a></li>";} else {echo "<li><a href=\"../register.php\" class=\"nav-link\">Register</a></li>";}?>

                    </ul>
                </nav>

            </div>

            <div class="toggle-button d-inline-block d-lg-none"><a href="#"
                    class="site-menu-toggle py-5 js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

        </div>
    </div>

</header>