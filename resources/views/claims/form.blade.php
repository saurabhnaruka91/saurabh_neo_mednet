@extends('layouts.main')

@section('content')
    <?php

  //  dd($errors); ?>

    <div class="container" style="padding-top: 60px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Intimate Claim') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ empty($data) ? route('save.claim') : route('update.claim',$data['id']) }}">
                            @csrf
                            <h6>Claims</h6>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="MemberID" type="text"
                                           class="form-control @error('MemberID') is-invalid @enderror" name="MemberID"
                                           value="{{ (isset($data['MemberID']) && !empty($data['MemberID'])) ? $data['MemberID'] : old('MemberID') }}" autocomplete="name"   placeholder="MemberID">

                                    @error('MemberID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input id="PayerID" type="text"
                                           class="form-control @error('PayerID') is-invalid @enderror" name="PayerID"
                                           value="{{ (isset($data['PayerID']) && !empty($data['PayerID'])) ? $data['PayerID'] : old('PayerID') }}" autocomplete="name"    placeholder="PayerID">

                                    @error('PayerID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="ProviderID" type="text"
                                           class="form-control @error('ProviderID') is-invalid @enderror" name="ProviderID"
                                           value="{{ (isset($data['ProviderID']) && !empty($data['ProviderID'])) ? $data['MemberID'] : old('ProviderID') }}" autocomplete="name"   placeholder="ProviderID">

                                    @error('ProviderID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input id="EmiratesIDNumber" type="text"
                                           class="form-control @error('EmiratesIDNumber') is-invalid @enderror" name="EmiratesIDNumber"
                                           value="{{ (isset($data['EmiratesIDNumber']) && !empty($data['PayerID'])) ? $data['EmiratesIDNumber'] : old('EmiratesIDNumber') }}" autocomplete="name"    placeholder="EmiratesIDNumber">

                                    @error('EmiratesIDNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="Gross" type="text"
                                           class="form-control @error('Gross') is-invalid @enderror" name="Gross"
                                           value="{{ (isset($data['Gross']) && !empty($data['Gross'])) ? $data['Gross'] : old('Gross') }}" autocomplete="name" placeholder="Gross">

                                    @error('Gross')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input id="PatientShare" type="text"
                                           class="form-control @error('PatientShare') is-invalid @enderror" name="PatientShare"
                                           value="{{ (isset($data['PatientShare']) && !empty($data['PatientShare'])) ? $data['PatientShare'] : old('PatientShare') }}" autocomplete="name"   placeholder="PatientShare">

                                    @error('PatientShare')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="Net" type="text"
                                           class="form-control @error('Net') is-invalid @enderror" name="Net"
                                           value="{{ (isset($data['Net']) && !empty($data['Net'])) ? $data['Net'] : old('Net') }}" autocomplete="name" placeholder="Net">

                                    @error('Net')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @include('claims._encounter')
                            @include('claims._diagnosis')
                            @include('claims._activity')
                            @include('claims._observation')


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save as xml') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
