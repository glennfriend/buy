<?php

namespace blocks;

class BaseBlock
{

    /**
     *  讀取 template.php
     */
    public function toHtml()
    {
        $className = get_class($this);
        $classNames = explode('\\', $className);
        if ( !isset($classNames[1]) ) {
            return null;
        }

        $blockName = $classNames[1];
        $file = APPLICATION_BASE_PATH . '/app/'. APPLICATION_PORTAL .'_mods/blocks/'. $blockName . '/template.php';
        if ( !file_exists($file) ) {
            return null;
        }

        ob_start();
            include $file;
            $tmp = ob_get_contents();
        ob_end_clean();
        return $tmp;
    }

}