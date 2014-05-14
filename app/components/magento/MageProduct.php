<?php

class MageProduct
{

    /**
     *  @return product object or ?
     */
    static public function getByUrl( $urlKey )
    {
        $urlKey = trim($urlKey);
    
        MageLoader::start();

            $storeId = Mage::app()->getStore()->getId();

            $oRewrite = Mage::getModel('core/url_rewrite')
                            ->setStoreId( $storeId )
                            ->loadByRequestPath( $urlKey );

            $productId = $oRewrite->getProductId();
            $product = Mage::getModel('catalog/product')->load( $productId );

        MageLoader::end();

        return $product;
    }

    /**
     *  @return product object or ?
     */
    static public function findByCategoryId( $categoryId )
    {
        MageLoader::start();

            $categoryId = (int) $categoryId;
            $category = new Mage_Catalog_Model_Category();
            $category->load( $categoryId );

            $products = $category->getProductCollection();
            $products->addAttributeToSelect('*');

        MageLoader::end();

        return $products;
    }

}
