<?php

$relationships = getenv("PLATFORM_RELATIONSHIPS");

if (!$relationships) {
    return;
}

$relationships = json_decode(base64_decode($relationships), true);

foreach ($relationships['database'] as $endpoint) {
    if (empty($endpoint['query']['is_master'])) {
      continue;
    }

    $container->setParameter('sylius.database.driver', 'pdo_' . $endpoint['scheme']);
    $container->setParameter('sylius.database.host', $endpoint['host']);
    $container->setParameter('sylius.database.port', $endpoint['port']);
    $container->setParameter('sylius.database.name', $endpoint['path']);
    $container->setParameter('sylius.database.user', $endpoint['username']);
    $container->setParameter('sylius.database.password', $endpoint['password']);
    $container->setParameter('sylius.database.path', '');
}

$container->setParameter('sylius.redis.host', $relationships['redis'][0]['host']);
$container->setParameter('sylius.redis.port', $relationships['redis'][0]['port']);

ini_set('session.save_path', '/tmp/sessions');
