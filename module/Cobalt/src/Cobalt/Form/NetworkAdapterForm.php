<?php

namespace Cobalt\Form;

/**
 * NetworkAdapterForm
 * 
 * @author Steve Rayner <srayner02@gmail.com>
 */
class NetworkAdapterForm extends HorizontalForm
{
    public function __construct()
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 4;
        $this->controlWidth = 8;
        
        $this->addText('name', 'Name')
             ->addText('dnsSuffix', 'DNS Suffix')
             ->addText('ipv6Address', 'IPv6 Address')
             ->addText('tempIpv6Address', 'Temp IPv6 Address')
             ->addText('localIpv6Address', 'Local IPv6 Address')
             ->addText('physicalAddress', 'Physical Address')
             ->addText('ipv4Address', 'IPv4 Address')
             ->addText('networkMask', 'Network Mask')
             ->addText('subnetMask', 'Subnet Mask')
             ->addText('defaultGateway', 'Default Gateway')
             ->addText('dhcpEnabled', 'DHCP Enabled')
             ->addText('preferredDnsServer', 'Preferred DNS Server')
             ->addText('alternameDnsServer', 'Alternate DNS Server')
             ->addButton('submit', 'Add', 'btn-primary');
    }
}