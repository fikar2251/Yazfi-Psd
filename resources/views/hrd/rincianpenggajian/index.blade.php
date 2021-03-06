@extends('layouts.master', ['title' => 'Rincian Penggajian'])
@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Rincian Gaji</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="{{ route('hrd.rincianpenggajian.create') }}" class="btn btn btn-primary btn-rounded float-right"><i
                class="fa fa-plus"></i> Add Rincian</a>
    </div>
</div>

<x-alert></x-alert>

<div class="row">
    <div class="col-md-12">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table  table-striped custom-table report">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No.</th>
                            <th>Name Roles</th>
                            <th> Gaji</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gajians as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->role->key }}</td>
                            <td>@currency($data->gaji)</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('hrd.rincianpenggajian.edit', $data->id) }}"
                                        class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('hrd.rincianpenggajian.destroy', $data->id) }}"
                                        class="delete-form" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                            class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop

@section('footer')
<script>
    $('.report').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'copy',
                className: 'btn-default',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                className: 'btn-default',
                title: 'Laporan Users ',
                messageTop: 'Tanggal  {{ request("from") }} - {{ request("to") }}',
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                className: 'btn-default',
                title: 'Laporan Users ',
                messageTop: 'Tanggal {{ request("from") }} - {{ request("to") }}',
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
        ]
    });

</script>
@stop
