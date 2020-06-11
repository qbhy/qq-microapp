<?php

namespace Qbhy\QqMicroApp;

/**
 * Class Factory
 * @package Qbhy\QqMicroApp
 */
class Factory
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var QqMicroApp[]
     */
    protected $drivers = [];

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function make(?string $name = 'default', ?array $config = null)
    {
        $name = $name ?? 'default';
        if (empty($this->config['drivers'][$name])) {
            throw new QqMicroAppException("Undefined {$name} application");
        }

        $config = $config ?? $this->config['drivers'][$name];

        if (empty($config['debug'])) {
            $config['debug'] = $this->config['debug'] ?? true;
        }

        return $this->drivers[$name] ?? $this->drivers[$name] = new QqMicroApp($config);
    }
}