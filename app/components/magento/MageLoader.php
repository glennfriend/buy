<?php

/**
 *  PHP autoloaders 的機制是採用註冊的方式
 *  所以該 class 是在要使用 magento 的時候
 *  備份 並 停止 原有的 autoloader
 *  直到使用完成
 *  接著移除 magento autoloader
 *  再恢復原有的 autoloaders
 *
 */
class MageLoader
{
    /**
     *  save origin autoloaders
     */
    protected static $origin = array();

    /**
     *  save magento autoloaders
     */
    protected static $magento = array();
    
    /**
     *  備份 origin autoloader
     *  停止 origin autoloader
     *  啟用 magento autoloader
     */
    public static function start()
    {
        // 假若 developer 之前使用忘了關閉 end()
        // 這段程式可以提醒該錯誤
        if ( self::$origin ) {
            die('57104571024750124751082374927343');
        }

        // origin
        self::$origin = spl_autoload_functions();
        foreach( self::$origin as $obj ) {
            spl_autoload_unregister( $obj );
        }

        // magento
        if ( self::$magento ) {
            // 之前已引用過 mage
            foreach( self::$magento as $obj ) {
                spl_autoload_register( $obj );
            }
        }
        else {
            // 第一次引用 mage
            require_once APPLICATION_SHOP_BASE_PATH . '/app/Mage.php';
            umask(0);

            Mage::app();
            /*
            Mage::getSingleton('core/session', array(
                'name' => APPLICATION_SHOP_COOKIE_NAME
            ));
            // $session = Mage::getSingleton('customer/session', array('name'=>APPLICATION_SHOP_COOKIE_NAME));
            */

            self::$magento = spl_autoload_functions();
        }

    }

    /**
     *  停止 magento autoloader
     *  恢復 origin autoloader
     */
    public static function end()
    {
        // magento
        foreach( self::$magento as $obj ) {
            spl_autoload_unregister( $obj );
        }

        // origin
        foreach ( self::$origin as $obj ) {
            spl_autoload_register( $obj );
        }
        self::$origin = array();

        restore_error_handler();
        restore_exception_handler();
    }

}

