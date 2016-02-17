<?php

namespace Cobalt\Service;


use phpWhois\Whois;

class WhoisService
{
    public function lookup($domain)
    {
        $whois = new Whois();
        return  $whois->lookup($domain,false);
    }
}

