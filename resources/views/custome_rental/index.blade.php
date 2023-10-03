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
                        <form method="GET" action="{{ route('costume-rental') }}">
                            <div class="row">
                                {{-- <div class="col-md-3">
                                    <div class="input-group pb-3">
                                        <select class="form-select">
                                            <option value="">Jenis Kostum</option>
                                            @foreach ($costume_type as $item)
                                                <option value="{{ $item->id }}">{{ ucfirst($item ->nama) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-4">
                                    <div class="input-group pb-3">
                                        <select class="form-select" id="size" name="size">
                                            <option value="">Ukuran</option>
                                            @foreach ($size as $item)
                                                <option value="{{ $item->id }}" @if ($size_value == $item->id) selected @endif>{{ ucfirst($item ->nama) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group pb-3">
                                        <select class="form-select animation-dropdown me-2 w-100" id="ketegori_kostum" name="ketegori_kostum">
                                            <option value="">-- Plih Kategori Kostum --</option>
                                            <option value="DL" @if ($ketegori_kostum === 'DL') selected @endif>Dewasa - Laki</option>
                                            <option value="DP" @if ($ketegori_kostum === 'DP') selected @endif>Dewasa - Perempuan</option>
                                            <option value="AL" @if ($ketegori_kostum === 'AL') selected @endif>Anak - Laki</option>
                                            <option value="AP" @if ($ketegori_kostum === 'AP') selected @endif>Anak - Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group pb-3">
                                        <input type="text" class="form-control" placeholder="Search..." name="costume_type_name">
                                        <button class="btn btn-primary" type="submit" onclick="window.location.href='/new_page'">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="primary-container">
                            <div class="primary-image"> 
                                <div class="row">
                                    @forelse ($costume_type_list as $item)
                                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                                            <a href="{{ route('costume-rental-by-custome', ['id' => $item->id]) }}" class="picture">
                                                <div class="member box">
                                                    <div class="member-img">
                                                        <img src="{{ $item->image }}" class="img-fluid pb-2" alt="" style="height: 250px; width: 300px; border-radius: 10px">
                                                    </div>
                                                    <div class="member-info">
                                                        <h4>{{ $item->nama }}</h4>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <div class="col-lg-12 col-md-12 align-items-center aos-init aos-animate" data-aos="fade-up" data-aos-delay="100" style="text-align: center;">
                                            <p>Tidak Ditemukan Data</p>
                                        </div>
                                    @endforelse
                                </div>  
                            </div>
                        </div>
                        <div class="row">
                            <ul class="pagination">
                                @if ($costume_type_list->currentPage() > 1)
                                    <li><a href="{{ $costume_type_list->previousPageUrl() }}" class="btn btn-info">Sebelumnya</a></li>                        
                                @else
                                    <li><a href="{{ $costume_type_list->previousPageUrl() }}" class="btn btn-info disabled">Sebelumnya</a></li>
                                @endif
            
                                @for ($i = 1; $i <= $costume_type_list->lastPage(); $i++)
                                    <li><a href="{{ $costume_type_list->url($i) }}" class="btn {{ $costume_type_list->currentPage() === $i ? 'btn-info active' : 'btn-secondary' }}">{{ $i }}</a></li>
                                @endfor
            
                                @if ($costume_type_list->hasMorePages())
                                    <li><a href="{{ $costume_type_list->nextPageUrl() }}" class="btn btn-info">Selanjutnya</a></li>
                                @else
                                    <li><a href="{{ $costume_type_list->nextPageUrl() }}" class="btn btn-info disabled">Selanjutnya</a></li>
                                @endif
                            </ul>
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