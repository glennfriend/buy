<?php
namespace Blocks\AppConfig;

/**
 *  get all app config
 *
 *  PS. 警告! 不要把 path (實體路徑) 在 type=public 的悄況下傳出去
 *      public 的情況有可能被輸出為 json, 所有使用者會看的見
 *      json  輸出表示為 public
 *      任何私有 path 可以輸出為 array
 *      但是絕不能輸出 json
 *      如有 path 路徑 (如 /var/www/project)
 *      一律在輸出成 json 之前要刪除該值!!
 *
 *  @param type "public" or "private"
 *  @return array
 */
class Block extends \Blocks\BaseBlock
{

    public function __construct( $type='public' )
    {
        $config = array(
            'portal'    => APPLICATION_PORTAL,
         // 'baseUri'   => Yii::app()->baseUrl ,
         // 'themeUri'  => Yii::app()->baseUrl . '/themes' ,
            'homeUri'   => APPLICATION_HOME_URI ,
            'httpHost'  => $_SERVER['HTTP_HOST'] ,
        );

        if ( 'private' !== $type ) {
            $this->value = $config;
            return;
        }

        // private
        /*
        $config += array(
            'baesPath' => '',
        );
        */

        $this->value = $config;
        return;

        /*
            json output
                  "var app = app || {};\n"
                . 'app.config=' . json_encode($config)
                . ";\n";
        */
    }

}