@extends('appshell::layouts.default')

@section('title')
    {{ __('Create new client') }}
@stop

@section('content')

    <div class="row">

        <div class="col-xl-9">
            <div class="card card-accent-success">
                <div class="card-header">
                    {{ __('Enter Client Details') }}
                </div>
                <div class="card-block">

                    {!! Form::open(['route' => 'appshell.client.store', 'autocomplete' => 'off']) !!}

                    @include('appshell::client._form')

                    <hr>
                    <div class="form-group">
                        <button class="btn btn-success">{{ __('Create client') }}</button>
                        <a href="#" onclick="history.back();" class="btn btn-link text-muted">{{ __('Cancel') }}</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>

@stop