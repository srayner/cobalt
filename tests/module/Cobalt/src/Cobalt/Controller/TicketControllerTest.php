<?php

namespace Cobalt\Controller;

use Cobalt\Controller\TicketController;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use PHPUnit_Framework_TestCase;

class TicketControllerTest extends PHPUnit_Framework_TestCase
{
    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;

    protected function setUp()
    {
        $bootstrap      = \Zend\Mvc\Application::init(include 'config/application.config.php');
        $serviceManager = $bootstrap->getServiceManager();
        $service = $serviceManager->get('Cobalt\EntityService\TicketService');
     
        $this->controller = new TicketController($service);
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'ticket'));
        $this->event      = $bootstrap->getMvcEvent();
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
        $this->controller->setEventManager($bootstrap->getEventManager());
        $this->controller->setServiceLocator($bootstrap->getServiceManager());
    }
    
    public function testIndexActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'index');

        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
        $this->assertArrayHasKey('tickets', $result->getVariables());
    }
    
    public function testAddActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'add');

        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
        $this->assertArrayHasKey('form', $result->getVariables());
    }
    
}