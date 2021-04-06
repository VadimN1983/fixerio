# fixerio
Fixer API is capable of delivering real-time exchange rate data for 170 world currencies

*Examples*
---
The Fixer API comes with a constantly updated endpoint returning 
all available currencies.
```php
use \Thelema\Forex as FX;
FX\FixerIO::getInstance()->symbols();
```
#
Depending on your subscription plan, the API's latest endpoint will 
return real-time exchange rate data updated every 60 minutes, every 
10 minutes or every 60 seconds.

base	[optional] Enter the three-letter currency code of your preferred base currency.
symbols	[optional] Enter a list of comma-separated currency codes to limit output currencies.
```php
use \Thelema\Forex as FX;
FX\FixerIO::getInstance()->latest(string $base = null, string $rates = null);
```
#
Historical rates are available for most currencies all the way back to the year of 1999
```php
use \Thelema\Forex as FX;
FX\FixerIO::getInstance()->history('2015-02-04', 'EUR', 'USD,RUB');
```
#
The Fixer API comes with a separate currency conversion endpoint, which 
can be used to convert any amount from one currency to another.
```php
use \Thelema\Forex as FX;
FX\FixerIO::getInstance()->convert('EUR', 'USD,RUB', 25);
```
#
If supported by your subscription plan, the Fixer API's timeseries 
endpoint lets you query the API for daily historical rates between 
two dates of your choice, with a maximum time frame of 365 days.
```php
use \Thelema\Forex as FX;
FX\FixerIO::getInstance()->period('2001-01-01', '2001-01-30', 'EUR', 'USD,RUB');
```
For more information, please visit: https://fixer.io/documentation