<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use DataTables;

class DataController extends Controller
{
    public function index()
    {
        $data = Data::get();
        if (request()->ajax()) {
            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = " <button class='edit btn  btn-danger' id='" . $data->id . "' >Edit</button>";
                    $button .= " <button class='hapus btn  btn-danger' id='" . $data->id . "' >Hapus</button>";
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('/dashboard/data/index');
    }

    public function store(Request $request)
    {
        $data = new Data();
        $data->nama_lengkap = $request->nama_lengkap;
        $data->alamat_domisili = $request->alamat_domisili;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->pendidikan_terakhir = $request->pendidikan_terakhir;
        $data->jurusan = $request->jurusan;
        $data->hari = $request->hari;
        $simpan = $data->save();
        if ($simpan) {
            return response()->json(['data' => $data, 'text' => 'data berhasi disimpan'], 200);
        } else {
            return response()->json(['data' => $data, 'text' => 'data berhasi disimpan']);
        }
    }

    /**
     * edits 
     * Ambil Data
     * @param  mixed $request->id
     * @return void
     */
    public function edits(Request $request)
    {
        # code...
        $id = $request->id;
        $data = Data::find($id);
        return response()->json(['data' => $data]);
    }
    /**
     * Ubah Data
     *
     * @param  mixed $var
     * @return void
     */
    public function updates(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        $datas = [
            'nama_lengkap' => $request->nama_lengkap,
            'alamat_domisili' => $request->alamat_domisili,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'jurusan' => $request->jurusan,
            'hari' => $request->hari,
        ];
        $data = Data::find($id);
        $simpan = $data->update($datas);
        if ($simpan) {
            return response()->json(['text' => 'berhasil diubah'], 200);
        } else {
            return response()->json(['text' => 'Gagal diubah'], 422);
        }
    }

    /**
     * hapus
     *
     * @param  mixed $request
     * @return void
     */
    public function hapus(Request $request)
    {
        $id = $request->id;
        $data = Data::find($id);
        $data->delete();
        return response()->json(['text' => 'berhasil dihapus'], 200);
    }
}
