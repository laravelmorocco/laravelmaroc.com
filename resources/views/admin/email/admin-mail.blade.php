@extends('layouts.dashboard')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Mail To Admin') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Mail To Admin') }}</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title mt-1">{{ __('Mail To Admin') }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form class="form-horizontal" action="{{ route('admin.mailadmin.update') }}" method="POST">
                                    @csrf



                                    <div class="form-group row">
                                        <label for="from_email" class="col-sm-2 control-label">{{ __('Email Address') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="contactemail" placeholder="{{ __('Email Address') }}" value="{{ $commonsetting->contactemail }}">
                                            @if ($errors->has('contactemail'))
                                                <p class="text-danger"> {{ $errors->first('contactemail') }} </p>
                                            @endif
                                        </div>
                                    </div>

                        

                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn bg-pink-500 text-white active:bg-pink-600 focus:ring-pink-500">{{ __('Save') }}</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                            <!-- /.card-body -->
                        </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
@endsection
