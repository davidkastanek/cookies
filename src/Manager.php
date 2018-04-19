<?php

namespace Gutter\Cookies;

use Nette\Http\IRequest;
use Nette\Http\IResponse;
use Nette\SmartObject;

/**
 * @todo Enable setting and getting of array values.
 */
class Manager
{
    use SmartObject;

    /** @var string */
    private $maxAge;

    /** @var IRequest */
    private $request;

    /** @var IResponse */
    private $response;

    /** @var array Cookies cache */
    private $cookies;

    /** @var array Destroyed cookies */
    private $destroyed = [];

    /**
     * @param string $maxAge Default max age for cookies.
     * @param IRequest $request
     * @param IResponse $response
     */
    public function __construct($maxAge, IRequest $request, IResponse $response)
    {
        $this->maxAge = $maxAge;
        $this->request = $request;
        $this->response = $response;

        foreach ($this->request->getCookies() as $name => $value) {
            $this->cookies[$name] = new Cookie($name, $value);
        }
    }

    /**
     * Get cookie.
     * Creates and returns cookie of default value, if not exist.
     * @param string $name
     * @param string $default
     * @return Cookie
     */
    public function get($name, $default = null)
    {
        if (isset($this->cookies[$name])) {
            return $this->cookies[$name];
        }

        if (isset($this->destroyed[$name])) {
            return new Cookie($name, null);
        }

        $value = $this->request->getCookie($name);
        if ($value) {
            $cookie = new Cookie($name, $value);
            $this->cookies[$cookie->name] = $cookie;

            return $cookie;
        }

        if ($default) {
            $cookie = new Cookie($name, $default);
            $this->set($cookie);

            return $cookie;
        }

        return new Cookie($name, null);
    }

    /**
     * Store cookie.
     * @param Cookie $cookie
     */
    public function set(Cookie $cookie)
    {
        $this->cookies[$cookie->getName()] = $cookie;
        $this->response->setCookie($cookie->getName(), $cookie->getValue(), $cookie->getMaxAge());
    }

    /**
     * Delete cookie.
     * @param Cookie $cookie
     */
    public function destroy(Cookie $cookie)
    {
        $this->response->deleteCookie($cookie->getName());
        $this->destroyed[$cookie->getName()] = $cookie;
        unset($this->cookies[$cookie->getName()]);
    }
}
