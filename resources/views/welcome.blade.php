@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h1 class="card-title text-white">
                            Ajax Crud
                        </h1>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark float-right" style="margin-top: -45px;" onclick="create()" data-toggle="modal" data-target="#modal">
                            Add New
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-dark">
                            <thead class="text-center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Religion</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="religion" class="col-sm-2 col-form-label">Religion</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="religion" id="religion" placeholder="Religion">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btnSave" onclick="store()">Save</button>
                    <button type="button" class="btn btn-primary btnUpdate" onclick="update()">Update</button>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        var _modal = $('#modal');
        var btnSave = $('.btnSave');
        var btnUpdate = $('.btnUpdate');

        //Prevent csrf-token mismatch error
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Get data from database
        function getRecords() {
            $.get('{{ route('getData') }}')
                .then(function (data) {
                    var html = "";
                    data.forEach(function (row) {
                        html += "<tr>";
                        html += "<td>" + row.id + "</td>";
                        html += "<td>" + row.name + "</td>";
                        html += "<td>" + row.email + "</td>";
                        html += "<td>" + row.phone + "</td>";
                        html += "<td>" + row.religion + "</td>";
                        html += "<td>";
                        html += '<button type="button" class="btn btn-xs btn-warning btnEdit" title="Edit Record">Edit</button>';
                        html += '<button type="button" class="btn btn-xs btn-danger btnDelete" data-id="'+ row.id +'" title="Delete Record">Delete</button>';
                        html += "</td> </tr>";
                    });
                    $('table tbody').html(html);
                });
        }
        getRecords();

        //Reset inputs
        function reset() {
            _modal.find('input').each(function () {
                $(this).val(null);
            });
        }

        // Get inputs value and convert it into json data
        function getInputs() {
            var id          = $('input[name="id"]').val();
            var name        = $('input[name="name"]').val();
            var email       = $('input[name="email"]').val();
            var phone       = $('input[name="phone"]').val();
            var religion    = $('input[name="religion"]').val();

            return {
                id: id,
                name: name,
                email: email,
                phone: phone,
                religion: religion,
            };
        }

        // Show create Modal
        function create() {
            _modal.find('.modal-title').text('New Contact');
            reset();
            _modal.modal('show');
            btnSave.show();
            btnUpdate.hide();
        }

        //Store Records
        function store() {
            if(!confirm("Are you sure?")) return;
            $.ajax({
                method: 'POST',
                url: 'contacts/store',
                data: getInputs(),
                dataType: 'JSON',
                success: function () {
                    alert('Inserted');
                    reset();
                    _modal.modal('hide');
                    getRecords();
                }
            });
        }

        //Edit records
        $('table').on('click', '.btnEdit', function () {
            _modal.find('.modal-title').text('Edit Content');
            _modal.modal('show');
            btnUpdate.show();
            btnSave.hide();

            var id          = $(this).parent().parent().find('td').eq(0).text();
            var name        = $(this).parent().parent().find('td').eq(1).text();
            var email       = $(this).parent().parent().find('td').eq(2).text();
            var phone       = $(this).parent().parent().find('td').eq(3).text();
            var religion    = $(this).parent().parent().find('td').eq(4).text();

            $('input[name="id"]').val(id);
            $('input[name="name"]').val(name);
            $('input[name="email"]').val(email);
            $('input[name="phone"]').val(phone);
            $('input[name="religion"]').val(religion);
        });

        //Udpate Records
        function update() {
            if(!confirm("Are you sure?")) return;
            $.ajax({
                method: 'POST',
                url: '{{ route('update') }}',
                data: getInputs(),
                dataType: 'JSON',
                success: function () {
                    alert('Updated');
                    reset();
                    _modal.modal('hide');
                    getRecords();
                }
            });
        }

        //Delete Records
        $('table').on('click', '.btnDelete', function () {
            if(!confirm("Are you sure?")) return;
            var id = $(this).data('id');
            var data = {id:id};
            $.ajax({
                method: 'POST',
                url: '{{ route('delete') }}',
                data: data,
                dataType: 'JSON',
                success: function () {
                    alert('Deleted');
                    getRecords();
                }
            });
        });
    </script>
@endpush
