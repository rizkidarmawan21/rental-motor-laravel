@extends('layouts.dashboard')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Penyewa {{ $penyewa->nama_penyewa }}</h1>
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
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('penyewa.update',$penyewa->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="no_identitas">Nomor Identitas</label>
                            <small class="form-text "><span class="text-warning">Contoh penulisan:</span> KTP-1234 ,
                                SIM-54331</small>
                            <input type="text" class="form-control @error('no_identitas') is-invalid @enderror"
                                id="no_identitas" name="no_identitas"
                                value="{{ old('no_identitas',$penyewa->no_identitas) }}">
                            @error('no_identitas')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_penyewa">Nama Penyewa</label>
                            <input type="text" class="form-control @error('nama_penyewa') is-invalid @enderror"
                                id="nama_penyewa" name="nama_penyewa"
                                value="{{ old('nama_penyewa',$penyewa->nama_penyewa) }}">
                            @error('nama_penyewa')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="exampleRadios1"
                                    value="Pria" @if($penyewa->gender == 'Pria') checked @endif>
                                <label class="form-check-label" for="exampleRadios1">
                                    Pria
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="exampleRadios2"
                                    value="Wanita" @if($penyewa->gender == 'Wanita') checked @endif>
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
                                name="no_hp" value="{{ old('no_hp',$penyewa->no_hp) }}">
                            @error('no_hp')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                id="alamat" cols="30" rows="3">{{ old('alamat',$penyewa->alamat) }}</textarea>
                            @error('alamat')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="">
                            <button class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>


@endsection