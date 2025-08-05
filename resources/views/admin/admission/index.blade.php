@extends('admin.layouts.app')
@section('title')
    {{ 'Admission List' }}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="header-title m-0">Admission List</h4>
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
                                                        <label for="select-status">From Date - To Date</label>
                                                        <input type="text" id="date" name="date"
                                                            class="form-control" placeholder="From Date - To Date">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="select-status">State</label>
                                                        <select class="form-control" id="state" name="state">
                                                            <option value="" disabled selected>Please Select
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="select-status">City</label>
                                                        <select class="form-control" id="city" name="city">
                                                            <option value="" disabled selected>Please Select
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="select-status">Addmission For</label>
                                                        <select class="form-control" id="admission_for"
                                                            name="admission_for">
                                                            <option value="" disabled selected>Please Select</option>
                                                            <option value="playgroup">Playgroup</option>
                                                            <option value="nursery">Nursery</option>
                                                            <option value="lkg">LKG</option>
                                                            <option value="ukg">UKG</option>
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
                                <table id="admission-table" class="table table-striped dt-responsive table-word-warp w-100">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Date</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Student Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Admission For</th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css" />
    <script>
        //ajax Table
        let table = '';
        $(function() {
            table = $('#admission-table').DataTable({
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
                    url: "{{ route('admission.ajax.table') }}",
                    data: function(d) {
                        d.date = $('#date').val();
                        d.state = $('#state').val();
                        d.city = $('#city').val();
                        d.admission_for = $('#admission_for').val();
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
                        data: 'date',
                        name: 'date',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'state',
                        name: 'state',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'city',
                        name: 'city',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'student_name',
                        name: 'student_name',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'admission_for',
                        name: 'admission_for',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    }
                ],
            });
            $('#state, #city,#admission_for, #date').on('change', function() {
                table.draw();
                window.scroll({
                    top: document.body.scrollHeight,
                    behavior: 'smooth'
                });
            });
            $.fn.dataTable.ext.errMode = 'none';
            $('#admission-table').on('error.dt', function(e, settings, techNote, message) {
                console.log('An error has been reported by DataTables: ', message);
            })
        });
        $(document).ready(function() {
            $('#state').select2({
                placeholder: "Please Select",
                allowClear: true,
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: "{{ route('states.list') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            country_id: $('#country').val(),
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
                                    text: item.name.charAt(0).toUpperCase() + item.name.slice(1)
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
            }).on('select2:unselecting', function() {
                $(this).data('unselecting', true);
            }).on('select2:opening', function(e) {
                if ($(this).data('unselecting')) {
                    $(this).removeData('unselecting');
                    e.preventDefault();
                    table.ajax.reload(null, false);
                }
            });
            $('#city').select2({
                placeholder: "Please Select",
                allowClear: true,
                width: 'resolve',
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: "{{ route('cities.list') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            state_id: $('#state').val(),
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
                                    text: item.name.charAt(0).toUpperCase() + item.name.slice(1)
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
            }).on('select2:unselecting', function() {
                $(this).data('unselecting', true);
            }).on('select2:opening', function(e) {
                if ($(this).data('unselecting')) {
                    $(this).removeData('unselecting');
                    e.preventDefault();
                    table.ajax.reload(null, false);
                }
            });
            $('#admission_for').select2({
                placeholder: "{{ __('Please Select') }}",
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
        flatpickr("#date", {
            placeholder: 'From Date - To Date',
            mode: "range",
            dateFormat: 'Y/m/d',
        })
    </script>
@endpush
