<?php
namespace Blocks\Date;

class Block extends \Blocks\BaseBlock
{

    public function __construct( $value, $format='Y-m-d' )
    {
        $this->value = date( $format, $value );
    }

}