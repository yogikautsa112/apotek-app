@extends('templates.app', ['title' => 'Selamat Datang di Apotek Sehat'])

@section('dynamic-content')
    <!-- Hero Section with Background Image -->
    <div class="bg-dark text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <header class="mb-5">
                        <h1 class="display-4 fw-bold">Selamat Datang di Apotek Sehat</h1>
                        <p class="lead">Melayani dengan Hati, Menjaga Kesehatan Anda</p>
                    </header>
                    <div class="d-flex gap-3">
                        <a href="#layanan" class="btn btn-light btn-lg">Jelajahi Layanan</a>
                        <a href="#" class="btn btn-outline-light btn-lg">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <!-- Services Section -->
    <div class="container my-5">
        <h2 class="text-center mb-5" id="layanan">Layanan Unggulan Kami</h2>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-pills fa-4x mb-3 text-primary"></i>
                        <h3 class="card-title">Obat Berkualitas</h3>
                        <p class="card-text">Kami menyediakan berbagai jenis obat berkualitas tinggi untuk kebutuhan Anda.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-user-md fa-4x mb-3 text-success"></i>
                        <h3 class="card-title">Konsultasi Gratis</h3>
                        <p class="card-text">Dapatkan konsultasi gratis dari apoteker berpengalaman kami.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-truck fa-4x mb-3 text-info"></i>
                        <h3 class="card-title">Pengiriman Cepat</h3>
                        <p class="card-text">Kami menawarkan layanan pengiriman cepat ke seluruh wilayah.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Us Section -->
    <div class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-5">Mengapa Memilih Kami?</h2>
            
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="text-center">
                        <i class="fas fa-certificate fa-3x text-warning mb-3"></i>
                        <h4>Bersertifikat</h4>
                        <p>Apotek resmi dengan sertifikasi lengkap</p>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="text-center">
                        <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                        <h4>Buka 24 Jam</h4>
                        <p>Layanan 24 jam untuk kebutuhan darurat Anda</p>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="text-center">
                        <i class="fas fa-hand-holding-heart fa-3x text-danger mb-3"></i>
                        <h4>Pelayanan Ramah</h4>
                        <p>Staff kami siap melayani dengan sepenuh hati</p>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="text-center">
                        <i class="fas fa-mobile-alt fa-3x text-success mb-3"></i>
                        <h4>Pemesanan Online</h4>
                        <p>Pesan obat dengan mudah melalui aplikasi kami</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonial Section -->
    <div class="container my-5">
        <h2 class="text-center mb-5">Apa Kata Pelanggan Kami</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <p class="card-text">"Pelayanan sangat ramah dan profesional. Obat selalu tersedia."</p>
                        <footer class="blockquote-footer mt-2">Andi Susanto</footer>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <p class="card-text">"Konsultasi gratis sangat membantu. Terima kasih Apotek Sehat!"</p>
                        <footer class="blockquote-footer mt-2">Siti Rahayu</footer>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <p class="card-text">"Pengiriman cepat dan tepat waktu. Sangat memuaskan!"</p>
                        <footer class="blockquote-footer mt-2">Budi Santoso</footer>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Find Us Section -->
    <div class="container my-5">
        <h2 class="text-center mb-5">Temukan Kami</h2>
        
        <div class="row">
            <div class="col-md-6 mb-4">
                <img src="https://i.pinimg.com/564x/03/91/52/03915227a2bcb73e4a60e37fcd137956.jpg" alt="Apotek Sehat Location" class="img-fluid rounded shadow-sm">
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Lokasi Kami</h3>
                        <p class="card-text mb-3"><i class="fas fa-map-marker-alt text-danger me-2"></i>Jl. Kangen No. 123, Jakarta Pusat</p>
                        <p class="card-text mb-3"><i class="fas fa-phone text-primary me-2"></i>(021) 1234-5678</p>
                        <p class="card-text mb-3"><i class="fas fa-envelope text-info me-2"></i>info@apoteksehat.com</p>
                        <p class="card-text"><i class="fas fa-clock text-success me-2"></i>Buka Setiap Hari: 08.00 - 22.00 WIB</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5>Tentang Kami</h5>
                    <p>Apotek Sehat adalah apotek terpercaya yang menyediakan layanan kesehatan berkualitas untuk masyarakat.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Beranda</a></li>
                        <li><a href="#layanan" class="text-white">Layanan</a></li>
                        <li><a href="#" class="text-white">Tentang Kami</a></li>
                        <li><a href="#" class="text-white">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Ikuti Kami</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; 2023 Apotek Sehat. All rights reserved.</p>
            </div>
        </div>
    </footer>
@endsection