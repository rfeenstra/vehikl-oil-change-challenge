<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->registerValidationErrorMacro();
    }

    protected function registerValidationErrorMacro(): void
    {
        TestResponse::macro('assertValidationError', function ($key, $message) {
            $this->assertJsonValidationErrorFor($key);
            $this->assertJsonFragment([$key => [$message]]);
        });
    }
}
