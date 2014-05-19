<hr/>
<?php
    $categoryUrl    = url('category');
    $clearCartUrl   = url('cart/clear');
    $itemsCount     = MageSession::getCartItemsCount();

    echo <<<EOD
        Hello World
        | <a href="{$categoryUrl}">Categories list</a>
        | Cart ({$itemsCount})
        | <a href="{$clearCartUrl}">Clear you Cart</a>
        <hr/>
EOD;

