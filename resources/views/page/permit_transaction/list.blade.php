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
                                        <div class="col-md-9">
                                            @include('layouts.flash-message')
                                        </div>

                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-2">
                                            <a href="javascript:" data-toggle="modal" onclick="addData()"
                                               data-target="#AddModal" class="btn-primary bg-gradient-primary btn" >Add Permit
                                            </a>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="javascript:" data-toggle="modal" onclick="addDatasipa()"
                                               data-target="#AddSipaModal" class="btn-primary bg-gradient-info btn" >Add SIPA Permit
                                            </a>
                                        </div>

                                      </div>
                                   <h3>Permit </h3>
                                    <table class="table table-bordered table-hover nowrap " id="permitlist">
                                        <thead>
                                        <tr >
                                            <th> No</th>
                                            @if(Session::get('PROJECT_NO_CHAR')=='1')
                                                <th>Project Name</th>
                                            @endif

                                            <th> Permit Number</th>
                                            <th >Permit Name</th>
                                            <th>Issue By</th>
                                            <th > Issue date</th>
                                            <th>Expired Date</th>
                                            <th> Period</th>
                                            <th >Location</th>
                                            <th>PIC Dept  </th>
                                            <th> Note</th>
                                            <th>Status</th>
                                            <th>Renew </th>
                                            <th>Sipa  </th>
                                            <th>Action</th>

                                            {{--                                            <th>Remainings Day</th>--}}

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($permitprocess as $permitproces)
                                            <tr >
                                                <?php
                                                $ticketTime = strtotime($permitproces->permit_expire_date);
                                                $difference = $ticketTime - time(); ?>
                                                <td>{{ $loop->iteration }}
                                                    {!! Form::hidden('id_permit_int', $permitproces->id_permit_int,['class'=>'form-control','id'=>'id_permit_int_hidden','readonly'])!!}

                                                </td>
                                                @if(Session::get('PROJECT_NO_CHAR')=='1')
                                                    <td>{{ $permitproces->PROJECT_NAME  }}</td>
                                                @endif

                                                <td>{{ $permitproces->permit_trx_nochar }}

                                                    {!! Form::hidden('permit_desc_old1', $permitproces->permit_desc,['class'=>'form-control','id'=>'permit_desc_old1','readonly'])!!}
                                                </td>
                                                <td>{{ rtrim($permitproces->permit_description)}}
                                                    {!! Form::hidden('permit_gov_status_old1', $permitproces->permit_gov_status,['class'=>'form-control','id'=>'permit_gov_status_old1','readonly'])!!}
                                                </td>
                                                <td>{{ $permitproces->nama_instansi }}</td>
                                                <td>{{ date('d-m-Y', strtotime($permitproces->permit_issue_date)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($permitproces->permit_expire_date)) }}</td>
                                                <td>{{ $permitproces->permit_period }}</td>
                                                <td>{{ $permitproces->permit_location }}</td>
                                                <td>{{ $permitproces->CR_DIVISI_NAME }}</td>
                                                <td>{{ substr(rtrim($permitproces->permit_desc),0,30) }}</td>
                                                <td>{{ $permitproces->permit_gov_status }}</td>
                                                <td>@if($permitproces->permit_renew_int==0)
                                                        TIDAK   PERPANJANG
                                                    @else
                                                        PERPANJANG
                                                    @endif</td>
                                                    <td>@if($permitproces->permit_sipa_flag_int==1)
                                                            Ya
                                                        @else
                                                            Tidak
                                                        @endif</td>
                                                {{--                                                <td>{{ round($difference / 86400) }}</td>--}}

                                                <td>

                                                    @if($permitproces->permit_gov_status=='request'||$permitproces->permit_gov_status=='REQUEST' )
                                                        <a href="javascript:" data-toggle="modal" onclick="approvedocpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#DeleteModal" class="btn btn-xs bg-gradient-info"><i class="fa fa-check " title="Edit " ></i>Submit Doc
                                                        </a>
                                                        <a href="{{ route('permitprocess.edit', $permitproces->id_permit_int) }}" class="btn btn-xs bg-gradient-green "><i class="fa fa-eye" title="detail"></i>Edit</a>

                                                        <a href="#" class="btn btn-xs btn-outline-dark  disabled" ><i class="fa fa-edit " title="Edit " ></i>Update</a>

                                                        <a href="javascript:" data-toggle="modal" onclick="updatedocpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#UpdateModal" val="{{$permitproces->permit_trx_nochar}}" class="btn btn-xs btn-outline-info disabled " ><i class="fa fa-upload" title="upload" ></i>Upload
                                                        </a>
                                                        <a href="javascript:" data-toggle="modal" onclick="cancelpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#CancelModal" val="{{$permitproces->permit_trx_nochar}}"  class="btn btn-xs bg-gradient-danger cancelbtn " ><i class="fa fa-times" title="cancel" ></i>Cancel
                                                        </a>
                                                        {{--                                                            <a href="{{ route('instansi.edit', $permitproces->id_permit_int) }}" class="btn btn-xs bg-gradient-yellow disabled"><i class="fas fa-sync" title="approve ">Renew </i></a>--}}
                                                    @elseif($permitproces->permit_gov_status=='submit_doc')
                                                        <a href="javascript:" data-toggle="modal" onclick="approvedocpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#DeleteModal" class="btn btn-xs btn-outline-primary disabled"><i class="fa fa-check " title="Edit " ></i>Submit Doc</a>
                                                        <a href="#" class="btn btn-xs bg-gradient-green"><i class="fa fa-eye" title="detail"></i>Detail</a>

                                                        <a href="javascript:" data-toggle="modal" onclick="updatefinpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#UpdatefinModal" val="{{$permitproces->permit_trx_nochar}}" class="btn btn-xs bg-gradient-navy updatefin "><i  class="fa fa-edit "></i>Fin Process</a>
                                                        <a href="javascript:" data-toggle="modal" onclick="updatedocpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#UpdateModal" val="{{$permitproces->permit_trx_nochar}}" class="btn btn-xs btn-outline-info disabled" ><i class="fa fa-upload" title="upload" ></i>Upload</a>
                                                        <a href="javascript:" data-toggle="modal" onclick="cancelpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#CancelModal" val="{{$permitproces->permit_trx_nochar}}" class="btn btn-xs bg-gradient-danger cancelbtn " ><i class="fa fa-times" title="cancel" ></i>Cancel
                                                        </a>
                                                    @elseif($permitproces->permit_gov_status=='submit_fin')
                                                        <a href="javascript:" data-toggle="modal" onclick="approvedocpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#DeleteModal" class="btn btn-xs btn-outline-primary disabled"><i class="fa fa-check " title="Edit " ></i>Submit Doc</a>
                                                        <a href="#" class="btn btn-xs bg-gradient-green"><i class="fa fa-eye" title="detail"></i>Detail</a>

                                                        <a href="javascript:" data-toggle="modal" onclick="updatedocpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#UpdateModal" val="{{$permitproces->permit_trx_nochar}}" class="btn btn-xs bg-gradient-navy updateprocess "><i  class="fa fa-edit "></i>Process</a>
                                                        <a href="javascript:" data-toggle="modal" onclick="updatedocpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#UpdateModal" val="{{$permitproces->permit_trx_nochar}}" class="btn btn-xs btn-outline-info disabled" ><i class="fa fa-upload" title="upload" ></i>Upload</a>
                                                        <a href="javascript:" data-toggle="modal" onclick="cancelpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#CancelModal" val="{{$permitproces->permit_trx_nochar}}" class="btn btn-xs bg-gradient-danger cancelbtn " ><i class="fa fa-times" title="cancel" ></i>Cancel
                                                        </a>

                                                    @elseif($permitproces->permit_gov_status=='process')
                                                        <a href="javascript:" data-toggle="modal" onclick="approvedocpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#DeleteModal" class="btn btn-xs btn-outline-primary disabled"><i class="fa fa-check " title="Edit " ></i>Submit Doc</a>
                                                        <a href="#" class="btn btn-xs bg-gradient-green"><i class="fa fa-eye" title="detail"></i>Detail</a>

                                                        <a href="javascript:" data-toggle="modal" onclick="updatereceiptpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#UpdateapprModal" val="{{$permitproces->permit_trx_nochar}}" class="btn btn-xs bg-gradient-navy updatereceipt "><i  class="fa fa-edit "></i>Update</a>
                                                        <a href="javascript:" data-toggle="modal" onclick="updatedocpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#UpdateModal" val="{{$permitproces->permit_trx_nochar}}" class="btn btn-xs btn-outline-info disabled" ><i class="fa fa-upload" title="upload" ></i>Upload</a>
                                                        {{--                                                            <a href="{{ route('instansi.edit', $permitproces->id_permit_int) }}" class="btn btn-xs bg-gradient-yellow disabled"><i class="fas fa-sync disabled" title="approve ">Renew </i></a>--}}
                                                        <a href="javascript:" data-toggle="modal" onclick="cancelpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#CancelModal" val="{{$permitproces->permit_trx_nochar}}" class="btn btn-xs bg-gradient-danger  cancelbtn " ><i class="fa fa-times" title="cancel" ></i>Cancel
                                                        </a>
                                                    @elseif($permitproces->permit_gov_status=='receipt')
                                                        <a href="javascript:" data-toggle="modal" onclick="approvedocpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#DeleteModal" class="btn btn-xs btn-outline-info disabled"><i class="fa fa-check " title="Edit " ></i>Submit Doc</a>
                                                        <a href="#" class="btn btn-xs bg-gradient-green"><i class="fa fa-eye" title="detail"></i>Detail</a>

                                                        <a href="javascript:" data-toggle="modal" onclick="updatedocpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#UpdateModal" val="{{$permitproces->permit_trx_nochar}}" class="btn btn-xs btn-outline-dark updatedoc disabled "><i  class="fa fa-edit "></i>Update</a>
                                                        <a href="javascript:" data-toggle="modal" onclick="uploaddocpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#UploadModal" val="{{$permitproces->permit_trx_nochar}}" class="btn btn-xs bg-gradient-maroon uploaddoc " data-pmitdate ="{{$permitproces->permit_expire_date}}" ><i class="fa fa-upload" title="upload" ></i>Upload</a>

                                                        <a href="javascript:" data-toggle="modal" onclick="cancelpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#CancelModal" val="{{$permitproces->permit_trx_nochar}}" class="btn btn-xs bg-gradient-danger cancelbtn " ><i class="fa fa-times" title="cancel" ></i>Cancel
                                                        </a>
                                                    @elseif($permitproces->permit_gov_status=='reject')
                                                        <a href="javascript:" data-toggle="modal" onclick="approvedocpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#DeleteModal" class="btn btn-xs bg-gradient-info "><i class="fa fa-check " title="Edit " ></i>Process</a>
                                                        <a href="#" class="btn btn-xs btn-outline-success disabled"><i class="fa fa-eye" title="detail"></i>Detail</a>

                                                        <a href="javascript:" data-toggle="modal" onclick="updatedocpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#UpdateModal" val="{{$permitproces->permit_trx_nochar}}" class="btn btn-xs btn-outline-dark disabled "><i  class="fa fa-edit "></i>Update</a>
                                                        <a href="javascript:" data-toggle="modal" onclick="updatedocpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#UpdateModal" val="{{$permitproces->permit_trx_nochar}}" class="btn btn-xs btn-outline-dark disabled" ><i class="fa fa-upload" title="upload" ></i>Upload</a>
                                                        <a href="javascript:" data-toggle="modal" onclick="cancelpermit({{$permitproces->id_permit_int}})"
                                                           data-target="#CancelModal" val="{{$permitproces->permit_trx_nochar}}" class="btn btn-xs bg-gradient-danger cancelbtn  "  ><i class="fa fa-times" title="cancel" ></i>Cancel
                                                        </a>
                                                    @endif

                                                </td>

                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div id="AddModal" class="modal fade " role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <!-- Modal content-->
                                            <form action="" id="savepermitForm" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <h3>Permit Process</h3>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">Close </h4>
                                                    </div>
                                                    <div class="modal-body ">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                {{ csrf_field() }}
                                                                {{ method_field('POST') }}
                                                                <div class="form-group row">
                                                                    <label for="name" class="col-sm-4 col-form-label">Doc Type</label>

                                                                    <div class="col-sm-8">
                                                                        <select name="permit_type_doc" class="form-control form-control-sm" id="period" >
                                                                            <option value="">---Select---</option>
                                                                            <option value="permit">Permit</option>
                                                                            <option value="contract">Contract</option>

                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="name" class="col-sm-4 col-form-label">Permit Name</label>

                                                                    <div class="col-sm-8">
                                                                        <select name="id_permitdt" class="form-control form-control-sm" id="id_permitdt" style="width: 100%" >
                                                                            <option value="">---Select---</option>
                                                                            @foreach($permitdt as $permitd)
                                                                                <option value="{{ $permitd->id_permitdt }}">{{ $permitd->permit_description }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Number</label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" name="permit_trx_nochar" placeholder="Number">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Doc Ref</label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" name="permit_doc_refno" placeholder="Number">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="name" class="col-sm-4 col-form-label">Issue By</label>
                                                                    <div class="col-sm-8">
                                                                        <select name="id_instansi_int"  class=" select2-info form-control-sm" id="id_instansi_int"  style="width: 100%">
                                                                            <option value="">---Select---</option>
                                                                            @foreach($instansi as $instans)
                                                                                <option value="{{ $instans->id }}">{{ $instans->nama_instansi }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="p-1 border-dark mt-2" style="border: solid 1px; margin-top: 2px;">
                                                                    <h5>Maintenance Service</h5>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label"> Vendor Name </label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" name="permit_vendor_name" id="permit_vendor_name" placeholder="Vendor name">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label"> Vendor Phone</label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" name="permit_vendor_phone" id="permit_vendor_phone" placeholder="Vendor Phone">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label"> Vendor Contract</label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" name="permit_vendor_contract_amt" id="permit_vendor_contract_amt" placeholder="vendor contract amount">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="name" class="col-sm-4 col-form-label">Last Maintenance</label>
                                                                    <div class="col-sm-8">
                                                                        <input class="form-control form-control-sm" type="date" name="permit_last_maintenance" id="permit_last_maintenance"  />
                                                                    </div>

                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label for="name" class="col-sm-4 col-form-label">Estimation Date</label>
                                                                    <div class="col-sm-8">
                                                                        <input class="form-control form-control-sm" type="date" name="permit_etd_date" id="permit_etd_date"  />
                                                                    </div>

                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label"> Location(lokasi ijin) </label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" name="permit_location" id="permit_location" placeholder="permit location e.g lift samping">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="name" class="col-sm-4 col-form-label">Issue Date</label>
                                                                    <div class="col-sm-8">
                                                                        <input class="form-control form-control-sm" type="date" name="permit_issue_date" id="permit_issue_date"  />
                                                                    </div>

                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="name" class="col-sm-4 col-form-label">Expire Date</label>
                                                                    <div class="col-sm-8">
                                                                        <input class="form-control form-control-sm" type="date" name="permit_expire_date" id="permit_expire_date"  />
                                                                    </div>

                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Period(Year)</label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" name="permit_period" type="number" id="permit_period" placeholder="period">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label"> Doc Location </label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" name="permit_doc_location" id="permit_doc_location" placeholder=" doc storage location">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Floor </label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" type="number" name="permit_floor" id="permit_floor" placeholder="floor">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="name" class="col-sm-4 col-form-label">PIC Division</label>
                                                                    <div class="col-sm-8">
                                                                        <select name="permit_pic_dept" class="form-control form-control-sm" id="permit_pic_dept"  style="width: 100%">
                                                                            <option value="">---Select---</option>
                                                                            @foreach($divisi as $div)
                                                                                <option value="{{ $div->CR_DIVISI_INT }}">{{ $div->CR_DIVISI_NAME }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Cost  </label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" type="number" name="permit_cost_amount" id="permit_cost_amount" placeholder="floor">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group clearfix">
                                                                    <label for="name" class="col-sm-4 col-form-label">Subscription</label>
                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="checkbox" id="checkboxPrimary1" name="permit_renew_int" >
                                                                        <label for="checkboxPrimary1">
                                                                        </label>
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
{{--sipa--}}
                                    <div id="AddSipaModal" class="modal fade " role="dialog">
                                        <div class="modal-dialog modal-xl">
                                            <!-- Modal content-->
                                            <form action="" id="savepermitsipaForm" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-info">
                                                        <h3>Permit Process</h3>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">Close </h4>
                                                    </div>
                                                    <div class="modal-body ">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                {{ csrf_field() }}
                                                                {{ method_field('POST') }}
                                                                <div class="form-group row">
                                                                    <label for="name" class="col-sm-4 col-form-label">Doc Type</label>

                                                                    <div class="col-sm-8">
                                                                        <select name="permit_type_doc" class="form-control form-control-sm" id="permit_type_docsipa" >
                                                                            <option value="">---Select---</option>
                                                                            <option value="permit">Permit</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="name" class="col-sm-4 col-form-label">Permit Name</label>

                                                                    <div class="col-sm-8">
                                                                        <select name="id_permitdt" class="form-control form-control-sm" id="id_permitdtsipa" style="width: 100%" >
                                                                            <option value="">---Select---</option>
                                                                            @foreach($permitdt as $permitd)
                                                                                <option value="{{ $permitd->id_permitdt }}">{{ $permitd->permit_description }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Number</label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" name="permit_trx_nochar" placeholder="Number">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="name" class="col-sm-4 col-form-label">Issue By</label>
                                                                    <div class="col-sm-8">
                                                                        <select name="id_instansi_int"  class=" select2-info form-control-sm" id="id_instansi_intsipa"  style="width: 100%">
                                                                            <option value="">---Select---</option>
                                                                            @foreach($instansi as $instans)
                                                                                <option value="{{ $instans->id }}">{{ $instans->nama_instansi }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="name" class="col-sm-4 col-form-label">Estimation Date</label>
                                                                    <div class="col-sm-8">
                                                                        <input class="form-control form-control-sm" type="date" name="permit_etd_date" id="permit_etd_date"  />
                                                                    </div>

                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="name" class="col-sm-4 col-form-label">Issue Date</label>
                                                                    <div class="col-sm-8">
                                                                        <input class="form-control form-control-sm" type="date" name="permit_issue_date" id="permit_issue_date"  />
                                                                    </div>

                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="name" class="col-sm-4 col-form-label">Expire Date</label>
                                                                    <div class="col-sm-8">
                                                                        <input class="form-control form-control-sm" type="date" name="permit_expire_date" id="permit_expire_date"  />
                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Doc Ref</label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" name="permit_doc_refno" placeholder="Number">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Period(Year)</label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" name="permit_period" type="number" id="permit_period" placeholder="period">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label"> Doc Location </label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" name="permit_doc_location" id="permit_doc_location" placeholder=" doc storage location">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Floor </label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" type="number" name="permit_floor" id="permit_floor" placeholder="floor">
                                                                        <input  class="form-control form-control-sm" type="hidden" name="permit_sipa_flag_int" id="permit_sipa_flag_int" placeholder="floor">

                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="name" class="col-sm-4 col-form-label">PIC Division</label>
                                                                    <div class="col-sm-8">
                                                                        <select name="permit_pic_dept" class="form-control form-control-sm" id="permit_pic_deptsipa"  style="width: 100%">
                                                                            <option value="">---Select---</option>
                                                                            @foreach($divisi as $div)
                                                                                <option value="{{ $div->CR_DIVISI_INT }}">{{ $div->CR_DIVISI_NAME }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Alias Name </label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" type="text" name="permit_name_alias" id="permit_name_alias" placeholder="sumur ke ">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group clearfix">
                                                                    <label for="name" class="col-sm-4 col-form-label">Subscription</label>
                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="checkbox" id="checkboxPrimary2" name="permit_renew_int" >
                                                                        <label for="checkboxPrimary2">
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-4">

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Registration No:</label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" type="text" name="permit_reg_number" id="permit_reg_number" placeholder="Registraion number ">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Sipa Start Meter </label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" type="number" name="permit_sipa_meter" id="permit_sipa_meter" placeholder="Sipa Start Meter ">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label"> Location(lokasi ijin) </label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" name="permit_location" id="permit_location" placeholder="permit location e.g lift samping">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Coordinate (B/T) </label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" type="text" name="permit_coordinate_location" id="permit_coordinate_location" placeholder="west /east">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Coordinate(U/S) </label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" type="text" name="permit_coordinate_location2" id="permit_coordinate_location" placeholder="North/South">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Quota </label>
                                                                    <div class="col-sm-4">
                                                                        <input  class="form-control form-control-sm" type="number" name="permit_max_capacity" id="permit_max_capacity" placeholder="capacity">
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="permit_uom_capacity" class="form-control form-control-sm" id="period" >
                                                                            <option value="">---Select---</option>
                                                                            <option value="day">Day</option>
                                                                            <option value="month">Month</option>
                                                                            <option value="year">Year</option>
                                                                        </select></div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Cost  </label>
                                                                    <div class="col-sm-8">
                                                                        <input  class="form-control form-control-sm" type="number" name="permit_cost_amount" id="permit_cost_amount" placeholder="cost">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="" class="btn btn-primary bg-gradient-primary" data-dismiss="modal" onclick="formSubmitsipa()">Save</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div id="DeleteModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="approveform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">PROCESS CONFIRMATION</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        <p class="text-center">Your document required is completed ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="approve()">Process</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div id="UpdateModal" class="modal fade updatestatusdoc" role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="updateapproveform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">UPDATE PROGRESS</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        {!! Form::hidden('permit_desc_old', null,['class'=>'form-control','id'=>'permit_desc_old','readonly'])!!}
                                                        {!! Form::hidden('permit_gov_status_old', null,['class'=>'form-control','id'=>'permit_gov_status_old','readonly'])!!}
                                                        {!! Form::hidden('id_permit_int', null,['class'=>'form-control','id'=>'id_permit_int','readonly'])!!}

                                                        <div class="form-group row">

                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Number</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control form-control-sm" name="permit_trx_nochar" id="permit_trx_nochar_process" placeholder="note" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Note</label>
                                                            <div class="col-sm-8">
                                                                <textarea class="form-control" id="permit_descmodal" name="permit_desc" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Receipt date</label>
                                                            <div class="col-sm-8">
                                                                <input type="date" class="form-control form-control-sm" name="receipt_date" value="{{date('Y-m-d')}}" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-4 col-form-label">Status Doc</label>

                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control form-control-sm" name="permit_gov_status" id="permit_gov_status"  value ="process" placeholder="note" readonly>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>

                                                            <button type="submit" name="" class="btn bg-gradient-danger" data-dismiss="modal" >Cancel</button>
                                                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="updateapprove()">Save</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div id="UpdatefinModal" class="modal fade updatestatusdoc" role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="updatefinform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">FIN PROCESS</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        {!! Form::hidden('permit_desc_old', null,['class'=>'form-control','id'=>'permit_desc_old','readonly'])!!}
                                                        {!! Form::hidden('permit_gov_status_old', null,['class'=>'form-control','id'=>'permit_gov_status_old','readonly'])!!}
                                                        {!! Form::hidden('id_permit_int', null,['class'=>'form-control','id'=>'id_permit_int','readonly'])!!}

                                                        <div class="form-group row">

                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Number</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control form-control-sm" name="permit_trx_nochar" id="permit_trx_nocharfin" placeholder="note" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Note</label>
                                                            <div class="col-sm-8">
                                                                <textarea class="form-control" id="permit_descmodal" name="permit_desc" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Receipt date</label>
                                                            <div class="col-sm-8">
                                                                <input type="date" class="form-control form-control-sm" name="receipt_date" value="{{date('Y-m-d')}}" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-4 col-form-label">Status Doc</label>

                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control form-control-sm" name="permit_gov_status" id="permit_gov_status" placeholder="note" value="submit_fin" readonly>

                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>

                                                            <button type="submit" name="" class="btn bg-gradient-danger" data-dismiss="modal" >Cancel</button>
                                                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="updatefinapprove()">Save</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div id="UpdateapprModal" class="modal fade " role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="updatereceiptform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">UPDATE PROCESS</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        {!! Form::hidden('permit_desc_old', null,['class'=>'form-control','id'=>'permit_desc_old','readonly'])!!}
                                                        {!! Form::hidden('permit_gov_status_old', null,['class'=>'form-control','id'=>'permit_gov_status_old','readonly'])!!}
                                                        {!! Form::hidden('id_permit_int', null,['class'=>'form-control','id'=>'id_permit_int','readonly'])!!}

                                                        <div class="form-group row">

                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Number</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control form-control-sm" name="permit_trx_nochar" id="permit_trx_nochar_rcp" placeholder="note" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Note</label>
                                                            <div class="col-sm-8">
                                                                <textarea class="form-control" id="permit_descmodal" name="permit_desc" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Receipt date</label>
                                                            <div class="col-sm-8">
                                                                <input type="date" class="form-control form-control-sm" name="receipt_date" value="{{date('Y-m-d')}}" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-4 col-form-label">Status Doc</label>

                                                            <div class="col-sm-8">
                                                                <select name="permit_gov_status" class="form-control form-control-sm" id="permit_gov_status" >
                                                                    <option value="">---Select---</option>
                                                                    <option value="receipt">Receipt</option>
                                                                    <option value="return">Return</option>
                                                                    <option value="reject">reject</option>

                                                                </select>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>

                                                            <button type="submit" name="" class="btn bg-gradient-danger" data-dismiss="modal" >Cancel</button>
                                                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="updatereceipt()">Save</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div id="UploadModal" class="modal fade UploadModal" role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="uploadform" method="post" enctype="multipart/form-data">

                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">UPLOAD DOC</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        {!! Form::hidden('permit_desc_old', null,['class'=>'form-control','id'=>'permit_desc_old','readonly'])!!}
                                                        {!! Form::hidden('permit_gov_status_old', null,['class'=>'form-control','id'=>'permit_gov_status_old','readonly'])!!}
                                                        {!! Form::hidden('id_permit_int', null,['class'=>'form-control','id'=>'id_permit_int','readonly'])!!}

                                                        <div class="form-group row">

                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Number</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control form-control-sm" name="permit_trx_nochar" id="permitochar_upload" placeholder="note" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Due date</label>
                                                            <div class="col-sm-8">
                                                                <input type="date" class="form-control form-control-sm" name="permit_trx_date" id="permit_trx_date" placeholder="permit date" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Doc (PDF File Only)</label>
                                                            <div class="col-sm-8">
                                                                {!! Form::hidden('permit_file', null,['id'=>'sheet']) !!}
                                                                {!! Form::file('permit_file', null,['id'=>'sheet']) !!}</div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Receipt date</label>
                                                            <div class="col-sm-8">
                                                                <input type="date" class="form-control form-control-sm" name="receipt_date" placeholder="note">
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>

                                                            <button type="submit" name="" class="btn bg-gradient-danger" data-dismiss="modal" >Cancel</button>
                                                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="uploadformSubmit()">Save</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                    <div id="CancelModal" class="modal fade cancelpermit" role="dialog">
                                        <div class="modal-dialog ">
                                            <!-- Modal content-->
                                            <form action="" id="cancelform" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-navy">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">Cancel Permit</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        {!! Form::hidden('permit_desc_old', null,['class'=>'form-control','id'=>'permit_desc_old','readonly'])!!}
                                                        {!! Form::hidden('permit_gov_status_old', null,['class'=>'form-control','id'=>'permit_gov_status_old','readonly'])!!}
                                                        {!! Form::hidden('id_permit_int', null,['class'=>'form-control','id'=>'id_permit_int','readonly'])!!}

                                                        <div class="form-group row">

                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Number</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control form-control-sm" name="permit_trx_nochar" id="permit_trx_nochar_cancel" placeholder="note" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Reason</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control form-control-sm" name="permit_cancel_reason" id="permit_cancel_reason" placeholder="note">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Permit Note</label>
                                                            <div class="col-sm-8">
                                                                <textarea class="form-control" id="permit_descmodal" name="permit_desc" rows="3"></textarea>
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>

                                                            <button type="submit" name="" class="btn bg-gradient-danger" data-dismiss="modal" >Cancel</button>
                                                            <button type="submit" name="" class="btn bg-gradient-primary" data-dismiss="modal" onclick="approvecancel()">Save</button>
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
    <script type="text/javascript">
        //add form

        function addData()
        {
            var url = '{{ route("permitprocess.save") }}';
            $("#savepermitForm").attr('action', url);
        }
        function formSubmit()
        {
            $("#savepermitForm").submit();
        }

        function addDatasipa()
        {
            var url = '{{ route("permitprocess.savesipa") }}';
            $("#savepermitsipaForm").attr('action', url);
        }
        function formSubmitsipa()
        {
            $("#savepermitsipaForm").submit();
        }


        //approve doc from request to sumbit doc (1)
        function approvedocpermit(id)
        {
            var id = id;
            var url = '{{ route("permitprocess.processpermitdoc", ":id") }}';
            url = url.replace(':id', id);

            $("#approveform").attr('action', url);
        }
        function approve()
        {
            $("#approveform").submit();
        }
        //fin form update (2)
        function updatefinpermit(id)
        {
            var id = id;
            var url = '{{ route("permitprocess.permitprocessupdatedoc", ":id") }}';
            url = url.replace(':id', id);

            $("#updatefinform").attr('action', url);
        }
        function updatefinapprove()
        {
            $("#updatefinform").submit();
        }
        //update process form (3)
        function updatedocpermit(id)
        {
            var id = id;
            var url = '{{ route("permitprocess.permitprocessupdatedoc", ":id") }}';
            url = url.replace(':id', id);

            $("#updateapproveform").attr('action', url);
        }
        function updateapprove()
        {
            $("#updateapproveform").submit();
        }

        //update receipt form (4)
        function updatereceiptpermit(id)
        {
            var id = id;
            var url = '{{ route("permitprocess.permitprocessupdatedoc", ":id") }}';
            url = url.replace(':id', id);

            $("#updatereceiptform").attr('action', url);
        }
        function updatereceipt()
        {
            $("#updatereceiptform").submit();
        }

        function rejectdoc()
        {
            $("#updateapproveform").submit();
        }
     //form upload (5)
        function uploaddocpermit(id)
        {
            var id = id;
            var url = '{{ route("permitprocess.permituploaddoc", ":id") }}';
            url = url.replace(':id', id);

            $("#uploadform").attr('action', url);
        }

        function uploadformSubmit()
        {
            $("#uploadform").submit();
        }
  ///cancel

        function cancelpermit(id)
        {
            var id = id;
            var url = '{{ route("permitprocess.cancelpermit", ":id") }}';
            url = url.replace(':id', id);

            $("#cancelform").attr('action', url);
        }
        function approvecancel()
        {
            $("#cancelform").submit();
        }



    </script>
    <script>
        $(document).ready(function(){

            // $(".updatedoc").click(function(){
            //     var currentRow=$(this).closest("tr");
            //     var col1=currentRow.find("td:eq(0)").html(); // get current row 1st table cell TD value
            //     var col2=currentRow.find("td:eq(1)").html(); // get current row 2nd table cell TD value
            //     var col3=currentRow.find("td:eq(1)").find('#permit_desc_old1').val();
            //     var col4=currentRow.find("td:eq(2)").find('#permit_gov_status_old1').val();
            //     var col5=currentRow.find("td:eq(0)").find('#id_permit_int_hidden').val();
            //     var col9=currentRow.find("td:eq(9)").html();
            //     var col10=currentRow.find("td:eq(10)").html();
            //
            //     // get current row 3rd table cell  TD value
            //     // var col4=currentRow.find("td:eq(4)").html();
            //     // var col5=currentRow.find("td:eq(5)").html();
            //     //
            //     // document.getElementById('no_unit').value = col1;
            //     // document.getElementById('cust_id').value = col2;
            //     // document.getElementById('cust_name').value = col3;
            //     // document.getElementById('building').value = col4;
            //     // document.getElementById('BOOKING_CODE').value = col5;
            //     $('#permit_desc_old').val(col3);
            //     $('#permit_gov_status_old').val(col4);
            //     $('#id_permit_int').val(col5);
            //     $('#permit_descmodal').val(col9);
            //
            //     $('#permit_gov_status ').val(col10);
            //     // $('#unitModal').modal('hide');
            // });

            $(".updatedoc").click(function(){

                var currentRow=$(this).closest("tr");
                var col1=currentRow.find("td:eq(0)").html(); // get current row 1st table cell TD value
                var col2=currentRow.find("td:eq(1)").html(); // get current row 2nd table cell TD value
                var col3=currentRow.find("td:eq(1)").find('#permit_desc_old1').val();
                var col4=currentRow.find("td:eq(2)").find('#permit_gov_status_old1').val();
                var col5=currentRow.find("td:eq(0)").find('#id_permit_int_hidden').val();
                var col9=currentRow.find("td:eq(9)").html();
                var col10=currentRow.find("td:eq(10)").html();
            //    alert(col1);

                // get current row 3rd table cell  TD value
                // var col4=currentRow.find("td:eq(4)").html();
                // var col5=currentRow.find("td:eq(5)").html();
                //
                // document.getElementById('no_unit').value = col1;
                // document.getElementById('cust_id').value = col2;
                // document.getElementById('cust_name').value = col3;
                // document.getElementById('building').value = col4;
                // document.getElementById('BOOKING_CODE').value = col5;
                $('#permit_desc_old').val(col3);
                $('#permit_gov_status_old').val(col4);
                $('#id_permit_int').val(col5);
                $('#permit_descmodal').val(col9);

                // $('#permit_gov_status ').val(col10);
                // $('#unitModal').modal('hide');
            });
                // $('#permitlist').dataTable({
                //     "scrollX": true,
                //     dom: 'Bfrtip',
                //     buttons: [
                //         'copyHtml5',
                //         'excelHtml5',
                //         'pdfHtml5'
                //     ]
                // });
            // $('#permitlist tfoot th').each(function (i) {
            //     var title = $('#permitlist thead th').eq($(this).index()).text();
            //     $(this).html('<input type="text" placeholder=" ' + title + '" data-index="' + i + '"/>');
            // });


            var table = $('#permitlist').DataTable({
                "paging":true,
                "scrollX": true,
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'pdfHtml5'
                ]});
            $(table.table().container()).on('keyup', 'tfoot input', function () {
                table.column($(this).data('index'))
                    .search(this.value, true, false)
                    .draw();
            });

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            $("input[data-bootstrap-switch]").each(function(){
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });
            $('#id_instansi_int').select2();
            $('#permit_pic_dept').select2();
            $('#id_permitdt').select2();
            $('#id_instansi_intsipa').select2();
            $('#permit_pic_deptsipa').select2();
            $('#id_permitdtsipa').select2();

            $('#checkboxPrimary1').click(function () {
                this.value = this.checked ? 1 : 0;
            });
            $('#checkboxPrimary2').click(function () {
                this.value = this.checked ? 1 : 0;
            });

            $(document).on('click','.updatedoc', function () {
                getVal = $(this).attr('val');
                 $('#permitochar_modal').val(getVal);

            });
            //doc to fin
            $(document).on('click','.updatefin', function () {
                getVal = $(this).attr('val');
                //alert(getVal);
                $('#permit_trx_nocharfin').val(getVal);

            });
            //fin to process
            $(document).on('click','.updateprocess', function () {
                getVal = $(this).attr('val');
                $('#permit_trx_nochar_process').val(getVal);

            });
            //process to receipt/reject/return
            $(document).on('click','.updatereceipt', function () {
                getVal = $(this).attr('val');
                $('#permit_trx_nochar_rcp').val(getVal);

            });






            $(document).on('click','.uploaddoc', function () {
                getVal = $(this).attr('val');
                val2 = $(".uploaddoc").attr("data-pmitdate");
               // alert(val2);
                $('#permitochar_upload').val(getVal);
                $('#permit_trx_date').val(val2);


            });

            $(document).on('click','.cancelbtn', function () {
                getVal = $(this).attr('val');
                $('#permit_trx_nochar_cancel').val(getVal);

            });

        });
       //filter column
       //  <p id="selectTriggerFilter"><label><b>Filter:</b></label><br></p>
       //  var table = $('#tableTrigger').DataTable({
       //      "lengthMenu": [
       //          [10, 25, 50, 100, -1],
       //          [10, 25, 50, 100, "All"]
       //      ],
       //      "scrollY": "200px",
       //      "dom": 'rtipS',
       //      // searching: false,
       //      "deferRender": true,
       //      initComplete: function() {
       //          var column = this.api().column(2);  //office
       //
       //          var select = $('<select class="filter"><option value=""></option></select>')
       //              .appendTo('#selectTriggerFilter')
       //              .on('change', function() {
       //                  var val = $(this).val();
       //                  //column.search(val ? '^' + $(this).val() + '$' : val, true, false).draw();
       //                  column.search(val).draw()
       //              });
       //
       //          var offices = [];
       //          column.data().toArray().forEach(function(s) {
       //              s = s.split(',');
       //              s.forEach(function(d) {
       //                  if (!~offices.indexOf(d)) {
       //                      offices.push(d)
       //                      select.append('<option value="' + d + '">' + d + '</option>');                         }
       //              })
       //          })
       //          /*
       //      column.data().unique().sort().each(function(d, j) {
       //        select.append('<option value="' + d + '">' + d + '</option>');
       //      });
       //     */
       //      }
       //  });
    </script>
@endsection

