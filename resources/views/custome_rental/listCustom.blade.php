@extends('layouts.app')

@section('title')
List Sewa Kostum Anda
@endsection

@section('styles')

@endsection

@section('content')
<div class="main">
    <!-- ======= Contact Section ======= -->
    <section id="Register-course" class="contact section-bg">
        <div class="container" data-aos="fade-up">
            <div data-aos="fade-up" data-aos-delay="100">
                <div class="section-title">
                    <h3><span>List Sewa Kostum Anda</span></h3>
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
                                    <th>Status</th>
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
                                        <td>{{ $item->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
</script>
@endsection