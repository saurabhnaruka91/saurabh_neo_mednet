@extends('layouts.main')
@section('content')
    <section style="padding-top: 20px; padding-left: 10px; padding-right: 10px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div style="  position: absolute; right: 300px; z-index: 999">
{{--                        <a class="btn btn-success"--}}
{{--                           href="{{ route('category.export') }}"><i class="fas fa-file-csv"></i> Export</a>--}}
                    </div>
                    <table id="claim-table" class="table table-condensed">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>PayerID</th>
                            <th>ProviderID</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
       <script>
           $('#claim-table').DataTable({
               processing: true,
               serverSide: true,
               order: [[ 1, "desc" ]],
               ajax: '{{ route('claim.list') }}',
               columns: [
                   {data: 'id', name: 'id'},
                   {data: 'PayerID', name: 'PayerID',searchable: true},
                   {data: 'ProviderID', name: 'ProviderID'},
                   {data: 'action', name: 'action', orderable: false, searchable: false}
               ],
               buttons: [
               'csv'
               ]
           });
           $('#claim-table').on('click', '.btn-delete[data-remote]', function (e) {
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
               }else
                   alert("You have cancelled!");
           });
       </script>
    </section>
@endsection
