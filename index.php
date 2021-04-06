<?php
require_once 'fixerio.php';

use \Thelema\Forex as FX;

echo '<pre>';

// print_r(FX\FixerIO::getInstance()->symbols();
// print_r(FX\FixerIO::getInstance()->latest();
// print_r(FX\FixerIO::getInstance()->latest('EUR', 'USD,RUB'));
// print_r(FX\FixerIO::getInstance()->history('2015-02-04', 'EUR', 'USD,RUB'));
// print_r(FX\FixerIO::getInstance()->convert('EUR', 'USD,RUB', 25));
// print_r(FX\FixerIO::getInstance()->period('2001-01-01', '2001-01-30', 'EUR', 'USD,RUB'));

print_r(FX\FixerIO::getInstance()->latest('EUR', 'USD,RUB'));

echo '</pre>';