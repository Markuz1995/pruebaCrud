@extends('app')

@section('title', 'Listado de categorias')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="text-right mb-2">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Agregar categoria</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td class="text-center">
                        <a href="{{ route('categories.edit', ['id' => $category->id]) }}" class="btn btn-sm btn-info">Editar</a>
                        <a href="{{ route('categories.destroy', ['id' => $category->id]) }}" class="btn btn-sm btn-danger"
                           onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar esta categoria?')){ document.getElementById('form-user-delete-{{ $category->id }}').submit(); }">Eliminar</a>
                        <form id="form-user-delete-{{ $category->id }}"
                              action="{{ route('categories.destroy', ['id' => $category->id]) }}" method="POST"
                              style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
