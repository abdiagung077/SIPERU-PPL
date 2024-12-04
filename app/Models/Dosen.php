<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table= "dosen";
    protected $primarykey = "id";
    protected $fillable = ['id', 'nip', 'nama_dosen', 'no_hp'];

    public function jadwal(){
        return $this->hasMany(Jadwal::class);
    }
}
