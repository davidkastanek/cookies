<?php

use PHPUnit\Framework\TestCase;
use Gutter\Cookies\Manager;
use Nette\Http\Request;
use Nette\Http\Response;
use Gutter\Cookies\Cookie;

final class ManagerTest extends TestCase
{
    public function testSetCookie(): void
    {
        $request = $this->createMock(Request::class);
        $request->method('getCookies')->willReturn([]);
        $response = $this->createMock(Response::class);
        $response->method('setCookie');
        $response->method('deleteCookie');

        $cookies = new Manager('100 days', $request, $response);
        $cookies->set(new Cookie('abeceda', 'to je veda'));
        $cookie = $cookies->get('abeceda');

        $this->assertInstanceOf(Cookie::class, $cookie);
        $this->assertSame('to je veda', $cookie->getValue());
    }
}
