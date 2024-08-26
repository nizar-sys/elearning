<?php

namespace App\DataTables;

use App\Models\Video;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VideoDataTable extends DataTable
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
            ->addColumn('action', 'console.videos.action')
            ->editColumn('description', function ($query) {
                return str()->limit($query->description, 50);
            })
            ->editColumn('thumbnail', function ($query) {
                return '<img width="100" src="' . $query->thumbnail . '" class="img-fluid" alt="' . $query->title . '">';
            })
            ->editColumn('video', function ($query) {
                return '<a href="' . $query->video . '" target="_blank">' . $query->video . '</a>';
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
            ->rawColumns(['action', 'thumbnail', 'description', 'video', 'categories']);
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Video $model): QueryBuilder
    {
        return $model->newQuery()->with(['creator', 'categories']);
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
            'searchPlaceholder' => 'Search Videos',
            'paginate' => [
                'next' => '<i class="ri-arrow-right-s-line"></i>',
                'previous' => '<i class="ri-arrow-left-s-line"></i>'
            ]
        ];
        // Konfigurasi tombol
        $buttons = [
            [
                'text' => '<i class="ri-add-line me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add Video</span>',
                'className' => 'add-new btn btn-primary mb-5 mb-md-0 me-3 waves-effect waves-light',
                'init' => 'function (api, node, config) {
                    $(node).removeClass("btn-secondary");
                }',
                'action' => 'function (e, dt, node, config) {
                    window.location = "' . route('videos.create') . '";
                }'
            ],
            [
                'text' => '<i class="ri-refresh-line me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Reload</span>',
                'className' => 'btn btn-secondary mb-5 mb-md-0 me-3 waves-effect waves-light',
                'action' => 'function (e, dt, node, config) {
                    $("#videos-table_filter input").val("").keyup();
                    $("#created_by_filter").val("").trigger("change");
                    dt.draw();
                }'
            ]
        ];

        $columnExport = [0, 2, 3, 4, 5, 6];
        $buttons[] = [
            [
                'extend' => 'collection',
                'text' => '<i class="ri-upload-2-line ri-16px me-2"></i><span class="d-none d-sm-inline-block">Export</span>',
                'buttons' => [
                    [
                        'extend' => 'copy',
                        'exportOptions' => [
                            'columns' => $columnExport
                        ],
                    ],
                    [
                        'extend' => 'excel',
                        'exportOptions' => [
                            'columns' => $columnExport
                        ],
                    ],
                    [
                        'extend' => 'csv',
                        'exportOptions' => [
                            'columns' => $columnExport
                        ],
                    ],
                    [
                        'extend' => 'pdf',
                        'exportOptions' => [
                            'columns' => $columnExport
                        ],
                    ],
                    [
                        'extend' => 'print',
                        'exportOptions' => [
                            'columns' => $columnExport,
                        ],
                    ]
                ],
                'className' => 'btn btn-secondary buttons-collection dropdown-toggle btn-outline-secondary waves-effect waves-light',
                'init' => 'function (api, node, config) {
                    $(node).removeClass("btn-secondary");
                }',
            ],
        ];

        return $this->builder()
            ->setTableId('videos-table')
            ->columns($this->getColumns())
            ->parameters([
                'order' => [[0, 'desc']], // Urutan default
                'dom' => $dom, // Struktur DOM
                'language' => $language, // Bahasa
                'buttons' => $buttons, // Tombol
                'responsive' => true, // Responsif
                'autoWidth' => false, // AutoWidth
            ])
            ->ajax([
                'url'  => route('videos.index'),
                'type' => 'GET',
                'data' => "function(d){
                    d.category_id = $('#category_id_filter').val();
                    d.created_by = $('#created_by_filter').val();
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
            Column::make('categories')->title('Categories')
                ->orderable(false)
                ->searchable(false),
            Column::make('creator.name')->title('Creator'),
            Column::make('title'),
            Column::make('description'),
            Column::make('video')->title('Video URL'),
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
        return 'Video_' . date('YmdHis');
    }
}
