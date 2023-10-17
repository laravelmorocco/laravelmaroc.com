<?php

declare(strict_types=1);

namespace Watson\Validating\Tests;

use Mockery;
use Watson\Validating\ValidationException;

final class ValidationExceptionTest extends TestCase
{
    public $validator;

    public $model;

    public $exception;

    public function setUp(): void
    {
        //$this->validator = Mockery::mock(\Illuminate\Contracts\Validation\Validator::class);
        $this->validator = Mockery::mock(\Illuminate\Contracts\Validation\Validator::class, function ($mock): void {
            $mock
                ->shouldReceive('errors')
                ->once()
                ->andReturn();
        });


        //$this->model = Mockery::mock('Illuminate\Database\Eloquent\Model');

        $this->model = Mockery::mock(\Illuminate\Database\Eloquent\Model::class, function ($mock): void {
            $mock
                ->shouldReceive([])
                ->andReturn($this);
        });

        $this->exception = new ValidationException(
            $this->validator,
            $this->model
        );
    }

    public function testModel(): void
    {
        $this->assertEquals($this->model, $this->exception->model());
    }

    public function testGetModel(): void
    {
        $this->assertEquals($this->model, $this->exception->getModel());
    }

    public function testGetErrors(): void
    {
        $this->validator->shouldReceive('errors')
            ->once()
            ->andReturn('errors');

        $this->assertEquals('errors', $this->exception->getErrors());
    }

    public function testGetsMessageBag(): void
    {
        $this->validator->shouldReceive('errors')
            ->once()
            ->andReturn('errors');

        $this->assertEquals('errors', $this->exception->getMessageBag());
    }
}
