@extends('app')

@section('title', 'Crear Categoria')
@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form method="POST" action="{{ route('categories.store') }}" class="form row">
        @csrf
        <div class="col-md-6">

            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" >
                @error('name')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                @error('description')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
@endsection
