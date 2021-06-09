@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">
            Qrcode
        </h1>
        <h1 class="pull-right">
            @if($qrcode->user_id == Auth::user()->id || Auth::user()->role_id < 2)
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom:5px" href="{!! route('qrcodes.edit', [$qrcode->id])!!}">Edit</a>
            @endif
        </h1>
    </section>
    <div class="clearfix"></div>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('qrcodes.show_fields')
                    {{-- <a href="{{ route('qrcodes.index') }}" class="btn btn-default">Back</a> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
