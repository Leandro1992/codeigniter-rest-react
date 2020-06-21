@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8">
            <div class="card margin-menu">
            <div class="card-header text-white bg-primary">Produtos</div>
                <div class="card-body">
                @if(Auth::user()->roles->pluck('name')->contains('admin'))
                <table-product admin="true" lang={{app()->getLocale()}} products="{{$products}}"></table-product>
                @endif 
                @if(!Auth::user()->roles->pluck('name')->contains('admin'))
                <table-product admin="false" lang={{app()->getLocale()}} products="{{$products}}"></table-product>
                @endif 
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card margin-menu">
            <div class="card-header text-white bg-primary">Cadastrar produtos</div>
                <div class="card-body">
                    <form class="form" action="{{route('product.create',  app()->getLocale())}}" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="Nome" required autofocus>
    
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

    
                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" placeholder="Preço" name="price" value="" required>
    
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row">
    
                            <div class="col-md-12">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Descrição" name="description" value="" required></textarea>
    
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
    
                            <div class="col-md-6">
                                <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" placeholder="Cor" name="color" value="">
    
                                @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <input id="size" type="text" class="form-control @error('size') is-invalid @enderror"  placeholder="Tamanho" name="size" value="">
    
                                @error('size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="">
    
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        @csrf
                        {{method_field('GET')}}
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary float-right">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection