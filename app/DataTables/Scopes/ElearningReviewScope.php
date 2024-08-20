<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class ElearningReviewScope implements DataTableScope
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function apply($query)
    {
        return $query->when($this->request->filled('elearning_id'), function ($query) {
            $query->where('elearning_id', $this->request->elearning_id);
        })->when($this->request->filled('reviewer_id'), function ($query) {
            $query->where('reviewer_id', $this->request->reviewer_id);
        });
    }
}
