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
                <h3><span>Next Kursus</span></h3>
            </div>
            <div data-aos="fade-up" data-aos-delay="100">
                <form action="{{ route('do-next-register-course') }}" method="POST" role="form" id="form-next-course">
                    @csrf
                    <div class="row g-3">
                        <input type="hidden" class="form-control" id="id-user" name="id_user" value="{{ session('id') }}">
                        <input type="hidden" class="form-control" id="kategori-kursus" name="kategori_kursus" value="{{ $kategori }}">
                        <div class="col-md-12">
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
                            <div class="text-right p-5">
                                <div class="pe-5">
                                    <h5>*Note :</h5>
                                    <span>Biaya : Rp. 100.000, </span>
                                    <span>Transfer Ke Rekening : BCA an Romi 134532394 </span>
                                </div>
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

        var form=$("#form-next-course");
        let formData = new FormData($("#form-next-course")[0]);
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
                    document.getElementById("form-next-course").reset();
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