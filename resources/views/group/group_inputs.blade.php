@extends('layouts.info')

@section('title',(!empty($editRow) ? 'Edit ' . $editRow->name : 'Add ') . 'Group')

@section('content')
    <section class="content-header">
        <h1 class="breadcrumb ml-5 mt-4">
            <i class="fa fa-industry"></i><a class="ml-2 mr-2" href="{{url('groups')}}">Group</a>
            {{ (!empty($editRow) ? '/ Edit - ' . $editRow->name : '/ Add New Group') }}
        </h1>
    </section>
    <hr>
    <div class="page-content">
        <div class="page-content ml-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="panel-body ml-5">
                            <form class="form-horizontal" role="form" method="POST" action="{{ !empty($editRow) ? url('group/update', $editRow->id) : url('group/store') }}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ $token }}">
                                <!-- row -->
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="name">Group Name<i class="text-danger">*</i> :</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Group Name" value="{{!empty($editRow) ? $editRow->name : ''}}" style="width: 350px;">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="group_code">Group Code<i class="text-danger">*</i> :</label>
                                        <input type="text" name="group_code" id="group_code" placeholder="Enter Group Code" class="form-control" value="{{!empty($editRow) ? $editRow->group_code : ''}}" style="width: 350px;">
                                    </div>

                                </div>
                                <!-- row -->
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="serial_no">Serial No<i class="text-danger">*</i> :</label>
                                        <input type="text" name="serial_no" id="serial_no" class="form-control" placeholder="Enter Serial No" value="{{!empty($editRow) ? $editRow->serial_no : ''}}" style="width: 350px;">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="status">Status<i class="text-danger">*</i> :</label>
                                        <select class="form-control" name="status" id="status" style="width: 350px;">
                                            <option value="" disabled selected readonly="">Choose One</option>
                                            @if (!empty($editRow->status) && $editRow->status == 'Inactive')
                                                <option selected value="{{ 'Inactive' }}">{{ 'Inactive' }}</option>
                                                <option value="{{ 'Active' }}"> {{ 'Active' }}</option>
                                            @elseif(!empty($editRow->status) && $editRow->status == 'Active')
                                                <option value="{{ 'Inactive' }}">{{ 'Inactive' }}</option>
                                                <option selected value="{{ 'Active' }}"> {{ 'Active' }}</option>
                                            @else
                                                <option value="{{ 'Inactive' }}">{{ 'Inactive' }}</option>
                                                <option selected value="{{ 'Active' }}"> {{ 'Active' }}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <!-- row -->
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="icon">Group Icon<i class="text-danger">*</i> :</label>
                                        <input {{ !empty($editRow->icon) ? '' : 'Not Found!' }} accept="image/*" name="icon" type="file" onchange="imageRandChange(this)" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="short_details">Short Details :</label>
                                        <textarea type="text" name="short_details" id="short_details" placeholder="Enter short details for group." class="form-control" style="width: 350px;">{{!empty($editRow) ? $editRow->short_details : ''}}</textarea>
                                    </div>
                                </div>

                                <!-- row -->
                                <div class="row">
                                    <div class="col-sm-12"></div>
                                    <div>
                                        <button type="submit" class="btn btn-md btn-dark">{{ !empty($editRow->id) ? 'Update' : 'Save' }}</button>
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

