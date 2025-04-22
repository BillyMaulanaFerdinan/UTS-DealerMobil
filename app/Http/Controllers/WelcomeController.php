<?php

namespace App\Http\Controllers;

use App\Models\MobilModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Dashboard',
            'list' => ['Home', 'Dashboard']
        ];

        $page = (object) [
            'title' => 'Selamat datang di Fast Dealership'
        ];
        $activeMenu = 'dashboard';

        $data = [
            'jumlahMobil' => MobilModel::count(),
            'totalOmset' => MobilModel::sum('harga'),
            'totalBaru' => MobilModel::where('kondisi', 'baru')->count(),
            'totalBekas' => MobilModel::where('kondisi', 'bekas')->count()
        ];

        return view('welcome', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'data' => $data]);
    }
}
