@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card margin-menu">
            <div class="card-header text-white bg-primary">Produtos</div>
                <div class="card-body">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Preço</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Cor</th>
                                <th scope="col">Tamanho</th>
                                <th scope="col">Estoque</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{$product->id}}</th>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->color}}</td>
                                <td>{{$product->size}}</td>
                                <td>{{$product->stock()}}</td>
                                <td>                             
                                    <form class="float-left form-stock  col-md-4" action="{{route('stock.create', ['lang' => app()->getLocale(), 'user_id' => Auth::user(), 'product_id' => $product, 'type' => 'in'])}}" method="POST">
                                        <input id="quantity" type="number" class="form-control" name="quantity" value="" />
                                        @csrf
                                        {{method_field('POST')}} 
                                        <button type="submit" class="btn btn-primary">+</button>
                                    </form> 
                                    <form class="float-left form-stock col-md-4" action="{{route('stock.create', ['lang' => app()->getLocale(), 'user_id' => Auth::user(), 'product_id' => $product, 'type' => 'out'])}}" method="POST">
                                        <input id="quantity" type="number" class="form-control" name="quantity" value="" />
                                        @csrf
                                        {{method_field('POST')}} 
                                        <button type="submit" class="btn btn-danger">-</button>
                                    </form> 
                                    <a href="{{route('stock.check', ['lang' => app()->getLocale(), 'product' => $product])}}"><button type="button" class="btn btn-warning col-md-4 float-left">History</button></a> 
                               </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection