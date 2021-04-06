<?php
require_once 'fixerio.php';

echo '<pre>';
print_r(\Thelema\Forex\FixerIO::getInstance()->symbols());
echo '</pre>';