<div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">
    <table class="table table-striped table-bordered" id="perangkats-table" width="100%">
        <thead>
            <tr>
                <th>ID Perangkat</th>
                <th>Uraian Perangkat</th>
                <th>Stok Perangkat</th>
                <th>Tahun Pengadaan Perangkat</th>
                <th>Type Perangkat</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($perangkats as $perangkat)
                <tr>
                    <td>{!! $perangkat->id_perangkat !!}</td>
                    <td>{!! $perangkat->uraian_perangkat !!}</td>
                    <td>{!! $perangkat->stok_perangkat !!}</td>
                    <td>{!! $perangkat->tahun_pengadaan_perangkat !!}</td>
                    <td>{!! $perangkat->type_perangkat !!}</td>
                    <td>
                        <a
                            href="{{ route('perangkats.show', collect($perangkat)->first() ) }}">
                            <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA"
                                data-hc="#428BCA" title="view perangkat"></i>
                        </a>
                        <a
                            href="{{ route('perangkats.edit', collect($perangkat)->first() ) }}">
                            <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA"
                                data-hc="#428BCA" title="edit perangkat"></i>
                        </a>
                        <a href="{{ route('perangkats.confirm-delete', collect($perangkat)->first() ) }}"
                            data-toggle="modal" data-target="#delete_confirm"
                            data-id="{{ route('perangkats.delete', collect($perangkat)->first() ) }}">
                            <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954"
                                data-hc="#f56954" title="delete perangkat"></i>

                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@section('footer_scripts')

<div class="modal fade" id="data_confirm" tabindex="-1" role="dialog" aria-labelledby="dataLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="dataLabel">Import/Export Data Perangkat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('perangkats.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                        <div class="custom-file text-left">
                            <input type="file" name="import_file" accept=".xlsx" class="custom-file-input" id="import_file">
                            <label class="custom-file-label" for="import_file">Choose file</label>
                        </div>
                    </div>
                    <button class="btn btn-primary">Import Data</button>
                    <a class="btn btn-warning" href="{{ URL::to('perangkats/download/xlsx') }}">Download Template</a>
                    <a class="btn btn-success" href="{{ route('perangkats.export') }}">Export Data</a>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteLabel">Delete Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                Are you sure to delete this Item? This operation is irreversible.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a type="button" class="btn btn-danger Remove_square">Delete</a>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('body').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');
        });
    });

</script>
<link rel="stylesheet" type="text/css"
    href="{{ asset('vendors/datatables/css/buttons.bootstrap4.css') }}" />
<link rel="stylesheet" type="text/css"
    href="{{ asset('vendors/datatables/css/dataTables.bootstrap4.css') }}" />
<link rel="stylesheet" type="text/css"
    href="{{ asset('vendors/datatables/css/buttons.bootstrap4.css') }}">
<script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}">
</script>
<script type="text/javascript"
    src="{{ asset('vendors/datatables/js/dataTables.bootstrap4.js') }}"></script>

<script>
    $('#perangkats-table').DataTable({
        responsive: true,
        pageLength: 10
    });
    $('#perangkats-table').on('page.dt', function () {
        setTimeout(function () {
            $('.livicon').updateLivicon();
        }, 500);
    });
    $('#perangkats-table').on('length.dt', function (e, settings, len) {
        setTimeout(function () {
            $('.livicon').updateLivicon();
        }, 500);
    });

    $('#delete_confirm').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var $recipient = button.data('id');
        var modal = $(this);
        modal.find('.modal-footer a').prop("href", $recipient);
    })

</script>

@stop
