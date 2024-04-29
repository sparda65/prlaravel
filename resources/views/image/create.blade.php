@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	@include('includes.message')
            <div class="card">
                <div class="card-header">
                    Subir imagen
                </div>

                <div class="card-body">
                    <form method="POST"action="{{ route('SaveImage') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="image_path" class="col-md-3 col-form-label text-md-end">Imagen</label>
                            <div class="col-md-7">
                                <input type="file" id="image_path" name="image_path" class="form-control" required />        
                                @if($errors->has('image_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{ $errors->first('image_path') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label text-md-end">Descripcion</label>
                            <div class="col-md-7">
                                <textarea type="text" id="description" name="description" class="form-control" required></textarea>        
                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-7 offset-md-5">
                                <input type="submit" class="btn btn-primary" value="Subir" />
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection