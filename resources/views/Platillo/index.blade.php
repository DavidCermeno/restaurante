@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>    
        @endif
         
        <form action="{{ route('platillo.index') }}" method="GET">
            <div class="input-group">
                <div class="input-group-prepend">
                    <input type="submit" class="btn btn-primary" value="Buscar">
                </div>
                <input type="text" class="form-control" placeholder="Buscar" aria-label="Input group example" aria-describedby="btnGroupAddon">
            </div>
        </form>

        <a href="{{ url('platillo/create') }}" class="btn btn-success" >Registrar platillo</a>
        <br><br>
        <table class="table table-dark">
            <thead class="thead-dark">
                <tr>
                    <th>id</th>
                    <th>Nombre </th>
                    <th>Descripción </th>
                    <th>Foto </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($platillos as $platillo)
                    <tr>
                        <td>{{ $platillo->id }}</td>
                        <td>{{ $platillo->nombre }}</td>
                        <td>{{ $platillo->descripcion}}</td>
                        <td>
                            <img src="{{ asset('storage').'/'.$platillo->foto }}" width="100px" alt=""> <!--Aquí accedemos a la carpeta storage-->
                        </td>
                        <td>
                            <a href="{{ url('/platillo/'.$platillo->id.'/edit') }}" class="btn btn-warning">
                                Editar
                            </a>
                            | 
                            <form action="{{ url('/platillo/'.$platillo->id) }}" method="POST" class="d-inline">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input type="submit" onclick="return confirm('¿Quiere eliminar este platillo?')" value="Eliminar" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $platillos->links() !!}
    </div>
@endsection