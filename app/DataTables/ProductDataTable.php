<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
        $editBtn = "<a href='" . route('admin.products.edit', $query->id) . "' class='btn btn-primary mr-2'>
      <i class='fas fa-pen'></i>
      </a>";
        $deleteBtn = "<a href='" . route('admin.products.destroy', $query->id) . "' class='btn btn-danger mr-2 delete-item'>
      <i class='fas fa-trash'></i>
      </a>";
        $moreBtn = '<div class="dropdown dropleft d-inline">
      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-cog"></i>
      </button>
      <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
        <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i> Action</a>
        <a class="dropdown-item has-icon" href="#"><i class="far fa-file"></i> Another action</a>
        <a class="dropdown-item has-icon" href="#"><i class="far fa-clock"></i> Something else here</a>
      </div>
    </div>';

        return $editBtn . $deleteBtn . $moreBtn;
      })
      ->addColumn("thumb_image", function ($query) {
        return '<img src="' . asset($query->thumb_image) . '" width="70px">';
      })
      ->addColumn("price", function ($query) {
        return number_format($query->price) . "đ";
      })
      ->addColumn("offer_price", function ($query) {
        return number_format($query->offer_price) . "đ";
      })
      ->addColumn("product_type", function ($query) {
        switch ($query->product_type) {
          case 'new_product':
            return "Sản phẩm mới";
            break;
          case 'featured_product':
            return "Sản phẩm nổi bật";
            break;
          case 'top_product':
            return "Sản phẩm phổ biến";
            break;
          default:
            return "Sản phẩm tốt nhất";
            break;
        }
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
      ->rawColumns(["thumb_image", "action", "status"])
      ->setRowId('id');
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Product $model): QueryBuilder
  {
    return $model->newQuery();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('product-table')
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
      Column::make('sku')->title("SKU"),
      Column::make('thumb_image')->width(100)->title("Hình ảnh"),
      Column::make('name')->title("Tên sản phẩm"),
      Column::make('price')->title("Giá sản phẩm"),
      Column::make('offer_price')->title("Giá sản phẩm khi giảm"),
      Column::make('offer_start_date')->title("Ngày bắt đầu"),
      Column::make('offer_end_date')->title("Ngày kết thúc"),
      Column::make('product_type')->title("Loại sản phẩm"),
      Column::make('status')->width(30)->title("Trạng thái"),
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
    return 'Product_' . date('YmdHis');
  }
}
