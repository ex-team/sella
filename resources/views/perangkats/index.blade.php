@extends('layouts/default')

@section('title')
Perangkat
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Perangkat</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Perangkat</li>
        <li class="active">Daftar Perangkat</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
     <div class="col-12">
     @include('flash::message')
        <div class="card panel-primary ">
            <div class="card-heading clearfix">
                <h4 class="card-title float-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Daftar Perangkat
                </h4>
                <div class="float-right">
                    <a style="margin: 0 10px" href="{{ route('perangkats.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus fa-fw"></i> @lang('button.create')</a>
                    <a style="margin: 0 10px" href="{{ route('perangkats.pdf') }}" class="btn btn-sm btn-warning"><i class="fa fa-plus fa-fw"></i> Export PDF</a>
                    <a style="margin: 0 10px" href="#" class="float-right btn btn-sm btn-success import_btn" data-toggle="modal" data-target="#data_confirm">
                        <i class="fa fa-plus fa-fw"></i>Bulk Import/Export</a>
                </div>
            </div>
            <br />
            <div class="card-body table-responsive">
                 @include('perangkats.table')

            </div>
        </div>
        </div>
 </div>
</section>
@stop
