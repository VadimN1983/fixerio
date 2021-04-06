<?php
require_once 'fixerio.php';

use \Thelema\Forex as FX;

echo '<pre>';
print_r(FX\FixerIO::getInstance()->symbols());
echo '</pre>';