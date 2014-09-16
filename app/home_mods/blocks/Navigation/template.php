<?php
    $categoryUrl    = url('category');
    $clearCartUrl   = url('cart/clear');
    $itemsCount     = MageSession::getCartItemsCount();
?>
<div class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Buy</a>
        </div>
        <div class="navbar-collapse collapse">

            <ul class="nav navbar-nav">
                <!--
                    <li class="active">Home</li>
                -->
                <li><a href="<?php echo url(''); ?>">Home</a></li>
                <li><a href="<?php echo $categoryUrl; ?>">Categories list</a></li>
                <li><a href="<?php echo $clearCartUrl; ?>">Clear you Cart</a></li>
                <li>Cart (<?php echo $itemsCount; ?>)</li>
            </ul>

            <ul class="nav navbar-nav pull-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello<b class="caret"></b></a>
                    <ul class="dropdown-menu"><li class="dropdown-header">User</li>
                        <li><a href="#">User Name</a></li>
                        <li class="dropdown-header">Status</li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</div>
