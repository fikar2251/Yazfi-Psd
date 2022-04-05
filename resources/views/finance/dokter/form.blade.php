<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="name">Full Name <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="name" value="{{ $dokter->name ?? old('name') }}">

            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Email <span class="text-danger">*</span></label>
            <input class="form-control" type="email" name="email" value="{{ $dokter->email ?? old('email') }}">

            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password">

            @error('password')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Phone </label>
            <input class="form-control" type="text" name="phone_number" value="{{ $dokter->phone_number ?? old('phone_number') }}">

            @error('phone_number')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Image</label>
            <div class="profile-upload">
                <div class="upload-input">
                    <input type="file" class="form-control" name="image">
                </div>
            </div>

            @error('image')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" id="address" rows="3" class="form-control">{{ $dokter->address ?? old('address') }}</textarea>

                    @error('address')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>