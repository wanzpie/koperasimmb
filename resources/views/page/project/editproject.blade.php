@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <section class="content">
                    <div class="container-fluid">
                        <!-- SELECT2 EXAMPLE -->
                        <div class="card  mt-3  card-fuchsia" >
                            <div class="card-header" style="background-color:#39cccc; ">
                                Permit List
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    {!! Form::open(['method' => 'delete', 'route' => ['permitprocess.saveedit'] ]) !!}
                                    <div class="modal-content">
                                            <div class="modal-header bg-gradient-navy">
                                                <h3>PROJECT</h3>
                                            </div>
                                            <div class="modal-body ">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Project Name</label>
                                                            <div class="col-sm-8">
                                                                <input  class="form-control form-control-sm" name="PROJECT_NAME" value="{{ $project->PROJECT_NAME }}" placeholder="name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Project Description</label>
                                                            <div class="col-sm-8">
                                                                <input  class="form-control form-control-sm" name="PROJECT_DESC"  value="{{ $project->PROJECT_DESC }}"  placeholder="code">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Project Code</label>
                                                            <div class="col-sm-8">
                                                                <input  class="form-control form-control-sm" name="PROJECT_CODE"  value="{{ $project->PROJECT_CODE }}"  placeholder="code">
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-4 col-form-label">Gm Name </label>
                                                            <div class="col-sm-8">
                                                                <input class="form-control form-control-sm" type="date" name="GM_NAME" value="{{$project->GM_NAME }}" id="GM_NAME"  />
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-4 col-form-label">Gm Email </label>
                                                            <div class="col-sm-8">
                                                                <input class="form-control form-control-sm" type="date" name="GM_MAIL" value="{{$project->GM_MAIL }}" id="GM_MAIL"  />
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-4 col-form-label">Dir Ops Email </label>
                                                            <div class="col-sm-8">
                                                                <input class="form-control form-control-sm" name="DIR_OPS_MAIL" value="{{$project->DIR_OPS_MAIL }}" id="DIR_OPS_MAIL"  />
                                                            </div>

                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <center>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="" class="btn btn-primary bg-gradient-primary" data-dismiss="modal" onclick="formSubmit()">Save</button>
                                                </center>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>




