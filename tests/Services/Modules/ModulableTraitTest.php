<?php

/*
 * This file is part of Rocketeer
 *
 * (c) Maxime Fabre <ehtnam6@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Rocketeer\Services\Modules;

use Rocketeer\Dummies\Modules\DummyCatchallModule;
use Rocketeer\Dummies\Modules\DummyModulable;
use Rocketeer\Dummies\Modules\DummyModule;
use Rocketeer\TestCases\BaseTestCase;

class ModulableTraitTest extends BaseTestCase
{
    public function testCanRetrieveMethodInModule()
    {
        $modulable = new DummyModulable();
        $modulable->register(new DummyModule());

        $this->assertEquals('foobar', $modulable->foo());
    }

    public function testCanCallParentClass()
    {
        $modulable = new DummyModulable();
        $modulable->register(new DummyModule());

        $this->assertEquals('parent', $modulable->parent());
    }

    /**
     * @expectedException \Rocketeer\Services\Modules\ModuleNotFoundException
     */
    public function testThrowsExceptionOnNotFoundMethod()
    {
        $modulable = new DummyModulable();
        $modulable->nope();
    }

    public function testCanHaveDefaultModule()
    {
        $modulable = new DummyModulable();
        $modulable->register(new DummyCatchallModule());

        $this->assertEquals('default', $modulable->default());
    }
}
