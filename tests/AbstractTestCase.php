<?php

namespace CodePress\CodeTag\tests;

use Orchestra\Testbench\TestCase;

abstract class AbstractTestCase extends TestCase {

    public function migrate() {
        $this->artisan('migrate', [
            '--realpath' => realpath(__DIR__ . '/../src/resources/migrations')
        ]);
    }

    protected function getEnvironmentSetUp($app) {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

}
