@extends('layouts.master', ['title' => 'Dashboard'])

@section('content')

@role('super-admin')
@include('dashboard._super-admin')
@endrole

@role('finance')
<x-resepsionis._resepsionis :bayar="$bayar" :refund="$refund" :komisi="$komisi" :tukar="$tukar" :pengajuans='$pengajuans' :reinbursts='$reinbursts' :penggajians='$penggajians'></x-resepsionis._resepsionis>
@endrole

{{-- @role('dokter')
@include('dokter.dashboard')
@endrole --}}

@role('marketing')
@include('marketing.dashboard/index')
@endrole

@role('supervisor')

@endrole
@role('hrd')
@include('hrd.dashboard')
@endrole
@role('logistik')
@include('logistik.dashboard')
@endrole
@role('purchasing')
@include('purchasing.dashboard')
@endrole


@stop

@role('resepsionis')
@section('footer')
<link rel=" stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {

        $('.stts').on('click', function(e) {
            e.preventDefault();
            var form = this;
            Swal.fire({
                title: 'Ubah status pasien ?',
                text: "Apakah anda yakin ubah status pasien?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    return form.submit();
                }
            })
        });
    })
</script>

@if(session('success'))
<script>
    iziToast.success({
        title: 'Success',
        position: 'topRight',
        message: "{{ session('success') }}",
    });
</script>
@endif
@stop
@endrole