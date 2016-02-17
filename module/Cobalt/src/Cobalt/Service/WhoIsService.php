<?php

namespace Cobalt\Service;

// Load composer framework
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require(__DIR__ . '/vendor/autoload.php');
}

use phpWhois\Whois;

class WhoisService
{
    public function lookup($domain)
    {
        $whois = new Whois();
        return  $whois->lookup($domain,false);
    }
}

