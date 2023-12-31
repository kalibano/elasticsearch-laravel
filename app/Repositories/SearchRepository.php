<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface SearchRepository
{
    public function search($query = ''): Collection;
}
