<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Shop;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function index(){   // 申請中のみ取得
        $shops = Shop::where('status', '>', 1 )->get();
        return view('admin.dashboard', ['shops' => $shops] );
    }
    public function accept($id){
        $shop = Shop::find($id);
        $shop->status = "0";
        $shop->save();
        $shops = Shop::where('status', '>', 1 )->get();
        return view('admin.dashboard', ['shops' => $shops]);
    }

    public function destroy($id){   // Adminによる削除承認（レコード削除）
        $shop = Shop::find($id);
        $shop -> delete();
        return redirect('/shops');
    }
}