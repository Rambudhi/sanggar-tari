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
    <section id="proses-verication" class="contact section-bg">
        <div class="container" data-aos="fade-up">
            <div class="col-lg-12" style="padding-top: 5rem">
                <div class="info-box mb-4">
                  <img src="{{ asset('assets/img/Icon-waiting.png') }}" alt="">
                  <h3>Dalam Proses Verifikasi</h3>
                  <p>Akun anda dalam proses verifikasi, mohon menunggu proses verifikasi dalam waktu 1 - 7 hari kerja</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Section --> 
</div>
@endsection
