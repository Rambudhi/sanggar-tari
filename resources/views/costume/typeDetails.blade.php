@extends('layouts.admin')

@section('title')
Jenis Kustom Detail
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        Jenis Kustom Detail :: {{ $costume_type->nama }}
    </h4>

    <div class="card">
        <div class="dt-action-buttons text-end p-3">
            <div class="dt-buttons"> 
                <button class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#basicModal">
                    <span>
                        <i class="mdi mdi-plus me-sm-1"></i> 
                        <span class="d-none d-sm-inline-block">Tambah Jenis Kustom Detail</span>
                    </span>
                </button> 
            </div>
        </div>
        <div class="card-datatable table-responsive" style="padding: 10px;">
            <table id="example" class="datatables-basic table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Kondisi</th>
                        <th>Aksesoris</th>
                        <th>Bahan</th>
                        <th>Harga Sewa</th>
                        <th>Harga Denda Keterlambatan</th>
                        <th>Jangka Waktu Sewa</th>
                        <th>Stock</th>
                        <th>Favorite</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($costume_type_details as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <img src="{{ $item->image }}" alt="" width="50" height="50">
                            </td>
                            <td>{{ ucfirst($item->kondisi) }}</td>
                            <td>{{ $item->aksesoris }}</td>
                            <td>{{ $item->bahan }}</td>
                            <td>{{ 'Rp ' . number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ 'Rp ' . number_format($item->denda_keterlambatan, 0, ',', '.') }}</td>
                            <td>{{ $item->jangka_waktu_sewa }} /Hari</td>
                            <td>{{ $item->stock }}</td>
                            <td>
                                @if ($item->is_favorite == 1)
                                 <span class="badge rounded-pill  bg-label-success">Ya</span>
                                @else 
                                    <span class="badge rounded-pill  bg-label-danger">Tidak</span>
                                @endif
                            </td>
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
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin::custom-type-detail-delete', ['id' => $item->id, 'id_custome_type' => $costume_type->id]) }}">
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
                <form action="{{ route('admin::custom-type-detail-add') }}" method="POST" role="form" id="form-add-course-material" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Tambah Kostum Detail</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_costume_type" value="{{ $costume_type->id }}">
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="file" id="image" class="form-control" name="image">
                                    <label for="image">Image</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="form-select animation-dropdown me-2 w-100" id="kondisi" name="kondisi">
                                        <option value="">-- Plih Kondisi --</option>
                                        <option value="baru">Baru</option>
                                        <option value="bekas">Bekas</option>
                                    </select>
                                    <label for="kondisi">Kondisi</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="aksesoris" class="form-control" name="aksesoris">
                                    <label for="aksesoris">Aksesoris</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="bahan" class="form-control" name="bahan">
                                    <label for="bahan">Bahan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="harga" name="harga" class="form-control" oninput="formatRupiah(this)">
                                    <label for="harga">Harga Sewa</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="denda_keterlambatan" name="denda_keterlambatan" class="form-control" oninput="formatRupiah(this)">
                                    <label for="denda_keterlambatan">Harga Denda Keterlambatan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" id="jangka_waktu_sewa" name="jangka_waktu_sewa" class="form-control" min="1">
                                    <label for="jangka_waktu_sewa">Jangka Waktu Sewa</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" id="stock" name="stock" class="form-control" min="1">
                                    <label for="stock">Stock</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="form-select animation-dropdown me-2 w-100" id="is_favorite" name="is_favorite">
                                        <option value="">-- Plih Favorite --</option>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                    <label for="is_favorite">Stock</label>
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
                <form action="{{ route('admin::custom-type-detail-edit') }}" method="POST" role="form" id="form-edit-course-material" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Edit Materi Kursus</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="{{ $costume_type->id }}">
                        <input type="hidden" name="id_costume_type" id="id_costume_type" value="{{ $costume_type->id }}">
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="file" id="image" class="form-control" name="image">
                                    <label for="image">Image</label>
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
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="form-select animation-dropdown me-2 w-100" id="kondisiEdit" name="kondisi">
                                        <option value="">-- Plih Kondisi --</option>
                                        <option value="baru">Baru</option>
                                        <option value="bekas">Bekas</option>
                                    </select>
                                    <label for="kondisi">Kondisi</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="aksesorisEdit" class="form-control" name="aksesoris">
                                    <label for="aksesorisEdit">Aksesoris</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="bahanEdit" class="form-control" name="bahan">
                                    <label for="bahan">Bahan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="hargaEdit" name="harga" class="form-control" oninput="formatRupiah(this)">
                                    <label for="harga">Harga Sewa</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="denda_keterlambatan_edit" name="denda_keterlambatan" class="form-control" oninput="formatRupiah(this)">
                                    <label for="denda_keterlambatan_edit">Harga Denda Keterlambatan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" id="jangka_waktu_sewaEdit" name="jangka_waktu_sewa" class="form-control" min="1">
                                    <label for="jangka_waktu_sewaEdit">Jangka Waktu Sewa</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" id="stockEdit" name="stock" class="form-control" min="1">
                                    <label for="stockEdit">Stock</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="form-select animation-dropdown me-2 w-100" id="is_favorite_edit" name="is_favorite">
                                        <option value="">-- Plih Favorite --</option>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                    <label for="is_favorite_edit">Stock</label>
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

        function formatRupiah(input, type) {
            // Remove non-numeric characters
            let value = '';
            if(type == 'Edit'){
                value = input.replace(/\D/g, ''); 

                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                // Add "Rp" prefix
                value = 'Rp ' + value;

                return value;

            } else {
                value = input.value.replace(/\D/g, '');

                // Add thousand separators
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                // Add "Rp" prefix
                value = 'Rp ' + value;

                // Update the input value
                input.value = value;
            }
        }

        function onLiClick(param) {
            var jsonObject = JSON.parse(param);
            
            $('#imageOld').val(jsonObject.image)
            $('#imageMateriShow').attr('src', jsonObject.image);
            $('#kondisiEdit').val(jsonObject.kondisi).trigger('change'); 
            $('#aksesorisEdit').val(jsonObject.aksesoris);
            $('#bahanEdit').val(jsonObject.bahan);
            $('#hargaEdit').val(formatRupiah(parseFloat(jsonObject.harga).toString(), 'Edit'));
            $('#denda_keterlambatan_edit').val(formatRupiah(parseFloat(jsonObject.denda_keterlambatan).toString(), 'Edit'));
            $('#jangka_waktu_sewaEdit').val(jsonObject.jangka_waktu_sewa);
            $('#stockEdit').val(jsonObject.stock);
            $('#is_favorite_edit').val(jsonObject.is_favorite).trigger('change'); 
            $('#id').val(jsonObject.id);
            $('#basicModalEdit').modal('show');
        }
    </script>
@endsection
