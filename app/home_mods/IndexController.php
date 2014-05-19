<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        // $this->view->setVars();
    }

    public function productAction( $url )
    {
        $url = trim($url);
        $product = MageProduct::getByUrl( $url );

        $this->view->setVars(array(
            'product' => $product
        ));
    }

    public function addToCartAction( $url )
    {
        $url = trim($url);
        $product = MageProduct::getByUrl( $url );

        $params = array(
            'product' => $product->getId(),
            'qty' => 1,
            //'price' => 123,
            //'amount' => 456,
        );
        MageCart::addByOptions( $params );

        $this->redirect( $url );
    }

    public function clearCartAction()
    {
        MageCart::clear();

        $this->redirect('');
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


}