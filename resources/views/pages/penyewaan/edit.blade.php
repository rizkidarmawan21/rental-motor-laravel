@extends('layouts.dashboard')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Transaksi</h1>
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

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('penyewaan.update',$penyewaan->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="penyewa_id">Nama Penyewa</label>
                            <select name="penyewa_id" id="penyewa_id" class="form-control @error('penyewa_id') is-invalid @enderror">
                                <option value="">[ Pilih Penyewa ]</option>
                                @forelse($penyewas as $penyewa)
                                <option value="{{ $penyewa->id }}" @if($penyewaan->penyewa_id == $penyewa->id) selected @endif>{{ $penyewa->restuid }} | {{ $penyewa->nama_penyewa }}
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
                            <select name="motor_id" id="motor_id" class="form-control @error('motor_id') is-invalid @enderror">
                                <option value="">[ Pilih Motor ]</option>
                                @forelse($motors as $motor)
                                <option value="{{ $motor->id }}" @if($penyewaan->motor_id == $motor->id) selected @endif>{{ $motor->mtruid }} | {{ $motor->nama }}</option>
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
                            <input type="date" class="form-control @error('tanggal_sewa') is-invalid @enderror" id="tanggal_sewa"
                                name="tanggal_sewa" value="{{ old('tanggal_sewa',$penyewaan->tanggal_sewa) }}">
                            @error('tanggal_sewa')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggal_kembali">Tanggal Kembali</label>
                            <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror" id="tanggal_kembali"
                                name="tanggal_kembali" value="{{ old('tanggal_kembali',$penyewaan->tanggal_kembali) }}">
                            @error('tanggal_kembali')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan"
                                name="catatan">{{ old('catatan',$penyewaan->catatan) }}</textarea>
                            @error('catatan')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>


@endsection