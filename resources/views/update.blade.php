@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Jadwal Lab') }}</h1>

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="content">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3>Edit Jadwal</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('update', $jdl->id) }}" method="POST">
                    {{ csrf_field() }}
                    
                    <div class="form-group">
                        <select class="form-control select2" style="width: 100%" name="idmatkul" id="idmatkul" required>
                            <option selected disabled value="">Pilih Matkul</option>
                            <option selected value="{{$jdl->idmatkul}}">{{ $jdl->matakuliah->nama_matkul}}</option>
                            @foreach ($mat as $item)
                            <option value="{{ $item->id}}">{{ $item->nama_matkul}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <select class="form-control select2" style="width: 100%" name="ruangan_id" id="ruangan_id" required>
                            <option disabled value="">Pilih Ruangan</option>
                            <option selected value="{{ $jdl->idruangan}}">{{ $jdl->ruangan->ruangan}}</option>
                            @foreach ($ruang as $item)
                            <option value="{{ $item->id}}">{{ $item->ruangan}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select class="form-control select2" style="width: 100%" name="idnip" id="idnip" required>
                            <option disabled value="">Pilih Dosen</option>
                            <option selected value="{{ $jdl->idnip}}">{{ $jdl->dosen->nama_dosen}}</option>
                            @foreach ($dos as $item)
                            <option value="{{ $item->id}}">{{ $item->nama_dosen}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="tersedia" {{ $jdl->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="digunakan" {{ $jdl->status == 'digunakan' ? 'selected' : '' }}>Digunakan</option>
                        </select>
                    </div>                    
                    
                    <div class="form-group">
                        <input type="time" id="jam_mulai" name="jam_mulai" placeholder="Masukkan jam Mulai" class="form-control" value="{{ $jdl->jam_mulai}}" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="time" id="jam_selesai" name="jam_selesai" placeholder="Masukkan jam Selesai" class="form-control" value="{{ $jdl->jam_selesai}}" required>
                    </div>

                    <!-- Input Hari -->
                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <select name="hari" id="hari" class="form-control" required>
                            <option value="Senin" {{ $jdl->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ $jdl->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ $jdl->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ $jdl->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ $jdl->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-warning">Ubah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
