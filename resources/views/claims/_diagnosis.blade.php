
                            <h6>Diagnosis</h6>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="dType" type="text"
                                           class="form-control @error('dType') is-invalid @enderror" name="dType"
                                           value="{{ (isset($data['diagnosis']['Type']) && !empty($data['diagnosis']['Type'])) ? $data['diagnosis']['Type'] : old('dType') }}" autocomplete="name"  placeholder="Type">

                                    @error('dType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input id="dCode" type="text"
                                           class="form-control @error('dCode') is-invalid @enderror" name="dCode"
                                           value="{{ (isset($data['diagnosis']['Code']) && !empty($data['diagnosis']['Code'])) ? $data['diagnosis']['Code'] : old('dCode') }}" autocomplete="name"  placeholder="Code">

                                    @error('dCode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

