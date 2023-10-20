<?php

declare(strict_types=1);

namespace LaravelFeature\Tests\Domain;

use LaravelFeature\Domain\FeatureManager;
use LaravelFeature\Domain\Exception\FeatureException;
use LaravelFeature\Domain\Model\Feature;
use LaravelFeature\Domain\Repository\FeatureRepositoryInterface;
use LaravelFeature\Featurable\FeaturableInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

final class FeatureManagerTest extends TestCase
{
    /** @var FeatureRepositoryInterface|PHPUnit_Framework_MockObject_MockObject */
    private $repositoryMock;

    /** @var FeatureManager */
    private $manager;

    public function setUp(): void
    {
        parent::setUp();

        $this->repositoryMock = $this->getMockBuilder(FeatureRepositoryInterface::class)
            ->onlyMethods(['save', 'remove', 'findByName', 'enableFor', 'disableFor', 'isEnabledFor'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->manager = new FeatureManager($this->repositoryMock);
    }

    /**
     * Tests that everything goes well when adding a new feature to the system.
     */
    public function testAdd(): void
    {
        $this->repositoryMock->expects($this->once())
            ->method('save');

        $this->manager->add('my.feature', true);
    }

    /**
     * Tests an exception is thrown if something goes wrong during the saving of a new feature.
     */
    public function testAddThrowsExceptionOnError(): void
    {
        $this->repositoryMock->expects($this->once())
            ->method('save')
            ->willThrowException(new FeatureException('Unable to save the feature.'));

        $this->expectException(FeatureException::class);
        $this->expectExceptionMessage('Unable to save the feature.');

        $this->manager->add('my.feature', true);
    }

    /**
     * Tests that everything goes well during a feature removal.
     */
    public function testRemove(): void
    {
        $feature = $this->getMockBuilder(Feature::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock->expects($this->once())
            ->method('findByName')
            ->willReturn($feature);

        $this->repositoryMock->expects($this->once())
            ->method('remove');

        $this->manager->remove('my.feature');
    }

    public function testRemoveThrowsExceptionOnError(): void
    {
        $feature = $this->getMockBuilder(Feature::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock->expects($this->once())
            ->method('findByName')
            ->willReturn($feature);

        $this->repositoryMock->expects($this->once())
            ->method('remove')
            ->willThrowException(new FeatureException('Unable to remove the feature.'));

        $this->expectException(FeatureException::class);
        $this->expectExceptionMessage('Unable to remove the feature.');

        $this->manager->remove('my.feature');
    }

    /**
     * Tests that everything goes well during a feature rename.
     */
    public function testRenameFeature(): void
    {
        $feature = $this->getMockBuilder(Feature::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock->expects($this->once())
            ->method('findByName')
            ->willReturn($feature);

        $this->repositoryMock->expects($this->once())
            ->method('save');

        $this->manager->rename('old.name', 'new.name');
    }

    /**
     * Tests that an exception is thrown if the feature is not found.
     */
    public function testRenameFeatureThrowsError(): void
    {
        $feature = $this->getMockBuilder(Feature::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock->expects($this->once())
            ->method('findByName')
            ->willReturn($feature);

        $this->repositoryMock->expects($this->once())
            ->method('save')
            ->willThrowException(new FeatureException('Unable to save the feature.'));

        $this->expectException(FeatureException::class);
        $this->expectExceptionMessage('Unable to save the feature.');

        $this->manager->rename('old.feature', 'new.feature');
    }

    /**
     * Tests everything goes well when a feature is globally enabled.
     */
    public function testEnableFeature(): void
    {
        $feature = $this->getMockBuilder(Feature::class)
            ->disableOriginalConstructor()
            ->getMock();

        $feature->expects($this->once())
            ->method('enable');

        $this->repositoryMock->expects($this->once())
            ->method('findByName')
            ->willReturn($feature);

        $this->repositoryMock->expects($this->once())
            ->method('save');

        $this->manager->enable('my.feature');
    }

    /**
     * Tests everything goes well when a feature is globally disabled.
     */
    public function testDisableFeature(): void
    {
        $feature = $this->getMockBuilder(Feature::class)
            ->disableOriginalConstructor()
            ->getMock();

        $feature->expects($this->once())
            ->method('disable');

        $this->repositoryMock->expects($this->once())
            ->method('findByName')
            ->willReturn($feature);

        $this->repositoryMock->expects($this->once())
            ->method('save');

        $this->manager->disable('my.feature');
    }

    /**
     * Tests the manager can correctly check if a feature is enabled or not.
     */
    public function testFeatureIsEnabled(): void
    {
        $feature = $this->getMockBuilder(Feature::class)
            ->disableOriginalConstructor()
            ->getMock();

        $feature->expects($this->once())
            ->method('isEnabled')
            ->willReturn(true);

        $this->repositoryMock->expects($this->once())
            ->method('findByName')
            ->willReturn($feature);

        $this->assertTrue($this->manager->isEnabled('my.feature'));
    }

    public function testEnableFor(): void
    {
        /** @var FeaturableInterface|PHPUnit_Framework_MockObject_MockObject $featurableMock */
        $featurableMock = $this->getMockBuilder(FeaturableInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock->expects($this->once())
            ->method('enableFor');

        $this->manager->enableFor('my.feature', $featurableMock);
    }

    public function testDisableFor(): void
    {
        /** @var FeaturableInterface|PHPUnit_Framework_MockObject_MockObject $featurableMock */
        $featurableMock = $this->getMockBuilder(FeaturableInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock->expects($this->once())
            ->method('disableFor');

        $this->manager->disableFor('my.feature', $featurableMock);
    }

    public function testIsEnabledFor(): void
    {
        /** @var FeaturableInterface|PHPUnit_Framework_MockObject_MockObject $featurableMock */
        $featurableMock = $this->getMockBuilder(FeaturableInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock->expects($this->once())
            ->method('isEnabledFor');

        $this->manager->isEnabledFor('my.feature', $featurableMock);
    }
}
