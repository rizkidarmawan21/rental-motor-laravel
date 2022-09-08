@extends('layouts.dashboard')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Penyewaan</h1>
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
                        <div class="col-md-3 text-center align-self-center">
                            <img src="{{ url('storage/'.$sewa->motor->image_motor) }}" width="150" class="img-fluid"
                                alt="">
                        </div>
                        <div class="col-md-3 mt-5 mt-lg-0">
                            <h4>Detail Penyewa</h4>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>UID</td>
                                        <td>{{ $sewa->penyewa->restuid}}</td>
                                    </tr>
                                    <tr>
                                        <td>No Identitas</td>
                                        <td>{{ $sewa->penyewa->no_identitas}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>{{ $sewa->penyewa->nama_penyewa }}</td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td>{{ $sewa->penyewa->gender }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Telepon</td>
                                        <td>{{ $sewa->penyewa->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>{{ $sewa->penyewa->alamat }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-3 mt-5 mt-lg-0">
                            <h4>Detail Transaksi</h4>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>UID</td>
                                        <td>{{ $sewa->sewa_uuid }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Sewa</td>
                                        <td>{{ $sewa->tanggal_sewa }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Kembali</td>
                                        <td>{{ $sewa->tanggal_kembali }}</td>
                                    </tr>
                                    <tr>
                                        <td>Catatan</td>
                                        <td>{{ $sewa->catatan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status Sewa</td>
                                        <td>@if(!$sewa->status)
                                            <span class="badge badge-secondary badge-pill">Masa Sewa
                                                @if ( date(('Y-m-d')) > $sewa->tanggal_kembali)
                                                - <span class="text-danger">Terlambat</span>
                                                @elseif(date(('Y-m-d')) === $sewa->tanggal_kembali)
                                                - <span class="text-warning">Hari terakhir</span>
                                                @endif
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Harga sewa</td>
                                        <td>Rp. {{ $sewa->motor->harga }} / hari</td>
                                    </tr>
                                    <tr>
                                        <td>Total Bayar</td>
                                        <td>Rp. {{ $sewa->total_biaya }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status Pembayaran</td>
                                        <td>
                                            @if($sewa->status_bayar)
                                            <span class="badge badge-pill badge-success">Telah Terbayar</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">Belum Membayar</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="col-md-3 mt-5 mt-lg-0">
                            <h4>Detail Motor</h4>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>UID</td>
                                        <td>{{ $sewa->motor->mtruid }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Motor</td>
                                        <td>{{ $sewa->motor->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kategori</td>
                                        <td>{{ $sewa->motor->kategori }}</td>
                                    </tr>
                                    <tr>
                                        <td>Catatan penjual</td>
                                        <td>{{ $sewa->motor->catatan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Polisi</td>
                                        <td>{{ $sewa->motor->no_polisi }}</td>
                                    </tr>
                                    <tr>
                                        <td>Harga sewa</td>
                                        <td>Rp. {{ $sewa->motor->harga }} / hari</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            @if($sewa->motor->status)
                                            <span class="badge badge-pill badge-danger">Sedang digunakan</span>
                                            @else
                                            <span class="badge badge-pill badge-info">Tersedia</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <a href="{{ route('penyewaan.edit',$sewa->id) }}" class="btn btn-primary">Edit Transaksi</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


@endsection