<?php

declare(strict_types=1);

namespace Watson\Validating\Tests\Injectors;

use Mockery;
use Watson\Validating\Tests\TestCase;

final class UniqueInjectorTest extends TestCase
{
    public $trait;

    public function setUp(): void
    {
        $this->trait = Mockery::mock(UniqueValidatingStub::class)->makePartial();
    }

    public function testUpdateRulesUniquesWithoutUniques(): void
    {
        $this->trait->setRules(['user_id' => ['required']]);

        $this->trait->updateRulesUniques();

        $result = $this->trait->getRules();

        $this->assertEquals(['user_id' => ['required']], $result);
    }

    public function testUpdateRulesUniquesWithUniquesInfersAttributes(): void
    {
        $this->trait->exists = true;

        $this->trait->shouldReceive('getTable')->andReturn('users');

        $this->trait->setRules(['user_id' => 'unique']);

        $this->trait->updateRulesUniques();

        $result = $this->trait->getRules();

        $this->assertEquals(['user_id' => ['unique:sqlite.users,user_id,1,id']], $result);
    }

    public function testGetPreparedRulesUniques(): void
    {
        $this->trait->exists = true;

        $this->trait->shouldReceive('getTable')->andReturn('users');

        $this->trait->setRules(['user_id' => 'unique']);

        $result = $this->trait->getPreparedRules();

        $this->assertEquals(['user_id' => ['unique:sqlite.users,user_id,1,id']], $result);
    }

    public function testUpdateRulesUniquesWithUniquesAndAdditionalWhereClauseInfersAttributes(): void
    {
        $this->trait->exists = true;

        $this->trait->shouldReceive('getTable')->andReturn('users');

        $this->trait->setRules(['user_id' => 'unique:users,user_id,1,id,username,null']);

        $this->trait->updateRulesUniques();

        $result = $this->trait->getRules();

        $this->assertEquals(['user_id' => ['unique:sqlite.users,user_id,1,id,username,test']], $result);
    }

    public function testUpdateRulesUniquesWithUniquesAndAdditionalWhereClauseInfersAttributesMaintainingNULLValue(): void
    {
        $this->trait->exists = true;

        $this->trait->shouldReceive('getTable')->andReturn('users');

        $this->trait->setRules(['user_id' => 'unique:users,user_id,1,id,deleted,null']);

        $this->trait->updateRulesUniques();

        $result = $this->trait->getRules();

        $this->assertEquals(['user_id' => ['unique:sqlite.users,user_id,1,id,deleted,NULL']], $result);
    }

    public function testUpdateRulesUniquesWithNonPersistedModelInfersAttributes(): void
    {
        $this->trait->shouldReceive('getTable')->andReturn('users');

        $this->trait->setRules(['user_id' => 'unique']);

        $this->trait->updateRulesUniques();

        $result = $this->trait->getRules();

        $this->assertEquals(['user_id' => ['unique:sqlite.users,user_id']], $result);
    }

    public function testUpdateRulesUniquesWorksWithMultipleUniques(): void
    {
        $this->trait->shouldReceive('getTable')->andReturn('users');

        $this->trait->setRules([
            'email' => 'unique',
            'slug'  => 'unique'
        ]);

        $this->trait->updateRulesUniques();

        $result = $this->trait->getRules();

        $this->assertEquals([
            'email' => ['unique:sqlite.users,email'],
            'slug'  => ['unique:sqlite.users,slug']
        ], $result);
    }

    public function testUpdateRulesUniquesDoesNotOverrideProvidedParameters(): void
    {
        $this->trait->setRules(['users' => 'unique:foo,bar,5,bat']);

        $this->trait->updateRulesUniques();

        $result = $this->trait->getRules();

        $this->assertEquals(['users' => ['unique:sqlite.foo,bar,5,bat']], $result);
    }
}

final class UniqueValidatingStub extends \Illuminate\Database\Eloquent\Model
{
    use \Watson\Validating\ValidatingTrait;

    protected $username = 'test';
    protected $deleted = null;

    public function getKey()
    {
        return 1;
    }

    public function getConnectionName()
    {
        return 'sqlite';
    }
}
