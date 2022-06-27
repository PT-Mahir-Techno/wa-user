

@extends('layouts.app')
@section('breadcrumb') <x-breadcrumb title="Device" current_page="index" url="device.index" /> @endsection

@section('content')
  <x-card title="Dokumentasi API" >
    <div class="col-lg-8 col-md-8 col-sm-12">
      <div class="form-group">
        <label for="roken" class="form-control-label">Token</label>
        <input class="form-control" type="text" id="name" value="{{ auth()->user()->api_token }}" readonly>
      </div>

    </div>
  </x-card>

@endsection
  