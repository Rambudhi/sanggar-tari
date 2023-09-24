@extends('layouts.admin')

@section('title')
Pendaftaran Kursus Detail
@endsection

@section('styles')
    <style>

    </style>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
      Pendaftaran Kursus Detail
    </h4>

    <div class="card">
        <div class="card-datatable table-responsive" style="padding: 10px;">
            <table id="example" class="datatables-basic table table-bordered">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Kategori Kursus</th>
                        <th>Bukti Pembayaran</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($register_course_detail as $item)
                        <tr>
                            <td style="height: 50px;">{{ $item->id }}</td>
                            <td>{{ $item->kategori_kursus }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" onclick="print('{{ $item->bukti_pembayaran }}')"> Show BP </button>
                            </td>
                            <td>
                                @if ($item->is_verified === 1)
                                    <span class="badge rounded-pill  bg-label-success">Verifikasi</span>
                                @else
                                    <span class="badge rounded-pill  bg-label-danger">Belum Verifikasi</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-inline-block">
                                    <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="verified('{{ $item->id }}')">
                                                @csrf
                                                <span class="align-middle">Verifikasi</span>
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
    <script>
        // Get the modal
        function print(url) { 
            var modalImg = document.getElementById("img01");
            modalImg.src = url;
            $('#paymentMethods').modal('show');
        }

        function verified(params) {
            
            $.ajax({
                type:"POST",
                url:'{{ route('admin::verified-course') }}',
                data:{
                    id:params,
                    _token: $('meta[name="csrf-token"]').attr('content') 
                },
                dataType: "json",
                success: function(response){

                    if (response.code == true) {
                        toastr.options.timeOut = 8000;
                        toastr.success(response.message);
                        location.reload();
                    } else {
                        toastr.options.timeOut = 8000;
                        toastr.error(response.message); 
                    }
                }, error: function(response){
                
                }
            });
        }
    </script>
@endsection
