@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <h1 class="text-black-50">Edit Client</h1>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('clients.update', ['client' => $client->id]) }}" enctype="multipart/form-data">
            @csrf
            <div>
                <label class="form-label" for="name"> {{ __('Name') }}</label>
                <input id="name" class="form-control block mt-1 w-full" style="width:500px;" type="text" name="name" value="{{$client->name}}" autofocus required/>
            </div>
            <div>
                <label class="form-label" for="email"> {{ __('Email') }}</label>
                <input id="email" class="form-control block mt-1 w-full" style="width:500px;" type="text" name="email" value="{{$client->email}}" autofocus required/>
            </div>
            <div>
                <label class="form-label" for="phone"> {{ __('Phone') }}</label>
                <input id="phone" class="form-control block mt-1 w-full" style="width:500px;" type="tel" name="phone" value="{{$client->phone}}" autofocus required/>
            </div>
            <div>
                <label class="form-label" for="companies"> {{ __('Companies') }}</label>
                <br>
                <select class="form-control" id="companies" style="width:500px;" name="companies[]" multiple>
                    @foreach($clientCompanies as $clientCompany)
                        <option value="{{ $clientCompany->id }}" selected>{{ $clientCompany->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-primary">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        $('#companies').select2({
            placeholder: 'Select User Companies',
            ajax: {
                url: "{{ route('companies.search') }}",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  data
                    };
                },
                cache: true
            }
        });

    </script>

@endsection
