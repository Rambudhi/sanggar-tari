@extends('layouts.app')

@section('styles')
    <style>
        .contact .info-box {
            background-color:white;
        }
    </style>
@endsection

@section('content')
<div class="main">
    <!-- ======= Contact Section ======= -->
    <section id="proses-verication" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="pt-5">
                <button class="btn btn-primary">Basic</button>
                <button class="btn btn-primary" @if ($kategori == 'Junior') disabled @endif>Junior</button>
                <button class="btn btn-primary">Remaja</button>
                <button class="btn btn-primary">Lansia</button>
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
    <!-- End Contact Section --> 
</div>
@endsection
