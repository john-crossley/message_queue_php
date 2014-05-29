<?php

class RouteTest extends PHPUnit_Framework_TestCase {

    protected $route;

    public function setUp()
    {
        $this->route = new \Banshee\Route;
    }

    /**
     * @test
     */
    public function itCanBeInstantiated()
    {
        $this->assertInstanceOf('\Banshee\Route', $this->route);
    }

    /**
     * @test
     */
    public function itCanStoreRoutes()
    {
        $this->route->get('/', function () {});
        $this->route->get('/hello', function () {});

        $routes = $this->route->getRoutes();
        $this->assertArrayHasKey('/', $routes);
        $this->assertArrayHasKey('/hello', $routes);
    }

    /**
     * @test
     */
    public function itExecutesTheCorrectRouteWhenInvoked()
    {
        $this->route->get('/', function () {
            return "Hello Banshee!";
        });

        $this->route->get('/awesomesauce', function () {
            return "Awesomesauce!";
        });

        $response = $this->route->run('/'); // Should really use something like guzzle
        $this->assertEquals("Hello Banshee!", $response);

        $response = $this->route->run('/awesomesauce');
        $this->assertEquals("Awesomesauce!", $response);
    }

    /**
     * @test
     * @expectedException \Banshee\BansheeRouteException
     */
    public function itThrowsBansheeRouteExceptionWhenARouteIsNotFound()
    {
        $this->route->run('/idontexist');
    }

}
