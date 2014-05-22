<?php

namespace Blocks\Navigation;

class Block extends \Blocks\BaseBlock
{

    public function toHtml()
    {
        return $this->getTemplate();
    }

}