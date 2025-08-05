@extends('admin.layouts.app')
@section('title')
    {{ 'Page Section List' }}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="header-title m-0">Page Section List</h4>
                                <a href="{{ route('page-sections.create') }}" class="btn btn-sm btn-primary text-white"><i
                                        class="ri-add-line"></i>&nbsp;Add</a>
                            </div>
                            <div class="mt-2">
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button fw-medium" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <i class="ri-filter-line"></i>Filter
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="select-status">Parent Page</label>
                                                        <select class="form-control" id="page_id" name="page_id">
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
                                <table id="page-section-table"
                                    class="table table-striped dt-responsive table-word-warp w-100">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Action</th>
                                            <th>Page</th>
                                            <th>Parent Section</th>
                                            <th>Section Title</th>
                                            <th>Section Name</th>
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
            table = $('#page-section-table').DataTable({
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
                    url: "{{ route('page-sections.ajax.table') }}",
                    data: function(d) {
                        d.page_id = $('#page_id').val();
                        d.category = $('#category').val();
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
                        data: 'page_name',
                        name: 'page_name',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'parent_section',
                        name: 'parent_section',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'section_title',
                        name: 'section_title',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'featured_image',
                        name: 'featured_image',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    }
                ]
            });
            $('#page_id').on('change', function() {
                table.draw();
                window.scroll({
                    top: document.body.scrollHeight,
                    behavior: 'smooth'
                });
            });
            $.fn.dataTable.ext.errMode = 'none';
            $('#page-section-table').on('error.dt', function(e, settings, techNote, message) {
                console.log('An error has been reported by DataTables: ', message);
            })
        });
        $(document).ready(function() {
            $('#page_id').select2({
                placeholder: "Please Select",
                allowClear: true,
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: "{{ route('pages.list') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.title.charAt(0).toUpperCase() + item.title.slice(
                                        1)
                                };
                            }),
                            pagination: {
                                more: data.current_page < data.last_page
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0,
                language: {
                    searching: function() {
                        return "Searching...";
                    },
                    noResults: function() {
                        return "No result found";
                    }
                }
            });
        });
    </script>
@endpush
