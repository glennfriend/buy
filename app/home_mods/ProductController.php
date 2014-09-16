<?php

class ProductController extends ControllerBase
{

    public function indexAction()
    {
        $categories = MageCategory::getAll();

        $this->view->setVars(array(
            'categories' => $categories
        ));
    }

    public function listAction( $categoryId )
    {
        $products = MageProduct::findByCategoryId( (int) $categoryId );

        $this->view->setVars(array(
            'products' => $products
        ));
    }

}