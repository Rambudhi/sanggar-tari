@extends('layouts.admin')

@section('title')
    Jadwal Kursus
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            Jadwal Kursus
        </h4>

        <div class="card">
            <div class="dt-action-buttons text-end p-3">
                <div class="dt-buttons">
                    <button class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0"
                        type="button" data-bs-toggle="modal" data-bs-target="#basicModal">
                        <span>
                            <i class="mdi mdi-plus me-sm-1"></i>
                            <span class="d-none d-sm-inline-block">Tambah Jadwal Kursus</span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="card-datatable table-responsive" style="padding: 10px;">
                <table id="example" class="datatables-basic table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Lokasi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedule_course as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->kategori_kursus }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->jam }}</td>
                                <td>{{ $item->lokasi }}</td>
                                <td>
                                    <div class="d-inline-block">
                                        <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                                            data-bs-toggle="dropdown">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                                            <li>
                                                <a class="dropdown-item" onclick="onClick('{{ json_encode($item) }}')"
                                                    data-items="">
                                                    <span class="align-middle">Edit</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin::delete-schedule-course-by-category', ['id' => $item->id]) }}">
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
                    <form action="{{ route('admin::add-schedule-course-by-category') }}" method="POST" role="form"
                        id="form-add-course-material" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel1">Tambah Materi Kursus</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-4 mt-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="form-select animation-dropdown me-2 w-100" id="kategoriKursus"
                                            name="kategori_kursus">
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
                                        <input class="form-control" type="date" id="tanggal" name="tanggal">
                                        <label for="tanggal">Tanggal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-4 mt-2">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="time" id="jam" name="jam">
                                        <label for="jam">Jam</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-4 mt-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="lokasi" class="form-control" name="lokasi">
                                        <label for="lokasi">Lokasi</label>
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
                    <form action="{{ route('admin::edit-schedule-course-by-category') }}" method="POST" role="form"
                        id="form-edit-course-material" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel1">Edit Materi Kursus</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <div class="row">
                                <div class="col mb-4 mt-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="form-select animation-dropdown me-2 w-100" id="kategori_kursus"
                                            name="kategori_kursus">
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
                                        <input class="form-control" type="date" id="tanggal-edit" name="tanggal">
                                        <label for="tanggal">Tanggal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-4 mt-2">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="time" id="jam-edit" name="jam">
                                        <label for="jam">Jam</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-4 mt-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="lokasi-edit" class="form-control" name="lokasi">
                                        <label for="lokasi">Lokasi</label>
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
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true
            });
        });

        function onClick(param) {
            var jsonObject = JSON.parse(param);

            $('#id').val(jsonObject.id);
            $('#kategori_kursus').val(jsonObject.kategori_kursus).trigger('change');

            $('#tanggal-edit').val(jsonObject.tanggal);
            $('#jam-edit').val(jsonObject.jam);

            $('#lokasi-edit').val(jsonObject.lokasi);

            $('#basicModalEdit').modal('show');
        }
    </script>
@endsection
