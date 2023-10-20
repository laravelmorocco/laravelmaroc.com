<?php

declare(strict_types=1);

namespace Watson\Validating\Tests\Injectors;

use Mockery;
use Watson\Validating\Tests\TestCase;

final class UniqueWithInjectorTest extends TestCase
{
    public $trait;

    public function setUp(): void
    {
        $this->trait = Mockery::mock(UniqueWithValidatingStub::class)->makePartial();
    }

    public function testUpdateRulesUniquesUniqueWithWithUniquesInfersAttributes(): void
    {
        $this->trait->exists = true;

        $this->trait->setRules([
            'first_name' => 'unique_with:users,last_name'
        ]);

        $this->trait->updateRulesUniques();

        $result = $this->trait->getRules();

        $this->assertEquals(['first_name' => ['unique_with:users,last_name,1']], $result);
    }

    public function testUpdateRulesUniquesUniqueWithDoesNotOverrideProvidedParameters(): void
    {
        $this->trait->exists = true;

        $this->trait->setRules([
            'first_name' => 'unique_with:users,last_name,5'
        ]);

        $this->trait->updateRulesUniques();

        $result = $this->trait->getRules();

        $this->assertEquals(['first_name' => ['unique_with:users,last_name,5']], $result);
    }
}

final class UniqueWithValidatingStub extends \Illuminate\Database\Eloquent\Model
{
    use \Watson\Validating\Injectors\UniqueWithInjector;
    use \Watson\Validating\ValidatingTrait;

    public function getKey()
    {
        return 1;
    }
}
