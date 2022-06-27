@extends('layouts.app')
@section('breadcrumb') <x-breadcrumb title="Device" current_page="index" url="device.index" /> @endsection

@section('content')
  <x-card title="Profil" >
    <div class="col-lg-8 col-md-8 col-sm-12">
      
      <form action="{{ route('user.update', auth()->user()->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="name" class="form-control-label">Nama</label>
          <input class="form-control" type="text" name="name" id="name" value="{{ auth()->user()->name }}">
        </div>
    
        <div class="form-group">
          <label for="email" class="form-control-label">Email</label>
          <input class="form-control" type="email" name="email" id="email" value="{{ auth()->user()->email }}">
        </div>
    
        <div class="form-group">
          <label for="phone-number" class="form-control-label">No Whatsapp</label>
          <input class="form-control" type="text" name="phone_number" id="phone-number" value="{{ auth()->user()->phone_number }}">
        </div>
  
        <div class="form-group">
          <label for="password" class="form-control-label">Password</label>
          <input class="form-control" name="password" type="password" id="password">
        </div>
    
  
        <div>
          <button class="btn btn-success">simpan perubahan</button>
        </div>
      </form>


    </div>
  </x-card>
@endsection
  