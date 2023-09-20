

<section class="content">
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card  mt-3  card-fuchsia" >
            <div class="card-header" style="background-color:#39cccc; ">
                Permit List
            </div>
            <div class="card-body ">
                <div class="row">
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
                                                <select name="id_permitdt" class="form-control form-control-sm" id="period" >
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
                                                <select name="id_instansi_int" class="form-control form-control-sm" id="period" >
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
                                    </div>
                                    <div class="col-md-6">
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
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Location </label>
                                            <div class="col-sm-8">
                                                <input  class="form-control form-control-sm" name="permit_location" id="permit_location" placeholder="location">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-4 col-form-label">PIC Division</label>
                                            <div class="col-sm-8">
                                                <select name="id_instansi_int" class="form-control form-control-sm" id="period" >
                                                    <option value="">---Select---</option>
                                                    @foreach($divisi as $div)
                                                        <option value="{{ $div->CR_DIVISI_INT }}">{{ $div->CR_DIVISI_NAME }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <label for="name" class="col-sm-4 col-form-label">Subscription</label>
                                            <div class="icheck-danger d-inline">
                                                <input type="checkbox" id="checkboxPrimary1" name="permit_renew_int" checked>
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
        </div>
    </div>
</section>

