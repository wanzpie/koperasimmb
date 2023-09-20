
@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <h3><b> </b></h3>
                    <div class="col-md-6">

                    </div>
                </div>
                <div class="row">
                    <div class="response"></div>
                    <div id='calendar'></div>


                </div>
                <div class="row">
                    <div id="fullCalModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-gradient-navy">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                                    <h4 id="modalTitle" class="modal-title"></h4>
                                </div>
                               <div class="modal-body">
                                   <div id="expired" >
                                   </div>
                                   <div id="header" >
                                   </div>
                                   <div id="modalBody">
                                   </div>
                               </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn bg-gradient-danger btn-sm" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



@endsection
