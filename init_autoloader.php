<?php
$zf2Path = getenv('ZF2_PATH');

if ($zf2Path) {
    include $zf2Path . '/Zend/Loader/AutoloaderFactory.php';

    Zend\Loader\AutoloaderFactory::factory(array(
        'Zend\Loader\StandardAutoloader' => array(
            'autoregister_zf' => true
        )
    ));
}

if (!class_exists('Zend\Loader\AutoloaderFactory')) {
    throw new RuntimeException('Não foi possível carregar o ZF2.');
}
