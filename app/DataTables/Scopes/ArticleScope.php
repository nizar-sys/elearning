<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class ArticleScope implements DataTableScope
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function apply($query)
    {
        return $query->when($this->request->category_id, function ($query) {
            return $query->where('category_id', $this->request->category_id);
        })->when($this->request->created_by, function ($query) {
            return $query->where('created_by', $this->request->created_by);
        })->when($this->request->status, function ($query) {
            return $query->where('status', $this->request->status);
        });
    }
}
