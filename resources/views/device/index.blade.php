@extends('layouts.app')
@section('breadcrumb') <x-breadcrumb title="Device" current_page="index" url="device.index" /> @endsection

@section('content')
{{-- <button class="btn btn-danger" onclick="tes()">tes</button> --}}
  <div x-data="Device">
    @if (empty($device))
      <x-card title="Device" >
        <div class="col-lg-8 col-md-8 col-sm-12">
          <form action="{{ route('device.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="name" class="form-control-label">Nama</label>
              <input class="form-control @error('device_name') is-invalid @enderror" type="text" name="device_name" id="name">
              @error('device_name')
                <span class="text-danger"><strong><i><small>{{ $message }}</small></i></strong></span>
              @enderror
            </div>
        
            <div class="form-group">
              <label for="description" class="form-control-label">Deskripsi</label>
              <input class="form-control @error('description') is-invalid @enderror" type="text" name="description" id="description">
              @error('description')
                <span class="text-danger"><strong><i><small>{{ $message }}</small></i></strong></span>
              @enderror
            </div>
        
            <div class="form-group">
              <label for="phone-number" class="form-control-label">No Whatsapp</label>
              <input class="form-control @error('phone_number') is-invalid @enderror" type="text" name="phone_number" id="phone-number">
              @error('phone_number')
                <span class="text-danger"><strong><i><small>{{ $message }}</small></i></strong></span>
              @enderror
            </div>
      
            <div>
              <button class="btn btn-success">Buat Perangkat</button>
            </div>
          </form>
        </div>
      </x-card>
    @endif
  
    @isset($device)
      <x-card title="Device" >
        <div class="col-lg-8 col-md-8 col-sm-12">
          <div class="row py-4">
            {{-- <div class="col"><img src="https://upload.wikimedia.org/wikipedia/commons/3/37/MITC2013_QR_Code.jpg" alt=""></div> --}}
            @if ($device->status == 'unauthenticated')
            <div class="col">
              <img src="" alt="" id="qr-code">
            </div>
            @endif
            <div class="col">
              <table class="table">
                <tr>
                  <td>Nama</td>
                  <td>{{ $device->device_name }}</td>
                </tr>
                <tr>
                  <td>No Telepon</td>
                  <td>{{ $device->phone_number }}</td>
                </tr>
                <tr>
                  <td>Deskripsi</td>
                  <td>{{ $device->description }}</td>
                </tr>
                <tr>
                  <td>status</td>
                  @if ($device->status == 'authenticated')
                    <td><span class="badge bg-gradient-success">Whatsapp Siap</span></td>
                  @endif
                  @if ($device->status != 'authenticated')
                    <td><span class="badge bg-gradient-warning">Whatsapp belum Siap</span></td>
                  @endif
                </tr>
                <tr>
                  <td>Pembuatan Device</td>
                  <td>{{ $device->created_at->format('d/m/Y') }}</td>
                </tr>
              </table>
              <div>
                @if ($device->status == 'authenticated')
                  <button x-on:click="deleteSession({{ $device->phone_number }})" class="btn btn-icon btn-3 btn-primary" type="button">
                    <span class="btn-inner--icon"><i class="ni ni-button-play"></i></span>
                    <span class="btn-inner--text">keluar</span>
                  </button>
                @endif

                @if ($device->status == 'unauthenticated')
                  <button x-on:click="addSession()" class="btn btn-icon btn-3 btn-success" type="button">
                    <span class="btn-inner--icon"><i class="ni ni-button-play"></i></span>
                    <span class="btn-inner--text">scan ulang</span>
                  </button>
                  
                  <form method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button formaction="{{ route('device.destroy', $device->id) }}" class="btn btn-icon btn-3 btn-danger">
                      <span class="btn-inner--icon"><i class="ni ni-button-play"></i></span>
                      <span class="btn-inner--text">hapus</span>
                    </button>
                  </form>
                @endif

              </div>
            </div>
          </div>
    
        </div>
      </x-card>

      {{-- <x-card title="Device" >
        <div class="col-lg-8 col-md-8 col-sm-12">
          <div class="row py-4">
            <div class="col">
              <table class="table">
                <tr>
                  <td>Nama</td>
                  <td>Jopko wakwaw</td>
                </tr>
                <tr>
                  <td>No Telepon</td>
                  <td>98729787238462387</td>
                </tr>
                <tr>
                  <td>Deskripsi</td>
                  <td>wahatsapp notifikasi</td>
                </tr>
                <tr>
                  <td>Pembuatan Device</td>
                  <td>02/02/2022</td>
                </tr>
              </table>
              <div>
                <button class="btn btn-icon btn-3 btn-success" type="button">
                  <span class="btn-inner--icon"><i class="ni ni-button-play"></i></span>
                  <span class="btn-inner--text">scan ulang</span>
                </button>
                <button class="btn btn-icon btn-3 btn-danger" type="button">
                  <span class="btn-inner--icon"><i class="ni ni-button-play"></i></span>
                  <span class="btn-inner--text">hapus</span>
                </button>
              </div>
            </div>
          </div>
    
        </div>
      </x-card> --}}
    @endisset

  </div>
@endsection

@push('addon-script')
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  {{-- <script>
    function tes(){
      axios.post('http://localhost:3000/sessions/add',{
        "sessionId": "john"
      }).then(res => console.log(res)).err(err => console.log(err))

    }
  </script> --}}

  <script>
    function Device(){
      device       = @json($device);

      // prod
      // baseUrl      = 'https://api-wa.mahirtechnology.com';

      // dev
      baseUrl      = 'http://localhost:3000';

      originUrl    = 'http://wa-user.test/api';
      session_data = {
        'sessionId' : device.phone_number,
        "readIncomingMessages": true,
        "syncFullHistory": true
        // 'isLegacy' : false
      };
      // baseUrl = 'https://www.google.com/';
      // axios = axios.devault

      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      return {
        // data
        'status' : '',
        'qr': '',
        // methods
        init(){
          // setInterval(() => {window.location.reload()}, 3000)
          
          if (device.status == 'unauthenticated'){
            setInterval(() => {
              this.addSession(session_data)
            }, 20000);

            setInterval(() => {
              axios.get(baseUrl + '/sessions/' + device.phone_number+'/status')
              .then(res =>{
                if (res.data.status == 'AUTHENTICATED'){
                  axios.post(originUrl + '/update-device-status', {'id': device.id, 'status' : 'authenticated'})
                  .then(res => window.location.reload())
                  .catch(err => console.log(err))
                }
                console.log('cek status')
              })
              .catch(err => console.log(err))
            }, 5000);
            
           }

             console.log('init');
        },

        addSession(){
          axios.post(baseUrl +'/sessions/add', session_data)
            .then(response => {
              document.getElementById('qr-code').src = response.data.qr;
              // this.qr =  response.data.data.qr;
              // console.log(response.data.data.qr)
              console.log(response.data.qr)
            })
            .catch(error => {
              console.log(error)
              // console.log(error.response);
              // console.log(error.response.status);
              // console.log(error.response.data.message);
              // Toast.fire({
              //     icon: 'success',
              //     title: error.response.data.message
              //   })
            });
        },

        deleteSession(param){
          axios.delete(baseUrl + '/sessions/' + param)
            .then(res => {
              console.log(res.data);
              axios.post(originUrl + '/update-device-status', {'id': device.id, 'status' : 'unauthenticated'})
                .then(res => window.location.reload())
                .catch(err => console.log(err))
            })
            .catch(err => {
              console.log(err.response.data);
            })
        }
      }
    }
  </script>
@endpush

