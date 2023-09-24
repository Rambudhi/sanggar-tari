@extends('layouts.admin')

@section('title')
Pendaftaran Kursus
@endsection

@section('styles')
    <style>

    </style>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
      Pendaftaran Kursus
    </h4>

    <div class="card">
        <div class="card-datatable table-responsive">
            <table id="example" class="datatables-basic table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>Pendidikan</th>
                        <th>Nomor Telepon</th>
                        <th>Nama Ortu</th>
                        <th>Telpon Ortu</th>
                        <th>Pekerjaan Ortu</th>
                        <th>Alamat</th>                     
                        <th>Kartu Keluarga</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($register_course as $item)
                        <tr>
                            <td style="height: 50px;">{{ $item->id }}</td>
                            <td>{{ $item->nama_depan }}  {{ $item->nama_belakang }}</td>
                            <td>{{ $item->pendidikan }}</td>
                            <td>{{ $item->nomor_telepon }}</td>
                            <td>{{ $item->nama_ortu }}</td>
                            <td>{{ $item->nomor_telepon_ortu }}</td>
                            <td>{{ $item->pekerjaan_ortu }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" onclick="print('{{ $item->kartu_keluarga }}')"> Show KK </button>
                            </td>
                            <td>
                                <div class="d-inline-block">
                                    <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin::register-course-detail', $item->id) }}">
                                                @csrf
                                                <span class="align-middle">Detail</span>
                                            </a>
                                        </li>
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
    <!-- Vertically centered modal -->

    <!-- Payment Methods modal -->
    <div class="modal fade" id="paymentMethods" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-simple modal-enable-otp modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <img id="img01" width="1000" height="800">
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- / Payment Methods modal -->

    <!-- Modal -->
    <div class="modal fade" id="basicModalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('admin::edit-register-course') }}" method="POST" role="form" id="form-edit-course-material" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Edit Data Registrasi Kursus</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="id_user" id="id_user">
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="nama-depan" name="nama_depan">
                                    <label for="nama-depan">Nama Depan</label>
                                </div>
                            </div>
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="nama-belakang" name="nama_belakang">
                                    <label for="nama-belakang">Nama Belakang</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="pendidikan" name="pendidikan">
                                    <label for="pendidikan">Pendidikan</label>
                                </div>
                            </div>
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="nomor-telepon" name="nomor_telepon">
                                    <label for="nomor-telepon">Nomor Telepon</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control"  id="nama-ortu" name="nama_ortu">
                                    <label for="nama-ortu">Nama Ortu</label>
                                </div>
                            </div>
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="nomor-telepon-ortu" name="nomor_telepon_ortu">
                                    <label for="nomor-telepon-ortu">Nomor Telpon Ortu</label>
                                </div>
                            </div>
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="pekerjaan-ortu" name="pekerjaan_ortu">
                                    <label for="pekerjaan-ortu">Pekerjaan Ortu</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                                    <label for="alamat">Alamat</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="kota" name="kota">
                                    <label for="kota">Kota</label>
                                </div>
                            </div>
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="provinsi" name="provinsi">
                                    <label for="provinsi">Provinsi</label>
                                </div>
                            </div>
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="kode-pos" name="kode_pos">
                                    <label for="kode-pos">Kode Pos</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="file" class="form-control" id="photo-file" name="photo_file">
                                    <label for="photo-file">Photo</label>
                                </div>
                            </div>
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <img id="photoShow" src="" alt="" width="50" height="50">
                                    <input type="hidden" name="photo_old" id="photo_old">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="file" class="form-control" id="kk-file" name="kk_file">
                                    <label for="kk-file">KK</label>
                                </div>
                            </div>
                            <div class="col mb-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <img id="kkShow" src="" alt="" width="50" height="50">
                                    <input type="hidden" name="kk_old" id="kk_old">
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

        // Get the modal
        function print(url) { 
            var modalImg = document.getElementById("img01");
            modalImg.src = url;
            $('#paymentMethods').modal('show');
        }

        function onLiClick(param) {
            var jsonObject = JSON.parse(param);
            
            $('#nama-depan').val(jsonObject.nama_depan); 
            $('#nama-belakang').val(jsonObject.nama_belakang); 
            $('#pendidikan').val(jsonObject.pendidikan); 
            $('#nomor-telepon').val(jsonObject.nomor_telepon);
            $('#nama-ortu').val(jsonObject.nama_ortu);
            $('#nomor-telepon-ortu').val(jsonObject.nomor_telepon_ortu);
            $('#pekerjaan-ortu').val(jsonObject.pekerjaan_ortu);
            $('#alamat').val(jsonObject.alamat);
            $('#kota').val(jsonObject.kota);
            $('#provinsi').val(jsonObject.provinsi);
            $('#kode-pos').val(jsonObject.kode_pos);
            $('#photoShow').attr('src', jsonObject.photo);
            $('#kkShow').attr('src', jsonObject.kartu_keluarga);
            $('#id').val(jsonObject.id);
            $('#photo_old').val(jsonObject.photo);
            $('#kk_old').val(jsonObject.kartu_keluarga);
            $('#id_user').val(jsonObject.id_user);

            $('#basicModalEdit').modal('show');
        }
    </script>
@endsection
