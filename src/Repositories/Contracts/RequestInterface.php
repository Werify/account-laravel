<?php

namespace Werify\Account\Laravel\Repositories\Contracts;

interface RequestInterface
{
    public function generateApiUrl(string $path): string;

    public function getHeaders($token = null): array;
}
