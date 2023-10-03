@extends('layouts.admin')

@section('title')
Pengambilan Kostum
@endsection

@section('styles')
    
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        Pengambilan Kostum
    </h4>

    <div class="card">
        <div class="card-datatable table-responsive" style="padding: 10px;">
            <table id="example" class="datatables-basic table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Nama Penyewa</th>
                        <th>Nama Kostum</th>
                        <th>Image Kostum</th>
                        <th>Quantity</th>
                        <th>Harga</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Tgl Pengambilan</th>
                        <th>Tgl Pengembalian</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trx_custome_rental as $item)
                        <tr>
                            <td></td>
                            <td>{{ $item->id_transaksi }}</td>
                            <td>{{ $item->nama_depan }} {{ $item->nama_belakang }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                <img src="{{ $item->image }}" alt="" width="100" height="100">
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->tgl_pengambilan }}</td>
                            <td>{{ $item->tgl_pengembalian }}</td>
                            <td>
                                <div class="d-inline-block">
                                    <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                                        <i class="mdi mdi-dots-vertical"></i>
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

    <!-- Modal -->
    <div class="modal fade" id="basicModalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin::edit-taking-rental-costume') }}" method="POST" role="form" id="form-edit-taking-rental-customer" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Edit Materi Kursus</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_transaksi" id="id_transaksi">
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="form-select animation-dropdown me-2 w-100" id="status" name="status">
                                        <option value="">-- Plih STATUS --</option>
                                        <option value="DIPESAN">DIPESAN</option>
                                        <option value="DIAMBIL">DIAMBIL</option>
                                        <option value="DIBATALKAN">DIBATALKAN</option>
                                    </select>
                                    <label for="status">Status</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="datetime-local" id="tgl_pengambilan" name="tgl_pengambilan">
                                    <label for="tgl_pengambilan">Tgl Pengambilan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="datetime-local" id="tgl_pengembalian" name="tgl_pengembalian">
                                    <label for="tgl_pengembalian">Tgl Pengembalian</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready( function () {
            $('#example').DataTable({
                responsive: true
            });
        });

        function onLiClick(param) {
            var jsonObject = JSON.parse(param);
            
            $('#status').val(jsonObject.status).trigger('change'); 

            if(jsonObject.tgl_pengambilan !== null || jsonObject.tgl_pengambilan !== '')
            {
                $('#tgl_pengambilan').val(jsonObject.tgl_pengambilan);
            }

            if(jsonObject.tgl_pengembalian !== null || jsonObject.tgl_pengembalian !== '')
            {
                $('#tgl_pengembalian').val(jsonObject.tgl_pengembalian);
            }

            $('#id_transaksi').val(jsonObject.id_transaksi);

            $('#basicModalEdit').modal('show');
        }
    </script>
@endsection
