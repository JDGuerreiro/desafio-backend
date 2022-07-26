<?php

namespace App\Repositories\Contracts;

use App\Models\Quote;

Interface QuoteRepositoryInterface
{

    public function __construct(Quote $quote);
    public function create($data);

}
