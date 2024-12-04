<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class Jadwal extends Model
{
    protected $table = "jadwal";
    protected $primaryKey = "id";
    protected $fillable = [
        'id','idmatkul', 'idnip','idruangan', 'status', 'hari','jam_mulai','jam_selesai'];

    public function ruangan(){
        return $this->belongsTo(Ruangan::class, 'idruangan');
    }

    public function matakuliah(){
        return $this->belongsTo(Matkul::class, 'idmatkul');
    }

    public function dosen(){
        return $this->belongsTo(Dosen::class, 'idnip');
    }


    public function getCreatedAtAttribute(){
        return Carbon::parse(date('d F Y'))
            ->translatedFormat('l, d F Y');
    }

    
}
