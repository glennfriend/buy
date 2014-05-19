<?php

class MageSession
{

    /**
     *  get cart items
     *  @return array
     */
    static public function getCartItems()
    {
        MageLoader::start();

            $items = array();

            $session = Mage::getSingleton('checkout/session');
            foreach ( $session->getQuote()->getAllItems() as $item ) {
                $sku = $item->getSku();
                $items[$sku] = array(
                    'sku'   => $sku,
                    'name'  => $item->getName(),
                    'qty'   => $item->getQty(),
                    'price' => $item->getBaseCalculationPrice(),
                );
            }

        MageLoader::end();
        return $items;
    }

    /**
     *  get cart items count
     *  @return integer
     */
    static public function getCartItemsCount()
    {
        MageLoader::start();

            $count = Mage::helper('checkout/cart')->getCart()->getItemsCount();

        MageLoader::end();
        return $count;
    }


}
