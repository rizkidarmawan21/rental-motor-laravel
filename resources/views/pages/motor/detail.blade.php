@extends('layouts.dashboard')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Motor</h1>
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
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-center align-self-center">
                            <img src="{{ url('storage/'.$motor->image_motor) }}" width="150" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-6 mt-5 mt-lg-0">
                            <h4>Detail Motor</h4>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>UID</td>
                                        <td>{{ $motor->mtruid }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Motor</td>
                                        <td>{{ $motor->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kategori</td>
                                        <td>{{ $motor->kategori }}</td>
                                    </tr>
                                    <tr>
                                        <td>Catatan penjual</td>
                                        <td>{{ $motor->catatan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Polisi</td>
                                        <td>{{ $motor->no_polisi }}</td>
                                    </tr>
                                    <tr>
                                        <td>Harga sewa</td>
                                        <td>Rp. {{ $motor->harga }} / hari</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            @if($motor->status)
                                            <span class="badge badge-pill badge-danger">Sedang digunakan</span>
                                            @else
                                            <span class="badge badge-pill badge-info">Tersedia</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="{{ route('motor.edit',$motor->id) }}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


@endsection