<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FlashSaleController extends Controller
{
  public function index()
  {
    $flashSale = FlashSale::first();

    $products = Product::where("status", 1)
      ->where("is_approved", 1)
      ->whereDate("offer_start_date", "<=", Carbon::now())
      ->whereDate("offer_end_date", ">=", Carbon::now())
      ->get();

    $flashSaleItems = FlashSaleItem::all();

    return view("admin.flash-sale.index", compact("flashSale", "products", "flashSaleItems"));
  }

  public function update(Request $request)
  {
    $request->validate([
      "end_date" => ["required"]
    ]);

    FlashSale::updateOrCreate(["id" => 1], ["end_date" => $request->end_date]);

    Toastr::success("Thiết lập thời gian Flash Sale thành công", "Thành công");

    return redirect()->back();
  }

  public function addProduct(Request $request)
  {
    $request->validate([
      "product" => ["required", "unique:flash_sale_items,product_id"],
      "show_at_home" => ["required"],
    ]);

    $flashSaleItem = new FlashSaleItem();
    $flashSale = FlashSale::first();

    $flashSaleItem->flash_sale_id = $flashSale->id;
    $flashSaleItem->product_id = $request->product;
    $flashSaleItem->show_at_home = $request->show_at_home;
    $flashSaleItem->status = $request->status;
    $flashSaleItem->save();

    Toastr::success("Thêm sản phẩm thành công", "Thành công");

    return redirect()->back();
  }

  public function changeShowAtHomeStatus(Request $request)
  {
    $flashSaleItem = FlashSaleItem::findOrFail($request->id);

    $flashSaleItem->show_at_home = $request->status == "true" ? 1 : 0;
    $flashSaleItem->save();

    // Toastr::success("Cập nhật trạng thái hiển thị thành công", "Thành công");
    return response([
      "message" => "Cập nhật trạng thái thành công",
    ]);
  }

  public function changeStatus(Request $request)
  {
    $flashSaleItem = FlashSaleItem::findOrFail($request->id);

    $flashSaleItem->status = $request->status == "true" ? 1 : 0;
    $flashSaleItem->save();

    // Toastr::success("Cập nhật trạng thái sản phẩm thành công", "Thành công");
    return response([
      "message" => "Cập nhật trạng thái thành công",
    ]);
  }

  public function destroy(string $id)
  {
    $flashSaleItem = FlashSaleItem::findOrFail($id);
    $flashSaleItem->delete();

    return response([
      "message" => "Xoá sản phẩm thành công",
      "status" => "success"
    ]);
  }
}
