<?php
$phar = new Phar('index.phar');
$phar->buildFromDirectory(dirname(__FILE__) . '/src');
$phar->setStub('<?php include(\'phar://\' . __FILE__ . \'/index.php\');__HALT_COMPILER();');

rename(dirname(__FILE__) . '/index.phar', dirname(__FILE__) . '/dist/index.php');