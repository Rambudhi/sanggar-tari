@extends('layouts.app')

@section('title')
List Pengembalian Kostum Anda
@endsection

@section('styles')
<style>
    .copy-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-left: 10px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        background-color: #007bff;
        color: #fff;
        border-radius: 4px;
    }

    .copy-button i {
        margin-left: 8px;
        margin-right: 8px;
    }
</style>
@endsection

@section('content')
<div class="main">
    <!-- ======= Contact Section ======= -->
    <section id="Register-course" class="contact section-bg">
        <div class="container" data-aos="fade-up">
            <div data-aos="fade-up" data-aos-delay="100">
                <div class="section-title">
                    <h3><span>List Pengembalian Kostum Anda</span></h3>
                </div>
                <div class="card">
                    <div class="card-datatable table-responsive">
                        <table id="example" class="datatables-basic table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Nama Kostum</th>
                                    <th>Image Kostum</th>
                                    <th>Quantity</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>
                                    <th>Bukti Bayar</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trx_custome_rental as $item)
                                    <tr>
                                        <td></td>
                                        <td>{{ $item->id_transaksi }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>
                                            <img src="{{ $item->image }}" alt="" width="100" height="100">
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                        <td>{{ $item->tgl_pembayaran }}</td>
                                        <td>{{ $item->bukti_pembayaran }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <div class="d-inline-block">
                                                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                                                    <i class="vertical-dots"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                                                    <li>
                                                        <a class="dropdown-item" onclick="onLiClick('{{ json_encode($item) }}')" data-items="">
                                                            <span class="align-middle">Edit</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="basicModalEdit" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('add-return-costume-rental-by-custome') }}" method="POST" role="form" id="form-edit-taking-rental-customer" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel1">Bayar Sewa Kostum</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id_transaksi" id="id_transaksi">
                                <div class="row">
                                    <div class="col-md-12 d-flex"> 
                                        <p>Total Tagihan</p>
                                        <span>&nbsp;:&nbsp;</span>
                                        <p id="total-tagihan">Rp. 100.000</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex"> 
                                        <p>No Rekening BNI</p>
                                        <span>&nbsp;:&nbsp;</span>
                                        <p id="copyText">123 5647 987</p>
                                        <a class="copy-button" onclick="copyToClipboard()">
                                            <i class="bx bx-file"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-4 mt-2">
                                        <label for="bukti_pembayaran">Upload Bukti Bayar</label>
                                        <input class="form-control" type="file" id="bukti_pembayaran" name="bukti_pembayaran">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-4 mt-2">
                                        <label for="tgl_pembayaran">Tgl Pembayran</label>
                                        <input class="form-control" type="datetime-local" id="tgl_pembayaran" name="tgl_pembayaran">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready( function () {
        $('#example').DataTable({
            responsive: true
        });
    });

    function copyToClipboard() {
        var copyText = document.getElementById("copyText");
        var range = document.createRange();
        range.selectNode(copyText);
        window.getSelection().removeAllRanges(); // Clear previous selection
        window.getSelection().addRange(range); // Select the text
        document.execCommand("copy"); // Copy the selected text
        window.getSelection().removeAllRanges(); // Clear the selection again
        alert('Berhasil Di Copy');
    }

    function onLiClick(param) {
        var jsonObject = JSON.parse(param);

        var currentDateTime = new Date();
        var inputDateTime = new Date(jsonObject.tgl_pengembalian);

        var totalPenagihan;
        if (currentDateTime > inputDateTime) {
            // Calculate the time difference in milliseconds
            var timeDifference = inputDateTime.getTime() - currentDateTime.getTime();

            // Convert the time difference to days
            var dayDifference = Math.floor(timeDifference / (1000 * 60 * 60 * 24)); 
            
            totalPenagihan = (Math.abs(dayDifference) * jsonObject.object.denda_keterlambatan) + parseInt(jsonObject.total_harga);
        } else {
            totalPenagihan = parseInt(jsonObject.total_harga)
        }
        
        $('#total-tagihan').text(formatRupiah(totalPenagihan));
        $('#id_transaksi').val(jsonObject.id_transaksi);

        $('#basicModalEdit').modal('show');
    }

    function formatRupiah(angka) {
        var number_string = angka.toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return 'Rp ' + rupiah;
    }
</script>
@endsection