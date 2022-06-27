@props(['title' => ''])
<div class="card mb-4">
  <div class="card-header pb-0">
    <h6>{{ $title ?? '' }}</h6>
  </div>
  <div class="card-body pt-0 pb-2">
    {{ $slot }}
  </div>
</div>