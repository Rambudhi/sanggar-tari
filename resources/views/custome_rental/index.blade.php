@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .option .custome-radio {
            display: inline-block;
        }

        #hero {
            width: 100%;
            height: 75vh;
            background: url(../assets/img/background_custom.png) top left;
            background-size: cover;
            position: relative;
        }

        #hero:before {
            content: "";
            background: none !important;
            position: absolute;
            bottom: 0;
            top: 0;
            left: 0;
            right: 0;
        }

        .primary-container {
            display: flex;
        }

        .primary-sidebar {
            width: 250px;
            background-color: rgba(243, 221, 248, 0.5);
            position: sticky;
            top: 0;
            height: 70vh;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 5px 5px 5px #d4d4d4;
        }

        .primary-image {
            width: 100%;
            background-color: rgba(243, 221, 248, 0.5);
            position: sticky;
            top: 0;
            height: 100%;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 5px 5px 5px #d4d4d4;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li .side {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .expand-btn::before {
            content: '▶';
            margin-right: 5px;
            display: inline-block;
        }

        .expand-btn.expanded::before {
            content: '▼';
        }

        .expand-btn:hover {
            cursor: pointer;
        }

        .nested-list {
            display: none;
            margin-left: 20px;
        }

        .nested-list.visible {
            display: block;
        }

        .custome-checkbox input[type="checkbox"]:checked + .form-check-label::before {
            background-color: #A705CF;
            border-color: #A705CF;
        }
        .custome-checkbox .form-check-label::before {
            content: "";
            border: 2px solid #A705CF;
            height: 17px;
            width: 17px;
            margin: 0px 8px 0 0;
            display: inline-block;
            vertical-align: middle;
            border-radius: 2px;
        }
        .custome-checkbox .form-check-label {
            position: relative;
            cursor: pointer;
            color: #687188;
            padding: 0;
            vertical-align: middle;
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

        h4 {
            color: #5e575c;
        }

        .btn-primary {
            background: #A705CF !important;
            border-color: #A705CF !important;
        }
    </style>
@endsection

@section('content')
<div class="main">
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <div class="position-relative">

            </div>
        </div>
    </section>
    <!-- End Hero --> 
    <!-- ======= Contact Section ======= -->
    <section id="Register-course" class="contact">
        <div class="container" data-aos="fade-up">
            <div data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group pb-3">
                                    <select class="form-select">
                                        <option value="">Jenis Kostum</option>
                                        @foreach ($costume_type as $item)
                                            <option value="{{ $item->id }}">{{ ucfirst($item ->nama) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group pb-3">
                                    <select class="form-select">
                                        <option value="">Ukuran</option>
                                        @foreach ($size as $item)
                                            <option value="{{ $item->id }}">{{ ucfirst($item ->nama) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group pb-3">
                                    <select class="form-select">
                                        <option>Type</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group pb-3">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="primary-container">
                            <div class="primary-image"> 
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                                        <a href="" class="picture">
                                            <div class="member box">
                                                <div class="member-img">
                                                  <img src="{{ asset('assets/img/kostum-1.svg') }}" class="img-fluid pb-2" alt="" style="height: 300px;">
                                                </div>
                                                <div class="member-info">
                                                    <h4>Baju Tari Madura</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                                        <a href="" class="picture">
                                            <div class="member box">
                                                <div class="member-img">
                                                  <img src="{{ asset('assets/img/kostum-1.svg') }}" class="img-fluid pb-2" alt="" style="height: 300px;">
                                                </div>
                                                <div class="member-info">
                                                    <h4>Baju Tari Madura</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                                        <a href="" class="picture">
                                            <div class="member box">
                                                <div class="member-img">
                                                  <img src="{{ asset('assets/img/kostum-1.svg') }}" class="img-fluid pb-2" alt="" style="height: 300px;">
                                                </div>
                                                <div class="member-info">
                                                    <h4>Baju Tari Madura</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                                        <a href="" class="picture">
                                            <div class="member box">
                                                <div class="member-img">
                                                  <img src="{{ asset('assets/img/kostum-1.svg') }}" class="img-fluid pb-2" alt="" style="height: 300px;">
                                                </div>
                                                <div class="member-info">
                                                    <h4>Baju Tari Madura</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>  

                                {{-- <div class="row">
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
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
        let expandBtns = document.querySelectorAll('.expand-btn');

        expandBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                this.classList.toggle('expanded');
                let nestedList = this.querySelector('.nested-list');
                nestedList.classList.toggle('visible');
            });
        });
    });
</script>
@endsection