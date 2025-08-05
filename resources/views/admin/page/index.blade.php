@extends('admin.layouts.app')
@section('title')
    {{ 'Page List' }}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="header-title m-0">Page List</h4>
                                <a href="{{ route('pages.create') }}" class="btn btn-sm btn-primary text-white"><i
                                        class="ri-add-line"></i>&nbsp;Add</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="page-table" class="table table-striped dt-responsive table-word-warp w-100">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Action</th>
                                        <th>Title</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        //ajax Table
        let table = '';
        $(function() {
            table = $('#page-table').DataTable({
                "language": {
                    "zeroRecords": "No record(s) found.",
                    searchPlaceholder: "Search records",
                    processing: 'Processing...',
                },
                ordering: true,
                order: [0, 'desc'],
                paging: true,
                processing: true,
                serverSide: true,
                lengthChange: true,
                searchable: true,
                ajax: {
                    url: "{{ route('pages.ajax.table') }}"
                },
                dataType: 'html',
                columns: [{
                        data: 'created_at',
                        name: 'created_at',
                        searchable: false,
                        orderable: true,
                        defaultContent: 'NA',
                        visible: false,
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'title',
                        name: 'title',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    }
                ]
            });
            $.fn.dataTable.ext.errMode = 'none';
            $('#page-table').on('error.dt', function(e, settings, techNote, message) {
                console.log('An error has been reported by DataTables: ', message);
            })
        });
    </script>
@endpush
