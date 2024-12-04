@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Tambah Data Jadwal') }}</h1>

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning border-left-warning" role="alert">
            {{ session('warning') }}
        </div>
    @endif

    <div class="content">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3>Tambah Jadwal</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('simpan') }}" method="POST">
                    {{ csrf_field() }}
                    
                    <!-- Pilih Ruangan -->
                    <div class="form-group">
                        <select class="form-control select2" style="width: 100%" name="idruangan" id="idruangan" required>
                            <option selected disabled value="">Pilih Ruangan</option>
                            @foreach ($ruang as $item)
                            <option value="{{ $item->id }}" {{ old('idruangan') == $item->id ? 'selected' : '' }}>{{ $item->ruangan }}</option>
                            @endforeach
                        </select>
                        @error('idruangan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Pilih Mata Kuliah -->
                    <div class="form-group">
                        <select class="form-control select2" style="width: 100%" name="idmatkul" id="idmatkul" required>
                            <option selected disabled value="">Pilih Matkul</option>
                            @foreach ($mat as $item)
                            <option value="{{ $item->id }}" {{ old('idmatkul') == $item->id ? 'selected' : '' }}>{{ $item->nama_matkul }}</option>
                            @endforeach
                        </select>
                        @error('idmatkul')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Pilih Dosen -->
                    <div class="form-group">
                        <select class="form-control select2" style="width: 100%" name="idnip" id="idnip" required>
                            <option selected disabled value="">Pilih Dosen</option>
                            @foreach ($dos as $item)
                            <option value="{{ $item->id }}" {{ old('idnip') == $item->id ? 'selected' : '' }}>{{ $item->nama_dosen }}</option>
                            @endforeach
                        </select>
                        @error('idnip')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Status Jadwal -->
                    <div class="form-group">
                        <select class="form-control select2" name="status" id="status" required>
                            <option selected disabled value="">Pilih Status</option>
                            <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="digunakan" {{ old('status') == 'digunakan' ? 'selected' : '' }}>Digunakan</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Jam Mulai -->
                    <div class="form-group">
                        <input type="time" id="jam_mulai" name="jam_mulai" class="form-control" value="{{ old('jam_mulai') }}" required>
                        @error('jam_mulai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Jam Selesai -->
                    <div class="form-group">
                        <input type="time" id="jam_selesai" name="jam_selesai" class="form-control" value="{{ old('jam_selesai') }}" required>
                        @error('jam_selesai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pilih Hari -->
                    <div class="form-group">
                        <label for="hari">Pilih Hari</label>
                        <select class="form-control select2" name="hari" id="hari" required>
                            <option selected disabled value="">Pilih Hari</option>
                            <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        </select>
                        @error('hari')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Tombol Simpan -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
