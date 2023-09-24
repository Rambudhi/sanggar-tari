@extends('layouts.admin')

@section('title')
Materi Kelas
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        Materi Kelas
    </h4>

    <div class="card">
        <div class="dt-action-buttons text-end p-3">
            <div class="dt-buttons"> 
                <button class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#basicModal">
                    <span>
                        <i class="mdi mdi-plus me-sm-1"></i> 
                        <span class="d-none d-sm-inline-block">Tambah Materi Kursus</span>
                    </span>
                </button> 
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table id="example" class="datatables-basic table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5px;">ID</th>
                        <th>Kategori Kursus</th>
                        <th>Nama Materi</th>
                        <th>Image</th>
                        <th>Order Seq</th>
                        <th style="width: 5px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori_materi as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ ucfirst($item->kategori_kursus) }}</td>
                            <td>{{ $item->nama_materi }}</td>
                            <td>
                                <img src="{{ $item->image_materi }}" alt="" width="50" height="50">
                            </td>
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
                                            <a class="dropdown-item" onclick="onLiClick('{{ json_encode($item) }}')" data-items="">
                                                <span class="align-middle">Edit</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin::delete-class-material', ['id' => $item->id]) }}">
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
                <form action="{{ route('admin::add-materi-kursus') }}" method="POST" role="form" id="form-add-course-material" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Tambah Materi Kursus</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="form-select animation-dropdown me-2 w-100" id="kategoriKursus" name="kategori_kursus">
                                        <option value="">-- Plih Kategori --</option>
                                        <option value="basic">Basic</option>
                                        <option value="junior">Junior</option>
                                        <option value="remaja">Remaja</option>
                                        <option value="lansia">Lansia</option>
                                    </select>
                                    <label for="kategoriKursus">Kategori Kursus</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="namaMateri" class="form-control" name="nama_materi">
                                    <label for="namaMateri">Nama Materi</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mb-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="file" id="imageMateri" class="form-control" name="image_materi">
                                    <label for="imageMateri">Image Materi</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mb-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" id="orderSeq" class="form-control" name="order_seq" min="1">
                                    <label for="orderSeq">Order Materi</label>
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
                <form action="{{ route('admin::edit-materi-kursus') }}" method="POST" role="form" id="form-edit-course-material" enctype="multipart/form-data">
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
                                    <select class="form-select animation-dropdown me-2 w-100" id="kategoriKursusEdit" name="kategori_kursus">
                                        <option value="">-- Plih Kategori --</option>
                                        <option value="basic">Basic</option>
                                        <option value="junior">Junior</option>
                                        <option value="remaja">Remaja</option>
                                        <option value="lansia">Lansia</option>
                                    </select>
                                    <label for="kategoriKursus">Kategori Kursus</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="namaMateriEdit" class="form-control" name="nama_materi">
                                    <label for="namaMateri">Nama Materi</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mb-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="file" id="imageMateri" class="form-control" name="image_materi">
                                    <label for="imageMateri">Image Materi</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mb-2">
                                <div class="form-floating form-floating-outline">
                                    <img id="imageMateriShow" src="" alt="" width="100" height="100">
                                    <input type="hidden" name="image_old" id="imageOld">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mb-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" id="orderSeqEdit" class="form-control" name="order_seq" min="1">
                                    <label for="orderSeq">Order Materi</label>
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
            
            $('#kategoriKursusEdit').val(jsonObject.kategori_kursus.toLowerCase()).trigger('change'); 
            $('#namaMateriEdit').val(jsonObject.nama_materi);
            $('#orderSeqEdit').val(jsonObject.order_seq);
            $('#imageMateriShow').attr('src', jsonObject.image_materi);
            $('#id').val(jsonObject.id);
            $('#imageOld').val(jsonObject.image_materi);
            $('#basicModalEdit').modal('show');
        }
    </script>
@endsection
