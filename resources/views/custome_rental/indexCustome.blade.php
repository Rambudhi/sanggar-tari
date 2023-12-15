@extends('layouts.app')

@section('styles')
    <style>
        .scroll-container {
            overflow-x: auto;
            white-space: nowrap;
            padding: 10px;
            margin: 20px 0;
            position: relative;
        }

        .scroll-content {
            display: inline-flex;
            transition: transform 0.3s ease-in-out;
        }

        .scroll-item {
            min-width: 100px;
            /* Adjust according to your content */
            padding: 10px;
            margin: 0 5px;
            background-color: #f0f0f0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .scrollbar {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background-color: #f0f0f0;
            border-radius: 4px;
        }

        .scroll-thumb {
            width: 20%;
            height: 100%;
            background-color: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar {
            width: 10px;
            /* Set the width of the scrollbar */
        }

        /* Handle */
        /* For Webkit Browsers (Chrome, Safari) */
        /* --------------------------------------- */
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
            /* Color of the scrollbar handle */
            min-height: 2px;
            /* Set the minimum height of the scrollbar handle */
            border-radius: 10px;
            /* Set the border radius of the scrollbar handle */
        }

        /* For Firefox */
        /* --------------------------------------- */
        /* Handle */
        body::-webkit-scrollbar-thumb {
            background-color: #888;
            /* Color of the scrollbar handle */
            min-height: 2px;
            /* Set the height of the scrollbar handle */
            border-radius: 10px;
            /* Set the border radius of the scrollbar handle */
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
            /* Color of the scrollbar handle on hover */
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f0f0f0;
            /* Color of the scrollbar track */
        }


        /* For Firefox */
        /* --------------------------------------- */
        /* Track */
        body {
            scrollbar-color: #888 #f0f0f0;
            /* Color of the scrollbar track and handle */
        }

        /* Handle */
        body::-webkit-scrollbar-thumb {
            background-color: #888;
            /* Color of the scrollbar handle */
        }

        /* Handle on hover */
        body::-webkit-scrollbar-thumb:hover {
            background-color: #555;
            /* Color of the scrollbar handle on hover */
        }

        /* Width of the scrollbar */
        body::-webkit-scrollbar {
            width: 10px;
        }

        /* Height of the scrollbar track */
        body::-webkit-scrollbar-track {
            background: #f0f0f0;
            /* Color of the scrollbar track */
        }

        /* Width of the scrollbar handle */
        body::-webkit-scrollbar-thumb {
            border-radius: 25px;
            /* Roundness of the scrollbar handle */
        }

        .image-container {
            padding: 10px;
            margin: 0 5px;
            position: relative;
            width: 630px;
            /* Adjust as needed */
        }

        .image {
            width: 600px;
            height: auto;
            display: block;
            border-radius: 8px;
            /* Optional: Add rounded corners to the image */
            box-shadow: 0 4px 8px rgba(147, 145, 145, 0.1);
            /* Add shadow effect */
        }

        .scroll-item-image-container {
            padding: 10px;
            margin: 0 5px;
            position: relative;
            width: 100px;
            /* Adjust as needed */
        }

        .image-items {
            width: 100px;
            height: auto;
            display: block;
            border-radius: 8px;
            /* Optional: Add rounded corners to the image */
            box-shadow: 0 4px 8px rgba(147, 145, 145, 0.1);
            /* Add shadow effect */
        }

        /* Styles for devices with a maximum width of 767px (typical mobile phones) */
        @media (max-width: 767px) {
            .image-container {
                padding: 10px;
                margin: 0 5px;
                position: relative;
                width: 380px;
                /* Adjust as needed */
            }

            .image {
                width: 360px;
                height: auto;
                display: block;
                border-radius: 8px;
                /* Optional: Add rounded corners to the image */
                box-shadow: 0 4px 8px rgba(147, 145, 145, 0.1);
                /* Add shadow effect */
            }
        }

        .cart {
            border: 1px solid #ffffff;
            border-radius: 15px;
            padding: 10px;
            margin: 10px 0;
        }

        .cart-item {
            display: flex;
            margin-bottom: 10px;
        }

        .cart-item img {
            max-width: 100px;
            margin-right: 10px;
        }

        .item-details {
            flex-grow: 1;
        }

        .quantity {
            display: flex;
            align-items: center;
            margin-top: 5px;
        }

        .quantity-button {
            background-color: #A705CF;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: #fff;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
        }

        .remove-button {
            background-color: #ff0000;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .remove-button:hover {
            background-color: #cc0000;
        }

        .total {
            text-align: right;
        }

        .checkout-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .checkout-button:hover {
            background-color: #0056b3;
        }

        .btn-primary-custom {
            background-color: #A705CF;
            color: #fff;
        }

        .btn-primary-custom:hover {
            background-color: #cd58eb;
            color: #fff;
        }
    </style>
@endsection

@section('content')
    <div class="main">
        <!-- ======= Contact Section ======= -->
        <section id="Register-course" class="contact section-bg">
            <div class="container" data-aos="fade-up">
                <div data-aos="fade-up" data-aos-delay="100">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="image-container">
                                <img class="image" src="{{ $costume_type_list[0]->image }}" alt="Your Image"
                                    id="image-first">
                            </div>
                            <div class="scroll-container">
                                <div class="scroll-content">
                                    @foreach ($costume_type_list as $item)
                                        <a href="#" id="{{ $item->id }}" onclick="onAClick('{{ $item->id }}')"
                                            data-items="{{ json_encode($item) }}">
                                            <div class="scroll-item-image-container">
                                                <img class="image-items" src="{{ $item->image }}" alt="Your Image">
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cart">
                                <div class="d-flex row p-2">
                                    <h5>Detail Kostum</h5>
                                </div>
                                <div class="cart-item p-2">
                                    <div class="row">
                                        <div class="d-flex col-md-12">
                                            <h5>Kondisi</h5>
                                            <span>&nbsp;:&nbsp;</span>
                                            <p id="kondisi">{{ $costume_type_list[0]->kondisi }}</p>
                                        </div>
                                        <div class="d-flex col-md-12">
                                            <h5>Aksesoris</h5>
                                            <span>&nbsp;:&nbsp;</span>
                                            <p id="aksesoris">{{ $costume_type_list[0]->aksesoris }}</p>
                                        </div>
                                        <div class="d-flex col-md-12">
                                            <h5>Bahan</h5>
                                            <span>&nbsp;:&nbsp;</span>
                                            <p id="bahan">{{ $costume_type_list[0]->bahan }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cart">
                                <div class="d-flex row p-2">
                                    <h5>Atur Stok dan Pencatatan</h5>
                                </div>
                                <div class="cart-item p-2">
                                    <div class="row">
                                        <div class="d-flex col-md-12 p-3">
                                            <img src="{{ $costume_type_list[0]->image }}" alt="Product 1" id="image-detail">
                                            <h5 style="padding: 20px">{{ $costume_type_list[0]->nama }}</h5>
                                        </div>
                                        <input type="hidden" name="id_costume_type" id="id-costume-type"
                                            value="{{ $costume_type_list[0]->id_costume_type }}">
                                        <input type="hidden" name="id_costume_type_detail" id="id-costume-type-detail"
                                            value="{{ $costume_type_list[0]->id }}">
                                        <input type="hidden" name="id_user" id="id-user" value="{{ session('id') }}">
                                        <div class="item-details p-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="quantity">
                                                        <button class="quantity-button"
                                                            onclick="decreaseQty(this)">-</button>
                                                        <input type="text" class="quantity-input" value="1">
                                                        <button class="quantity-button"
                                                            onclick="increaseQty(this)">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="col-md-6">
                                                        <p>Stock: <span
                                                                id="stock">{{ $costume_type_list[0]->stock }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div class="col-md-6">
                                                    <h4>Harga</h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>Rp.
                                                        <span
                                                            id="harga">{{ number_format($costume_type_list[0]->harga, 0, ',', '.') }}</span>
                                                        /
                                                        <span
                                                            id="time">{{ $costume_type_list[0]->jangka_waktu_sewa }}</span>
                                                        hr
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div class="col-md-6">
                                                    <h4>Total</h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>Rp. <span
                                                            id="total-harga">{{ number_format($costume_type_list[0]->harga, 0, ',', '.') }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <button class="btn btn-primary-custom w-100" id="showModalBtn">Sewa</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #D220FF; color: white;">
                            <h5 class="modal-title" id="exampleModalLabel">Selamat Datang di Penyewaan Kostum</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-4 mt-2">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="datetime-local" id="tgl_pengambilan"
                                            name="tgl_pengambilan">
                                        <label for="tgl_pengambilan">Tgl Pengambilan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-4 mt-2">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="datetime-local" id="tgl_pengembalian"
                                            name="tgl_pengembalian">
                                        <label for="tgl_pengembalian">Tgl Pengembalian</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary ms-auto me-auto" id="ya">Sewa</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#showModalBtn").click(function() {
                $("#myModal").modal('show');
            });
        });

        $(document).on("click", "#ya", function(e) {
            e.preventDefault();
            var url = "{{ route('add-costume-rental-by-custome') }}";
            var urlHref = "{{ route('list-costume-rental') }}";
            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id_costume_type: $('#id-costume-type').val(),
                    id_costume_type_detail: $('#id-costume-type-detail').val(),
                    quantity: $('.quantity-input').val(),
                    harga: $('#harga').text(),
                    total_harga: $('#total-harga').text(),
                    id_user: $('#id-user').val(),
                    tgl_pengambilan: $('#tgl_pengambilan').val(),
                    tgl_pengembalian: $('#tgl_pengembalian').val(),
                },
                dataType: "json",
                success: function(response) {
                    if (response.code == true) {
                        $("#myModal").modal('hide');
                        window.location.href = urlHref;
                        toastr.options.timeOut = 8000;
                        toastr.success(response.message);
                    } else {
                        toastr.options.timeOut = 8000;
                        toastr.error(response.message);
                    }
                },
                error: function(response) {

                }
            });
        });

        function increaseQty(button) {
            var input = button.parentElement.querySelector(".quantity-input");
            var newValue = parseInt(input.value) + 1;

            var rupiahString = document.getElementById('harga').textContent;
            rupiahString = rupiahString.replace(/[^\d]/g, '');
            var rupiahInteger = parseInt(rupiahString);
            var total = rupiahInteger * newValue;
            document.getElementById('total-harga').textContent = formatRupiah(total.toString());

            input.value = Math.min(newValue, Number($('#stock').text())); // Assuming max stock is 5
        }

        function decreaseQty(button) {
            var input = button.parentElement.querySelector(".quantity-input");
            var newValue = parseInt(input.value) - 1;

            if (newValue >= 1) {
                var rupiahString = document.getElementById('harga').textContent;
                rupiahString = rupiahString.replace(/[^\d]/g, '');
                var rupiahInteger = parseInt(rupiahString);
                var total = rupiahInteger * newValue;
                document.getElementById('total-harga').textContent = formatRupiah(total.toString());
            }

            input.value = Math.max(newValue, 1); // Assuming min quantity is 1
        }

        function onAClick(test) {
            var element = document.getElementById(test);
            var attributeValue = element.getAttribute('data-items');
            var jsonObject = JSON.parse(attributeValue);

            var imageFirst = document.getElementById('image-first');
            imageFirst.src = jsonObject.image;

            var imageDetail = document.getElementById('image-detail');
            imageDetail.src = jsonObject.image;

            document.getElementById('kondisi').textContent = jsonObject.kondisi;
            document.getElementById('aksesoris').textContent = jsonObject.aksesoris;
            document.getElementById('bahan').textContent = jsonObject.bahan;
            document.getElementById('stock').textContent = jsonObject.stock;
            document.getElementById('harga').textContent = formatRupiah(jsonObject.harga.replace(/\.00$/, ''));
            document.getElementById('total-harga').textContent = formatRupiah(jsonObject.harga.replace(/\.00$/, ''));
            document.getElementById('id-costume-type').value = jsonObject.id_costume_type;
            document.getElementById('id-costume-type-detail').value = jsonObject.id;
            document.getElementById('time').textContent = jsonObject.jangka_waktu_sewa;

            $('.quantity-input').val(1);
        }

        function formatRupiah(input) {
            // Remove non-numeric characters
            var value = '';
            value = input.replace(/\D/g, '');
            // Add thousand separators
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            // Update the input value
            return value;
        }
    </script>
@endsection
