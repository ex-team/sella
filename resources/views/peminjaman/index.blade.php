@extends('layouts/default')

@section('title')
Peminjaman
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Peminjaman</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Peminjaman</li>
        <li class="active">Daftar Peminjaman</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
     <div class="col-12">
     @include('flash::message')
        <div class="card panel-primary ">
            <div class="card-heading clearfix">
                <h4 class="card-title float-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Daftar Peminjaman
                </h4>
                <div class="float-right">
                    <a href="{{ route('peminjaman.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus fa-fw"></i> @lang('button.create')</a>
                </div>
            </div>
            <br />
            <div class="card-body table-responsive">
                 @include('peminjaman.table')

            </div>
        </div>
        </div>
 </div>
</section>
@stop
