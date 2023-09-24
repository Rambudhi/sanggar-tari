@extends('layouts.admin')

@section('title')
Materi Kelas
@endsection

@section('content')
<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        Kategori : {{ ucfirst($kategori_materi->kategori_kursus) }} | Materi : {{ ucfirst($kategori_materi->nama_materi) }}
    </h4>

    <div class="card">
        <div class="dt-action-buttons text-end p-3">
            <div class="dt-buttons"> 
                <button class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#basicModal">
                    <span>
                        <i class="mdi mdi-plus me-sm-1"></i> 
                        <span class="d-none d-sm-inline-block">Tambah Materi Video</span>
                    </span>
                </button> 
            </div>
        </div>
        <div class="card-datatable table-responsive" style="padding: 10px;">
            <table id="example" class="datatables-basic table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5px;">ID</th>
                        <th>Nama</th>
                        <th>Video</th>
                        <th>Desc</th>
                        <th>Order Seq</th>
                        <th style="width: 5px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori_materi_detail as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                <video controls width="150" height="150">
                                    <source src="{{ $item->video }}" type="video/mp4">
                                </video>
                            </td>
                            <td>{{ $item->desc }}</td>
                            <td>{{ $item->order_seq }}</td>
                            <td>
                                <div class="d-inline-block">
                                    <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin::class-material-detail', ['id' => $item->id]) }}">
                                                @csrf
                                                <span class="align-middle">Detail</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin::delete-class-material-detail', ['id' => $item->id, 'id_materi' => $id ]) }}">
                                                @csrf
                                                <span class="align-middle">Delete</span>
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
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin::add-materi-video') }}" method="POST" role="form" id="form-add-course-material-detail" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Tambah Materi Video</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id-kategori-kursus" name="id_kategori_kursus" value="{{ $id }}">
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="nama" class="form-control" name="nama">
                                    <label for="nama">Nama</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="file" id="video" class="form-control" name="video">
                                    <label for="video">Video</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mb-2">
                                <div class="form-floating form-floating-outline">
                                    <textarea class="form-control" id="desc" name="desc" rows="4" cols="50"></textarea>
                                    <label for="desc">deskripsi</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mb-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" id="orderSeq" class="form-control" name="order_seq" min="1">
                                    <label for="orderSeq">Order Video</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
    </script>
@endsection
