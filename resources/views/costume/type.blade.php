@extends('layouts.admin')

@section('title')
Jenis Kustom
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        Jenis Kustom
    </h4>

    <div class="card">
        <div class="dt-action-buttons text-end p-3">
            <div class="dt-buttons"> 
                <button class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#basicModal">
                    <span>
                        <i class="mdi mdi-plus me-sm-1"></i> 
                        <span class="d-none d-sm-inline-block">Tambah Jenis Kustom</span>
                    </span>
                </button> 
            </div>
        </div>
        <div class="card-datatable table-responsive" style="padding: 10px;">
            <table id="example" class="datatables-basic table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Size</th>
                        <th>Kategori Baju</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($costume_type as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nama_size }}</td>
                            <td>
                                @if ($item->ketegori_kostum === 'DL')
                                    Dewasa - Laki
                                @elseif ($item->ketegori_kostum === 'DP')
                                    Dewasa - Perempuan
                                @elseif ($item->ketegori_kostum === 'AL')
                                    Anak - Laki
                                @elseif ($item->ketegori_kostum === 'AP')
                                    Anak - Laki
                                @endif
                            </td>
                            <td>
                                <div class="d-inline-block">
                                    <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin::custom-type-detail', ['id' => $item->id]) }}">
                                                @csrf
                                                <span class="align-middle">Detail</span>
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
                <form action="{{ route('admin::add-custom-type') }}" method="POST" role="form" id="form-add-course-material" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Tambah Kostum</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="nama_custome" class="form-control" name="nama_custome">
                                    <label for="nama_custome">Nama Kostum</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="form-select animation-dropdown me-2 w-100" id="id_size" name="id_size">
                                        <option value="">-- Plih Ukuran --</option>
                                        @foreach ($size as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    <label for="id_size">Ukuran</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="form-select animation-dropdown me-2 w-100" id="ketegori_kostum" name="ketegori_kostum">
                                        <option value="">-- Plih Kategori Kostum --</option>
                                        <option value="DL">Dewasa - Laki</option>
                                        <option value="DP">Dewasa - Perempuan</option>
                                        <option value="AL">Anak - Laki</option>
                                        <option value="AL">Anak - Perempuan</option>
                                    </select>
                                    <label for="ketegori_kostum">Kategori Kostum</label>
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

    <!-- Modal -->
    <div class="modal fade" id="basicModalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin::edit-custom-size') }}" method="POST" role="form" id="form-edit-course-material" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Edit Materi Kursus</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="namaMateri" class="form-control" name="nama_materi">
                                    <label for="namaMateri">Nama Ukuran</label>
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
    </script>
@endsection
