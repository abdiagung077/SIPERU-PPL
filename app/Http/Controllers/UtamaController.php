<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class UtamaController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::where('status', 'tersedia')->get();
        $skrg = '';
        $jml = $jadwal->count();
    
        return view('utama', compact('jadwal', 'jml', 'skrg'));
    }
    
    public function hari($id)
    {
        $hari = explode(',', $id);
        $skrg = "hari " . $hari[0];
        $jadwal = Jadwal::where('hari', $hari[0])->where('status', 'tersedia')->get();
        $jml = $jadwal->count();
    
        return view('utama', compact('jadwal', 'jml', 'skrg'));
    }    
}
