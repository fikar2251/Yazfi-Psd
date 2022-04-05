<div class="modal fade bd-example-modal-lg" id="show-data" aria-hidden="true" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul">Pilih Pasien</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('marketing.service.appointments.book') }}" method="post">
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        <!-- <div class="col-md-3"> -->
                            <!-- <div class="form-group"> -->
                                <!-- <label for="jadwal_id">Jadwal ID</label> -->
                                <input type="hidden" class="form-control" name="jadwal_id" id="jadwal_id" readonly>
                            <!-- </div> -->
                        <!-- </div> -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="dokter_id">Dokter</label>
                                <input type="hidden" class="form-control" name="dokter_id" id="dokter_id" readonly>
                                <input type="text" class="form-control" id="dokter_name" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="marketing_id">Marketing</label>
                                <input type="hidden" class="form-control" name="marketing_id" id="marketing_id" readonly value="{{ auth()->user()->id }}">
                                <input type="text" class="form-control" readonly value="{{ auth()->user()->name }}">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="waktu_mulai">Waktu Mulai</label>
                                <input type="text" class="form-control" name="waktu_mulai" id="waktu_mulai" readonly>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pasien_id">Pasien</label>
                                <select class="pasienList" name="pasien_id" id="pasien_id">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary" id="tombol-simpan" value="create">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>