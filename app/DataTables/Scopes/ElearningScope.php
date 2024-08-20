<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class ElearningScope implements DataTableScope
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function apply($query)
    {
        return $query->when($this->request->filled('teacher_id'), function ($query) {
            $query->where('teacher_id', $this->request->teacher_id);
        })->when($this->request->filled('benefit_id'), function ($query) {
            $query->where('benefit_id', $this->request->benefit_id);
        })->when($this->request->filled('status'), function ($query) {
            $query->where('status', $this->request->status);
        })->when($this->request->category_id, function ($query) {
            $query->whereHas('categories', function ($query) {
                $query->where('category_id', $this->request->category_id);
            });
        })->when($this->request->material_id, function ($query) {
            $query->whereHas('materials', function ($query) {
                $query->where('material_id', $this->request->material_id);
            });
        });
    }
}
