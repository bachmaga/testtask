<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\EventListener\BadRequestHttpExceptionToJsonListener;

return function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();
    $services->defaults()
        ->autowire(true)
        ->autoconfigure(true);

    $services->load('App\\', '../src/*')
        ->exclude('../src/{DependencyInjection,Entity,Tests,Kernel.php}');

    $services->load('App\\Controller\\', '../src/Controller')
        ->tag("controller.service_arguments");

    $services->set(BadRequestHttpExceptionToJsonListener::class)
        ->tag(
            'kernel.event_listener',
            [
                'event' => 'kernel.exception',
            ],
        );
};
