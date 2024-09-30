<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class DashboardController extends Controller
{
    public function index(){

        $item_count = Item::count();
        return view('admin.index', compact('item_count'));
    }
}
