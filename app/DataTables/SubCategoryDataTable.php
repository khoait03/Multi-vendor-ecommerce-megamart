<?php

namespace App\DataTables;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubCategoryDataTable extends DataTable
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
        $editBtn = "<a href='" . route('admin.sub-category.edit', $query->id) . "' class='btn btn-primary mr-2'>
          <i class='fas fa-pen'></i>
        </a>";
        $deleteBtn = "<a href='" . route('admin.sub-category.destroy', $query->id) . "' class='btn btn-danger delete-item'>
          <i class='fas fa-trash'></i>
        </a>";

        return $editBtn . $deleteBtn;
      })
      ->addColumn("category_id", function ($query) {
        return $query->category->name;
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
      ->filterColumn('name', function ($query, $keyword) {
        $query->where('name', 'like', "%{$keyword}%");
      })
      ->filterColumn('slug', function ($query, $keyword) {
        $query->where('slug', 'like', "%{$keyword}%");
      })
      ->filterColumn('category_id', function ($query, $keyword) {
        $query->whereHas('category', function ($query) use ($keyword) {
          $query->where('name', 'like', "%{$keyword}%");
        });
      })
      ->filterColumn('sub_category_id', function ($query, $keyword) {
        $query->whereHas('subCategory', function ($query) use ($keyword) {
          $query->where('name', 'like', "%{$keyword}%");
        });
      })
      ->rawColumns(["action", "status", "category_id"])
      ->setRowId('id');
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(SubCategory $model): QueryBuilder
  {
    return $model->newQuery()->latest();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('subcategory-table')
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
      Column::make('id')->width(50),
      Column::make('name')->title("Tên danh mục"),
      Column::make('slug'),
      Column::make('category_id')->width(250)->title("Thuộc danh mục cấp 1"),
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
    return 'SubCategory_' . date('YmdHis');
  }
}
