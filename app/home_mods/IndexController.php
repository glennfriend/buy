<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $product = $this->getProduct();

        $this->view->setVars(array(
            'product' => $product
        ));
    }

    protected function getProduct()
    {
        MageLoader::start();

        // get product url key
        $vPath = 'sleeve/helena-gown';

        $oRewrite = Mage::getModel('core/url_rewrite')
                        ->setStoreId(Mage::app()->getStore()->getId())
                        ->loadByRequestPath($vPath);

        $productId = $oRewrite->getProductId();
        $product = Mage::getModel('catalog/product')->load($productId);

        MageLoader::end();

        return $product;
    }

}