@extends('layouts.dashboard')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Motor {{ $motor->mtruid }}</h1>
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
                    <form action="{{ route('motor.update',$motor->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
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
                                name="nama" value="{{ old('nama',$motor->nama) }}">
                            @error('nama')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_polisi">Nomor Polisi</label>
                            <input type="text" class="form-control @error('no_polisi') is-invalid @enderror"
                                id="no_polisi" name="no_polisi" value="{{ old('no_polisi',$motor->no_polisi) }}">
                            @error('no_polisi')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori Motor</label>
                            <select name="kategori" id="kategori"
                                class="form-control @error('kategori') is-invalid @enderror">
                                <option value="">[ Pilih Kategori Motor ]</option>
                                <option value="Matik" @if(old('kategori',$motor->kategori)==='Matik' ) selected @endif>Motor Matik
                                </option>
                                <option value="Bebek" @if(old('kategori',$motor->kategori)==='Bebek' ) selected @endif>Motor Bebek
                                </option>
                            </select>
                            @error('kategori')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror" name="catatan"
                                id="catatan" cols="30" rows="3">{{ old('catatan',$motor->catatan) }}</textarea>
                            @error('catatan')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga per-hari</label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga"
                                name="harga" value="{{ old('harga',$motor->harga) }}">
                            @error('harga')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Edit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>


@endsection