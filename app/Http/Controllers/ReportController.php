<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //menampilkan tabel laporan beserta tombol tambah
        $reports = \App\Models\Report::all();
        return view('reports.index',compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //menyimpan data:
        $request->validate(
            [
                'jenis_surat' => 'required',
                'total' => 'required|numeric',
                'selesai' => 'required|numeric',
                'ditolak' => 'required|numeric',
            ]
        );
        \App\Models\Report::create($request->all());
        return redirect()->route('reports.index')->with('success','surat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update surat :
         $request->validate(
            [
                'jenis_surat' => 'required',
                'total' => 'required|numeric',
                'selesai' => 'required|numeric',
                'ditolak' => 'required|numeric',
            ]
        );
        //cari produk berdasarkan ID :
        $report = \App\Models\Report::findOrFail($id);
        //update:
        $report->update($request->all());
        return redirect()->route('reports.index')->with('success','surat berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //hapus data berdasarkan id
        $report =  \App\Models\Report::findOrFail($id);
        $report->delete();
        return redirect()->route('reports.index')->with('success','surat berhasil dihapus');
    }

    //fungsi download pdf
    public function downloadPDF(){
        //ambil semua data tabel products
        $reports =\App\Models\Report::all();
        //muat halaman view khusus (html+css) dan gunakan data pruducts
        $pdf = PDF::loadView('reports.report_pdf', compact('reports'));
        return $pdf->download('Laporan-Rekapitulasi-Data-Sipadu.pdf');
    }

}
