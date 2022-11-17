@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::open(array('route'=>'products.store','class' => 'form', 'id' => 'signinfrom','files'=>true)) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name:', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">
            {!! Form::text('name', $value = null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('detail', 'Detail:', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">
            {!! Form::textArea('detail', $value = null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            {!!Form::label('category', 'Categories')!!}
            {!! Form::select('category', $select, null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        {!! Form::label('image','Insert Image') !!}
        <div class="form-group">
            {!! form::file('image',['class'=>'form-control','placeholder'=>'image'])!!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            {!! Form::submit('Submit', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
        </div>
    </div>

{!! Form::close() !!}

@endsection