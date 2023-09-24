@extends('layouts.app')

@section('styles')
<style>
     /* Custom scrollbar */
     .video-list-container {
        max-height: 600px; /* Set the maximum height for the container */
        overflow-y: scroll; /* Enable vertical scrolling */
        scrollbar-width: thin; /* Set the width of the scrollbar */
        scrollbar-color: #888 #f0f0f0; /* Define the color of the scrollbar */
    }

    /* Style the list items */
    ul.video-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    ul.video-list li {
        margin-bottom: 10px;
    }

    video::-webkit-media-controls-enclosure {
        overflow:hidden;
    }
    video::-webkit-media-controls-panel {
        width: calc(100% + 30px);
    }
    li:hover {
        cursor: pointer; /* Change cursor to pointer on hover */
    }
</style>
@endsection

@section('content')
<div class="main">
    <!-- ======= Contact Section ======= -->
    <section id="proses-verication" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="pt-5">
                <button class="btn btn-primary" onclick="goBack()">Kembali</button>
            </div>
        </div>
    </section>
    <section id="proses-verication" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-md-8">
                    <div class="embed-responsive embed-responsive-16by9">
                        <video class="embed-responsive-item" controls width="800" id="video-default">
                            <source src="{{ $kategori_materi_detail[0]->video }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="p-3">
                        <h4><span id="video-name">{{ $kategori_materi_detail[0]->nama }}</span></h4>
                    </div>
                    <div class="p-3">
                        <h4><span>Penjelasan</span></h4>
                    </div>
                    <div class="p-3">
                        <p id="video-desc">{{ $kategori_materi_detail[0]->desc }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="video-list-container">
                        <ul class="video-list">
                            @foreach ($kategori_materi_detail as $item)
                                <li class="d-flex" id="{{ $item->nama }}" onclick="onLiClick('{{ $item->nama }}')" data-items="{{ json_encode($item) }}">
                                    <video width="200" height="100">
                                        <source src="{{ $item->video }}" type="video/mp4">
                                    </video>
                                    <div style="padding-top: 40px;">
                                        <h4><span>{{ $item->nama }}</span></h4>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    function goBack() {
        window.history.back();
    }

    function onLiClick(test) {
        var element = document.getElementById(test);
        var attributeValue = element.getAttribute('data-items');
        var jsonObject = JSON.parse(attributeValue); 

        var videoElement = document.getElementById('video-default');
        videoElement.src = jsonObject.video;
        videoElement.load();

        document.getElementById('video-name').textContent = jsonObject.nama;
        document.getElementById('video-desc').textContent = jsonObject.desc;
    }
</script>
@endsection
