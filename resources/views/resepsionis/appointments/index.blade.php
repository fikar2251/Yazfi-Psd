@extends('layouts.master', ['title' => 'Appointments'])

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1 class="page-title">Appointments</h1>
    </div>
</div>

<x-alert></x-alert>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table" width="100%" id="appointments">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Appointment</th>
                        <th>Nama Pasien</th>
                        <th>Dokter</th>
                        <th>Cabang</th>
                        <th>Tanggal Booking</th>
                        <th>Waktu Booking</th>
                        <th>Status Kedatangan</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>

                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Status Kedatangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="status">Status Kedatangan</label>
                        <select name="" id="" class="form-control kedatangan">
                            <option disabled selected>-- Select Status --</option>
                            @foreach($status as $stt)
                            <option value="{{ $stt->id }}">{{ $stt->status }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary update">Update</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getData() {
            $('#appointments').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/resepsionis/appointments/ajax',
                    get: 'get'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'no_booking',
                        name: 'no_booking'
                    },
                    {
                        data: 'pasien',
                        name: 'pasien'
                    },
                    {
                        data: 'dokter',
                        name: 'dokter'
                    },
                    {
                        data: 'cabang',
                        name: 'cabang'
                    },
                    {
                        data: 'tgl_status',
                        name: 'tgl_status'
                    },
                    {
                        data: 'waktu',
                        name: 'waktu'
                    },
                    {
                        data: 'kedatangan',
                        name: 'kedatangan'
                    },
                    {
                        data: 'tindakan',
                        name: 'tindakan'
                    },
                ]
            })
        }

        getData()

    })

    function getId(id) {
        $(".update").on('click', function(e) {
            e.preventDefault()
            let status = $(".kedatangan").val()

            $.ajax({
                method: 'POST',
                type: 'POST',
                url: '/resepsionis/appointments/updatestatus',
                data: {
                    id: id,
                    status: status,
                },
                success: function(response) {
                    if (response.status == 'success') {
                        iziToast.success({
                            title: 'Success',
                            position: 'topRight',
                            message: response.message,
                        });
                    }
                }
            })
        })
    }
</script>
@stop