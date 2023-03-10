<?php

declare(strict_types=1);

namespace Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Config;
use BladeUI\Icons\BladeIconsServiceProvider;
use Codeat3\BladePepicons\BladePepiconsServiceProvider;

class CompilesIconsTest extends TestCase
{
    /** @test */
    public function it_compiles_a_single_anonymous_component()
    {
        $result = svg('pepicon-chain')->toHtml();

        // Note: the empty class here seems to be a Blade components bug.
        $expected = <<<'SVG'
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none"><rect x="12.7835" y="2.38351" width="6" height="10" rx="3" transform="rotate(33.0385 12.7835 2.38351)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><rect x="7.83558" y="6.32284" width="6" height="10" rx="3" transform="rotate(33.0385 7.83558 6.32284)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            SVG;


        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_classes_to_icons()
    {
        $result = svg('pepicon-chain', 'w-6 h-6 text-gray-500')->toHtml();
        $expected = <<<'SVG'
            <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none"><rect x="12.7835" y="2.38351" width="6" height="10" rx="3" transform="rotate(33.0385 12.7835 2.38351)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><rect x="7.83558" y="6.32284" width="6" height="10" rx="3" transform="rotate(33.0385 7.83558 6.32284)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            SVG;
        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_styles_to_icons()
    {
        $result = svg('pepicon-chain', ['style' => 'color: #555'])->toHtml();


        $expected = <<<'SVG'
            <svg style="color: #555" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none"><rect x="12.7835" y="2.38351" width="6" height="10" rx="3" transform="rotate(33.0385 12.7835 2.38351)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><rect x="7.83558" y="6.32284" width="6" height="10" rx="3" transform="rotate(33.0385 7.83558 6.32284)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_default_class_from_config()
    {
        Config::set('blade-pepicons.class', 'awesome');

        $result = svg('pepicon-chain')->toHtml();

        $expected = <<<'SVG'
            <svg class="awesome" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none"><rect x="12.7835" y="2.38351" width="6" height="10" rx="3" transform="rotate(33.0385 12.7835 2.38351)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><rect x="7.83558" y="6.32284" width="6" height="10" rx="3" transform="rotate(33.0385 7.83558 6.32284)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            SVG;

        $this->assertSame($expected, $result);

    }

    /** @test */
    public function it_can_merge_default_class_from_config()
    {
        Config::set('blade-pepicons.class', 'awesome');

        $result = svg('pepicon-chain', 'w-6 h-6')->toHtml();

        $expected = <<<'SVG'
            <svg class="awesome w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none"><rect x="12.7835" y="2.38351" width="6" height="10" rx="3" transform="rotate(33.0385 12.7835 2.38351)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><rect x="7.83558" y="6.32284" width="6" height="10" rx="3" transform="rotate(33.0385 7.83558 6.32284)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            SVG;

        $this->assertSame($expected, $result);

    }

    protected function getPackageProviders($app)
    {
        return [
            BladeIconsServiceProvider::class,
            BladePepiconsServiceProvider::class,
        ];
    }
}
