@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Category</h2>
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


    {!! Form::open(array('route'=>'categories.store','class' => 'form', 'id' => 'signinfrom')) !!}
    <div class="form-group">
        {!! Form::label('name', 'Category:', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">
            {!! Form::text('name', $value = null, ['class' => 'form-control', 'placeholder' => 'Category']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            {!! Form::submit('Submit', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
        </div>
    </div>

{!! Form::close() !!}

@endsection