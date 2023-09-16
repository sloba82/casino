@extends('layouts.master')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <h4>
                List Affiliates in office range
            </h4>

            <div class="row mt-1">
                <div class="col-3">
                    <label for="office" class="form-label">Select office</label>
                    <select id="office" class="form-select form-select-nm mb-3">
                        <option selected></option>
                        @foreach ($offices as $office)
                            <option value="{{$office['latitude']}}_{{$office['longitude']}}">{{$office['city']}}</option>
                        @endforeach
                    </select>
                    <div id="office_error" style="display: none" class="error" >
                        <p class="text-danger">Plaese select office</p>
                    </div>
                </div>
                <div class="col-3">
                    <label for="distance" class="form-label">Select distance</label>
                    <select id="distance" class="form-select form-select-md mb-3">
                        <option selected></option>
                        <option value="100">100 km</option>
                        <option value="50">50 km</option>
                        <option value="25">25 km</option>
                      </select>
                      <div id="distance_error" style="display: none" class="error" >
                        <p class="text-danger">Plaese select distance</p>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-3">
                    <button type="button" id="search" class="btn btn-success" >Search</button>
                </div>
            </div>


            <div id="search_result" class="row mt-5">


            </div>


        </div>
    </div>

@stop
