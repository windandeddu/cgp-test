@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <h1 class="text-black-50">Create Company</h1>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
            @csrf
            <div>
                <label class="form-label" for="name"> {{ __('Name') }}</label>
                <br>
                <input id="name" class="form-control block mt-1 w-full" style="width:500px;" type="text" name="name" value="{{old('name')}}" autofocus required/>
            </div>
            <div>
                <label class="form-label" for="address"> {{ __('Address') }}</label>
                <br>
                <input id="address" class="form-control block mt-1 w-full" style="width:500px;" type="text" name="address" value="{{old('address')}}" autofocus required/>
            </div>
            <div>
                <label class="form-label" for="phone"> {{ __('Phone') }}</label>
                <br>
                <input id="phone" class="form-control block mt-1 w-full" style="width:500px;" type="tel" name="phone" value="{{old('phone')}}" autofocus required/>
            </div>
            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-primary">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>

@endsection
