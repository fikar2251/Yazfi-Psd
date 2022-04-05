@extends('layouts.master', ['title' => 'Dashboard'])

@section('content')
<div class="text-center">
    <h4 style="font-size: 30px; font-weight: 500;" class="page-title mb-3">PEMBAYARAN KONSUMEN</h4>
</div>
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">List Sales</h4>
        </div>
    </div>

    <div class="row doctor-grid">
        @foreach ($user as $u)
            <div class="col-md-4 col-sm-4  col-lg-3">
                <div class="profile-widget">
                    <div class="doctor-img">
                        <a class="avatar" href="#"><img alt="" src="https://w1.pngwing.com/pngs/386/684/png-transparent-face-icon-user-icon-design-user-profile-share-icon-avatar-black-and-white-silhouette.png"
                                style="object-fit: cover; object-position: center;"></a>
                    </div>
                    <h4 class="doctor-name text-ellipsis"><a
                            href="{{ url('supervisor/payment/' . $u->user->id) }}">{{ $u->user->name }}</a></h4>
                    <div class="user-country">
                        <i class="fa fa-map-marker"></i> {{ $u->user->jabatan->nama }}
                    </div>
                </div>
            </div>
        @endforeach
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
                    title: 'Laporan Barang ',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-default',
                    title: 'Laporan Barang ',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
            ]
        });
    </script>
@stop
