@extends('layouts.app')

@section('styles')
    <style>
        .option .custome-radio {
            display: inline-block;
        }
    </style>
@endsection

@section('content')
<div class="main">
    <!-- ======= Contact Section ======= -->
    <section id="Register-course" class="contact section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h3><span>Daftar Kursus</span></h3>
            </div>
            <div data-aos="fade-up" data-aos-delay="100">
                <form action="{{ route('do-insert-register-course') }}" method="POST" role="form" id="form-regis-course">
                    @csrf
                    <div class="row g-3">
                        <input type="hidden" class="form-control" id="id-user" name="id_user" value="{{ session('id') }}">
                        <div class="col-md-6">
                            <label for="namaDepan" class="form-label">Nama Depan</label>
                            <input type="text" class="form-control" id="nama-depan" name="nama_depan">
                        </div>
                        <div class="col-md-6">
                            <label for="pendidikan" class="form-label">Pendidikan</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pendidikan" id="rb1" value="sd">
                                <label class="form-check-label" for="inlineRadio1">SD</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pendidikan" id="rb2" value="smp">
                                <label class="form-check-label" for="inlineRadio2">SMP</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pendidikan" id="rb3" value="sma">
                                <label class="form-check-label" for="inlineRadio2">SMA</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pendidikan" id="rb4" value="kuliah">
                                <label class="form-check-label" for="inlineRadio2">Kuliah</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="namaBelakang" class="form-label">Nama Belakang</label>
                            <input type="text" class="form-control" id="nama-belakang" name="nama_belakang">
                        </div>
                        <div class="col-md-6">
                            <label for="namaOrtu" class="form-label">Nama Orang tua</label>
                            <input type="text" class="form-control" id="nama-ortu" name="nama_ortu">
                        </div>
                        <div class="col-md-6">
                            <label for="nomorTelpon" class="form-label">Nomor Telpon</label>
                            <input type="text" class="form-control" id="nomor-telepon" name="nomor_telepon">
                        </div>
                        <div class="col-md-6">
                            <label for="nomerTelponOrtu" class="form-label">Nomor Telpon Orang Tua</label>
                            <input type="text" class="form-control" id="nomor-telepon-ortu" name="nomor_telepon_ortu">
                        </div>
                        <div class="col-md-12">
                            <label for="pekerjaanOrtu" class="form-label">Pekerjaan Orang tua</label>
                            <input type="text" class="form-control" id="pekerjaan-ortu" name="pekerjaan_ortu">
                        </div>
                        <div class="col-md-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="kota" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota">
                        </div>
                        <div class="col-md-6">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <input type="text" class="form-control" id="provinsi" name="provinsi">
                        </div>
                        <div class="col-md-6">
                            <label for="kodePos" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" id="kode-pos" name="kode_pos">
                        </div>
                        <div class="col-md-6">
                            <label for="kategoriKursus" class="form-label">Kategori Kursus</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kategori_kursus" id="rb1" value="basic">
                                <label class="form-check-label" for="inlineRadio1">Basic</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kategori_kursus" id="rb2" value="Junior">
                                <label class="form-check-label" for="inlineRadio2">Junior</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kategori_kursus" id="rb3" value="remaja">
                                <label class="form-check-label" for="inlineRadio2">Remaja</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kategori_kursus" id="rb4" value="lansia">
                                <label class="form-check-label" for="inlineRadio2">Lansia</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="kategoriKursus" class="form-label">Kartu Keluarga</label>
                                <div class="mb-4 d-flex justify-content-center">
                                    <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="example placeholder" id="image-kk" style="width: 300px; height: 300px;" />
                                </div>
                            <div class="d-flex justify-content-center">
                                <div class="btn btn-primary btn-rounded">
                                    <label class="form-label text-white m-1" for="kk-file">Choose file</label>
                                    <input type="file" class="form-control d-none" id="kk-file" name="kk_file" onchange="uploadKK()"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="kategoriKursus" class="form-label">Bukti Pembayaran</label>
                            <div class="mb-4 d-flex justify-content-center">
                                <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="example placeholder" id="image-bp" style="width: 300px; height: 300px;" />
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="btn btn-primary btn-rounded">
                                    <label class="form-label text-white m-1" for="bp-file">Choose file</label>
                                    <input type="file" class="form-control d-none" id="bp-file" name="bp_file" onchange="uploadBP()"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-right">
                               <button class="btn btn-primary float-end" id="save">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End Contact Section --> 
</div>
@endsection

@section('scripts')
<script>
    function uploadKK() {
        let image = document.getElementById('kk-file').files[0];
        let formData = new FormData();
        formData.append('kk_file', image);
        formData.append('_token', '{{csrf_token()}}');
        $.ajax({
            url: '{{ route('upload-kk') }}',
            enctype: 'multipart/form-data',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.code == true) {
                    $('#image-kk').attr('src', data.data.url);
                    toastr.options.timeOut = 8000;
                    toastr.success(data.message);
                } else {
                    toastr.options.timeOut = 8000;
                    toastr.error(data.message);
                }
            },
            error: function(data) {
                toastr.options.timeOut = 8000;
                toastr.error(data.message);
            }
        });
    }

    function uploadBP() {
        let image = document.getElementById('bp-file').files[0];
        let formData = new FormData();
        formData.append('bp_file', image);
        formData.append('_token', '{{csrf_token()}}');
        $.ajax({
            url: '{{ route('upload-bp') }}',
            enctype: 'multipart/form-data',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.code == true) {
                    $('#image-bp').attr('src', data.data.url);
                    toastr.options.timeOut = 8000;
                    toastr.success(data.message);
                } else {
                    toastr.options.timeOut = 8000;
                    toastr.error(data.message);
                }
            },
            error: function(data) {
                toastr.options.timeOut = 8000;
                toastr.error(data.message);
            }
        });
    }

    $(document).on("click", "#save", function(e) {
        e.preventDefault();

        var form=$("#form-regis-course");
        let formData = new FormData($("#form-regis-course")[0]);
        formData.append('kartu_keluarga', document.getElementById("image-kk").src)
        formData.append('bukti_pembayaran', document.getElementById("image-bp").src)
        $.ajax({
            type:"POST",
            url:form.attr("action"),
            data:formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(response){

                if (response.code == true) {
                    toastr.options.timeOut = 8000;
                    toastr.success(response.message);
                    document.getElementById("form-regis-course").reset();
                    $('#image-kk').attr('src','https://mdbootstrap.com/img/Photos/Others/placeholder.jpg');
                    $('#image-bp').attr('src','https://mdbootstrap.com/img/Photos/Others/placeholder.jpg');
                } else {
                    toastr.options.timeOut = 8000;
                    toastr.error(response.message); 
                }
            }, error: function(response){
            
            }
        });
    });
</script>
@endsection