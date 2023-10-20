<?php

declare(strict_types=1);

namespace LaravelFeature\Tests\Domain;

use LaravelFeature\Domain\Model\Feature;
use PHPUnit\Framework\TestCase;

final class FeatureTest extends TestCase
{
    /**
     * Tests a simple feature object creation.
     */
    public function testFeatureCreation(): void
    {
        $feature = Feature::fromNameAndStatus('my.feature', false);

        $this->assertEquals('my.feature', $feature->getName());
        $this->assertFalse($feature->isEnabled());
    }

    /**
     * Tests the name change for a feature.
     */
    public function testNameChange(): void
    {
        $feature = Feature::fromNameAndStatus('old.name', false);
        $feature->setNewName('new.name');

        $this->assertEquals('new.name', $feature->getName());
    }

    /**
     * Tests the enable operation of a feature.
     */
    public function testEnable(): void
    {
        $feature = Feature::fromNameAndStatus('my.feature', false);

        $feature->enable();

        $this->assertTrue($feature->isEnabled());
    }

    /**
     * Tests the disable operation of a feature.
     */
    public function testDisable(): void
    {
        $feature = Feature::fromNameAndStatus('my.feature', true);

        $feature->disable();

        $this->assertFalse($feature->isEnabled());
    }
}
