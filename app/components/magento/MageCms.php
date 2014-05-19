<?php

class MageCms
{

    /**
     *  @return cms content
     */
    static public function getBlock( $identifier )
    {
        $identifier = trim($identifier);

        MageLoader::start();

            $content = Mage::getModel('cms/block')->load( $identifier )->getContent();

            $helper = Mage::helper('cms');
            $processor = $helper->getPageTemplateProcessor();
            $html = $processor->filter( $content );

        MageLoader::end();

        return $html;
    }

}
