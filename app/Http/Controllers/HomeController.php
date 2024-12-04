<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\User;
// use Carbon\Carbon;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Ruangan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
  public function index()
{
    $dtJadwal = Jadwal::with('ruangan', 'matakuliah', 'dosen')->latest()->get();
    $jadwalByDay = $dtJadwal->groupBy('hari'); // Mengelompokkan berdasarkan hari

    // Menentukan urutan hari
    $daysOrder = [
        'Senin' => 1,
        'Selasa' => 2,
        'Rabu' => 3,
        'Kamis' => 4,
        'Jumat' => 5
    ];

    // Mengurutkan grup jadwal berdasarkan urutan hari
    $jadwalByDay = $jadwalByDay->sortBy(function ($day, $key) use ($daysOrder) {
        return $daysOrder[$key] ?? 99; // Jika hari tidak ditemukan, beri urutan paling akhir
    });

    $matkul = Jadwal::count();
    $users = User::count();
    $jummatkul = Matkul::count();
    $dosen = Dosen::count();
    $hari = Carbon::now()->isoFormat('D MMMM Y');

    $widget = [
        'users' => $users,
        'jadwalByDay' => $jadwalByDay, // Data jadwal yang sudah dikelompokkan dan diurutkan
        'matkul' => $matkul,
        'jummatkul' => $jummatkul,
        'dosen' => $dosen,
        'hari' => $hari,
    ];

    return view('home', $widget);
}    

    public function create()
    {
        $dos = Dosen::all();
        $mat = Matkul::all();
        $ruang = Ruangan::all();
        return view('input', compact('ruang', 'mat', 'dos'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'idruangan' => 'required|exists:ruangan,id',
            'idmatkul' => 'required|exists:matkul,id',
            'idnip' => 'required|exists:dosen,id',
            'status' => 'required|in:tersedia,digunakan',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat', // Validasi hari
        ]);
    
        // Cek apakah jadwal bentrok
        $existingSchedule = Jadwal::where('idruangan', $request->idruangan)
            ->where('hari', $request->hari) // Pastikan hari juga diperiksa
            ->where(function($query) use ($request) {
                $query->where('jam_mulai', '<', $request->jam_selesai)
                      ->where('jam_selesai', '>', $request->jam_mulai);
            })
            ->exists();
    
        if ($existingSchedule) {
            return redirect()->back()->with('warning', 'Jadwal bentrok dengan jadwal yang sudah ada!');
        }
    
        // Simpan data jadwal baru
        Jadwal::create([
            'idruangan' => $request->idruangan,
            'idmatkul' => $request->idmatkul,
            'idnip' => $request->idnip,
            'status' => $request->status,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'hari' => $request->hari // Simpan hari dari input pengguna
        ]);
    
        return redirect()->route('home')->with('success', 'Data jadwal berhasil ditambahkan!');
    }
    

    public function edit($id)
    {
        $dos = Dosen::all();
        $mat = Matkul::all();
        $ruang = Ruangan::all();
        $jdl = Jadwal::with('ruangan')->findorfail($id);
        return view('update', compact('jdl', 'ruang', 'mat', 'dos'));
    }

    public function update(Request $request, $id)
    {
        $jdl = Jadwal::findorfail($id);
        $jdl->update($request->all());
        return redirect('home')->with('success', 'Data Berhasil Diubah!');
    }

    public function destroy($id)
    {
        $jdl = Jadwal::findorfail($id);
        $jdl->delete();
        return back()->with('info', 'Data Berhasil Dihapus!');
    }
    public function indexTersedia($day = null)
    {
        // Ambil data jadwal dengan status 'tersedia' dan muat relasi (ruangan, matakuliah, dosen)
        $jadwalQuery = Jadwal::with(['ruangan', 'matakuliah', 'dosen'])
                             ->where('status', 'tersedia');

        // Jika hari dipilih, filter jadwal berdasarkan hari
        if ($day) {
            $jadwalQuery->where('hari', ucfirst($day));  // Menyesuaikan nama hari (Senin, Selasa, dsb.)
        }

        // Ambil jadwal yang sudah difilter
        $jadwal = $jadwalQuery->get();

        // Jika hari tidak dipilih, kelompokkan jadwal berdasarkan hari
        if (!$day) {
            // Tentukan urutan hari
            $orderOfDays = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
            
            // Urutkan jadwal berdasarkan urutan hari kerja
            $jadwal = collect($orderOfDays)->mapWithKeys(function ($day) use ($jadwal) {
                return [$day => $jadwal->filter(function ($schedule) use ($day) {
                    return $schedule->hari === $day;
                })];
            });
        }

        // Kembalikan view dengan data jadwal dan hari yang dipilih
        return view('indextersedia', compact('jadwal', 'day'));
    }
    
    

}
