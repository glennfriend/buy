<?php
namespace Blocks\DisplayPageLimit;

/**
 *  顯示 page limit and page info
 */
class Block extends \Blocks\BaseBlock
{

    public function __construct( $pageLimit, $showPageInfo=false )
    {
        if ( !is_object($pageLimit) ) {
            $this->value = '';
            return;
        }


        $paginationInfo = '';
        if( $pageLimit->getTotalPage() > 1 ) {
            $paginationInfo = '<ul class="pagination">'. $pageLimit->render() . '</ul>';
        }

        $pageInfo = '';
        if ( $showPageInfo ) {
            $pageInfo = cc('displayPageInfo', $pageLimit );
        }
    
        $this->value = <<<EOD
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        {$paginationInfo}
                    </div>
                    <div class="pull-right">
                        {$pageInfo}
                    </div>
                </div>
            </div>
EOD;
        
    }

}