<?php

/**
 *  為了讓系統架構更容易 插入 非主要功能的程式碼
 *  使用該方式來於處理副程式
 *
 *  注意: 不適當的使用, 會使系統變慢
 *
 */
class EventManager
{

    /**
     *  目前不考慮做成動態
     *  行為的定義必須要好好考量, 以避免成為效能地獄
     *
     *  @return array
     */
    public static function getEventList()
    {
        return array(
            'DebugModeEvent',
            'DatabaseAccessEvent',
        );
    }

    /**
     *  呼叫已訂閱的 event 程式
     *
     *  @param string programName
     */
    public static function notify( $method, $params )
    {
        $method = trim($method);

        $eventList = self::getEventList();
        foreach ( $eventList as $className ) {
            $handler = array( $className, $method );
            if ( !is_callable($handler) ) {
                continue;
            }
            // forward_static_call_array( $handler , $params );

            $class = new $className();
            $class->$method( $params );
        }
    }

}

