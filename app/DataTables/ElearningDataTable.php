<?php

namespace App\DataTables;

use App\Enums\ElearningStatus;
use App\Models\Elearning;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ElearningDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $badgeColors = ['primary', 'success', 'danger', 'warning', 'info'];

        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', 'console.elearnings.action')
            ->editColumn('description', function ($query) {
                return str()->limit($query->description, 50);
            })
            ->editColumn('thumbnail', function ($query) {
                return '<img width="100" src="' . $query->thumbnail . '" class="img-fluid" alt="' . $query->title . '">';
            })
            ->editColumn('status', function ($query) {
                $badge = match ($query->status) {
                    ElearningStatus::ACTIVE => 'bg-label-success',
                    default => 'bg-label-danger',
                };

                return '<span class="badge rounded-pill ' . $badge . '">' . ucfirst($query->status) . '</span>';
            })
            ->editColumn('categories', function ($query) use ($badgeColors) {
                if ($query->categories->isEmpty()) {
                    return '<span class="badge rounded-pill bg-label-secondary m-1">Have No Category</span>';
                }
                return $query->categories->map(function ($category) use ($badgeColors) {
                    $color = $badgeColors[array_rand($badgeColors)];
                    return '<span class="badge rounded-pill bg-label-' . $color . ' m-1">' . $category->name . '</span>';
                })->implode(' ');
            })
            ->editColumn('materials', function ($query) use ($badgeColors) {
                if ($query->materials->isEmpty()) {
                    return '<span class="badge rounded-pill bg-label-secondary m-1">Have No Material</span>';
                }
                return $query->materials->map(function ($material) use ($badgeColors) {
                    $color = $badgeColors[array_rand($badgeColors)];
                    return '<span class="badge rounded-pill bg-label-' . $color . ' m-1">' . $material->title . '</span>';
                })->implode(' ');
            })
            ->rawColumns(['action', 'thumbnail', 'description', 'status', 'categories', 'materials']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Elearning $model): QueryBuilder
    {
        return $model->newQuery()->with('teacher', 'benefit', 'categories');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        // Konfigurasi DOM untuk DataTables
        $dom = '<"row mx-1"' .
            '<"col-sm-12 col-md-3 mt-5 mt-md-0" l>' .
            '<"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-4"f>B>>' .
            '>t' .
            '<"row mx-2"' .
            '<"col-sm-12 col-md-6"i>' .
            '<"col-sm-12 col-md-6"p>' .
            '>';

        // Konfigurasi bahasa untuk DataTables
        $language = [
            'sLengthMenu' => 'Show _MENU_',
            'search' => '',
            'searchPlaceholder' => 'Search Elearnings',
            'paginate' => [
                'next' => '<i class="ri-arrow-right-s-line"></i>',
                'previous' => '<i class="ri-arrow-left-s-line"></i>'
            ]
        ];
        // Konfigurasi tombol
        $buttons = [
            [
                'text' => '<i class="ri-add-line me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add Elearning</span>',
                'className' => 'add-new btn btn-primary mb-5 mb-md-0 me-3 waves-effect waves-light',
                'init' => 'function (api, node, config) {
                    $(node).removeClass("btn-secondary");
                }',
                'action' => 'function (e, dt, node, config) {
                    window.location = "' . route('elearnings.create') . '";
                }'
            ],
            [
                'text' => '<i class="ri-refresh-line me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Reload</span>',
                'className' => 'btn btn-secondary mb-5 mb-md-0 waves-effect waves-light',
                'action' => 'function (e, dt, node, config) {
                    $("#elearnings-table_filter input").val("").keyup();
                    $("#teacher_id_filter, #benefit_id_filter, #status_filter").val("").trigger("change");
                    dt.draw();
                }'
            ]
        ];

        return $this->builder()
            ->setTableId('elearnings-table')
            ->columns($this->getColumns())
            ->parameters([
                'order' => [[0, 'desc']], // Urutan default
                'dom' => $dom, // Struktur DOM
                'language' => $language, // Bahasa
                'buttons' => $buttons, // Tombol
                'responsive' => false, // Responsif
                'autoWidth' => false, // AutoWidth
            ])
            ->ajax([
                'url'  => route('elearnings.index'),
                'type' => 'GET',
                'data' => "function(d){
                    d.teacher_id = $('#teacher_id_filter').val();
                    d.benefit_id = $('#benefit_id_filter').val();
                    d.status = $('#status_filter').val();
                    d.category_id = $('#category_id_filter').val();
                    d.material_id = $('#material_id_filter').val();
                }",
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('#')->orderable(false)->searchable(false),
            Column::make('thumbnail'),
            Column::make('teacher.name')->title('Teacher'),
            Column::make('benefit.type')->title('Benefit'),
            Column::make('categories')->title('Categories')
                ->orderable(false)
                ->searchable(false),
            Column::make('materials')->title('Materials')
                ->orderable(false)
                ->searchable(false),
            Column::make('title'),
            Column::make('description'),
            Column::make('duration'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('Action'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Elearning_' . date('YmdHis');
    }
}
