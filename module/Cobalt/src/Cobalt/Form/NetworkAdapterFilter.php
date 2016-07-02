<?php

namespace Cobalt\Form;

/**
 * NetworkAdapterFilter
 * 
 * @author Steve Rayner <srayner02@gmail.com>
 */
class NetworkAdapterFilter extends AbstractFilter
{
    public function __construct()
    {
        $this->addTextFilter('name', true, 128)
             ->addTextFilter('dnsSuffix', true, 64)
             ->addTextFilter('ipv6Address', false, 45)
             ->addTextFilter('tempIpv6Address', false, 45)
             ->addTextFilter('localIpv6Address', false, 45)
             ->addTextFilter('physicalAddress', false, 17)
             ->addTextFilter('ipv4Address', false, 15)
             ->addTextFilter('networkMask', false, 15)
             ->addTextFilter('subnetMask', false, 15)
             ->addTextFilter('defaultGateway', false, 15)
             ->addTextFilter('dhcpEnabled', false, 3)
             ->addTextFilter('preferredDnsServer', false, 15)
             ->addTextFilter('alternameDnsServer', false, 15);
    }
}