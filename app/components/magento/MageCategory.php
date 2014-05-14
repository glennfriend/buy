<?php

class MageCategory
{

    /**
     *  @return categories
     */
    static public function getAll()
    {
        MageLoader::start();

            $categories = Mage::getModel('catalog/category')->getCollection() 
                ->addAttributeToSelect('name') 
                ->addAttributeToSelect('is_active');

        MageLoader::end();

        return $categories;
    }

}
