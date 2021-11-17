
                            <h6>Observation</h6>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="oType" type="text"
                                           class="form-control @error('oType') is-invalid @enderror" name="oType"
                                           value="{{ (isset($data['observation']['Type']) && !empty($data['observation']['Type'])) ? $data['observation']['Type'] : old('oType') }}" autocomplete="name"  placeholder="Type">

                                    @error('oType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input id="oCode" type="text"
                                           class="form-control @error('oCode') is-invalid @enderror" name="oCode"
                                           value="{{ (isset($data['observation']['Code']) && !empty($data['observation']['Code'])) ? $data['observation']['Code'] : old('oCode') }}" autocomplete="name"  placeholder="Code">

                                    @error('oCode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="Value" type="text"
                                           class="form-control @error('Value') is-invalid @enderror" name="Value"
                                           value="{{ (isset($data['observation']['Value']) && !empty($data['observation']['Value'])) ? $data['observation']['Value'] : old('Value') }}" autocomplete="name"  placeholder="Value">

                                    @error('Value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input id="ValueType" type="text"
                                           class="form-control @error('ValueType') is-invalid @enderror" name="ValueType"
                                           value="{{ (isset($data['observation']['ValueType']) && !empty($data['observation']['ValueType'])) ? $data['observation']['ValueType'] : old('ValueType') }}" autocomplete="name"   placeholder="ValueType">

                                    @error('ValueType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
