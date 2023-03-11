@extends('app')

@section('title', 'Lista de usuarios')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="text-right mb-2">
        <a href="{{ route('users.create') }}" class="btn btn-primary">Agregar usuario</a>
    </div>
    <div class="mb-3">
        <form method="get" action="{{ route('users.index') }}">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="names">Nombres</label>
                    <input type="text" class="form-control" id="names" name="names" value="{{ request('names') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="lastName">Apellidos</label>
                    <input type="text" class="form-control" id="lastName" name="lastName"
                           value="{{ request('lastName') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="document">Documento</label>
                    <input type="text" class="form-control" id="document" name="document"
                           value="{{ request('document') }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Documento</th>
                <th>Correo electrónico</th>
                <th>País</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->names }}</td>
                    <td>{{ $user->lastName }}</td>
                    <td>{{ $user->document }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->country }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->cellPhone }}</td>
                    <td class="text-center">
                        <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-sm btn-info">Editar</a>
                        <a href="{{ route('users.destroy', ['id' => $user->id]) }}" class="btn btn-sm btn-danger"
                           onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar este usuario?')){ document.getElementById('form-user-delete-{{ $user->id }}').submit(); }">Eliminar</a>
                        <form id="form-user-delete-{{ $user->id }}"
                              action="{{ route('users.destroy', ['id' => $user->id]) }}" method="POST"
                              style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>

@endsection
