<div class="row">
    <div class="col-md-12">
        <div class="card shadow" id="card">
            <div class="card-body">


                <div class="form-group">
                    <label for="name">Name  <span style="color: red">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $role->key }}">
                     @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="permission">Roles  <span style="color: red">*</span></label>
                    <select name="permission[]" id="permission" class="form-control select2" multiple>
                        @if($rolePermissions != null)
                        @foreach($rolePermissions as $roles)
                        <option value="{{ $roles->permission_id }}" selected>{{ $roles->key }}</option>
                        @endforeach
                        @endif
                        @foreach($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->key }}</option>
                        @endforeach
                    </select>

                    @error('permission')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="id_perusahaan">Perusahaan <span style="color: red">*</span></label>
                    <select required name="id_perusahaan" id="id_perusahaan" class="form-control select2">
                        <option disabled selected>-- Select Perusahaan --</option>
                        @foreach($perusahaans as $perusahaan)
                        <option {{ $perusahaan->id == $role->id_perusahaan ? 'selected' : '' }}
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
