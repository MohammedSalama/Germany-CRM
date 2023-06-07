@extends('layouts.admin.master')
@section('css')
@endsection

@section('title')
    Customer
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6"> Customer <h4 class="mb-0"> </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color"> Customer </a></li>
                    <li class="breadcrumb-item active">Settings</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('message')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <button class="btn btn-success btn-sm" title="create" data-toggle="modal"
                            data-target="#createcustomer" >
                        Create Contact Person </button>
                    @include('Backend.Customer.create')
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> Name </th>
                                <th>Processes</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customer as $customer)
                                <tr>
                                    <td>{{ $loop -> iteration }}</td>
                                    <td>{{ $customer -> name }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" data-customer_id="{{$customer->id}}"
                                                data-toggle="modal" data-target="#deletedcustomer"><i
                                                class="fa fa-trash"></i></button>

                                        <button class="btn btn-success btn-sm" title="Edit" data-toggle="modal"
                                                data-target="#Editcustomer{{$customer->id}}" ><i
                                                class="fa fa-edit"></i></button>

                                        @include('Backend.Customer.deleted')

                                        @include('Backend.Customer.edit')

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <script>
        $('#deletedcustomer').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var customer_id = button.data(customer_id)
            var modal = $(this)
            modal.find('.modal-body #customer_id').val(customer_id);
        })
    </script>
@endsection
