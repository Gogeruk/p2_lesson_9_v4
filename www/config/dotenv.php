<?php

/**Behind the scenes, this is instructing the "repository"
 * to allow immutability or not.
 * By default, the repository is configured to allow overwriting existing values
 * by default, which is relevant
 * if one is calling the "create"
 * method using the RepositoryBuilder to construct
 * a more custom repository:
 */

$rep = Dotenv\Repository\RepositoryBuilder::createWithNoAdapters()
    ->addWriter(Dotenv\Repository\Adapter\PutenvAdapter::class)
    ->addAdapter(Dotenv\Repository\Adapter\EnvConstAdapter::class)->make();

$dataenv = Dotenv\Dotenv::create($rep , realpath('../'));
$dataenv->load();
