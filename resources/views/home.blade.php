@extends('_layouts.default')

@section('main')
<div class="am-g am-g-fixed blog-g-fixed">
  <div class="am-u-sm-12">
      <h1>Hello {{{ Auth::user()->nickname }}}</h1>
  </div>
</div>
@stop
