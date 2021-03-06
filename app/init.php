<?php

error_reporting(E_ALL ^ E_NOTICE);
ini_set('html_errors','Off');
ini_set('display_errors','Off');

// debug mode
if (isset($_SERVER['IS_DEVELOPER_MODE'])) {
    error_reporting(E_ALL);
    ini_set('html_errors','On');
    ini_set('display_errors','On');
}

if ( !in_array('phalcon', get_loaded_extensions() ) ) {
    echo 'Framework Disabled';
    exit;
}

$configFile = realpath(__DIR__.'/config/config.php' ) or die('Please setting "config.php" file');
require_once($configFile);

include 'helper.php';

/**
 *  init
 */
$factoryApplication = function()
{
    $appPath = APPLICATION_BASE_PATH . '/app';

    // Register an autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(array(
        $appPath .'/event/',
        $appPath .'/models/',
        $appPath .'/models/modelHelper/',
        $appPath .'/components/bridge/',
        $appPath .'/components/developer/',
        $appPath .'/components/helper/',
        $appPath .'/components/identity/',
        $appPath .'/components/manager/',
        $appPath .'/components/magento/',
        $appPath .'/'. APPLICATION_PORTAL .'_mods/',
        $appPath .'/'. APPLICATION_PORTAL .'_mods/components/',
    ));
    $loader->registerClasses(array(
        'File_CSV_DataSource'   => $appPath .'/vendors/csv_parser/File_CSV_DataSource.php',
        'SqlFormatter'          => $appPath .'/vendors/csv_parser/SqlFormatter.php',
    ));
    $loader->registerNamespaces(array(
        'Whoops'                => $appPath .'/vendors/whoops/',
        'Blocks'                => $appPath .'/'. APPLICATION_PORTAL .'_mods/blocks/',
    ));
    $loader->register();

    // start and get application
    $app = require( $appPath .'/'. APPLICATION_PORTAL . '_mods/setting/start.php' );

    SessionBrg::init();
    CookiesBrg::init();

    // url() helper function
    RegisterManager::set('url', $app->url );

    //
    LogBrg::init(   APPLICATION_BASE_PATH .'/app/tmp/log/'   );
    CacheBrg::init( APPLICATION_BASE_PATH .'/app/tmp/cache/' );

    /**
     *  zend loader
     */
    $zendLoader = function()
    {
        require_once APPLICATION_BASE_PATH . '/app/vendors/Zend/Loader/StandardAutoloader.php';
        
        $loader = new Zend\Loader\StandardAutoloader(array(
            'autoregister_zf' => true,
            'namespaces' => array(
                'Ydin'    => APPLICATION_BASE_PATH . '/app/vendors/Ydin',
                'Imagine' => APPLICATION_BASE_PATH . '/app/vendors/Imagine',
            ),
        ));
        $loader->register();
    };
    $zendLoader();

    // event init
    Ydin\Event::init( APPLICATION_BASE_PATH . '/app/event' );

    // init footer
    Ydin\Event::notify('init_footer', array('app'=>$app) );

    return $app;
};


