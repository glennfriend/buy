<?php

class CategoryController extends ControllerBase
{

    public function indexAction()
    {
        MageLoader::start();

        $collection = Mage::getModel('catalog/category')->getCollection() 
            ->addAttributeToSelect('name') 
            ->addAttributeToSelect('is_active');

        MageLoader::end();

        $this->view->setVars(array(
            'categories' => $collection
        ));
    }

    public function listAction( $categoryId )
    {
        MageLoader::start();

        $categoryId = (int) $categoryId;
        $category = new Mage_Catalog_Model_Category();
        $category->load( $categoryId );

        $collection = $category->getProductCollection();
        $collection->addAttributeToSelect('*');

        MageLoader::end();

        $this->view->setVars(array(
            'products' => $collection
        ));
    }

}