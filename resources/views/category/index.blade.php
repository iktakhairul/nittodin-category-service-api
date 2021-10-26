@extends('layouts.info')

@section('title', "Category" )

@section('content')

    <section class="content-header">
        <h1 class="breadcrumb ml-5 mt-4">
            <i class="fa fa-box mr-2"></i> Category
        </h1>
        <div class="form-group col-md-12">
            <div class="pull-right">
                <a href="{{ url('category/create') }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create Category</a>
            </div>
        </div>
    </section>
    <br>
    <hr>
    <!-- Main content -->
    <section class="content container-fluid">
        <br>
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-stripped responsive">
                        <thead>
                        <tr>
                            <th width="20">No</th>
                            <th>Group Id </th>
                            <th>Name </th>
                            <th>Slug </th>
                            <th>Icon </th>
                            <th>Category Code </th>
                            <th>Serial No </th>
                            <th>Short Details </th>
                            <th>Status </th>
                            <th width="100">Actions</th>
                        </tr>
                        </thead>
                        <tbody id="">
                        @if (count($categories) > 0)
                            @foreach ($categories as $key => $index)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        @foreach($groups as $group)
                                            @if($group->id === $index->group_id)
                                                {{ $group->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $index->name ?? '' }}</td>
                                    <td>{{ $index->slug ?? ''}}</td>
                                    <td>{{ $index->icon ?? ''}}</td>
                                    <td>{{ $index->category_code ?? '' }}</td>
                                    <td>{{ $index->serial_no ?? ''}}</td>
                                    <td>{{ $index->short_details ?? ''}}</td>
                                    <td class="text-{{ $index->status == 'Active' ? 'success' : 'danger' }}">{!! $index->status == 'Active' ? 'ACTIVE' : 'INACTIVE' !!}</td>
                                    <td>
                                        <center>
                                            <div class="row">
                                                <div class="col-4">
                                                    <a href="{{ url('category/update-status', $index->id) }}" class="btn btn-primary btn-xs btn-{{ $index->status == 'Active' ? 'info' : 'warning' }}" title="{{ $index->status == 'Active' ? 'Inactive ' : 'Activate ' }}" data-toggle="tooltip" data-placement="top"><i class="fa fa-{{ $index->status == 'Active' ? 'check-square ' : 'ban' }}"></i></a>
                                                </div>
                                                <div class="col-4">
                                                    <a href="{{ url('category/edit', $index->id) }}"><button class="btn btn-primary btn-xs position-relative"><i class="fas fa-pencil-alt"></i></button></a>
                                                </div>
                                                <div class="col-4">
                                                    <form method="GET" action="{{url('category/destroy', $index->id)}}">
                                                        <button class="btn btn-danger btn-xs" id="delete" onclick="return confirm('Are you sure to delete data of {{$index->name}} ?')"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">No data found!</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection

