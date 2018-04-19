<?php

namespace Gutter\Cookies;

use Nette\SmartObject;

/**
 * Example:
 * <code>
 * <?php
 * new \Gutter\Cookies\Cookie('id', 'article-1', '100 days');
 * ?>
 * </code>
 */
class Cookie
{
    use SmartObject;

    /** @var string */
    private $name;

    /** @var string */
    private $value;

    /** @var string */
    private $maxAge;

    /**
     * @param string $name
     * @param string $value
     * @param string $maxAge
     */
    public function __construct($name, $value, $maxAge = null)
    {
        $this->name = $name;
        $this->value = $value;
        $this->maxAge = $maxAge;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getMaxAge()
    {
        return $this->maxAge;
    }
}
