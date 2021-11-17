@extends('layouts.main')
@section('content')
    <section style="padding-top: 20px; padding-left: 10px; padding-right: 10px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div style="  position: absolute; right: 300px; z-index: 999">
                        <a class="btn btn-success"
                           href="{{ route('user.export') }}"><i class="fas fa-file-csv"></i> Export</a>
                    </div>
                    <table id="users-table" class="table table-condensed">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <script>
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                order: [[ 1, "asc" ]],
                ajax: '{{ route('users.list') }}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name', searchable: true},
                    {data: 'email', name: 'email', searchable: true},
                    {data: 'roles', name: 'roles.role_name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            $('#users-table').on('click', '.btn-delete[data-remote]', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = $(this).data('remote');
                // confirm then
                if (confirm('Are you sure you want to delete this?')) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        data: {method: 'POST', submit: true}
                    }).always(function (data) {
                        $('#faculties-table').DataTable().draw(false);
                        location.reload();
                    });
                } else
                    alert("You have cancelled!");
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://unpkg.com/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
        <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
        <script>
            $(function() {
                let copyButtonTrans = 'Copy'
                let csvButtonTrans = 'CSV'
                let excelButtonTrans = 'EXCEL'
                let pdfButtonTrans = 'Pdf'
                let printButtonTrans = 'Print'
                let colvisButtonTrans = 'Column visibility'

                let languages = {
                    'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
                };

                $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
                $.extend(true, $.fn.dataTable.defaults, {
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
                    },
                    columnDefs: [{
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0
                    }, {
                        orderable: false,
                        searchable: false,
                        targets: -1
                    }],
                    select: {
                        style:    'multi+shift',
                        selector: 'td:first-child'
                    },
                    order: [],
                    scrollX: true,
                    pageLength: 100,
                    dom: 'lBfrtip<"actions">',
                    buttons: [
                        {
                            extend: 'copy',
                            className: 'btn-default',
                            text: copyButtonTrans,
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'csv',
                            className: 'btn-default',
                            text: csvButtonTrans,
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'excel',
                            className: 'btn-default',
                            text: excelButtonTrans,
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdf',
                            className: 'btn-default',
                            text: pdfButtonTrans,
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'print',
                            className: 'btn-default',
                            text: printButtonTrans,
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'colvis',
                            className: 'btn-default',
                            text: colvisButtonTrans,
                            exportOptions: {
                                columns: ':visible'
                            }
                        }
                    ]
                });

                $.fn.dataTable.ext.classes.sPageButton = '';
            });
            </script>
    </section>
@endsection
