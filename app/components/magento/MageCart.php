<?php

/*
    TODO: 有 session 相關, 請確認是否放在這裡, 或改到
        MageSession::clearCart()
        MageSession::addCartOptions()
*/
class MageCart
{

    /**
     *  @return boolean
     */
    static public function clear()
    {
        MageLoader::start();

            try {
                $cart = Mage::getModel('checkout/cart');
                $cart->init();
                $cart->truncate();
                $cart->save();

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
                return false;
            }

            Mage::getSingleton('checkout/session')->setCartWasUpdated(true);

        MageLoader::end();

        return true;        
    }

    /**
     *  @return boolean ?
     */
    static public function addByOptions( $options )
    {
        $options += array(
            'product' => 0,
            'qty' => 1,
          //'price' => 50,
          //'amount' => 20,
        );

        if ( !$options['product'] ) {
            return false;
        }

        MageLoader::start();

            try {

                $product = Mage::getModel('catalog/product')->load( $options['product'] );
                // $product->setSpecialPrice( 50 );
                // $product->save();

                $cart = Mage::getModel('checkout/cart');
                $cart->init();
                $cart->addProduct($product, $options);
                $cart->save();

            }
            catch(Exception $e) {
                // TODO: 請改成 寫入 report log, 並提示 error report id
                pr( $e->getMessage() );
                pr( $e );
                exit;
            }

            Mage::getSingleton('checkout/session')->setCartWasUpdated(true);

        MageLoader::end();

        return true;
    }

}
