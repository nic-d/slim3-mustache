<?php

/**
 * Created by PhpStorm.
 * User: nic
 * Date: 25/05/2017
 * Time: 05:50
 */

namespace Slim\Tests\Views;

use Slim\Views\Mustache;
use PHPUnit\Framework\TestCase;

require dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Class MustacheTest
 * @package Slim\Tests\Views
 */
class MustacheTest extends TestCase
{
    /** @var Mustache $mustache */
    protected $mustache;
    protected $data = "Hello {{ variable }}!";

    public function setUp()
    {
        $this->mustache = new Mustache([]);
    }

    public function testFetch()
    {
        $output = $this->mustache->fetch($this->data, [
            'variable' => 'world',
        ]);

        $this->assertEquals("Hello world!", $output);
    }

    public function testRender()
    {
        $mockBody = $this->getMockBuilder('Psr\Http\Message\StreamInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $mockResponse = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $mockBody->expects($this->once())
            ->method('write')
            ->with("Hello world!")
            ->willReturn(12);

        $mockResponse->expects($this->once())
            ->method('getBody')
            ->willReturn($mockBody);

        $response = $this->mustache->render($mockResponse, $this->data, [
            'variable' => 'world',
        ]);

        $this->assertInstanceOf('Psr\Http\Message\ResponseInterface', $response);
    }
}