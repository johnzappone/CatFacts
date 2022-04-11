<?php

namespace App\Repositories;

interface FactRepositoryInterface
{
    // returns specific amount
    public function get($limit);
}
