<?php

// Path: tests\routerTest.php

use PHPUnit\Framework\TestCase;
use App\classes\router;

class routerTest extends TestCase
{
    public function testGet()
    {
        $router = new router();
        $router->get('/test', function () {
            return "test";
        });
        $_SERVER["REQUEST_URI"] = "/test";
        $this->assertEquals("Page not found", $router->run());
    }
}
