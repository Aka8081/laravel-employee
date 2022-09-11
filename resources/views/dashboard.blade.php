@extends('adminlte::page')
@section('meta_tags')
@endsection

@section('content')
    <!-- Page header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Employee list</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.page-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-danger">
                        <div class="card-header">
                            <div class="d-flex">
                                <h3 class="card-title">Employee List</h3>

                                <div class="ml-auto">
                                    <a href="{{ route('employee.create') }}">
                                        <button class="btn btn-dark btn-xs"><span class="fa fa-plus"></span> Add
                                            Employee
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover table-rouned">
                                <thead>
                                <tr class="table-rouned">
                                    <th style="border-top: none">#</th>
                                    <th style="border-top: none">Name</th>
                                    <th style="border-top: none">Email</th>
                                    <th style="border-top: none">Mobile</th>
                                    <th style="border-top: none">Image</th>
                                    <th style="border-top: none">Action</th>

                                </tr>
                                </thead>
                                <tbody>

                                @php $count=0  @endphp
                                @foreach ($employees as $employee)
                                    <tr id="data{{ $employee->id }}">
                                        <td>{{ ++$count }}</td>
                                        <td>{{ $employee->name}}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->mobile }}</td>
                                        <td>{{ $employee->image }}</td>
                                        <td class="text-center">

                                            <div class="btn-group">
                                                <a class="" href="{{ route('employee.edit', $employee->id) }}"><span
                                                        class="fa fa-edit text-info"></span></a>
                                                <a class="" id="deleterule" onclick="confirmDelete(event)" href=""
                                                   data-rule-id="{{ $employee->id }}"><span
                                                        class="ml-2 fa fa-trash text-maroon"></span></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop
@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)
@section('js')
    <script>
        @if (session()->has('success'))
        swal.fire("Done!", "{{ session()->get('success') }}", "success");
        @elseif(session()->has('error'))
        swal.fire("Error!", "{{ session()->get('error') }}", "error");
        @endif
    </script>
    <script>
        function confirmDelete(e) {
            e.preventDefault();
            var ruleId = e.currentTarget.getAttribute('data-rule-id');

            var url = "{{ url('employee/:id/delete') }}";
            url = url.replace(':id', ruleId);

            Swal.fire({
                title: "Delete",
                text: "Do you want to Delete Rule?",
                type: "question",
                showCancelButton: !0,
                confirmButtonText: "Yes",
                reverseButtons: 0
            }).then((res) => {
                if (res.value === true) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        contentType: 'application/json; charset=utf-8',
                        type: 'POST',
                        success: function(result) {
                            if (result.success) {
                                swal.fire({
                                    title: "Delete",
                                    type: "success",
                                    text: result.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(function() {
                                    $("#data"+ruleId).fadeTo(1000, 0.01, function() {
                                        $(this).slideUp(150, function() {
                                            $(this).remove();
                                        });
                                    });
                                })
                            } else {
                                swal.fire({
                                    title: "Oops...",
                                    type: "error",
                                    text: result.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            }
                        },
                        error: function(error) {
                            swal.fire({
                                title: "Oops...",
                                type: "error",
                                text: "Something went wrong.",
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                    });
                }
            })
        }
        $(function() {
            $('#example2').DataTable({
                "paging": true,
                "bFilter": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
