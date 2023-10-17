<?php

declare(strict_types=1);

namespace Watson\Validating\Tests;

use Mockery;

final class ValidatingModelTest extends TestCase
{
    public function testGetMessageBagCallsGetErrors(): void
    {
        $mock = Mockery::mock('Watson\Validating\ValidatingModel[getErrors]');

        $mock->shouldReceive('getErrors')->once()->andReturn('foo');

        $result = $mock->getMessageBag();

        $this->assertEquals('foo', $result);
    }
}
