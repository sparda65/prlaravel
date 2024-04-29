@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.message')
            @foreach($images as $image)
                @include('includes.image', ['image' => $image])
                <br/>
            @endforeach
            <div class="clear-fix"></div>
            {{ $images->links() }}
        </div>
    </div>
</div>
@endsection
