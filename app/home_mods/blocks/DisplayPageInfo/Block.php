<?php
namespace Blocks\DisplayPageInfo;

/**
 *  顯示 page info
 */
class Block extends \Blocks\BaseBlock
{

    public function __construct( $pageLimit )
    {
        $show = '';
        if ( is_object($pageLimit) && $pageLimit->getRowCount() > 0 ) {
            $show .= ' Total  <span class="badge">'. $pageLimit->getRowCount() .'</span>';
            $show .= ' , Page <span class="badge">'. $pageLimit->getPage() .' / '. $pageLimit->getTotalPage() .'</span>';
        }

        $this->value = $show;
    }

}