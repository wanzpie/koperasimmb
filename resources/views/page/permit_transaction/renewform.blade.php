@extends('layouts.app')
@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">

            <div class="card-info card">
                <div class="card-header">
                    <h3>Renew Permit/Contract</h3>
                    {!! Form::open(['method' => 'delete', 'route' => ['permitprocess.saverenew',] ]) !!}
                </div>
                <div class="card-body">
                    <h4>Renew Permit/Contract</h4>
                    <div class="row">
                        <div class="col-md-6">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}

                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label">Permit Name</label>

                                <div class="col-sm-8">
                                    <input  class="form-control form-control-sm" name="id_permit_int" type="hidden" value="{{$permit->id_permit_int}}" id="id_permit_int" placeholder="period">

                                <?php
                                    use App\Model\Divisi;use App\Model\MasterPermiDTModel;$permitdt = MasterPermiDTModel::get()->pluck('permit_description', 'id_permitdt');
                                    ?>
                                    {!! Form::select('id_permitdt',$permitdt, $permit->id_permitdt, ['class' => 'form-control']) !!}

                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Number</label>
                                <div class="col-sm-8">
                                    <input  class="form-control form-control-sm"  name="id_permit_int" value="{{ $permit->id_permit_int }}" type="hidden">

                                    <input  class="form-control form-control-sm" name="permit_trx_nochar" value="{{ $permit->permit_trx_nochar }}" placeholder="Number">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Doc Ref</label>
                                <div class="col-sm-8">
                                    <input  class="form-control form-control-sm" name="permit_doc_refno"  value="{{ $permit->permit_doc_refno }}"  placeholder="Number">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label">Estimation Date</label>
                                <div class="col-sm-8">
                                    <input class="form-control form-control-sm" type="date" value="{{$permit->permit_etd_date }}" name="permit_etd_date" id="permit_etd_date"  />
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label">Expire Date</label>
                                <div class="col-sm-8">
                                    <input class="form-control form-control-sm" type="date" name="permit_expire_date" value="{{$permit->permit_expire_date }}" id="permit_expire_date"  />
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Period(Year)</label>
                                <div class="col-sm-8">
                                    <input  class="form-control form-control-sm" name="permit_period" type="number" value="{{$permit->permit_period}}" id="permit_period" placeholder="period">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Location </label>
                                <div class="col-sm-8">
                                    <input  class="form-control form-control-sm" name="permit_location" id="permit_location" value="{{$permit->permit_location}}" placeholder="location">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label">PIC Division</label>
                                <div class="col-sm-8">
                                    <?php
                                    $div = Divisi::get()->pluck('CR_DIVISI_NAME','CR_DIVISI_INT');

                                    ?>
                                    {!! Form::select('permit_pic_dept',$div, $permit->permit_pic_dept, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label">Subscription</label>
                                                <div class="col-sm-6">
                                                    <select name="permit_renew_int" class="form-control form-control-sm">
                                                        <option value="0" {{ $permit->permit_renew_int == 0 ? 'selected' : '' }}>No</option>
                                                        <option value="1" {{ $permit->permit_renew_int == 1 ? 'selected' : '' }}>Yes</option>
                                                    </select>
                                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Note</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="permit_descmodal"  name="permit_desc" rows="3">{{$permit->permit_desc}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <input type="submit" value="Save" class="btn btn-sm btn-primary" />
                            <a class="btn btn-danger" href="{{ route('permitprocess.listapproved') }}">Back</a>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#checkboxPrimary1').click(function () {
                this.value = this.checked ? 1 : 0;
            });
            $('select[name="id_permitdt"]').select2({width: '80%'});
            $('select[name="id_instansi_int"]').select2({width: '80%'});
            $('select[name="permit_pic_dept"]').select2({width: '80%'});

        });
    </script>




