@extends('app')

@section('title', 'Crear Usuario')
@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('users.store') }}" method="POST" class="form row">
        @csrf
            <div class="col-md-6">
                <div class="form-group">
                    <label for="names">Nombres:</label>
                    <input type="text" name="names" value="{{ old('names') }}" class="form-control" >
                    @error('names')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lastName">Apellidos:</label>
                    <input type="text" name="lastName" value="{{ old('lastName') }}" class="form-control" >
                    @error('lastName')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="document">Cédula:</label>
                    <input type="text" name="document" value="{{ old('document') }}" class="form-control" >
                    @error('document')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" >
                    @error('email')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="country">Pais:</label>
                    <select class="form-control"  name="country">
                        @foreach ($countries as $country)
                            <option value="{{ $country->name->common }}" {{ old('country') == $country->name->common  ? 'selected' : '' }}>{{ $country->name->common }}</option>
                        @endforeach
                    </select>
                    @error('country')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category_id">Categoria:</label>
                    <select class="form-control"  name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('country') == $category->id  ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Dirección:</label>
                    <input type="text" name="address" value="{{ old('address') }}" class="form-control">
                    @error('address')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="cellPhone">Celular:</label>
                    <input type="text" name="cellPhone" value="{{ old('cellPhone') }}" class="form-control" >
                    @error('cellPhone')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>

            </div>
    </form>
@endsection
