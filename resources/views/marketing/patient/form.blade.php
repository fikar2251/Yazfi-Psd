<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $patient->nama ?? '' }}">

                    @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $patient->email ?? '' }}">

                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="no_telp">No Telp. Utama</label>
                    <input type="number" name="no_telp" id="no_telp" class="form-control" value="{{ $patient->no_telp ?? '' }}">

                    @error('no_telp')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="st">No Telp. Satu</label>
                    <input type="number" name="telp_st" id="no_telp" class="form-control" value="{{ $patient->telp_st ?? '' }}">

                    @error('telp_st')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="telp_nd">No Telp. Dua</label>
                    <input type="number" name="telp_nd" id="telp_nd" class="form-control" value="{{ $patient->telp_nd ?? '' }}">

                    @error('telp_nd')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tempat_lahir">Tempat, Tangal Lahir</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{ $patient->tempat_lahir ?? '' }}">
                            @error('tempat_lahir')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" value="{{ $patient->tgl_lahir ?? '' }}">
                            @error('tgl_lahir')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <label for="jk">Jenis Kelamin</label>
                    <div class="radio">
                        <input type="radio" name="jk" id="jk" value="Laki-Laki" {{ $patient->jk == 'Laki-Laki' ?'checked' : '' }}> Laki-Laki
                        <input type="radio" name="jk" id="jk" value="Perempuan" class="ml-3" {{ $patient->jk == 'Perempuan' ?'checked' : '' }}> Perempuan
                    </div>

                    @error('jk')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="display-block">Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_active" id="patient_active" value="1" checked>
                        <label class="form-check-label" for="patient_active">
                            Active
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_active" id="patient_inactive" value="0">
                        <label class="form-check-label" for="patient_inactive">
                            Inactive
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="suku">Suku</label>
                    <input type="text" name="suku" id="suku" class="form-control" value="{{ $patient->suku ?? '' }}">

                    @error('suku')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pekerjaan">Pekerjaan</label>
                    <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" value="{{ $patient->pekerjaan ?? '' }}">

                    @error('pekerjaan')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="no_rek">No Rek</label>
                    <input type="number" name="no_rek" id="no_rek" class="form-control" value="{{ $patient->no_rek ?? '' }}">

                    @error('no_rek')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nik_ktp">Nik Ktp</label>
                    <input type="number" name="nik_ktp" id="nik_ktp" class="form-control" value="{{ $patient->nik_ktp ?? '' }}">

                    @error('nik_ktp')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3" class="form-control"> {{ $patient->alamat }}</textarea>

                    @error('alamat')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pict">Foto</label>
                    <input type="file" name="pict" id="pict" class="form-control">

                    @error('pict')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="m-t-20 text-center">
            <button type="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i> Save</button>
        </div>
    </div>
</div>