<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Common helpers can live here
     * (factories, fake responses, shared assertions)
     */

    protected function setUp(): void
    {
        parent::setUp();
        // Global per-test setup (rarely needed)
    }

    protected function tearDown(): void
    {
        // Cleanup if needed
        parent::tearDown();
    }

    /**
     * Example shared assertion (optional)
     */
    protected function assertArrayHasKeys(array $keys, array $array): void
    {
        foreach ($keys as $key) {
            $this->assertArrayHasKey($key, $array);
        }
    }
}
