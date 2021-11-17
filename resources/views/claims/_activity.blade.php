
                            <h6>Activity</h6>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="aStart" type="text"
                                           class="form-control @error('aStart') is-invalid @enderror" name="aStart"
                                           value="{{ (isset($data['activity']['Start']) && !empty($data['activity']['Start'])) ? $data['activity']['Start'] : old('aStart') }}" autocomplete="name"  placeholder="Start">

                                    @error('aStart')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input id="aType" type="text"
                                           class="form-control @error('aType') is-invalid @enderror" name="aType"
                                           value="{{ (isset($data['activity']['Type']) && !empty($data['activity']['Type'])) ? $data['activity']['Type'] : old('aType') }}" autocomplete="name"  placeholder="Type">

                                    @error('aType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="aCode" type="text"
                                           class="form-control @error('aCode') is-invalid @enderror" name="aCode"
                                           value="{{ (isset($data['activity']['Code']) && !empty($data['activity']['Code'])) ? $data['activity']['Code'] : old('aCode') }}" autocomplete="name"  placeholder="Code">

                                    @error('aCode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input id="Quantity" type="text"
                                           class="form-control @error('Quantity') is-invalid @enderror" name="Quantity"
                                           value="{{ (isset($data['activity']['Quantity']) && !empty($data['activity']['Quantity'])) ? $data['activity']['Quantity'] : old('Quantity') }}" autocomplete="name"   placeholder="Quantity">

                                    @error('Quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="aNet" type="text"
                                           class="form-control @error('aNet') is-invalid @enderror" name="aNet"
                                           value="{{ (isset($data['activity']['Net']) && !empty($data['activity']['Net'])) ? $data['activity']['Net'] : old('aNet') }}" autocomplete="name" placeholder="Net">

                                    @error('aNet')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input id="Clinician" type="text"
                                           class="form-control @error('Clinician') is-invalid @enderror" name="Clinician"
                                           value="{{ (isset($data['activity']['Clinician']) && !empty($data['activity']['Clinician'])) ? $data['activity']['Clinician'] : old('StartType') }}" autocomplete="name"   placeholder="Clinician">

                                    @error('Clinician')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
