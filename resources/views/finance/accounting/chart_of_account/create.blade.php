@extends('layouts.master', ['title' => 'Create Chart of account'])

@section('content')
    <div class="row">
        <div class="col-sm-4 col-3 mt-3">
            <h4 class="page-title">Create Chart of account</h4>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered custom-table table-striped" id="chart" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="text-align: center; width: 5%">No</th>
                                    <th>Account No</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Balance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-md-6">
            <div class="card-box">
                <h4 class="card-title">Basic Form</h4>
                <form action="#">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">First Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Last Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Email Address</label>
                        <div class="col-md-9">
                            <input type="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Username</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Repeat Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @stop
