@extends('layouts.dashboard')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Motor</h1>
        <a href="#" class="btn btn-sm btn-primary shadow-sm mt-3 mt-md-0 mt-lg-0" data-toggle="modal"
            data-target="#exampleModal"><i class="fas fa-plus-circle"></i>
            Tambah motor</a>
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
            <h6 class="m-0 font-weight-bold text-primary">Data motor</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>UID</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>No. Polisi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($motors as $motor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $motor->mtruid }}</td>
                            <td><img src="{{ url('storage/'.$motor->image_motor) }}" width="80" alt="Motor"></td>
                            <td>{{ $motor->nama }}</td>
                            <td>{{ $motor->kategori }}</td>
                            <td>{{ $motor->no_polisi }}</td>
                            <td>Rp. {{ $motor->harga }}</td>
                            <td>
                                @if($motor->status)
                                <span class="badge badge-pill badge-danger">Sedang digunakan</span>
                                @else
                                <span class="badge badge-pill badge-info">Tersedia</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('motor.edit',$motor->id) }}" class="btn btn-sm btn-warning ">Edit</a>
                                <br>
                                <a href="{{ route('motor.show',$motor->id) }}" class="btn btn-sm btn-info mt-1">Detail</a>
                                <form action="{{ route('motor.destroy',$motor->id) }}" method="post" class="mt-1">
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Motor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('motor.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="image_motor">Gambar Motor</label>
                        <input type="file" class="form-control @error('image_motor') is-invalid @enderror"
                            id="image_motor" name="image_motor" value="{{ old('image_motor') }}">
                        @error('image_motor')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Motor</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            name="nama" value="{{ old('nama') }}">
                        @error('nama')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_polisi">Nomor Polisi</label>
                        <input type="text" class="form-control @error('no_polisi') is-invalid @enderror" id="no_polisi"
                            name="no_polisi" value="{{ old('no_polisi') }}">
                        @error('no_polisi')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori Motor</label>
                        <select name="kategori" id="kategori"
                            class="form-control @error('kategori') is-invalid @enderror">
                            <option value="">[ Pilih Kategori Motor ]</option>
                            <option value="Matik" @if(old('kategori')==='Matik' ) selected @endif>Motor Matik</option>
                            <option value="Bebek" @if(old('kategori')==='Bebek' ) selected @endif>Motor Bebek</option>
                        </select>
                        @error('kategori')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control @error('catatan') is-invalid @enderror" name="catatan"
                            id="catatan" cols="30" rows="3">{{ old('catatan') }}</textarea>
                        @error('catatan')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga per-hari</label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga"
                            name="harga" value="{{ old('harga') }}">
                        @error('harga')
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
            'Anda berhasil menambah motor!',
            'success'
        )
    }
    function editConfirm(){
        Swal.fire(
            'Berhasil',
            'Anda berhasil mengubah data motor ini!',
            'success'
        )
    }
    function destroyMessage(){
        Swal.fire(
            'Berhasil',
            'Anda berhasil menghapus data motor ini!',
            'success'
        )
    }
    
    {!! session('success') !!}
</script>
@endpush        