<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    return (new EloquentDataTable($query))
      ->addColumn('action', function ($query) {
        $editBtn = "<a href='" . route('admin.category.edit', $query->id) . "' class='btn btn-primary mr-2'>
      <i class='fas fa-pen'></i>
      </a>";
        $deleteBtn = "<a href='" . route('admin.category.destroy', $query->id) . "' class='btn btn-danger delete-item'>
      <i class='fas fa-trash'></i>
      </a>";

        return $editBtn . $deleteBtn;
      })
      ->addColumn('status', function ($query) {
        if ($query->status == 1) {
          $button = "
            <label class='custom-switch mt-2'>
              <input type='checkbox' checked name='custom-switch-checkbox' data-id='$query->id' class='custom-switch-input change-status'>
              <span class='custom-switch-indicator'></span>
            </label>
          ";
        } else {
          $button = "
            <label class='custom-switch mt-2'>
              <input type='checkbox' name='custom-switch-checkbox' data-id='$query->id' class='custom-switch-input change-status'>
              <span class='custom-switch-indicator'></span>
            </label>
          ";
        }
        return $button;
      })
      ->addColumn('icon', function ($query) {
        return "<i class='{$query->icon}' style='font-size:30px'></i>";
      })
      ->rawColumns(["action", "status", "icon"])
      ->setRowId('id');
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Category $model): QueryBuilder
  {
    return $model->latest()->newQuery();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('category-table')
      ->columns($this->getColumns())
      ->minifiedAjax()
      //->dom('Bfrtip')
      ->orderBy(1)
      ->selectStyleSingle()
      ->buttons([
        Button::make('excel'),
        Button::make('csv'),
        Button::make('pdf'),
        Button::make('print'),
        Button::make('reset'),
        Button::make('reload')
      ]);
  }

  /**
   * Get the dataTable columns definition.
   */
  public function getColumns(): array
  {
    return [
      Column::make('id'),
      Column::make('icon')->width(50)->title("Icon"),
      Column::make('name')->title("Tên danh mục"),
      Column::make('slug'),
      Column::make('status')->width(200)->title("Trạng thái")->addClass('text-center'),
      Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width(60)
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Category_' . date('YmdHis');
  }
}
