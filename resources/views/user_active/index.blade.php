@extends('layouts.admin')

@section('title')
Pengguna Aktif
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
      Pengguna Aktif
    </h4>

    <div class="card">
        <div class="card-datatable table-responsive" style="padding: 10px;">
            <table id="example" class="datatables-basic table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Is Active</th>
                        <th>Is Verified</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @if ($item->is_active === 1)
                                    <span class="badge rounded-pill  bg-label-success">Aktif</span>
                                @else
                                    <span class="badge rounded-pill  bg-label-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->is_verified === 1)
                                    <span class="badge rounded-pill  bg-label-success">Aktif</span>
                                @else
                                    <span class="badge rounded-pill  bg-label-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-inline-block">
                                    <a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready( function () {
            new DataTable('#example');
        });
    </script>
@endsection
