<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table report" id="product" width="100%">
                <thead>
                    <tr>
                        <th style="width:5%;">No</th>
                        <th>Nama Item</th>
                        <th>Supllier</th>
                        <th>Project</th>
                        {{-- <th>Before</th> --}}
                        <th style="width:5%;">In</th>
                        <th style="width:5%;">Out</th>
                        <th style="width:5%;">Last Stok</th>
                        <th>Waktu</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangs as $barang)
          
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="font-size:13px;">
                        <th >Total : </th>
                        <th colspan="3">&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>