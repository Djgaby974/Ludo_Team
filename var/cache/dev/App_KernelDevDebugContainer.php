<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerE25YYRz\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerE25YYRz/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerE25YYRz.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerE25YYRz\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerE25YYRz\App_KernelDevDebugContainer([
    'container.build_hash' => 'E25YYRz',
    'container.build_id' => '43cd2355',
    'container.build_time' => 1737101388,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerE25YYRz');
