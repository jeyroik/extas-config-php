![PHP Composer](https://github.com/jeyroik/extas-config-php/workflows/PHP%20Composer/badge.svg?branch=master)
![codecov.io](https://codecov.io/gh/jeyroik/extas-config-php/coverage.svg?branch=master)

[![Latest Stable Version](https://poser.pugx.org/jeyroik/extas-config-php/v)](//packagist.org/packages/jeyroik/extas-jsonrpc)
[![Total Downloads](https://poser.pugx.org/jeyroik/extas-config-php/downloads)](//packagist.org/packages/jeyroik/extas-jsonrpc)
[![Dependents](https://poser.pugx.org/jeyroik/extas-config-php/dependents)](//packagist.org/packages/jeyroik/extas-jsonrpc)

# extas-config-php

Generate extas.json from php config

# install

`# composer require jeyroik/extas-config-php`

# usage

`# vendor/bin/extas-cfg-php g`

See help for details:

`# vendor/bin/extas-cfg-php -h`

# result example

extas.php
```php
<?php

return [
    "tables" => []
];
```

Result:

extas.json
```json
{
    "tables": [

    ]
}
```