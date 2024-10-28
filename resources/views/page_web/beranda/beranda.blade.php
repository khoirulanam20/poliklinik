@extends('template_web.layout')

@section('content')
<!-- Hero Section -->
<div class="container-fluid bg-primary text-white py-5" style="background: linear-gradient(45deg, #26355d, #4267B2);">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Selamat Datang di Poliklinik</h1>
                <p class="lead mb-4">Kesehatan Anda adalah prioritas kami. Dapatkan layanan kesehatan terbaik dengan dokter-dokter berpengalaman.</p>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg me-2">Daftar Sekarang</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">Masuk</a>
                @endguest
            </div>
            <!-- <div class="col-lg-6">
                <img src="/images/hero-image.jpg" alt="Medical Service" class="img-fluid rounded shadow">
            </div> -->
        </div>
    </div>
</div>

<!-- Layanan Section -->
<div class="container py-5">
    <h2 class="text-center mb-5">Layanan Kami</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-heart-pulse fs-1 text-primary mb-3"></i>
                    <h5 class="card-title">Pemeriksaan Umum</h5>
                    <p class="card-text">Layanan pemeriksaan kesehatan umum dengan dokter berpengalaman.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-capsule fs-1 text-primary mb-3"></i>
                    <h5 class="card-title">Farmasi</h5>
                    <p class="card-text">Layanan farmasi lengkap dengan apoteker profesional.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-clipboard2-pulse fs-1 text-primary mb-3"></i>
                    <h5 class="card-title">Laboratorium</h5>
                    <p class="card-text">Fasilitas laboratorium modern untuk pemeriksaan kesehatan.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jadwal Section -->
<div class="container-fluid bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">Jadwal Praktik</h2>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Hari</th>
                        <th>Jam Buka</th>
                        <th>Layanan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Senin - Jumat</td>
                        <td>08:00 - 20:00</td>
                        <td>Semua Layanan</td>
                    </tr>
                    <tr>
                        <td>Sabtu</td>
                        <td>08:00 - 17:00</td>
                        <td>Pemeriksaan Umum</td>
                    </tr>
                    <tr>
                        <td>Minggu</td>
                        <td>09:00 - 14:00</td>
                        <td>Gawat Darurat</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="container py-5">
    <div class="row">
        <div class="col-lg-6">
            <h2 class="mb-4">Hubungi Kami</h2>
            <p><i class="bi bi-geo-alt-fill me-2"></i> Jl. Kesehatan No. 123, Kota</p>
            <p><i class="bi bi-telephone-fill me-2"></i> (021) 123-4567</p>
            <p><i class="bi bi-envelope-fill me-2"></i> info@poliklinik.com</p>
        </div>
        <div class="col-lg-6">
            <div class="ratio ratio-16x9">
                <iframe src="https://www.google.com/maps/embed" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
@endsection

