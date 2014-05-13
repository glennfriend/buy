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
        MageLoader::start();

        // get product url key
        $vPath = 'sleeve/helena-gown';
        $vPath = 'f90001.html';

        $oRewrite = Mage::getModel('core/url_rewrite')
                        ->setStoreId(Mage::app()->getStore()->getId())
                        ->loadByRequestPath($vPath);

        $productId = $oRewrite->getProductId();
        $product = Mage::getModel('catalog/product')->load($productId);

        MageLoader::end();

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
        MageLoader::start();

        $productId = 2;
        $params = array(
            'product' => $productId,
            'qty' => 1,
            //'price' => 50,
            //'amount' => 20,
            //$productId => 1,
            //$productId => array('qty' => 1),
        );

        try {
            $product = Mage::getModel('catalog/product')->load( $productId );
            // $product->setSpecialPrice( 50 );
            // $product->save();

            $cart = Mage::getModel('checkout/cart');
            $cart->init();
            $cart->addProduct($product, $params);
            $cart->save();

            // clear cart items
            // $cart->truncate();

            /*
                // clear cart items
                $cartHelper = Mage::helper('checkout/cart');
                $items = $cartHelper->getCart()->getItems();        
                foreach ($items as $item) 
                {
                   $itemId = $item->getItemId();
                   $cartHelper->getCart()->removeItem($itemId)->save();
                } 
            */

        }
        catch(Exception $e) {
            pr( $e->getMessage() );
            pr( $e );
            exit;
        }


        Mage::getSingleton('checkout/session')->setCartWasUpdated(true);

        MageLoader::end();
    }

}