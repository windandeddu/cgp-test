@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <h1 class="text-black-50">Edit Company</h1>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('companies.update', ['company' => $company->id]) }}" enctype="multipart/form-data">
            @csrf
            <div>
                <label class="form-label" for="name"> {{ __('Name') }}</label>
                <br>
                <input id="name" class="form-control block mt-1 w-full" style="width:500px;" type="text" name="name" value="{{$company->name}}" autofocus required/>
            </div>
            <div>
                <label class="form-label" for="address"> {{ __('Adderess') }}</label>
                <br>
                <input id="address" class="form-control block mt-1 w-full" style="width:500px;" type="text" name="address" value="{{$company->address}}" autofocus required/>
            </div>
            <div>
                <label class="form-label" for="phone"> {{ __('Phone') }}</label>
                <br>
                <input id="phone" class="form-control block mt-1 w-full" style="width:500px;" type="text" name="phone" value="{{$company->phone}}" autofocus required/>
            </div>
            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-primary">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>

@endsection
