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
                               Edit Permit
                            </div>
                            <div class="card-body ">

                                <div class="row">
                                    {!! Form::open(['method' => 'delete', 'route' => ['permitprocess.saveedit'] ]) !!}

                                             <div class="row">
                                                    <div class="col-md-6">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-4 col-form-label">Doc Type</label>
                                                            {!! Form::hidden('id_permit_int',$permit->id_permit_int,['class'=>'form-control','id'=>'id_permit_int','readonly'])!!}


                                                            <div class="col-sm-8">
                                                                <?php
//                                                                $FORMULA = App\BillingType::get()->pluck('MD_BILLING_NAME', 'MD_BILLING_ID_INT');
                                                                ?>
                                                                {!! Form::select('permit_type_doc', [ 1 => 'permit',2=>'contract' ], $permit->permit_type_doc, ['class' => 'form-control custom-select select2-info']) !!}

                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-4 col-form-label">Permit Name</label>

                                                            <div class="col-sm-8">
                                                                <?php
                                                                use App\Model\Divisi;use App\Model\MasterInstansiModel;use App\Model\MasterPermiDTModel;$permitdt = MasterPermiDTModel::get()->pluck('permit_description', 'id_permitdt');
                                                                ?>
                                                                {!! Form::select('id_permitdt',$permitdt, $permit->id_permitdt, ['class' => 'form-control custom-select select2-info']) !!}

                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Number</label>
                                                            <div class="col-sm-8">
                                                                <input  class="form-control form-control-sm" name="permit_trx_nochar" value="{{ $permit->permit_trx_nochar }}" placeholder="Number" style="width: 80%;">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Doc Ref</label>
                                                            <div class="col-sm-8">
                                                                <input  class="form-control form-control-sm" name="permit_doc_refno"  value="{{ $permit->permit_doc_refno }}"  placeholder="Number">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-4 col-form-label">Issue By</label>
                                                            <div class="col-sm-8">
                                                                <?php
                                                                $instansi = MasterInstansiModel::get()->pluck('nama_instansi','id');
                                                                ?>

                                                                    {!! Form::select('id_instansi_int',$instansi, $permit->id_instansi_int, ['class' => 'form-control']) !!}

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-4 col-form-label">Estimation Date</label>
                                                            <div class="col-sm-8">
                                                                <input class="form-control form-control-sm" type="date" value="{{$permit->permit_etd_date }}" name="permit_etd_date" id="permit_etd_date"  />
                                                            </div>

                                                        </div>
                                                        <div class="p-1 border-dark mt-2" style="border: solid 1px; margin-top: 2px;">
                                                            <h5>Maintenance Service</h5>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label"> Vendor Name </label>
                                                            <div class="col-sm-8">
                                                                <input  class="form-control form-control-sm" name="permit_vendor_name" id="permit_vendor_name" placeholder="Vendor name" value="{{$permit->permit_vendor_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label"> Vendor Phone</label>
                                                            <div class="col-sm-8">
                                                                <input  class="form-control form-control-sm" name="permit_vendor_phone" id="permit_vendor_phone" placeholder="Vendor Phone"  value="{{$permit->permit_vendor_phone }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label"> Vendor Contract</label>
                                                            <div class="col-sm-8">
                                                                <input  class="form-control form-control-sm" name="permit_vendor_contract_amt" id="permit_vendor_contract_amt"  value="{{$permit->permit_vendor_contract_amt }}" placeholder="vendor contract amount">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-4 col-form-label">Last Maintenance</label>
                                                            <div class="col-sm-8">
                                                                <input class="form-control form-control-sm" type="date" name="permit_last_maintenance" id="permit_last_maintenance"  value="{{$permit->permit_last_maintenance }}" />
                                                            </div>

                                                        </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-4 col-form-label">Issue Date</label>
                                                            <div class="col-sm-8">
                                                                <input class="form-control form-control-sm" type="date" name="permit_issue_date" value="{{$permit->permit_issue_date }}" id="permit_issue_date"  />
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label"> Location(lokasi ijin) </label>
                                                            <div class="col-sm-8">
                                                                <input  class="form-control form-control-sm" name="permit_location" id="permit_location" value="{{$permit->permit_location}}" placeholder="permit location">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-4 col-form-label">Expire Date</label>
                                                            <div class="col-sm-8">
                                                                <input class="form-control form-control-sm" type="date" name="permit_expire_date" value="{{$permit->permit_expire_date }}" id="permit_expire_date"  />
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Period(Year)</label>
                                                            <div class="col-sm-8">
                                                                <input  class="form-control form-control-sm" name="permit_period" type="number" value="{{$permit->permit_period}}" id="permit_period" placeholder="period">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">doc Location </label>
                                                            <div class="col-sm-8">
                                                                <input  class="form-control form-control-sm" name="permit_doc_location" id="permit_doc_location" value="{{$permit->permit_doc_location}}" placeholder="location">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-4 col-form-label">PIC Division</label>
                                                            <div class="col-sm-8">
                                                                 <?php
                                                                $div = Divisi::get()->pluck('CR_DIVISI_NAME','CR_DIVISI_INT');

                                                                ?>
                                                                  {!! Form::select('permit_pic_dept',$div, $permit->permit_pic_dept, ['class' => 'form-control','id'=>'permit_pic_dept']) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group clearfix">
                                                            <label for="name" class="col-sm-4 col-form-label">Subscription</label>
                                                            @if($permit->permit_renew_int == 1)
                                                                <div class="icheck-danger d-inline">
                                                                    <input type="checkbox" name="permit_renew_int" id="checkboxPrimary1" value="{{ $permit->permit_renew_int }}" {{ $permit->permit_renew_int  == 1 ? 'checked' : null }}>
                                                                    <label for="checkboxPrimary1">
                                                                    </label>

                                                                </div>
                                                            @else
                                                                <div class="icheck-danger d-inline">
                                                                    <input type="checkbox" name="permit_renew_int" id="checkboxPrimary1" value="{{ $permit->permit_renew_int }}">
                                                                    <label for="checkboxPrimary1">
                                                                    </label>
                                                                </div>
                                                            @endif
{{--                                                            <div class="icheck-danger d-inline">--}}
{{--                                                                <input type="checkbox" id="checkboxPrimary1" name="permit_renew_int" checked>--}}
{{--                                                                --}}
{{--                                                            </div>--}}
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Note</label>
                                                            <div class="col-sm-8">
                                                                <textarea class="form-control" id="permit_descmodal"  name="permit_desc" rows="3">{{$permit->permit_desc}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row float-right">
                                                    <button type="button" class="btn btn-danger" ahref="{{ route('permitprocess.list') }}" >Back</button>&nbsp;&nbsp;
                                                    <button type="submit" name="" class="btn btn-primary bg-gradient-primary" data-dismiss="modal" onclick="formSubmit()">Save</button>

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

@endsection


