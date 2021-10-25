@extends('layouts.info')

@section('title', "Sub-Category" )

@section('content')

    <section class="content-header">
        <h1 class="breadcrumb ml-5 mt-4">
            <i class="fa fa-box"></i>. Sub-Category
        </h1>
        <div class="form-group col-md-12">
            <div class="pull-right">
                <a href="{{ url('sub-category/create') }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create Sub-Category</a>
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
                    <table id="listProdukToko" class="table table-bordered table-stripped responsive">
                        <thead>
                        <tr>
                            <th width="20">No</th>
                            <th>Group Id </th>
                            <th>Category Id </th>
                            <th>Name </th>
                            <th>Slug </th>
                            <th>Icon </th>
                            <th>Sub-Category Code </th>
                            <th>Serial No </th>
                            <th>Short Details </th>
                            <th>Status </th>
                            <th width="100">Actions</th>
                        </tr>
                        </thead>
                        <tbody id="">
                        @if (count($subCategories) > 0)
                            @foreach ($subCategories as $key => $index)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $index->group_id ?? '' }}</td>
                                    <td>{{ $index->category_id ?? '' }}</td>
                                    <td>{{ $index->name ?? '' }}</td>
                                    <td>{{ $index->slug ?? ''}}</td>
                                    <td>{{ $index->icon ?? ''}}</td>
                                    <td>{{ $index->subcategory_code ?? ''}}</td>
                                    <td>{{ $index->serial_no ?? ''}}</td>
                                    <td>{{ $index->short_details ?? ''}}</td>
                                    <td>{{ $index->status ?? ''}}</td>
                                    <td>
                                        <center>
                                            <a href="{{ url('sub-category/edit', $index->id) }}"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></button></a>
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

