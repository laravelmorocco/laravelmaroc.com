<?php

declare(strict_types=1);

namespace LaravelFeature\Domain\Model;

final class Feature
{
    private $name;
    private $isEnabled;

    public static function fromNameAndStatus($name, $isEnabled)
    {
        $feature = new self($name, (bool) $isEnabled);
        return $feature;
    }

    private function __construct($name, $isEnabled)
    {
        $this->name = $name;
        $this->isEnabled = $isEnabled;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->isEnabled;
    }

    public function setNewName($newName): void
    {
        $this->name = $newName;
    }

    public function enable(): void
    {
        $this->isEnabled = true;
    }

    public function disable(): void
    {
        $this->isEnabled = false;
    }
}
