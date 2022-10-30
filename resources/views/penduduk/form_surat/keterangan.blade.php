@extends('templates.admin.master')
@section('content')
    <div class="card">
        <div class="card-header bg-info d-md-flex flex-row justify-content-between">
            <h3 class="card-title text-light">{{ $page_attr['title'] }}</h3>
            <a type="button" class="btn btn-rounded btn-gray btn-sm" href="{{ route('penduduk.home') }}">
                <i class="fe fe-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form method="post" action="" enctype="multipart/form-data" id="MainForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="nik">Nomor Induk Kependudukan</label>
                            <input type="text" name="nik" id="nik" class="form-control" required
                                placeholder="Nomor Induk Kependudukan" value="" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="form-control" required
                                placeholder="Nama Lengkap" value="" />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required
                                placeholder="Tempat Lahir" value="" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required
                                placeholder="Tanggal Lahir" value="" />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="l">Laki-Laki</option>
                                <option value="p">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="kewarganegaraan">Kewarganegaraan</label>
                            <select class="form-control" name="kewarganegaraan" id="kewarganegaraan">
                                <option value="wni">Warga Negara Indonesia</option>
                                <option value="wna">Warga Negara Asing</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4" style="display: none" id="negara_nama_container">
                        <div class="form-group">
                            <label class="form-label" for="negara_nama">Negara Nama</label>
                            <input type="text" name="negara_nama" id="negara_nama" class="form-control"
                                placeholder="Negara Nama" value="" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="agama">Agama</label>
                            <select class="form-control" id="agama" name="agama">
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katholik">Katholik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="Lain-Lain">Lain-Lain</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label " for="status_kawin">Status Kawin</label>
                            <select class="form-control" id="status_kawin" name="status_kawin">
                                <option value="Kawin">Kawin</option>
                                <option value="Belum Kawin">Belum Kawin</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label " for="pekerjaan">Pekerjaan</label>
                            <select class="form-control" id="pekerjaan" name="pekerjaan">
                                <option value="Tidak Bekerja">Tidak Bekerja</option>
                                <option value="Ibu rumah Tangga">Ibu rumah Tangga</option>
                                <option value="Buruh">Buruh</option>
                                <option value="Pegawai Negeri Sipil">Pegawai Negeri Sipil</option>
                                <option value="ABRI/POLRI">ABRI/POLRI</option>
                                <option value="Pegawai Swasta">Pegawai Swasta</option>
                                <option value="Petani">Petani</option>
                                <option value="Pedagang">Pedagang</option>
                                <option value="Pelajar">Pelajar</option>
                                <option value="Mahasiswa">Mahasiswa</option>
                                <option value="Pensiunan">Pensiunan</option>
                                <option value="Pra Sekolah">Pra Sekolah</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="pendidikan">Pendidikan</label>
                            <select class="form-control" id="pendidikan" name="pendidikan">
                                <option value="Tidak/Belum Sekolah">Tidak/Belum Sekolah </option>
                                <option value="Tidak Tamat SD">Tidak Tamat SD </option>
                                <option value="Belum Tamat SD">Belum Tamat SD </option>
                                <option value="Tamat SD">Tamat SD </option>
                                <option value="Sekolah Lanjut Pertama">Sekolah Lanjut Pertama </option>
                                <option value="Sekolah Lanjut Atas">Sekolah Lanjut Atas </option>
                                <option value="Akademi/Sarjana Muda">Akademi/Sarjana Muda </option>
                                <option value="Sarjana/Pascasarjana">Sarjana/Pascasarjana </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="kampung">Kampung</label>
                            <input type="text" name="kampung" id="kampung" class="form-control"
                                placeholder="Kampung" value="" />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="rt">Rukun Tetangga</label>
                            <input type="number" name="rt" id="rt" class="form-control"
                                placeholder="Rukun Tetangga" value="" />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="rw">Rukun Warga</label>
                            <input type="number" name="rw" id="rw" class="form-control"
                                placeholder="Rukun Warga" value="" />
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="keterangan">Keterangan</label>
                            <select class="form-control" id="keterangan" name="keterangan">
                                <option value="Surat Keterangan Nikah">
                                    Surat Keterangan Nikah
                                </option>
                                <option value="Surat Keterangan Bepergian">
                                    Surat Keterangan Bepergian
                                </option>
                                <option value="Surat Keterangan Domisili">
                                    Surat Keterangan Domisili
                                </option>
                                <option value="Surat Keterangan Kelahiran">
                                    Surat Keterangan Kelahiran
                                </option>
                                <option value="Surat Keterangan Lain2">
                                    Surat Keterangan Lain2
                                </option>
                                <option value="Surat Keterangan Tidak Mampu">
                                    Surat Keterangan Tidak Mampu
                                </option>
                                <option value="Surat Keterangan Catatan Kepolisian">
                                    Surat Keterangan Catatan Kepolisian
                                </option>
                                <option value="Surat Pernyataan">
                                    Surat Pernyataan
                                </option>
                                <option value="Surat Ijin Keramaian">
                                    Surat Ijin Keramaian
                                </option>
                                <option value="Surat Tanda Laporan Kehilangan Barang">
                                    Surat Tanda Laporan Kehilangan Barang
                                </option>
                                <option value="Surat Keterangan Ahli Waris">
                                    Surat Keterangan Ahli Waris
                                </option>
                                <option value="Surat Keterangan Usaha">
                                    Surat Keterangan Usaha
                                </option>
                                <option value="Surat Keterangan Wali">
                                    Surat Keterangan Wali
                                </option>
                                <option value="Surat Pengantar Buka Rekening Bank">
                                    Surat Pengantar Buka Rekening Bank
                                </option>
                                <option value="Surat Pernyataan Kehilangan E KTP">
                                    Surat Pernyataan Kehilangan E KTP
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="form-group">
                <button type="submit" class="btn btn-success" form="MainForm">
                    <li class="fas fa-save mr-1"></li> Simpan
                </button>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#kewarganegaraan').change(() => {
                kewarganegaraan();
            });
        });

        function kewarganegaraan() {
            const conatiner = $('#negara_nama_container');
            const negara = $('#negara_nama');
            if ($('#kewarganegaraan').val() == 'wni') {
                conatiner.fadeOut();
                negara.attr('required', true);
            } else {
                conatiner.fadeIn();
                negara.removeAttr('required');
            }
        }
    </script>
@endsection
