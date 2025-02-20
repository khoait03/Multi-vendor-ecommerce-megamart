<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
  public function index()
  {
    $transactions = Transaction::latest()->get();

    return view('admin.transaction.index', compact("transactions"));
  }
}
