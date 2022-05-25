@extends('layouts.backend.app')
@section('title', 'Data Prestasi')
@push('css')
<!-- DataTables -->
<link rel="stylesheet"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- Sweetalert 2 -->
<link rel="stylesheet" type="text/css"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/sweetalert2/sweetalert2.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('content_title', 'Data Prestasi')
@section('content')
<x-alert></x-alert>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @can('create-prestasi')
                <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-toggle="modal"
                    data-target="#createModal">
                    <i class="fas fa-plus fa-fw"></i> Tambah Data
                </a>
                @endcan
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table id="dataTable2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>name</th>
                            <th>Nama Kejuaraan</th>
                            <th>Tingkat</th>
                            <th>Kelas</th>
                            <th>Kategori</th>
                            <th>Perolehan</th>
                            <th>tgl_acara</th>
                            <th>lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="store">
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display: none;">
                        <ul></ul>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="name">Nama Atlet:</label>
                                <input required="" type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="nama_kejuaraan">nama Kejuaraan:</label>
                                <input required="" type="text" name="nama_kejuaraan" id="nama_kejuaraan"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="tingkat">Tingkat:</label>
                                <select required="" name="tingkat" id="tingkat" class="form-control select2bs4">
                                    <option disabled="" selected="">- PILIH TINGKAT -</option>
                                    <option value="internasional">Internasional</option>
                                    <option value="nasional">Nasional</option>
                                    <option value="provinsi">Provinsi</option>
                                    <option value="kabupaten">Kabupaten</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="kelas">Kelas:</label>
                                <select required="" name="kelas" id="kelas" class="form-control select2bs4">
                                    <option disabled="" selected="">- PILIH KELAS -</option>
                                    <option value="pracadet">Pracadet</option>
                                    <option value="cadet">Cadet</option>
                                    <option value="junior">Junior</option>
                                    <option value="senior">Senior</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="kategori">Kategori:</label>
                                <select required="" name="kategori" id="kategori" class="form-control select2bs4">
                                    <option disabled="" selected="">- PILIH KATEGORI -</option>
                                    <option value="prestasi">Prestasi</option>
                                    <option value="pemula">Pemula</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="perolehan">Perolehan:</label>
                                <select required="" name="perolehan" id="perolehan" class="form-control select2bs4">
                                    <option disabled="" selected="">- PILIH KELAS -</option>
                                    <option value="emas">Emas</option>
                                    <option value="perak">Perak</option>
                                    <option value="perunggu">Perunggu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="tgl_acara">Tanggal Acara:</label>
                                <input required="" type="date" name="tgl_acara" id="tgl_acara" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="lokasi">Lokasi:</label>
                                <input required="" type="text" name="lokasi" id="lokasi" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save fa-fw"></i> SIMPAN
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Create Modal -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update">
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display: none;">
                        <ul></ul>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="name">Nama Atlet:</label>
                                <input required="" type="text" name="name" id="name_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="nama_kejuaraan">nama Kejuaraan:</label>
                                <input required="" type="text" name="nama_kejuaraan" id="nama_kejuaraan_edit"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="tingkat">Tignkat:</label>
                                <select required="" name="tingkat" id="tingkat_edit" class="form-control select2bs4">
                                    <option value="internasional">Internasional</option>
                                    <option value="nasional">Nasional</option>
                                    <option value="provinsi">Provinsi</option>
                                    <option value="kabupaten">Kabupaten</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="kelas">Kelas:</label>
                                <select required="" name="kelas" id="kelas_edit" class="form-control select2bs4">
                                    <option value="pracadet">Pracadet</option>
                                    <option value="cadet">Cadet</option>
                                    <option value="junior">Junior</option>
                                    <option value="senior">Senior</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="kategori">Kategori:</label>
                                <select required="" name="kategori" id="kategori_edit" class="form-control select2bs4">

                                    <option value="prestasi">Prestasi</option>
                                    <option value="pemula">Pemula</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="perolehan">Perolehan:</label>
                                <select required="" name="perolehan" id="perolehan_edit"
                                    class="form-control select2bs4">
                                    <option value="emas">Emas</option>
                                    <option value="perak">Perak</option>
                                    <option value="perunggu">Perunggu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="tgl_acara">Tanggal Acara:</label>
                                <input required="" type="date" name="tgl_acara" id="tgl_acara_edit"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="lokasi">Lokasi:</label>
                                <input required="" type="text" name="lokasi" id="lokasi_edit" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save fa-fw"></i> UPDATE
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal -->

@stop

@push('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js">
</script>
<script
    src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js">
</script>
<script
    src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
</script>
<!-- Sweetalert 2 -->
<script type="text/javascript"
    src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/select2/js/select2.full.min.js"></script>
@include('admin.prestasi.ajax')
@endpush