@extends('layouts.info')

@section('title',(!empty($editRow) ? 'Edit ' . $editRow->name : 'Add ') . 'Category')

@section('content')
    <div class="page-content">
        <div class="page-content ml-5">
            <div class="row">
                <div class="col-12">
                    <h5 class="page-header">
                        <i class="fa fa-industry"></i>
                        {{ (!empty($editRow) ? 'Edit, ' . $editRow->name : 'Add New Category') }}
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="panel-body ml-5">
                            <form class="form-horizontal" role="form" method="{{!empty($editRow) ? 'PATCH' : 'POST' }}" action="{{ !empty($editRow) ? url('category/update', $editRow->id) : url('category/store') }}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ $token }}">
                                <!-- row -->
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="name">Category Name<i class="text-danger">*</i> :</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Category Name" style="width: 350px;">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="category_code">Category Code<i class="text-danger">*</i> :</label>
                                        <input type="text" name="category_code" id="category_code" placeholder="Enter Category Code" class="form-control" style="width: 350px;">
                                    </div>
                                </div>
                                <!-- row -->
                                <div class="row">
                                    <div class="col-sm-12"></div>
                                    <div>
                                        <button type="submit" class="btn btn-md btn-success">{{ !empty($editRow->id) ? 'Update' : 'Save' }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

