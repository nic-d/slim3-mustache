<?php
/**
 * Created by PhpStorm.
 * User: nic
 * Date: 24/05/2017
 * Time: 08:52
 */

namespace Slim\Views;

use Psr\Http\Message\ResponseInterface;

/**
 * Class Mustache
 * @package Slim\Views
 */
class Mustache
{
    /** @var \Mustache_Engine $mustache */
    protected $mustache;

    /**
     * Mustache constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->setMustache(new \Mustache_Engine($options));
    }

    /**
     * Returns the rendered mustache template.
     *
     * @param string $template
     * @param array $data
     * @return string
     */
    public function fetch($template, array $data)
    {
        return $this->getMustache()->render($template, $data);
    }

    /**
     * Renders the template with PSR7 Response object.
     *
     * @param ResponseInterface $response
     * @param $template
     * @param array $data
     * @return ResponseInterface
     */
    public function render(ResponseInterface $response, $template, array $data = [])
    {
        $response->getBody()->write($this->fetch($template, $data));
        return $response;
    }

    # ---------------------------------------------------------------
    # - GETTERS AND SETTERS
    # ---------------------------------------------------------------

    /**
     * @return \Mustache_Engine
     */
    public function getMustache()
    {
        return $this->mustache;
    }

    /**
     * @param \Mustache_Engine $mustache
     */
    protected function setMustache($mustache)
    {
        $this->mustache = $mustache;
    }
}