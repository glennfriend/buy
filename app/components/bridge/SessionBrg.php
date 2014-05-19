<?php

class SessionBrg
{

    /**
     *  store session object
     */
    private static $session = array();

    /**
     *  session init
     */
    public static function init()
    {
        // TODO: 只是測試, 實際上並沒有要將兩個 framework 的 session 放一起!!
        session_save_path( APPLICATION_SHOP_BASE_PATH . '/var/session/' );

        // 設定跟 magento 一樣的 cookie name
        session_name(APPLICATION_SHOP_COOKIE_NAME);

        // 每次進來都重新變更 life time
        if ( isset( $_COOKIE[APPLICATION_SHOP_COOKIE_NAME] ) ) {
            setcookie(
                APPLICATION_SHOP_COOKIE_NAME,
                session_id( $_COOKIE[APPLICATION_SHOP_COOKIE_NAME] ),
                time() + APPLICATION_LOGIN_LIFETIME,
                "/"
            );
        }

        $session = new Phalcon\Session\Adapter\Files(array(
            'uniqueId' => APPLICATION_PRIVATE_DYNAMIC_CODE
        ));
        $session->start();

        self::$session = $session;
    }

    /* --------------------------------------------------------------------------------
        access
    -------------------------------------------------------------------------------- */

    /**
     *  get session
     */
    public static function get( $key, $defaultValue=null )
    {
        $val = self::$session->get($key);
        if ( !$val && $defaultValue ) {
            return $defaultValue;
        }
        return $val;
    }

    /* --------------------------------------------------------------------------------
        write
    -------------------------------------------------------------------------------- */

    /**
     *  set
     */
    public static function set( $key, $value )
    {
        return self::$session->set( $key, $value );
    }

    /**
     *  remove
     */
    public static function remove( $key )
    {
        self::$session->remove( $key );
    }

    /**
     *  destroy all
     */
    public static function destroy()
    {
        self::$session->destroy();
    }

}
