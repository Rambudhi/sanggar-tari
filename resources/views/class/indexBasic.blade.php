@extends('layouts.app')

@section('styles')
    <style>
        .contact .info-box {
            background-color:white;
        }

        .box {
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 20px;
        }
        .pagination li {
            margin: 0 5px;
        }
        .pagination a {
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #ccc;
            background-color: #ffffff;
            color: black;
        }

        .btn-check:checked+.btn, .btn.active, .btn.show, .btn:first-child:active, :not(.btn-check)+.btn:active {
            color: black;
            border: 1px solid #ccc !important;
            background-color: #eb9cd1 !important;
        }

        .btn-info {
            --bs-btn-hover-bg: #eb9cd1 !important;
            --bs-btn-hover-border-color: #ccc !important;
        }

        a.disabled {
            color: #ccc !important; /* Light gray color */
            background-color: #5e575c !important;
            border : 1px solid #5e575c !important;
            pointer-events: none !important; /* Disable mouse events */
            text-decoration: none !important; /* Remove underline */
            cursor: not-allowed !important; /* Change cursor to indicate not clickable */
        }
    </style>
@endsection

@section('content')
<div class="main">
    <!-- ======= Contact Section ======= -->
    <section id="proses-verication" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="pt-5">
                <button class="btn btn-primary" @if ($kategori == 'Basic') disabled @endif>Basic</button>
                <button class="btn btn-primary" onclick="window.location.href = '{{ route('class', 'Junior') }}'">Junior</button>
                <button class="btn btn-primary" onclick="window.location.href = '{{ route('class', 'Remaja') }}'">Remaja</button>
                <button class="btn btn-primary" onclick="window.location.href = '{{ route('class', 'Lansia') }}'">Lansia</button>
            </div>
        </div>
    </section>
    <section id="proses-verication" class="contact section-bg">
        <div class="container" data-aos="fade-up">
            <h2>Kursus Tari {{ $kategori }}</h2>
            <div class="row">
                <div class="col-lg-6 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="d-flex align-items-md-center">
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,  when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1995s
                        </p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                    <img class="ms-auto" src="{{ asset('assets/img/tari.png') }}" height="400" width="400">
                </div>
            </div>
        </div>
    </section>
    <section id="kursus" class="services">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Explore Materi Tari</h2>
                <p></p>
            </div>
            <div class="row">
              @foreach ($kategori_materi as $item)
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ route('class-video', ['kategori' => $kategori, 'id' => $item->id]) }}" class="picture">
                        <div class="member box" style="border: 1px solid #a69a9a;">
                            <div class="member-img">
                              <img src="{{ $item->image_materi }}" class="img-fluid pb-2" alt="" style="height: 300px;">
                            </div>
                            <div class="member-info p-3">
                              <h4>{{ $item->nama_materi }}</h4>
                            </div>
                        </div>
                    </a>
                </div>
              @endforeach
            </div>
            
            <div class="row">
                <ul class="pagination">
                    @if ($kategori_materi->currentPage() > 1)
                        <li><a href="{{ $kategori_materi->previousPageUrl() }}" class="btn btn-info">Sebelumnya</a></li>                        
                    @else
                        <li><a href="{{ $kategori_materi->previousPageUrl() }}" class="btn btn-info disabled">Sebelumnya</a></li>
                    @endif

                    @for ($i = 1; $i <= $kategori_materi->lastPage(); $i++)
                        <li><a href="{{ $kategori_materi->url($i) }}" class="btn {{ $kategori_materi->currentPage() === $i ? 'btn-info active' : 'btn-secondary' }}">{{ $i }}</a></li>
                    @endfor

                    @if ($kategori_materi->hasMorePages())
                        <li><a href="{{ $kategori_materi->nextPageUrl() }}" class="btn btn-info">Selanjutnya</a></li>
                    @else
                        <li><a href="{{ $kategori_materi->nextPageUrl() }}" class="btn btn-info disabled">Selanjutnya</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </section> 
</div>
@endsection
