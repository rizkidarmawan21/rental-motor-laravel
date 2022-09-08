@extends('layouts.dashboard')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Pembayaran</h1>
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
                    <form action="{{ route('pengembalian.update',$pengembalian->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="denda">Denda</label>
                            <input type="number" class="form-control @error('denda') is-invalid @enderror" id="denda"
                                name="denda" value="{{ old('denda') }}" placeholder="Masukkan denda jika ada">
                            @error('denda')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="total_biaya">Total Biaya Sewa</label>
                            <input type="number" class="form-control @error('total_biaya') is-invalid @enderror" id="total_biaya"
                                name="total_biaya" value="{{ old('total_biaya',$pengembalian->total_biaya) }}">
                            @error('total_biaya')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection