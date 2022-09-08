@extends('layouts.dashboard')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Penyewaan</h1>
        <a href="#" class="btn btn-sm btn-primary shadow-sm mt-3 mt-md-0 mt-lg-0" data-toggle="modal"
            data-target="#exampleModal"><i class="fas fa-plus-circle"></i>
            Tambah penyewaan</a>
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
            <h6 class="m-0 font-weight-bold text-primary">Data Sewa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>UID</th>
                            <th>ID Penyewa</th>
                            <th>ID Motor</th>
                            <th>Tanggal Sewa</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sewas as $sewa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sewa->sewa_uuid }}</td>
                            <td>{!! isset($sewa->penyewa->restuid)? $sewa->penyewa->restuid : '<small>Data penyewa telah
                                    dihapus!</small>' !!}</td>
                            <td>{!! isset($sewa->motor->mtruid) ? $sewa->motor->mtruid : '<small>Data motor telah
                                    dihapus!</small>' !!}</td>
                            <td>{{ date('d-F-Y', strtotime($sewa->tanggal_sewa)) }}</td>
                            <td>{{ date('d-F-Y', strtotime($sewa->tanggal_kembali)) }}</td>
                            <td>
                                @if(!$sewa->status)
                                <span class="badge badge-secondary badge-pill">Masa Sewa
                                    @if ( date(('Y-m-d')) > $sewa->tanggal_kembali)
                                    - <span class="text-danger">Terlambat</span>
                                    @elseif(date(('Y-m-d')) === $sewa->tanggal_kembali)
                                    - <span class="text-warning">Hari terakhir</span>
                                    @endif
                                </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('penyewaan.edit',$sewa->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <br>
                                <a href="{{ route('penyewaan.show',$sewa->id) }}"
                                    class="btn btn-info btn-sm mt-1 ">Detail</a>
                                <br>
                                <form action="{{ route('penyewaan.destroy',$sewa->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm mt-1">Batalkan</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Penyewaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('penyewaan.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="penyewa_id">Nama Penyewa</label>
                        <select name="penyewa_id" id="penyewa_id"
                            class="form-control @error('penyewa_id') is-invalid @enderror">
                            <option value="">[ Pilih Penyewa ]</option>
                            @forelse($penyewas as $penyewa)
                            <option value="{{ $penyewa->id }}">{{ $penyewa->restuid }} | {{ $penyewa->nama_penyewa }}
                            </option>
                            @empty
                            <option value="" disabled><small>Data penyewa masih kosong</small></option>
                            @endforelse
                        </select>
                        @error('penyewa_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="motor_id">Jenis Motor</label>
                        <select name="motor_id" id="motor_id"
                            class="form-control @error('motor_id') is-invalid @enderror">
                            <option value="">[ Pilih Motor ]</option>
                            @forelse($motors as $motor)
                            <option value="{{ $motor->id }}">{{ $motor->mtruid }} | {{ $motor->nama }}</option>
                            @empty
                            <option value="" disabled><small>Data motor masih kosong</small></option>
                            @endforelse
                        </select>
                        @error('motor_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal_sewa">Tanggal Sewa</label>
                        <input type="date" class="form-control @error('tanggal_sewa') is-invalid @enderror"
                            id="tanggal_sewa" name="tanggal_sewa" value="{{ old('tanggal_sewa') }}">
                        @error('tanggal_sewa')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal_kembali">Tanggal Kembali</label>
                        <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror"
                            id="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}">
                        @error('tanggal_kembali')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan"
                            name="catatan">{{ old('catatan') }}</textarea>
                        @error('catatan')
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
            'Anda berhasil menambah penyewaan baru!',
            'success'
        )
    }
    function failConfirm(){
        Swal.fire(
            'Gagal',
            'Motor sedang digunakan!',
            'error'
        )
    }
    function editConfirm(){
        Swal.fire(
            'Berhasil',
            'Anda berhasil mengubah penyewaan ini!',
            'success'
        )
    }
    function destroyMessage(){
        Swal.fire(
            'Berhasil',
            'Anda berhasil membatalkan penyewaan ini!',
            'success'
        )
    }
    
    {!! session('success') !!}
</script>
@endpush