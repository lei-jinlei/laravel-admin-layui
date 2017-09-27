@extends('layouts.default')
@section('content')
<div class="row">
    <ol>
        @foreach ($students as $student )
            <li>{{ $student->name }}------{{ $student->age }}</li>
        @endforeach
    </ol>
    {!! $students->render() !!}
</div>
@endsection