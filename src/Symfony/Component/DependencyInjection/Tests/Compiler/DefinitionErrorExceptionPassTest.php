<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Tests\Compiler;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Compiler\DefinitionErrorExceptionPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

class DefinitionErrorExceptionPassTest extends TestCase
{
    public function testThrowsException()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Things went wrong!');
        $container = new ContainerBuilder();
        $def = new Definition();
        $def->addError('Things went wrong!');
        $def->addError('Now something else!');
        $container->register('foo_service_id')
            ->setArguments([
                $def,
            ]);

        $pass = new DefinitionErrorExceptionPass();
        $pass->process($container);
    }

    public function testNoExceptionThrown()
    {
        $container = new ContainerBuilder();
        $def = new Definition();
        $container->register('foo_service_id')
            ->setArguments([
                $def,
            ]);

        $pass = new DefinitionErrorExceptionPass();
        $pass->process($container);
        $this->assertSame($def, $container->getDefinition('foo_service_id')->getArgument(0));
    }

    public function testSkipErrorFromTag()
    {
        $container = new ContainerBuilder();
        $def = new Definition();
        $def->addError('Things went wrong!');
        $def->addTag('container.error');
        $container->register('foo_service_id')
            ->setArguments([$def]);

        $pass = new DefinitionErrorExceptionPass();
        $pass->process($container);
        $this->assertSame($def, $container->getDefinition('foo_service_id')->getArgument(0));
    }
}
