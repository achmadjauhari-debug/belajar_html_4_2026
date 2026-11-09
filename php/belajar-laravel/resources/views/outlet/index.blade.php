@extends('layouts.app')
@section('content')

  
<div class="flex flex-col w-full">
<!-- Breadcrumb Navigation -->
<div class="bg-light border-bottom py-2">
<div class="container">
<nav aria-label="breadcrumb">
<ol class="breadcrumb mb-0 py-1" style="font-size: 0.85rem;">
<li class="breadcrumb-item">
<a class="text-decoration-none text-muted d-inline-flex align-items-center gap-1" href="index.html">
<i class="bi bi-house-door"></i> Beranda
            </a>
</li>
<li aria-current="page" class="breadcrumb-item active text-primary fw-semibold">Outlet Kami</li>
</ol>
</nav>
</div>
</div>
<!-- Header & Filter Section -->
<section class="py-4 py-lg-5 bg-white border-bottom position-relative">
<div class="container">
<div class="row align-items-center g-4">
<div class="col-lg-8">
<div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-light text-primary fw-semibold mb-3 border" style="font-size: 0.8rem;">
<i class="bi bi-geo-alt-fill text-danger"></i> 7 Cabang Siap Melayani
          </div>
<h1 class="display-6 fw-bold text-dark mb-3 lh-sm">
            Jaringan 7 Cabang Outlet PrimaGraphia di Jabodetabek
          </h1>
<p class="text-muted fs-6 mb-0 pe-lg-4 lh-base">
            Kunjungi outlet terdekat untuk pemesanan langsung, konsultasi proofing bahan dan warna, atau penyerahan sampel serta pengambilan pesanan online Anda secara gratis.
          </p>
</div>
<div class="col-lg-4">
<div class="p-3 bg-light rounded-4 border">
<div class="d-flex align-items-center gap-3">
<div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px;">
<i class="bi bi-box-seam-fill fs-4"></i>
</div>
<div>
<h6 class="fw-bold mb-1" style="font-size: 0.95rem;">Layanan Click &amp; Collect</h6>
<p class="text-muted small mb-0">Hemat ongkir dengan ambil pesanan di outlet terdekat.</p>
</div>
</div>
</div>
</div>
</div>
<!-- Quick Filter Bar -->
<div class="mt-4 pt-3 border-top">
<div class="row g-2 align-items-center">
<div class="col-12 col-md-5 col-lg-4">
<div class="input-group">
<span class="input-group-text bg-white border-end-0 text-muted">
<i class="bi bi-search"></i>
</span>
<input class="form-control border-start-0 ps-0" id="outletSearchInput" placeholder="Cari nama cabang, jalan, area..." style="font-size: 0.9rem;" type="text"/>
</div>
</div>
<div class="col-12 col-md-7 col-lg-8">
<div class="d-flex align-items-center gap-2 overflow-x-auto pb-1" id="filterRegionGroup">
<span class="small text-muted fw-semibold me-1 d-none d-lg-inline">Wilayah:</span>
<button class="btn btn-sm btn-primary rounded-pill px-3 filter-pill active" data-filter="all" type="button">Semua (7)</button>
<button class="btn btn-sm btn-outline-secondary rounded-pill px-3 filter-pill" data-filter="pusat" type="button">Jakarta Pusat</button>
<button class="btn btn-sm btn-outline-secondary rounded-pill px-3 filter-pill" data-filter="selatan" type="button">Jakarta Selatan</button>
<button class="btn btn-sm btn-outline-secondary rounded-pill px-3 filter-pill" data-filter="timur" type="button">Jakarta Timur</button>
<button class="btn btn-sm btn-outline-secondary rounded-pill px-3 filter-pill" data-filter="tangerang" type="button">Tangerang</button>
<button class="btn btn-sm btn-outline-secondary rounded-pill px-3 filter-pill" data-filter="bekasi" type="button">Bekasi</button>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Outlet Cards Grid -->
<section class="py-5 bg-light">
<div class="container">
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4" id="outletContainer">
<!-- Outlet 1: Kepu Senen (Headquarter) -->
<div class="col outlet-item" data-name="kepu senen bungur pusat jakarta" data-region="pusat">
<div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
<div class="position-absolute top-0 end-0 m-3 z-2">
<span class="badge bg-danger px-3 py-2 rounded-pill shadow-sm">
<i class="bi bi-star-fill me-1"></i> Kantor Pusat &amp; Workshop
              </span>
</div>
<div class="ratio ratio-16x9 bg-secondary">
<img alt="PrimaGraphia Kepu Senen" class="card-img-top object-fit-cover" data-alt="Modern facade and bustling production hub of PrimaGraphia Kepu Senen printing store in Jakarta with large digital signage, clean storefront and customer parking area under sunny afternoon sky." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCWK98ZwfrMruqD1OuX36Oh6ohfz9B_4IyFOW30FHROHr51CrsKnS-orjIaOa4UGuptxoEdNCQEMkiJj8PBFmnBoKUlsctjjqFZUmSovA2u-c18AD5ZTp0I9xm2OfUl9CPgNf_w6ocUrGXQKSYnS_fQip2gC5R8UsLEopPR5rxlIvvi3jT0Ybhk1H1x1G48mJruFmMzTdKXTkr3A3mC0n4E3PmqraUgc1cPkfVT4A"/>
</div>
<div class="card-body p-4 d-flex flex-column">
<div class="d-flex align-items-center justify-content-between mb-2">
<span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2 py-1 small">Jakarta Pusat</span>
<span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 small"><i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>Buka Hari Ini</span>
</div>
<h5 class="card-title fw-bold text-dark mb-2">PrimaGraphia Kepu Senen</h5>
<p class="card-text text-muted small mb-3">
<i class="bi bi-geo-alt-fill text-danger me-1"></i>
                Jl. Kepu Selatan No.66, RT.6/RW.1, Bungur, Kec. Senen, Kota Jakarta Pusat 10460
              </p>
<div class="bg-light p-3 rounded-3 mb-3 small">
<div class="fw-semibold text-dark mb-1"><i class="bi bi-clock-fill text-primary me-1"></i> Jam Operasional:</div>
<div class="d-flex justify-content-between text-muted mb-1">
<span>Senin - Jumat:</span> <span class="fw-medium text-dark">08.00 - 22.00 WIB</span>
</div>
<div class="d-flex justify-content-between text-muted mb-1">
<span>Sabtu:</span> <span class="fw-medium text-dark">08.00 - 20.00 WIB</span>
</div>
<div class="d-flex justify-content-between text-muted">
<span>Minggu:</span> <span class="fw-medium text-dark">09.00 - 17.00 WIB</span>
</div>
</div>
<div class="mb-4">
<div class="fw-semibold text-dark small mb-2"><i class="bi bi-check2-circle text-primary me-1"></i> Fasilitas Outlet:</div>
<div class="d-flex flex-wrap gap-1">
<span class="badge bg-white text-secondary border small">Layanan 24 Jam Mesin Industri</span>
<span class="badge bg-white text-secondary border small">Ambil Order Online</span>
<span class="badge bg-white text-secondary border small">Proofing Warna</span>
<span class="badge bg-white text-secondary border small">Ruang Tunggu AC</span>
<span class="badge bg-white text-secondary border small">Parkir Luas</span>
</div>
</div>
<div class="mt-auto d-grid gap-2">
<a class="btn btn-outline-primary rounded-pill fw-semibold btn-sm py-2" href="https://maps.google.com/?q=PrimaGraphia+Kepu+Selatan+Jakarta" rel="noopener noreferrer" target="_blank">
<i class="bi bi-geo-alt me-1"></i> Petunjuk Arah Google Maps
                </a>
<a class="btn btn-success rounded-pill fw-semibold btn-sm py-2" href="https://wa.me/62811987990?text=Halo%20PrimaGraphia%20Kepu%20Senen,%20saya%20ingin%20konsultasi%20cetak" rel="noopener noreferrer" target="_blank">
<i class="bi bi-whatsapp me-1"></i> Chat WhatsApp CS Cabang
                </a>
</div>
</div>
</div>
</div>
<!-- Outlet 2: Salemba -->
<div class="col outlet-item" data-name="salemba kenari pusat senen jakarta" data-region="pusat">
<div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
<div class="ratio ratio-16x9 bg-secondary">
<img alt="PrimaGraphia Salemba" class="card-img-top object-fit-cover" data-alt="Storefront of PrimaGraphia Salemba retail branch featuring clean glass entrance modern digital printing equipment showroom and friendly customer service counter." src="https://lh3.googleusercontent.com/aida-public/AB6AXuA1x00dUIk6-R9dJNqxC6mFU2sOGO3vUpf8ZxWfXTqqqoNH9hopF0vqRCstwcCVtrdNUy77nsjMQBJTp9xBm-V5d0Xx1NapgA7YH53Gz1AUtZj4X1DUbSgHzjpHrZP0P_7oqP7dcsSbBWinTULDeWjjQ7GHw6yOePg1Do_Tk46u6GKBGEuveuN67U_F5lSnD4WM7OKI1Y6ZVwO1rAtOtKlqn6ByT7GVXFgzB1uxGA"/>
</div>
<div class="card-body p-4 d-flex flex-column">
<div class="d-flex align-items-center justify-content-between mb-2">
<span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2 py-1 small">Jakarta Pusat</span>
<span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 small"><i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>Buka Hari Ini</span>
</div>
<h5 class="card-title fw-bold text-dark mb-2">PrimaGraphia Salemba</h5>
<p class="card-text text-muted small mb-3">
<i class="bi bi-geo-alt-fill text-danger me-1"></i>
                Jl. Salemba Raya No. 42, Kenari, Kec. Senen, Jakarta Pusat 10430
              </p>
<div class="bg-light p-3 rounded-3 mb-3 small">
<div class="fw-semibold text-dark mb-1"><i class="bi bi-clock-fill text-primary me-1"></i> Jam Operasional:</div>
<div class="d-flex justify-content-between text-muted mb-1">
<span>Senin - Sabtu:</span> <span class="fw-medium text-dark">08.00 - 20.00 WIB</span>
</div>
<div class="d-flex justify-content-between text-muted">
<span>Minggu:</span> <span class="badge bg-light text-danger border">Tutup</span>
</div>
</div>
<div class="mb-4">
<div class="fw-semibold text-dark small mb-2"><i class="bi bi-check2-circle text-primary me-1"></i> Fasilitas Outlet:</div>
<div class="d-flex flex-wrap gap-1">
<span class="badge bg-white text-secondary border small">Ambil Order Online</span>
<span class="badge bg-white text-secondary border small">Digital Offset A3+</span>
<span class="badge bg-white text-secondary border small">Sticker Die-Cut Express</span>
<span class="badge bg-white text-secondary border small">Pembayaran QRIS</span>
</div>
</div>
<div class="mt-auto d-grid gap-2">
<a class="btn btn-outline-primary rounded-pill fw-semibold btn-sm py-2" href="https://maps.google.com/?q=PrimaGraphia+Salemba+Jakarta" rel="noopener noreferrer" target="_blank">
<i class="bi bi-geo-alt me-1"></i> Petunjuk Arah Google Maps
                </a>
<a class="btn btn-success rounded-pill fw-semibold btn-sm py-2" href="https://wa.me/62811987990?text=Halo%20PrimaGraphia%20Salemba,%20saya%20ingin%20tanya%20pesanan" rel="noopener noreferrer" target="_blank">
<i class="bi bi-whatsapp me-1"></i> Chat WhatsApp CS Cabang
                </a>
</div>
</div>
</div>
</div>
<!-- Outlet 3: Gandaria -->
<div class="col outlet-item" data-name="gandaria kebayoran baru selatan jakarta" data-region="selatan">
<div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
<div class="ratio ratio-16x9 bg-secondary">
<img alt="PrimaGraphia Gandaria" class="card-img-top object-fit-cover" data-alt="Exterior view of PrimaGraphia Gandaria outlet in South Jakarta with distinctive corporate blue and red branding signs and welcoming entrance with glass doors." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDlA2BNxhCxZdWsKF35OiX3tMhiejHc-GDWcXxODXX_OHIErD7fKQBjydQBGdqeMk22D-W9D4UCCgp2ECq4M_qO40haJREyS_z7AppQn7_tn6skcATRKw-QQ5CCVAH4T3KNKk9OyYI8jEFm-93X8EeQSnoksfT7WHlVH8_C8N4w9_zSBsfvA_f3xzWaJeeIDxYtUAk7tlVC9c2H1CLzRd-d6H4BlKEIxCi17ucB_g"/>
</div>
<div class="card-body p-4 d-flex flex-column">
<div class="d-flex align-items-center justify-content-between mb-2">
<span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2 py-1 small">Jakarta Selatan</span>
<span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 small"><i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>Buka Hari Ini</span>
</div>
<h5 class="card-title fw-bold text-dark mb-2">PrimaGraphia Gandaria</h5>
<p class="card-text text-muted small mb-3">
<i class="bi bi-geo-alt-fill text-danger me-1"></i>
                Jl. Gandaria 1 No. 88, Kebayoran Baru, Jakarta Selatan 12130
              </p>
<div class="bg-light p-3 rounded-3 mb-3 small">
<div class="fw-semibold text-dark mb-1"><i class="bi bi-clock-fill text-primary me-1"></i> Jam Operasional:</div>
<div class="d-flex justify-content-between text-muted mb-1">
<span>Senin - Sabtu:</span> <span class="fw-medium text-dark">08.30 - 20.30 WIB</span>
</div>
<div class="d-flex justify-content-between text-muted">
<span>Minggu:</span> <span class="badge bg-light text-danger border">Tutup</span>
</div>
</div>
<div class="mb-4">
<div class="fw-semibold text-dark small mb-2"><i class="bi bi-check2-circle text-primary me-1"></i> Fasilitas Outlet:</div>
<div class="d-flex flex-wrap gap-1">
<span class="badge bg-white text-secondary border small">Pick-up Counter Cepat</span>
<span class="badge bg-white text-secondary border small">Large Format Banner</span>
<span class="badge bg-white text-secondary border small">Display Promotion Unit</span>
<span class="badge bg-white text-secondary border small">Ruang Konsultasi Desain</span>
</div>
</div>
<div class="mt-auto d-grid gap-2">
<a class="btn btn-outline-primary rounded-pill fw-semibold btn-sm py-2" href="https://maps.google.com/?q=PrimaGraphia+Gandaria+Jakarta" rel="noopener noreferrer" target="_blank">
<i class="bi bi-geo-alt me-1"></i> Petunjuk Arah Google Maps
                </a>
<a class="btn btn-success rounded-pill fw-semibold btn-sm py-2" href="https://wa.me/62811987990?text=Halo%20PrimaGraphia%20Gandaria,%20saya%20ingin%20tanya%20pesanan" rel="noopener noreferrer" target="_blank">
<i class="bi bi-whatsapp me-1"></i> Chat WhatsApp CS Cabang
                </a>
</div>
</div>
</div>
</div>
<!-- Outlet 4: Rawamangun -->
<div class="col outlet-item" data-name="rawamangun pemuda pulo gadung timur jakarta" data-region="timur">
<div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
<div class="ratio ratio-16x9 bg-secondary">
<img alt="PrimaGraphia Rawamangun" class="card-img-top object-fit-cover" data-alt="Street view of PrimaGraphia Rawamangun printing branch located along Jalan Pemuda East Jakarta with commercial street ambiance and clear store signage." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDsZXQk3QwYjbKwNZfgqJ47BNBPdmpwA1mUZ1lETK1yKrlTF-5BAAEDOkUtxiKk1DsbEPh1gFRyHjYRhfEqNvCkL2xc0yd1uKMne2S8WvIHFxuThcZdtv0bqBADXvxzdVDkdR9nffDK9XuoiDTTZKmje29FQuMgPttMcrJ4k4HsKz1pEFJv_WO6tI2nnyClMWCbUff7GhjALgMdpORudwrpCmq-PryfN0o0GF7XXw"/>
</div>
<div class="card-body p-4 d-flex flex-column">
<div class="d-flex align-items-center justify-content-between mb-2">
<span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2 py-1 small">Jakarta Timur</span>
<span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 small"><i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>Buka Hari Ini</span>
</div>
<h5 class="card-title fw-bold text-dark mb-2">PrimaGraphia Rawamangun</h5>
<p class="card-text text-muted small mb-3">
<i class="bi bi-geo-alt-fill text-danger me-1"></i>
                Jl. Pemuda No. 12, Rawamangun, Kec. Pulo Gadung, Jakarta Timur 13220
              </p>
<div class="bg-light p-3 rounded-3 mb-3 small">
<div class="fw-semibold text-dark mb-1"><i class="bi bi-clock-fill text-primary me-1"></i> Jam Operasional:</div>
<div class="d-flex justify-content-between text-muted mb-1">
<span>Senin - Sabtu:</span> <span class="fw-medium text-dark">08.30 - 20.30 WIB</span>
</div>
<div class="d-flex justify-content-between text-muted">
<span>Minggu:</span> <span class="badge bg-light text-danger border">Tutup</span>
</div>
</div>
<div class="mb-4">
<div class="fw-semibold text-dark small mb-2"><i class="bi bi-check2-circle text-primary me-1"></i> Fasilitas Outlet:</div>
<div class="d-flex flex-wrap gap-1">
<span class="badge bg-white text-secondary border small">Ambil Order Online</span>
<span class="badge bg-white text-secondary border small">Cetak Buku &amp; Dokumen</span>
<span class="badge bg-white text-secondary border small">Cetak Kaos DTF</span>
<span class="badge bg-white text-secondary border small">Parkir Motor &amp; Mobil</span>
</div>
</div>
<div class="mt-auto d-grid gap-2">
<a class="btn btn-outline-primary rounded-pill fw-semibold btn-sm py-2" href="https://maps.google.com/?q=PrimaGraphia+Rawamangun+Jakarta" rel="noopener noreferrer" target="_blank">
<i class="bi bi-geo-alt me-1"></i> Petunjuk Arah Google Maps
                </a>
<a class="btn btn-success rounded-pill fw-semibold btn-sm py-2" href="https://wa.me/62811987990?text=Halo%20PrimaGraphia%20Rawamangun,%20saya%20ingin%20tanya%20pesanan" rel="noopener noreferrer" target="_blank">
<i class="bi bi-whatsapp me-1"></i> Chat WhatsApp CS Cabang
                </a>
</div>
</div>
</div>
</div>
<!-- Outlet 5: Fatmawati -->
<div class="col outlet-item" data-name="fatmawati cilandak rs fatmawati selatan jakarta" data-region="selatan">
<div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
<div class="ratio ratio-16x9 bg-secondary">
<img alt="PrimaGraphia Fatmawati" class="card-img-top object-fit-cover" data-alt="PrimaGraphia Fatmawati store facade located in Cilandak South Jakarta near MRT station with clean modern architectural signage and customer entrance." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBDjm5HWgeJzJrKjVp2YV4vUkpe0bUAXPF684lLeuMfIiNIvJTy69FS7c2vIWP8DLhhueFJsaQdTxEVPfxBEUM_mNNOEc0RgK5-T7PZ8ob8zDcAKQBqMSofxrKVPUv2cqPLt76O4sBozcN-Fza_sHIeA9vHUU7oO9-6W4FYWNpUCeo5o4arLhb0ch9uSgqCFCaiUoNkNnJLVD8KAcI9iw9Fq4hMDl8l7SKkRcqbvA"/>
</div>
<div class="card-body p-4 d-flex flex-column">
<div class="d-flex align-items-center justify-content-between mb-2">
<span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2 py-1 small">Jakarta Selatan</span>
<span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 small"><i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>Buka Hari Ini</span>
</div>
<h5 class="card-title fw-bold text-dark mb-2">PrimaGraphia Fatmawati</h5>
<p class="card-text text-muted small mb-3">
<i class="bi bi-geo-alt-fill text-danger me-1"></i>
                Jl. RS Fatmawati Raya No. 35, Cilandak, Jakarta Selatan 12430
              </p>
<div class="bg-light p-3 rounded-3 mb-3 small">
<div class="fw-semibold text-dark mb-1"><i class="bi bi-clock-fill text-primary me-1"></i> Jam Operasional:</div>
<div class="d-flex justify-content-between text-muted mb-1">
<span>Senin - Sabtu:</span> <span class="fw-medium text-dark">08.30 - 20.00 WIB</span>
</div>
<div class="d-flex justify-content-between text-muted">
<span>Minggu:</span> <span class="badge bg-light text-danger border">Tutup</span>
</div>
</div>
<div class="mb-4">
<div class="fw-semibold text-dark small mb-2"><i class="bi bi-check2-circle text-primary me-1"></i> Fasilitas Outlet:</div>
<div class="d-flex flex-wrap gap-1">
<span class="badge bg-white text-secondary border small">Akses Dekat Stasiun MRT</span>
<span class="badge bg-white text-secondary border small">Packaging &amp; Box Sample</span>
<span class="badge bg-white text-secondary border small">Ambil Order Online</span>
<span class="badge bg-white text-secondary border small">Kartu Nama Express</span>
</div>
</div>
<div class="mt-auto d-grid gap-2">
<a class="btn btn-outline-primary rounded-pill fw-semibold btn-sm py-2" href="https://maps.google.com/?q=PrimaGraphia+Fatmawati+Jakarta" rel="noopener noreferrer" target="_blank">
<i class="bi bi-geo-alt me-1"></i> Petunjuk Arah Google Maps
                </a>
<a class="btn btn-success rounded-pill fw-semibold btn-sm py-2" href="https://wa.me/62811987990?text=Halo%20PrimaGraphia%20Fatmawati,%20saya%20ingin%20tanya%20pesanan" rel="noopener noreferrer" target="_blank">
<i class="bi bi-whatsapp me-1"></i> Chat WhatsApp CS Cabang
                </a>
</div>
</div>
</div>
</div>
<!-- Outlet 6: Bintaro -->
<div class="col outlet-item" data-name="bintaro sektor 7 tangerang selatan boulevard bintaro jaya" data-region="tangerang">
<div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
<div class="ratio ratio-16x9 bg-secondary">
<img alt="PrimaGraphia Bintaro" class="card-img-top object-fit-cover" data-alt="Commercial shophouse storefront of PrimaGraphia Bintaro branch in Sector 7 South Tangerang with wide glass windows and clean modern corporate presentation." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBgUWNdpxxl3gKICtQoe7lMn3Fz7oGRyVn7CDxiDClYtAwJDuLf8VO68RJu01ChuzVbrflMUkM8qEMm_eeIil8rpbtT2EcDJceDAUKyt45pVV8jCsHWO7Lm00UKhBkRzmfVW6Jf8j2iRZeXW2N5lWf2ZvHIG8S9gC04Ps4-1Fso8OOPnzVOcnKH-RTZuAVaF8k-5Bsv7HtqKHD2BMVeWQ9pxqIAdOpm4F_sR-vTDw"/>
</div>
<div class="card-body p-4 d-flex flex-column">
<div class="d-flex align-items-center justify-content-between mb-2">
<span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2 py-1 small">Tangerang Selatan</span>
<span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 small"><i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>Buka Hari Ini</span>
</div>
<h5 class="card-title fw-bold text-dark mb-2">PrimaGraphia Bintaro</h5>
<p class="card-text text-muted small mb-3">
<i class="bi bi-geo-alt-fill text-danger me-1"></i>
                Ruko Bintaro Sektor 7, Jl. Boulevard Bintaro Jaya, Tangerang Selatan 15224
              </p>
<div class="bg-light p-3 rounded-3 mb-3 small">
<div class="fw-semibold text-dark mb-1"><i class="bi bi-clock-fill text-primary me-1"></i> Jam Operasional:</div>
<div class="d-flex justify-content-between text-muted mb-1">
<span>Senin - Sabtu:</span> <span class="fw-medium text-dark">08.30 - 20.00 WIB</span>
</div>
<div class="d-flex justify-content-between text-muted">
<span>Minggu:</span> <span class="badge bg-light text-danger border">Tutup</span>
</div>
</div>
<div class="mb-4">
<div class="fw-semibold text-dark small mb-2"><i class="bi bi-check2-circle text-primary me-1"></i> Fasilitas Outlet:</div>
<div class="d-flex flex-wrap gap-1">
<span class="badge bg-white text-secondary border small">Ambil Order Online</span>
<span class="badge bg-white text-secondary border small">Merchandise &amp; UV Flatbed</span>
<span class="badge bg-white text-secondary border small">Proofing Tekstur Kertas</span>
<span class="badge bg-white text-secondary border small">Parkir Ruko Nyaman</span>
</div>
</div>
<div class="mt-auto d-grid gap-2">
<a class="btn btn-outline-primary rounded-pill fw-semibold btn-sm py-2" href="https://maps.google.com/?q=PrimaGraphia+Bintaro+Tangerang" rel="noopener noreferrer" target="_blank">
<i class="bi bi-geo-alt me-1"></i> Petunjuk Arah Google Maps
                </a>
<a class="btn btn-success rounded-pill fw-semibold btn-sm py-2" href="https://wa.me/62811987990?text=Halo%20PrimaGraphia%20Bintaro,%20saya%20ingin%20tanya%20pesanan" rel="noopener noreferrer" target="_blank">
<i class="bi bi-whatsapp me-1"></i> Chat WhatsApp CS Cabang
                </a>
</div>
</div>
</div>
</div>
<!-- Outlet 7: Bekasi Cyber Park -->
<div class="col outlet-item" data-name="bekasi cyber park barat noer ali bcp" data-region="bekasi">
<div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
<div class="ratio ratio-16x9 bg-secondary">
<img alt="PrimaGraphia Bekasi Cyber Park" class="card-img-top object-fit-cover" data-alt="PrimaGraphia Bekasi Cyber Park storefront along Jalan KH Noer Ali Bekasi Barat with vibrant digital print samples displayed in windows and bright lighting." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDQHCL1DnurK0D_VjlWtCOFO2xibmEQu98w-OBPnhVcbyluQceVUVzABWMxE2LUtaTsZ-Z0f0joMLiNCJYWluN1P1VNnYIKAx5-ip8FEeZS9llqnUagXX3FRnoI6mPemTGls_rcf1zW8-iGlrWuoy54tQ4VobPXP-Zj4z8v4W6aw4Jzu00z2D1NXaM1F4TMvdD4OheUCsV9gfZ7dZp1qsdNlw6MxiFOxbEa-eU34g"/>
</div>
<div class="card-body p-4 d-flex flex-column">
<div class="d-flex align-items-center justify-content-between mb-2">
<span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2 py-1 small">Bekasi Barat</span>
<span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 small"><i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>Buka Hari Ini</span>
</div>
<h5 class="card-title fw-bold text-dark mb-2">PrimaGraphia Bekasi Cyber Park</h5>
<p class="card-text text-muted small mb-3">
<i class="bi bi-geo-alt-fill text-danger me-1"></i>
                Jl. KH. Noer Ali No. 177, Bekasi Barat, Kota Bekasi 17148
              </p>
<div class="bg-light p-3 rounded-3 mb-3 small">
<div class="fw-semibold text-dark mb-1"><i class="bi bi-clock-fill text-primary me-1"></i> Jam Operasional:</div>
<div class="d-flex justify-content-between text-muted mb-1">
<span>Senin - Sabtu:</span> <span class="fw-medium text-dark">09.00 - 20.00 WIB</span>
</div>
<div class="d-flex justify-content-between text-muted">
<span>Minggu:</span> <span class="badge bg-light text-danger border">Tutup</span>
</div>
</div>
<div class="mb-4">
<div class="fw-semibold text-dark small mb-2"><i class="bi bi-check2-circle text-primary me-1"></i> Fasilitas Outlet:</div>
<div class="d-flex flex-wrap gap-1">
<span class="badge bg-white text-secondary border small">Ambil Order Online</span>
<span class="badge bg-white text-secondary border small">Area Strategis Dekat Mall</span>
<span class="badge bg-white text-secondary border small">Display Promo &amp; Roll Banner</span>
<span class="badge bg-white text-secondary border small">Konsultasi Cetak Kemasan</span>
</div>
</div>
<div class="mt-auto d-grid gap-2">
<a class="btn btn-outline-primary rounded-pill fw-semibold btn-sm py-2" href="https://maps.google.com/?q=PrimaGraphia+Bekasi+Cyber+Park" rel="noopener noreferrer" target="_blank">
<i class="bi bi-geo-alt me-1"></i> Petunjuk Arah Google Maps
                </a>
<a class="btn btn-success rounded-pill fw-semibold btn-sm py-2" href="https://wa.me/62811987990?text=Halo%20PrimaGraphia%20Bekasi,%20saya%20ingin%20tanya%20pesanan" rel="noopener noreferrer" target="_blank">
<i class="bi bi-whatsapp me-1"></i> Chat WhatsApp CS Cabang
                </a>
</div>
</div>
</div>
</div>
</div>
<!-- No Results State -->
<div class="alert alert-light border text-center py-5 d-none rounded-4 my-4" id="noResultsAlert">
<i class="bi bi-search text-muted fs-1 mb-3 d-block"></i>
<h5 class="fw-bold text-dark">Outlet Tidak Ditemukan</h5>
<p class="text-muted mb-3 small">Coba ubah kata kunci pencarian atau pilih filter wilayah yang lain.</p>
<button class="btn btn-sm btn-primary rounded-pill px-4" id="resetFilterBtn" type="button">Tampilkan Semua Cabang</button>
</div>
</div>
</section>
<!-- Interactive Map Section -->
<section class="py-5 bg-white border-top border-bottom">
<div class="container">
<div class="row align-items-center mb-4">
<div class="col-md-8">
<span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1 mb-2 fw-semibold">Peta Sebaran</span>
<h2 class="fw-bold text-dark mb-1">Cakupan Wilayah Percetakan PrimaGraphia</h2>
<p class="text-muted small mb-0">Temukan lokasi workshop dan gerai retail PrimaGraphia di seluruh sudut Jabodetabek.</p>
</div>
<div class="col-md-4 text-md-end mt-3 mt-md-0">
<a class="btn btn-outline-primary rounded-pill btn-sm px-3 fw-semibold" href="https://maps.google.com/?q=PrimaGraphia+Percetakan+Jakarta" rel="noopener noreferrer" target="_blank">
<i class="bi bi-arrow-up-right-square me-1"></i> Buka di Google Maps Penuh
          </a>
</div>
</div>
<div class="card border-0 rounded-4 shadow-sm overflow-hidden position-relative">
<div class="w-full bg-cover bg-center rounded-xl position-relative" data-alt="High contrast stylized top-down regional map mockup of Greater Jakarta Jabodetabek region with pinpoint icons marking branches in Central Jakarta, South Jakarta, East Jakarta, Bintaro Tangerang, and Bekasi with clear highways." data-location="Jakarta, Indonesia" style="height: 420px; background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDBL2Y4SlkBk_VbzEGDJxEmh2X6cvCLDFqlD3WrXr3cgOwm2NZLcGqmxJdKB0Z7HLXbzjH5Zy7gr8TiYckmhPFwsKE73i_lslyTyjRAYHTop8lCQaqLaXmP4eYm6QqVyI9lPNKa0MyJE5oShVLzpsbL4yyuDy29eIV0JMT_c248STJXg-dWm2BlXzdKDNfMcCKhJ_Gz1dQ0ATB09FGSuPtychPYNPXNJ4F51c7d0g');">
<!-- Floating Map Interactive Card Overlay -->
<div class="position-absolute bottom-0 start-0 m-3 m-md-4 bg-white p-3 rounded-3 shadow-lg border" style="max-width: 320px; z-index: 5;">
<div class="d-flex align-items-center gap-2 mb-2">
<span class="badge bg-danger rounded-circle p-2"><i class="bi bi-geo-alt-fill text-white"></i></span>
<div>
<div class="fw-bold small text-dark">7 Titik Layanan Aktif</div>
<div class="text-muted" style="font-size: 0.75rem;">Terhubung langsung ke sistem produksi pusat</div>
</div>
</div>
<p class="text-muted small mb-2 lh-sm" style="font-size: 0.8rem;">
              Anda dapat menyerahkan sampel cetakan dan mengambil hasil akhir di cabang manapun sesuai preferensi.
            </p>
<div class="d-flex gap-2">
<a class="btn btn-sm btn-light border text-dark fw-semibold w-50 py-1" href="tel:0811987990" style="font-size: 0.75rem;">
<i class="bi bi-telephone me-1"></i> Telepon CS
              </a>
<a class="btn btn-sm btn-primary fw-semibold w-50 py-1" href="https://wa.me/62811987990" rel="noopener noreferrer" style="font-size: 0.75rem;" target="_blank">
<i class="bi bi-whatsapp me-1"></i> Konsultasi
              </a>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Click & Collect (Pesan Online Ambil di Outlet) Feature Section -->
<section class="py-5 bg-light">
<div class="container">
<div class="text-center mx-auto mb-5" style="max-width: 680px;">
<span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1 mb-2 fw-semibold">
<i class="bi bi-lightning-charge-fill me-1 text-warning"></i> Solusi Lebih Efisien
        </span>
<h2 class="fw-bold text-dark mb-2">Pesan Online, Ambil di Outlet (Click &amp; Collect)</h2>
<p class="text-muted fs-6">
          Nikmati kemudahan pesan cetak dari rumah atau kantor kapan saja, lalu ambil hasilnya di counter ekspres cabang pilihan tanpa perlu antre dan bebas biaya kirim!
        </p>
</div>
<div class="row g-4">
<!-- Step 1 -->
<div class="col-12 col-md-4">
<div class="card h-100 border-0 rounded-4 p-4 shadow-sm bg-white position-relative">
<div class="d-flex align-items-center justify-content-between mb-3">
<div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 44px; height: 44px; font-size: 1.1rem;">
                1
              </div>
<span class="text-primary fs-3"><i class="bi bi-laptop"></i></span>
</div>
<h5 class="fw-bold text-dark mb-2">Pesan &amp; Unggah File Online</h5>
<p class="text-muted small mb-0 lh-base">
              Pilih spesifikasi produk, hitung harga otomatis, upload desain siap cetak Anda di website, lalu pilih opsi pengiriman <strong>"Ambil di Cabang Outlet"</strong> yang terdekat dengan lokasi Anda.
            </p>
</div>
</div>
<!-- Step 2 -->
<div class="col-12 col-md-4">
<div class="card h-100 border-0 rounded-4 p-4 shadow-sm bg-white position-relative">
<div class="d-flex align-items-center justify-content-between mb-3">
<div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 44px; height: 44px; font-size: 1.1rem;">
                2
              </div>
<span class="text-success fs-3"><i class="bi bi-whatsapp"></i></span>
</div>
<h5 class="fw-bold text-dark mb-2">Terima Notifikasi Siap Ambil</h5>
<p class="text-muted small mb-0 lh-base">
              Tim produksi kami memproses cetakan dengan standar kontrol warna ketat. Begitu order selesai dikemas dan siap di cabang tujuan, Anda akan menerima pesan WhatsApp konfirmasi beserta QR pengambilan.
            </p>
</div>
</div>
<!-- Step 3 -->
<div class="col-12 col-md-4">
<div class="card h-100 border-0 rounded-4 p-4 shadow-sm bg-white position-relative">
<div class="d-flex align-items-center justify-content-between mb-3">
<div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 44px; height: 44px; font-size: 1.1rem;">
                3
              </div>
<span class="text-danger fs-3"><i class="bi bi-box-seam"></i></span>
</div>
<h5 class="fw-bold text-dark mb-2">Ambil di Counter Ekspres</h5>
<p class="text-muted small mb-0 lh-base">
              Datangi outlet PrimaGraphia yang Anda pilih, tunjukkan nomor pesanan / barcode WhatsApp pada petugas counter khusus Click &amp; Collect, lalu bawa pulang cetakan Anda tanpa antrean reguler!
            </p>
</div>
</div>
</div>
<!-- Action Banner -->
<div class="mt-5 p-4 p-lg-5 rounded-4 text-white position-relative overflow-hidden shadow-sm" style="background: linear-gradient(135deg, #004b93 0%, #002e5b 60%, #e30613 130%);">
<div class="row align-items-center g-3 position-relative z-1">
<div class="col-lg-8">
<h3 class="fw-bold mb-2">Butuh Bantuan Memilih Cabang atau Mau Cetak Spesial?</h3>
<p class="text-white-50 mb-0">Customer Care PrimaGraphia siap memandu proofing bahan, quantity grosir partai besar, dan rute outlet tercepat.</p>
</div>
<div class="col-lg-4 text-lg-end">
<a class="btn btn-light text-primary rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2" href="https://wa.me/62811987990?text=Halo%20PrimaGraphia,%20saya%20butuh%20bantuan%20mengenai%20outlet%20dan%20pemesanan" rel="noopener noreferrer" target="_blank">
<i class="bi bi-whatsapp text-success fs-5"></i> Hubungi Customer Service
            </a>
</div>
</div>
</div>
</div>
</section>
<!-- Client-side Filtering & Search Script -->
</div>

@endsection