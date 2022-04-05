<div class="row">
    <div class="col-md-12">
        <div class="card shadow" id="card">
            <div class="card-body">


                <div class="form-group">
                <label for="nama">Name Jabatan  <span style="color: red">*</span></label>
                    <input type="text" name="nama"  value="{{ $jabatan->nama ?? old('nama')}}" class="form-control">
                    @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                     <label for="id_perusahaan">Perusahaan <span style="color: red">*</span></label>
                    <select name="id_perusahaan" id="perusahaan" class="form-control">
                        <option disabled selected>-- Select Perusahaan --</option>
                        @foreach($perusahaans as $perusahaan)
                        <option {{ $perusahaan->id == $jabatan->id_perusahaan ? 'selected' : '' }}
                            value="{{ $perusahaan->id }}">
                            {{ $perusahaan->nama_perusahaan }}
                        </option>
                        @endforeach
                    </select>

                    @error('id_perusahaan')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="m-t-20 text-center">
                    <button type="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
</div>