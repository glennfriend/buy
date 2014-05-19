<hr/>
<?php
    $categoryUrl  = url('category');
    $clearCartUrl = url('cart/clear');
    echo <<<EOD
        Hello World !
        | <a href="{$categoryUrl}">Categories list</a>
        | Cart (?)
        | <a href="{$clearCartUrl}">Clear you Cart</a>
        <hr/>
EOD;

