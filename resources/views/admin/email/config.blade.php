@extends('layouts.dashboard')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Mail From Admin') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Mail From Admin') }}</li>
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
                                <h3 class="card-title mt-1">{{ __('Mail From Admin') }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form class="form-horizontal" action="{{ route('admin.mail.config.update') }}" method="POST">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="is_smtp" class="col-sm-2 control-label">{{ __('SMTP') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <select name="is_smtp" class="form-control">
                                                <option value="1" {{ $emailsetting->is_smtp == 1 ? 'selected' : '' }}>{{ __('Activated') }}</option>
                                                <option value="0" {{ $emailsetting->is_smtp == 0 ? 'selected' : '' }}>{{ __('Deactivated') }}</option>
                                            </select>
                                            @if ($errors->has('is_smtp'))
                                                <p class="text-danger"> {{ $errors->first('is_smtp') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="header_email" class="col-sm-2 control-label">{{ __('Mail Engine') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <select name="header_email" class="form-control">
                                                <option value="smtp" {{ $emailsetting->header_email == 'smtp' ? 'selected' : '' }}>{{ __('SMTP') }}</option>
                                            </select>
                                            @if ($errors->has('header_email'))
                                                <p class="text-danger"> {{ $errors->first('header_email') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="smtp_host" class="col-sm-2 control-label">{{ __('SMTP HOST') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="smtp_host" placeholder="{{ __('SMTP HOST') }}" value="{{ $emailsetting->smtp_host }}">
                                            @if ($errors->has('smtp_host'))
                                                <p class="text-danger"> {{ $errors->first('smtp_host') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="smtp_port" class="col-sm-2 control-label">{{ __('SMTP PORT') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="smtp_port" placeholder="{{ __('SMTP PORT') }}" value="{{ $emailsetting->smtp_port }}">
                                            @if ($errors->has('smtp_port'))
                                                <p class="text-danger"> {{ $errors->first('smtp_port') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email_encryption" class="col-sm-2 control-label">{{ __('Encryption') }}</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="email_encryption" placeholder="{{ __('Encryption') }}" value="{{ $emailsetting->email_encryption }}">
                                            @if ($errors->has('email_encryption'))
                                                <p class="text-danger"> {{ $errors->first('email_encryption') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="smtp_user" class="col-sm-2 control-label">{{ __('SMTP Username') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="smtp_user" placeholder="{{ __('SMTP Username') }}" value="{{ $emailsetting->smtp_user }}">
                                            @if ($errors->has('smtp_user'))
                                                <p class="text-danger"> {{ $errors->first('smtp_user') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="smtp_pass" class="col-sm-2 control-label">{{ __('SMTP Password') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="smtp_pass" placeholder="{{ __('SMTP Password') }}" value="{{ $emailsetting->smtp_pass }}">
                                            @if ($errors->has('smtp_pass'))
                                                <p class="text-danger"> {{ $errors->first('smtp_pass') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="from_email" class="col-sm-2 control-label">{{ __('From Email') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="from_email" placeholder="{{ __('From Email') }}" value="{{ $emailsetting->from_email }}">
                                            @if ($errors->has('from_email'))
                                                <p class="text-danger"> {{ $errors->first('from_email') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="from_name" class="col-sm-2 control-label">{{ __('From Name') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="from_name" placeholder="{{ __('From Name') }}" value="{{ $emailsetting->from_name }}">
                                            @if ($errors->has('from_name'))
                                                <p class="text-danger"> {{ $errors->first('from_name') }} </p>
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
