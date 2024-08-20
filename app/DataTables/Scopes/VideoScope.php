<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class VideoScope implements DataTableScope
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function apply($query)
    {
        return $query->when($this->request->created_by, function ($query) {
            $query->where('created_by', $this->request->created_by);
        })->when($this->request->category_id, function ($query) {
            $query->whereHas('categories', function ($query) {
                $query->where('category_id', $this->request->category_id);
            });
        });
    }
}
