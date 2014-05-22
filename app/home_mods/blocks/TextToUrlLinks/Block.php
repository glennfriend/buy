<?php
namespace Blocks\TextToUrlLinks;

/**
 *  若文字內容中有符合 url link, 就自動加上 <a href="******">.....</a> 的 html tag
 *
 *  @param string $text
 *  @return string
 *
 */
class Block extends \Blocks\BaseBlock
{

    public function __construct( $text )
    {
        $regex = '@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@';
        $this->value = preg_replace( $regex, '<a href="$1" target="_blank">$1</a>', $text );
    }

}