<?php

namespace Cobalt\Form;

use Zend\InputFilter\InputFilter;

class UserFilter extends InputFilter
{
    public function __construct()
    {
        // Username
        $this->add(array(
            'name'       => 'username',
            'required'   => true,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 128,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // Display name
        $this->add(array(
            'name'       => 'displayName',
            'required'   => true,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 64,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // Email Address
        $this->add(array(
            'name'       => 'emailAddress',
            'required'   => false,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 256,
                    ),
                ),
                array(
                    'name' => 'EmailAddress'
                )
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // Telephone
        $this->add(array(
            'name'       => 'telephoneNumber',
            'required'   => false,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 32,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // Extension
        $this->add(array(
            'name'       => 'extensionNumber',
            'required'   => false,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 32,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // Mobile
        $this->add(array(
            'name'       => 'mobileNumber',
            'required'   => false,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 32,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // Company
        $this->add(array(
            'name'       => 'company',
            'required'   => false,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 64,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // Office
        $this->add(array(
            'name'       => 'office',
            'required'   => false
        ));
        
        // Department
        $this->add(array(
            'name'       => 'department',
            'required'   => false
        ));
        
        // Title
        $this->add(array(
            'name'       => 'title',
            'required'   => false,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 64,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // Reports to
        $this->add(array(
            'name'       => 'reportsTo',
            'required'   => false
        ));
    }
}