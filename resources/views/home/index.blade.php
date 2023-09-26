@extends('layouts.app')

@section('styles')
    <style>
        .btn-primary {
            background-color: #D220FF !important;
            color: white !important;
            border-color: #D220FF !important; 
        }
    </style>
@endsection

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <div class="position-relative">
                <div class="row align-items-center">
                    <div class="col-md-6 col-lg-6 align-items-stretch mb-5 mb-lg-0">
                        <h3>Selamat Datang di <span>Sangggar Tari Purnama</span></h3>
                        <h2>Lihat profil sanggar</h2>
                        <div class="d-flex">
                            <a href="#profile" class="btn-get-started scrollto">Get Started</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 d-flex align-items-stretch ">
                        <img class="logo-tari" src="{{ asset('assets/img/tari.svg') }}" height="550" width="750" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero -->

    <main id="main">
        <!-- ======= Featured Services Section ======= -->
        <section id="featured-services" class="featured-services" style="display: {{ $display }}">
            <div class="container" data-aos="fade-up">
                <div class="row mx-auto">
                    <!-- Button trigger modal -->
                    <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                            <h4 class="title text-center"><a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Daftar Kursus</a></h4>
                            <div class="icon"><img src="{{ asset('assets/img/register.svg') }}" class="img-fluid" alt="..."></div>
                        </div> 
                    </div>
                    
                    <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                            <h4 class="title text-center"><a href="">Sewa Kostum</a></h4>
                            <div class="icon"><img src="{{ asset('assets/img/sewa-kustom-icon.svg') }}" class="img-fluid" style="height: 240px !important; width: 260px; !important;" alt="..." ></div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                            <h4 class="title text-center"><a href="">Materi Kursus</a></h4>
                            <div class="icon"><img src="{{ asset('assets/img/materi-kursus-icon.svg') }}" class="img-fluid" alt="..."></div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Featured Services Section -->

        <!-- ======= Team Section ======= -->
        <section id="team" class="team" style="display: {{ $display }}">
            <div class="container" data-aos="fade-up">
        
                <div class="section-title">
                    <h2>Pilih Paket Tari</h2>
                    <p>life will always change.</p>
                </div>
        
                <div class="row">
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('assets/img/icon-basic.svg') }}" class="img-fluid" alt="">
                            </div>
                            <div class="member-info text-center">
                                <h4>Basic</h4>
                            </div>
                        </div>
                    </div>
        
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('assets/img/icon-junior.svg') }}" class="img-fluid" alt="">
                            </div>
                            <div class="member-info text-center">
                                <h4>Junior</h4>
                            </div>
                        </div>
                    </div>
        
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('assets/img/icon-remaja.svg') }}" class="img-fluid" alt="">
                            </div>
                            <div class="member-info text-center">
                                <h4>Remaja</h4>
                            </div>
                        </div>
                    </div>
        
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('assets/img/icon-lansia.svg') }}" class="img-fluid" alt="">
                            </div>
                            <div class="member-info text-center">
                                <h4>Lansia</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Team Section -->

        <!-- ======= Services Section ======= -->
        <section id="kursus" class="services" style="display: {{ $display_kelas }}">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Kursus Saya</h2>
                    <p></p>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="align-items-md-center">
                            <img class="ms-auto" src="{{ asset('assets/img/image-tari.svg') }}" height="400" width="700">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                        <div class="text-center" style="padding-top: 200px; margin-left: 200px;">
                            <button class="btn btn-primary" style="width: 100%;" onclick="location.href = '{{ route('class', ['kategori' => $kategori]) }}'">Belajar Kursus</button>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Services Section -->

        <!-- ======= About Section ======= -->
        <section id="about" class="about section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h3>Sewa Kostum Purnama<span></span></h3>
                    <p>Yuk sewa kostum sebanyak-banyaknya</p>
                    <div style="text-align: right;">
                        <a href="{{ route('costume-rental') }}" style="color: rgb(132, 132, 124);">Tampilkan Semua</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                        <div class="splide">
                            <div class="splide__track">
                                <div class="splide__list">
                                    <div class="col-md-4 splide__slide m-2">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280" src="{{ asset('assets/img/kostum-1.svg') }}">
                                            <div class="card-body">
                                                <h5 class="card-title">Kostum Tari Adat Batak</h5>
                                                <p class="card-text">Penyewaan 3 hari</p>
                                            </div>
                                            <div class="card-footer">
                                                <p class="card-text">Rp. 100.000</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 splide__slide m-2">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280" src="{{ asset('assets/img/kostum-2.svg') }}">
                                            <div class="card-body">
                                                <h5 class="card-title">Kostum Tari Adat Batak</h5>
                                                <p class="card-text">Penyewaan 3 hari</p>
                                            </div>
                                            <div class="card-footer">
                                                <p class="card-text">Rp. 100.000</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 splide__slide m-2">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280" src="{{ asset('assets/img/kostum-3.svg') }}">
                                            <div class="card-body">
                                                <h5 class="card-title">Kostum Tari Adat Batak</h5>
                                                <p class="card-text">Penyewaan 3 hari</p>
                                            </div>
                                            <div class="card-footer">
                                                <p class="card-text">Rp. 100.000</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 splide__slide m-2">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280" src="{{ asset('assets/img/kostum-4.svg') }}">
                                            <div class="card-body">
                                                <h5 class="card-title">Kostum Tari Adat Batak</h5>
                                                <p class="card-text">Penyewaan 3 hari</p>
                                            </div>
                                            <div class="card-footer">
                                                <p class="card-text">Rp. 100.000</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 splide__slide m-2">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280" src="{{ asset('assets/img/kostum-5.svg') }}">
                                            <div class="card-body">
                                                <h5 class="card-title">Special title treatment</h5>
                                                <p class="card-text">Penyewaan 3 hari</p>
                                            </div>
                                            <div class="card-footer">
                                                <p class="card-text">Rp. 100.000</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 splide__slide m-2">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280" src="{{ asset('assets/img/kostum-1.svg') }}">
                                            <div class="card-body">
                                                <h5 class="card-title">Special title treatment</h5>
                                                <p class="card-text">Penyewaan 3 hari</p>
                                            </div>
                                            <div class="card-footer">
                                                <p class="card-text">Rp. 100.000</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 splide__slide m-2">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280" src="{{ asset('assets/img/kostum-2.svg') }}">
                                            <div class="card-body">
                                                <h5 class="card-title">Special title treatment</h5>
                                                <p class="card-text">Penyewaan 3 hari</p>
                                            </div>
                                            <div class="card-footer">
                                                <p class="card-text">Rp. 100.000</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Services Section ======= -->
        <section id="profile" class="services">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Profile</h2>
                    <h3>Sanggar Tari<span> Purnama</span></h3>
                    <p></p>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="d-flex align-items-md-center">
                            <p>
                                Sanggar Tari Purnama ini memilki banyak peminat yang kebanyakan anak kecil dan remaja, 
                                dengan seluruh jumlah 37 orang dengan prestasi-prestasi yang memukau, mengikuti beberapa perlombaan. 
                                sanggar tari purnama ini cukup dikenal banyak masyarakat, dan mengundang minat masyarakat untuk mendaftarkan anak-anaknya yang lebih suka terhadap 
                                seni termasuk tari. Sehingga banyak murid dari sanggar yang dari luar kota bekasi.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                        <img class="ms-auto" src="{{ asset('assets/img/image-tari.svg') }}" height="400" width="700">
                    </div>
                </div>
            </div>
        </section><!-- End Services Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Contact</h2>
                    <h3><span>Contact Us</span></h3>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-6 ">
                        <iframe class="mb-4 mb-lg-0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=sanggar tari purnama bekasi&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
                    </div>

                    <div class="col-lg-6">
                        <form method="post" action="https://formspree.io/f/xaygbevy" role="form" class="php-email-form" id="my-form">
                            <div class="row">
                                <div class="col form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                                </div>
                                <div class="col form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>
                    </div>
                </div>

            </div>
        </section>
        <!-- End Contact Section --> 
    </main>
    <!-- End #main -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #D220FF; color: white;">
                    <h5 class="modal-title" id="exampleModalLabel">Selamat Datang di Sanggar Purnama</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Hallo ,Yeayy 
                        Sekarang kita punya fitur Pendaftaran khursus tari
                        lhoo dan kamu bisa memilih materi video tari jika
                        kamu melakukan pendaftaran dan memilih kategori
                        Yuk, isi Form dulu...
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary ms-auto me-auto" onclick="location.href='{{ route('form-register-course') }}'">Isi Form</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    var splide = new Splide('.splide', {
        arrows :false,
        type: 'loop',
        perPage: 5,
        rewind: true,
        autoplay: "play"
    });

    splide.mount();

    var form = document.getElementById("my-form");
    
    async function handleSubmit(event) {
        event.preventDefault();
        var status = document.getElementById("my-form-status");
        var data = new FormData(event.target);
        fetch(event.target.action, {
            method: form.method,
            body: data,
            headers: {
                'Accept': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                toastr.options.timeOut = 8000;
                toastr.success('Thanks for your submission!');
                form.reset()
            } else {
                response.json().then(data => {
                    if (Object.hasOwn(data, 'errors')) {
                        toastr.options.timeOut = 8000;
                        toastr.error(data["errors"].map(error => error["message"]).join(", "));
                    } else {
                        toastr.options.timeOut = 8000;
                        toastr.error("There was a problem submitting your form");
                    }
                })
            }
        }).catch(error => {
            toastr.options.timeOut = 8000;
            toastr.error("There was a problem submitting your form");
        });
    }
    
    form.addEventListener("submit", handleSubmit)
</script>
@endsection