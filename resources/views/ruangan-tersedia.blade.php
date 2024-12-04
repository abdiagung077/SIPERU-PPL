<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Jadwal</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <main id="main">
        <section id="jadwal" class="features">
            <div class="container">
                <div class="section-title mb-5">
                    <h2>Ruangan Tersedia {{ $skrg }}</h2>
                    <div class="dropdown show d-flex justify-content-start">
                        <div class="mb-4">
                            <a href="{{ route('home') }}" class="btn btn-secondary">
                                Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                        <div class="dropdown show d-flex justify-content-start">
                        <a style="background: #143454; color: white !important" class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hari
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('ruangan-tersedia-home') }}#jadwal">Semua Data</a>
                            <a class="dropdown-item" href="{{ url('ruangan-tersedia-hari/Senin') }}#jadwal">Senin</a>
                            <a class="dropdown-item" href="{{ url('ruangan-tersedia-hari/Selasa') }}#jadwal">Selasa</a>
                            <a class="dropdown-item" href="{{ url('ruangan-tersedia-hari/Rabu') }}#jadwal">Rabu</a>
                            <a class="dropdown-item" href="{{ url('ruangan-tersedia-hari/Kamis') }}#jadwal">Kamis</a>
                            <a class="dropdown-item" href="{{ url('ruangan-tersedia-hari/Jumat') }}#jadwal">Jumat</a>
                        </div>
                    </div>

                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @php
                                $totalPages = ceil($jadwal->count() / 5); // Total halaman berdasarkan jumlah data dibagi 5
                            @endphp

                            @for ($i = 0; $i < $totalPages; $i++)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"></li>
                            @endfor
                        </ol>

                        <div class="carousel-inner">
                            @php
                                $x = 0;
                            @endphp

                            @for ($page = 0; $page < $totalPages; $page++)
                                <div class="carousel-item {{ $page == 0 ? 'active' : '' }}">
                                    <div data-aos="fade-up" class="table-responsive mt-2">
                                        @if ($jadwal->isEmpty())
                                            <img src="{{ asset('img/nodata.png') }}" alt="No Data">
                                        @else
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th style="background-color: #143454; color: white">Ruang</th>
                                                        <th>Jam</th>
                                                        <th>Status</th>
                                                        <th>Matakuliah</th>
                                                        <th>Nama Dosen</th>
                                                        @if (Auth::user()->hak_akses=="Admin")
                                                            <th>Aksi</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($jadwal->slice($x, 5) as $jw)
                                                        <tr>
                                                            <td>{{ $jw->ruangan->ruangan }}</td>
                                                            <td>{{ date('H:i', strtotime($jw->jam_mulai)) }} - {{ date('H:i', strtotime($jw->jam_selesai)) }}</td>
                                                            <td>{{ $jw->status }}</td>
                                                            <td>{{ $jw->matakuliah->nama_matkul }}</td>
                                                            <td>{{ $jw->dosen->nama_dosen }}</td>
                                                            @if (Auth::user()->hak_akses=="Admin")
                                                            <td class="d-flex justify-content-center">
                                                                <a href="{{ url('update', $jw->id) }}" class="btn btn-warning mr-1">
                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                </a>
                                                                <a href="{{ url('delete', $jw->id) }}" class="btn btn-danger">
                                                                    <i class="fa-solid fa-trash-can"></i>
                                                                </a>
                                                            </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                                @php
                                    $x += 5; // Melanjutkan 5 data berikutnya untuk setiap halaman
                                @endphp
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
