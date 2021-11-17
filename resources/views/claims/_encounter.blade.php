
                            <h6>Encounter</h6>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="FacilityID" type="text"
                                           class="form-control @error('FacilityID') is-invalid @enderror" name="FacilityID"
                                           value="{{ (isset($data['encounter']['FacilityID']) && !empty($data['encounter']['FacilityID'])) ? $data['encounter']['FacilityID'] : old('FacilityID') }}" autocomplete="name"   placeholder="FacilityID">

                                    @error('FacilityID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input id="Type" type="text"
                                           class="form-control @error('Type') is-invalid @enderror" name="Type"
                                           value="{{ (isset($data['encounter']['Type']) ) ? $data['encounter']['Type'] : old('Type') }}" autocomplete="name"  placeholder="Type">

                                    @error('Type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="PatientID" type="text"
                                           class="form-control @error('PatientID') is-invalid @enderror" name="PatientID"
                                           value="{{ (isset($data['encounter']['PatientID']) && !empty($data['encounter']['PatientID'])) ? $data['encounter']['PatientID'] : old('PatientID') }}" autocomplete="name"   placeholder="PatientID">

                                    @error('PatientID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input id="Start" type="text"
                                           class="form-control @error('Start') is-invalid @enderror" name="Start"
                                           value="{{ (isset($data['encounter']['Start']) && !empty($data['encounter']['Start'])) ? $data['encounter']['Start'] : old('Start') }}" autocomplete="name"   placeholder="Start">

                                    @error('Start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="End" type="text"
                                           class="form-control @error('End') is-invalid @enderror" name="End"
                                           value="{{ (isset($data['encounter']['End']) && !empty($data['encounter']['End'])) ? $data['encounter']['End'] : old('End') }}" autocomplete="name" placeholder="End">

                                    @error('End')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input id="StartType" type="text"
                                           class="form-control @error('StartType') is-invalid @enderror" name="StartType"
                                           value="{{ (isset($data['encounter']['StartType']) && !empty($data['encounter']['StartType'])) ? $data['encounter']['StartType'] : old('StartType') }}" autocomplete="name"   placeholder="StartType">

                                    @error('StartType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="EndType" type="text"
                                           class="form-control @error('EndType') is-invalid @enderror" name="EndType"
                                           value="{{ (isset($data['encounter']['EndType']) && !empty($data['encounter']['EndType'])) ? $data['encounter']['EndType'] : old('EndType') }}" autocomplete="name" placeholder="EndType">

                                    @error('EndType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
