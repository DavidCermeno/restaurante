@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <form action="{{ url('/platillo') }}" method="post" enctype="multipart/form-data"><!-- enctype es para enviar archivos -->
                @csrf
                    @include('platillo.form', ['modo'=>'Crear'])
            </form>
        </div>
    </div>
@endsection