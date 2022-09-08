@extends('layouts.dashboard')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Penyewa</h1>
        <a href="#" class="btn btn-sm btn-primary shadow-sm mt-3 mt-md-0 mt-lg-0" data-toggle="modal"
            data-target="#exampleModal"><i class="fas fa-plus-circle"></i>
            Tambah penyewa</a>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data penyewa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>UID</th>
                            <th>No. Identitas</th>
                            <th>Nama</th>
                            <th>Gender</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($penyewas as $penyewa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $penyewa->restuid }}</td>
                            <td>{{ $penyewa->no_identitas }}</td>
                            <td>{{ $penyewa->nama_penyewa }}</td>
                            <td>{{ $penyewa->gender }}</td>
                            <td>{{ $penyewa->no_hp }}</td>
                            <td>{{ $penyewa->alamat }}</td>
                            <td>
                                <a href="{{ route('penyewa.edit',$penyewa->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('penyewa.destroy',$penyewa->id) }}" method="post" class="mt-1">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Penyewa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('penyewa.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="no_identitas">Nomor Identitas</label>
                        <small class="form-text "><span class="text-warning">Contoh penulisan:</span> KTP-1234 ,
                            SIM-54331</small>
                        <input type="text" class="form-control @error('no_identitas') is-invalid @enderror"
                            id="no_identitas" name="no_identitas" value="{{ old('no_identitas') }}">
                        @error('no_identitas')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_penyewa">Nama Penyewa</label>
                        <input type="text" class="form-control @error('nama_penyewa') is-invalid @enderror"
                            id="nama_penyewa" name="nama_penyewa" value="{{ old('nama_penyewa') }}">
                        @error('nama_penyewa')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="Pria">
                            <label class="form-check-label" for="exampleRadios1">
                                Pria
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="exampleRadios2"
                                value="Wanita">
                            <label class="form-check-label" for="exampleRadios2">
                                Wanita
                            </label>
                        </div>
                        @error('gender')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_hp">Nomor Telepon</label>
                        <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                            name="no_hp" value="{{ old('no_hp') }}">
                        @error('no_hp')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat"
                            cols="30" rows="3">{{ old('alamat') }}</textarea>
                        @error('alamat')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('addon-style')
<link href="{{ url('') }}/dashboard/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@push('addon-script')
<!-- Page level plugins -->
<script src="{{ url('') }}/dashboard/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('') }}/dashboard/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{ url('') }}/dashboard/js/demo/datatables-demo.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.13/dist/sweetalert2.all.min.js"></script>

<script>
    function addConfirm(){
        Swal.fire(
            'Berhasil',
            'Anda berhasil menambah penyewa baru!',
            'success'
        )
    }
    function editConfirm(){
        Swal.fire(
            'Berhasil',
            'Anda berhasil mengubah penyewa ini!',
            'success'
        )
    }
    function destroyMessage(){
        Swal.fire(
            'Berhasil',
            'Anda berhasil menghapus penyewa ini!',
            'success'
        )
    }
    
    {!! session('success') !!}
</script>
@endpush