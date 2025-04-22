<?php

namespace App\Http\Controllers;

use App\Models\MobilModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MobilController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Data Mobil',
            'list' => ['Home', 'Data Mobil']
        ];

        $page = (object) [
            'title' => 'Data Mobil yang terdaftar dalam sistem'
        ];

        $activeMenu = 'mobil';

        $mobil = MobilModel::all();

        return view('mobil.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'mobil' => $mobil, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $mobil = MobilModel::query(); // menyiapkan query builder 

        if ($request->merek) {
            $mobil->where('merek', $request->merek);
        }
        return DataTables::of($mobil)->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->editColumn('harga', function ($row) {
                return 'Rp ' . number_format($row->harga, 0, ',', '.');
            }) // mengubah format harga menjadi format rupiah
            ->addColumn('aksi', function ($mobil) { // menambahkan kolom 
                $btn = '<button onclick="modalAction(\'' . url('/mobil/' . $mobil->mobil_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/mobil/' . $mobil->mobil_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/mobil/' . $mobil->mobil_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
            ->make(true);
    }

    public function create_ajax()
    {
        $data = MobilModel::select('merek', 'kondisi')->get();
        return view('mobil.create_ajax')->with('data', $data);
    }

    public function show_ajax(string $id)
    {
        $mobil = MobilModel::find($id);

        if (!$mobil) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return view('mobil.show_ajax')->with('mobil', $mobil);
    }


    public function store_ajax(Request $request)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'merek' => 'required|string',
                'nama' => 'required|string',
                'kode_mesin' => 'required|digits:15|unique:mobil,kode_mesin',
                'warna' => 'required|string',
                'kondisi' => 'required|string',
                'harga' => 'required|numeric',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            try {
                MobilModel::create($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data mobil berhasil disimpan',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan saat menyimpan data.',
                    'msgField' => ['server' => [$e->getMessage()]]
                ]);
            }
        }

        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $mobil = MobilModel::find($id);
        $data = MobilModel::select('merek', 'kondisi')->get();

        if (!$mobil) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return view('mobil.edit_ajax', ['mobil' => $mobil, 'data' => $data]);
    }

    public function update_ajax(Request $request, $id)
    { // cek apakah request dari ajax 
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'merek' => 'required|string',
                'nama' => 'required|string',
                'kode_mesin' => 'required|digits:15|unique:mobil,kode_mesin,' . $id . ',mobil_id',
                'warna' => 'required|string',
                'kondisi' => 'required|string',
                'harga' => 'required|numeric',
            ];
            // use Illuminate\Support\Facades\Validator; 
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal 
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error 
                ]);
            }
            $check = MobilModel::find($id);
            if ($check) {
                // jika data ditemukan, update data
                $check->update($request->all());
                return response()->json(['status' => true, 'message' => 'Data berhasil diupdate']);
            } else {
                return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax(String $id)
    {
        $mobil = MobilModel::find($id);
        return view('mobil.confirm_ajax')->with('mobil', $mobil);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $mobil = MobilModel::find($id);
            if ($mobil) {
                $mobil->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
}
