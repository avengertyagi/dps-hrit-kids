@extends('admin.layouts.app')
@section('title')
    {{ 'Media List' }}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="header-title m-0">Media List</h4>
                                <a href="{{ route('media.create') }}" class="btn btn-sm btn-primary text-white"><i
                                    class="ri-add-line"></i>&nbsp;Add</a>
                            </div>
                            <div class="mt-2">
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button fw-medium" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <i class="ri-filter-line"></i> Filter
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="select-status">Status</label>
                                                        <select class="form-control" id="status" name="status">
                                                            <option value="" disabled selected>Please Select</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="media-table"
                                    class="table table-striped dt-responsive table-word-warp w-100">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Action</th>
                                            <th>Status</th>
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
    </div>
@endsection
@push('js')
    <script>
        //ajax Table
        let table = '';
        $(function() {
            table = $('#media-table').DataTable({
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
                    url: "{{ route('media.ajax.table') }}",
                    data: function(d) {
                        d.status = $('#status').val();
                    },
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
                        data: 'status',
                        name: 'status',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'widget_name',
                        name: 'widget_name',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    }
                ],
                fnDrawCallback: function(oSettings, json) {
                    $('.status-switch').on('change', function() {
                        let switchId = this.id;
                        let roleId = switchId.replace('switch-', '');
                        let isChecked = this.checked;
                        Swal.fire({
                            title: "Are you sure?",
                            text: "Do you want to update the Status?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: "Yes, update it!",
                            cancelButtonText: "Cancel"
                        }).then(function(result) {
                            if (result.isConfirmed) {
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $(
                                            'meta[name="csrf-token"]').attr(
                                            'content')
                                    },
                                    url: "{{ route('media.status-change') }}",
                                    type: "POST",
                                    dataType: 'json',
                                    data: {
                                        id: roleId,
                                        status: isChecked ? 1 : 0
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            toastMagic.success(response
                                                .success);
                                            table.ajax.reload();
                                        } else {
                                            toastMagic.error(response.error);
                                            table.ajax.reload();
                                        }
                                    },
                                    error: function(xhr) {
                                        toastMagic.error(
                                            "An error occurred. Please try again."
                                        );
                                        table.ajax.reload();
                                    }
                                });
                            } else {
                                $('#' + switchId).prop('checked', !isChecked);
                            }
                        });
                    });
                }
            });
            $('#status').on('change', function() {
                table.draw();
                window.scroll({
                    top: document.body.scrollHeight,
                    behavior: 'smooth'
                });
            });
            $.fn.dataTable.ext.errMode = 'none';
            $('#media-table').on('error.dt', function(e, settings, techNote, message) {
                console.log('An error has been reported by DataTables: ', message);
            })
        });
        $(document).ready(function() {
            $('#status').select2({
                placeholder: "Please Select",
                allowClear: true,
            }).on('select2:unselecting', function() {
                $(this).data('unselecting', true);
            }).on('select2:opening', function(e) {
                if ($(this).data('unselecting')) {
                    $(this).removeData('unselecting');
                    e.preventDefault();
                    table.ajax.reload(null, false);
                }
            });
        });
    </script>
@endpush
