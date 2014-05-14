<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        
        $this->addToCart();
        $product = $this->getProduct();

        //$product = $this->getProduct2();

        $this->view->setVars(array(
            'product' => $product
        ));
    }

    protected function getProduct()
    {
        // get product url key
        $url = 'sleeve/helena-gown';
        $url = 'f90001.html';

        $product = MageProduct::getByUrl( $url );


        return $product;
    }

    protected function getCategory()
    {
        /*
        MageLoader::start();
        $vPath = 'silhouette/mermaid-trumpet'; // category

        $oRewrite = Mage::getModel('core/url_rewrite')
                        ->setStoreId(Mage::app()->getStore()->getId())
                        ->loadByRequestPath($vPath);

        MageLoader::end();
        */
    }

    protected function addToCart()
    {
        $productId = 2;
        $params = array(
            'product' => $productId,
            'qty' => 1,
            //'price' => 50,
            //'amount' => 20,
            //$productId => 1,
            //$productId => array('qty' => 1),
        );

        MageCart::addByOptions( $params );

    }

}