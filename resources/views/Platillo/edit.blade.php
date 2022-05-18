@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <form action="{{ url('/platillo/'.$platillo->id) }}" method="post" enctype="multipart/form-data"><!-- enctype es para enviar archivos -->
                @csrf
                {{ method_field('PATCH') }} 
                    @include('platillo.form', ['modo'=>'Editar'])
            </form>
        </div>
    </div>
@endsection