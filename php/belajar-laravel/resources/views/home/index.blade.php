@extends('layouts.app')
@section('content')
        <!-- BEGIN: HeroPromoSection -->
        <!-- Membungkus seluruh section utama dengan kontainer standar agar simetris dengan navbar atas -->
        <section class="py-3 py-lg-4 container" data-purpose="hero-promotions">

            <!-- Hero Promotional Slider / Banner Mockup -->
            <!-- Menghapus semua penumpukan container-fluid dan margin eksternal yang merusak layout -->
            <div class="hero-banner-card p-4 p-md-5 mb-4 position-relative">
                <div class="banner-graphic-bg position-absolute top-0 start-0 w-100 h-100 pointer-events-none">
                </div>
                <div class="row align-items-center position-relative z-1 g-4">
                    <!-- Promo Left Copy -->
                    <div class="col-lg-6 col-md-7 text-white">
                        <span class="badge bg-white text-danger fw-bold text-uppercase px-2.5 py-1 mb-2 rounded-2"
                            style="font-size: 0.75rem;">Baru!</span>
                        <h1 class="display-6 fw-extrabold lh-tight mb-2 fw-bold">
                            Kartu Nama <br class="d-none d-sm-inline" />Premium
                        </h1>
                        <p class="fs-6 text-white-50 mb-3 fw-medium">
                            Spot UV &amp; Foil Digital finishing mewah dan berkelas. Buat impresi pertama bisnis
                            Anda tak terlupakan.
                        </p>
                        <div class="d-flex align-items-baseline gap-2 mb-4">
                            <span class="text-white-50 fs-6">Mulai</span>
                            <span class="fs-2 fw-bold text-warning">Rp87.500</span>
                            <span class="badge bg-warning text-dark fw-bold rounded-pill px-2.5 py-1"
                                style="font-size: 0.7rem;">Tanpa minimum order</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <a class="btn btn-light rounded-pill px-4 py-2 fw-bold text-primary shadow-sm d-inline-flex align-items-center gap-2"
                                href="#">
                                Lihat promo <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Promo Right Visual Display Mockup -->
                    <div class="col-lg-6 col-md-5 text-center text-md-end">
                        <div class="position-relative d-inline-block">
                            <div
                                class="p-3 bg-white bg-opacity-10 rounded-4 border border-white border-opacity-25 shadow-lg d-inline-block">
                                <div class="bg-dark text-white rounded-3 p-4 shadow-sm"
                                    style="width: 260px; height: 155px; transform: rotate(-4deg); background: linear-gradient(135deg, #1e293b, #0f172a);">
                                    <div class="d-flex justify-content-between align-items-start mb-4">
                                        <span class="badge bg-warning text-dark fw-bold"
                                            style="font-size: 0.65rem;">SPOT UV DIGITAL</span>
                                        <i class="bi bi-stars text-warning fs-5"></i>
                                    </div>
                                    <div class="fw-bold fs-6 tracking-wide text-uppercase">PT Prima Inovasi</div>
                                    <div class="text-white-50" style="font-size: 0.7rem;">Foil Emas Premium Finish
                                    </div>
                                </div>
                            </div>
                            <!-- Navigation Controls Overlay -->
                            <div class="position-absolute bottom-0 end-0 d-flex gap-2 p-2">
                                <button aria-label="Slide sebelumnya"
                                    class="btn btn-sm btn-light rounded-circle shadow-sm p-0 d-flex align-items-center justify-content-center"
                                    style="width: 32px; height: 32px;">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <button aria-label="Slide berikutnya"
                                    class="btn btn-sm btn-light rounded-circle shadow-sm p-0 d-flex align-items-center justify-content-center"
                                    style="width: 32px; height: 32px;">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Bagian 4 USP Cards otomatis rapi mengikuti kontainer induk di atas -->
            <div class="row g-2 g-md-3">
                <div class="col-6 col-lg-3">
                    <div class="usp-item d-flex align-items-center gap-2 gap-md-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-2 d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px; flex-shrink: 0;">
                            <i class="bi bi-shop fs-5"></i>
                        </div>
                        <div class="lh-sm">
                            <div class="fw-bold text-dark" style="font-size: 0.85rem;">7 outlet</div>
                            <div class="text-muted" style="font-size: 0.75rem;">di Jabodetabek</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="usp-item d-flex align-items-center gap-2 gap-md-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-2 d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px; flex-shrink: 0;">
                            <i class="bi bi-bag-check fs-5"></i>
                        </div>
                        <div class="lh-sm">
                            <div class="fw-bold text-dark" style="font-size: 0.85rem;">Pesan online</div>
                            <div class="text-muted" style="font-size: 0.75rem;">ambil di outlet</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="usp-item d-flex align-items-center gap-2 gap-md-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-2 d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px; flex-shrink: 0;">
                                <i class="bi bi-truck fs-5"></i>
                            </div>
                            <div class="lh-sm">
                                <div class="fw-bold text-dark" style="font-size: 0.85rem;">Bisa dikirim</div>
                                <div class="text-muted" style="font-size: 0.75rem;">ke seluruh Indonesia</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="usp-item d-flex align-items-center gap-2 gap-md-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-2 d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px; flex-shrink: 0;">
                                <i class="bi bi-download fs-5"></i>
                            </div>
                            <div class="lh-sm">
                                <div class="fw-bold text-dark" style="font-size: 0.85rem;">Unduh template</div>
                                <div class="text-muted" style="font-size: 0.75rem;">desain siap pakai</div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
@endsection
