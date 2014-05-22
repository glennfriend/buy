<?php
namespace Blocks\Datetime;

class Block extends \Blocks\BaseBlock
{

    public function __construct( $value, $format='Y-m-d H:i:s' )
    {
        $this->value = date( $format, $value );
    }

}