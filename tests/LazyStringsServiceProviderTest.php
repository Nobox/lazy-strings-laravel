<?php

namespace Nobox\LazyStrings\Tests;

use Illuminate\Support\Facades\Config;
use Nobox\LazyStrings\LazyStrings;
use Orchestra\Testbench\TestCase;

class LazyStringsServiceProviderTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return ['Nobox\LazyStrings\LazyStringsServiceProvider'];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('lazy-strings.csv-url', 'http://docs.google.com/spreadsheets/d/1V_cHt5Fe4x9XwVepvlXB39sqKXD3xs_QbM-NppkrE4A/export?format=csv');
        $app['config']->set('lazy-strings.sheets', array('en' => 0));
        $app['config']->set('lazy-strings.target-folder', 'lazy-strings');
        $app['config']->set('lazy-strings.nested', true);
        $app['config']->set('lazy-strings.strings-route', 'build-copy');
    }

    /**
     * @test
     */
    public function it_shows_strings_generation_view()
    {
        $this->call('GET', '/lazy/build-copy');
        $this->assertResponseOk();
        $this->assertViewHas('refreshedBy');
        $this->assertViewHas('refreshedOn');
    }
}
