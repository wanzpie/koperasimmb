
<?php
use App\Navigations\MenuBuildNav;
use App\Model\ProjectModel;
?>


<div id="modal-default" class="modal fade" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <form class="modal-content" role="form" method="POST" id="change_proj" action="{{ route('change_project') }}">
            <?php $PROJECT_NO_CHAR=  Session::get('PROJECT_NO_CHAR'); ?>

            <div class="modal-content">
                <div class="modal-header bg-gradient-navy">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">Change Project</h4>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="form-group row">

                        <label for="inputEmail3" class="col-sm-4 col-form-label">Project Name</label>
                        <div class="col-sm-8">
                            <?php $perms = explode(',', Session::get('assignment_project'));

                            $projects = ProjectModel::select('PROJECT_NO_CHAR','PROJECT_NAME')
                                ->whereIn('PROJECT_NO_CHAR', $perms)
                                ->OrderBy('PROJECT_NAME','ASC')->get();
                            ?>
                            <select name="project" id="project" class="custom-select select2-info"  style="width: 100%">
                                <option value="0">-=Pilih=-</option>

                                @foreach($projects as $project)
                                    <option value="{{ $project->PROJECT_NO_CHAR }}">{{ $project->PROJECT_NAME }}</option>
                                @endforeach
                            </select>       </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit"  class="btn bg-gradient-primary" id="chbutton" data-dismiss="modal" >Save</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>
    <!-- /.modal-dialog -->

<!-- /.modal -->

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <?php
            $PROJECT_NO_CHAR=  Session::get('PROJECT_NO_CHAR');
            $prefix= \DB::table('md_company')->SELECT('company_name')->where('id_company',$PROJECT_NO_CHAR)->first();
//       dd($PROJECT_NO_CHAR);
            ?>
            <a href="#"  class="nav-link" ><b>{{ $prefix->company_name}} &nbsp;</b></a>
        </li>

    </ul>

    <!-- SEARCH FORM -->
{{--    <form class="form-inline ml-3">--}}
{{--        <div class="input-group input-group-sm">--}}
{{--            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
{{--            <div class="input-group-append">--}}
{{--                <button class="btn btn-navbar" type="submit">--}}
{{--                    <i class="fas fa-search"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->


        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" title="LOGOUT" data-widget="control-sidebar"
               onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-fuchsia sidebar-light-fuchsia elevation-3" style="background-color: #001f3f;">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link" style="color: #FFFFFF;">
        Version : 1.0.0
    </a>
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-2 pb-3 mb-1 d-flex" >
            <div class="image">
                <img src="{{ URL::to('/') }}/assets/Licenza2.jpeg" class="img-lg elevation-2" alt=" Image" style="width: 70px;border-radius: 35px;">
            </div>
{{--        <div class="image">--}}
{{--            <img src="{{ asset('assets/AdminLTE/dist/img/user2-160x160t.png') }}" class="img-circle elevation-2" alt="User Image">--}}
{{--        </div>--}}
        <div class="info">
            <a href="#" class="nav-link">
               {{ Session::get('username')}}
            </a>
        </div>
    </div>
{!! MenuBuildNav::menus() !!}
    <!-- Sidebar -->
{{--    <div class="sidebar">--}}
{{--        <!-- Sidebar user panel (optional) -->--}}
{{--        <div class="user-panel mt-3 pb-3 mb-3 d-flex">--}}
{{--            <div class="image">--}}
{{--                <img src="{{ asset('assets/AdminLTE/dist/img/user2-160x160t.png') }}" class="img-circle elevation-2" alt="User Image">--}}
{{--            </div>--}}
{{--            <div class="info">--}}
{{--                <a href="#" class="d-block">{{ Auth::user()->name }}</a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Sidebar Menu -->--}}
{{--        <nav class="mt-2">--}}
{{--            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">--}}
{{--                <!-- Add icons to the links using the .nav-icon class--}}
{{--                     with font-awesome or any other icon font library -->--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('home') }}" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-tachometer-alt"></i>--}}
{{--                        <p>--}}
{{--                            Dashboard--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="#" id="change_project" class="nav-link" data-toggle="modal" data-target="#modal-default">--}}
{{--                        <i class="nav-icon fas fa-sync-alt"></i>--}}
{{--                        <p>--}}
{{--                            Change Project--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item has-treeview">--}}
{{--                    <a href="" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-th"></i>--}}
{{--                        <p>--}}
{{--                           Master--}}
{{--                            <i class="fas fa-angle-left right"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('users.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>User</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('billingtype.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Form Billing Type</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('formula.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-dot-circle nav-icon"></i>--}}
{{--                                <p>Formula</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="nav-item has-treeview">--}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-copy"></i>--}}
{{--                        <p>--}}
{{--                            Utility--}}
{{--                            <i class="fas fa-angle-left right"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('invoicemanual.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-dot-circle nav-icon"></i>--}}
{{--                                <p>Entry Invoice Manual</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('opttrans.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-dot-circle nav-icon"></i>--}}
{{--                                <p> Setup Client/Contract</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('optutility.index') }}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Entry Meter Utility</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                          <a href="{{ route('optutility.list') }}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p> Meter Utility Approval</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('genbill.index') }}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Generate Billing</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('genbill.genscauto') }}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Generate Service Charge</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="nav-item has-treeview">--}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-copy"></i>--}}
{{--                        <p>--}}
{{--                            Finance--}}
{{--                            <i class="fas fa-angle-left right"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('bank.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Master Bank</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('invoicemanual.approvedlist')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Manual/Service Payment</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('genbill.listgenbill') }}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Utility Payment </p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('payment_bill.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-dot-circle nav-icon"></i>--}}
{{--                                <p> Payment Approval</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('payment_bill.paymentlistapproved')}}" class="nav-link">--}}
{{--                                <i class="far fa-dot-circle nav-icon"></i>--}}
{{--                                <p> List Payment </p>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="nav-item has-treeview">--}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-copy"></i>--}}
{{--                        <p>--}}
{{--                            Accounting--}}
{{--                            <i class="fas fa-angle-left right"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('coa.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Coa</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('coa.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Setup Accounting</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('coa.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Sub Account</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item has-treeview">--}}
{{--                            <a href="#" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>--}}
{{--                                    Accounting Process--}}
{{--                                    <i class="right fas fa-angle-left"></i>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                            <ul class="nav nav-treeview">--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#" class="nav-link">--}}
{{--                                        <i class="far fa-dot-circle nav-icon"></i>--}}
{{--                                        <p>Journal manual</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#" class="nav-link">--}}
{{--                                        <i class="far fa-dot-circle nav-icon"></i>--}}
{{--                                        <p>External GL</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#" class="nav-link">--}}
{{--                                        <i class="far fa-dot-circle nav-icon"></i>--}}
{{--                                        <p>Journal Posting</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#" class="nav-link">--}}
{{--                                        <i class="far fa-dot-circle nav-icon"></i>--}}
{{--                                        <p>Month/Year closing </p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#" class="nav-link">--}}
{{--                                        <i class="far fa-dot-circle nav-icon"></i>--}}
{{--                                        <p>Recalculate</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#" class="nav-link">--}}
{{--                                        <i class="far fa-dot-circle nav-icon"></i>--}}
{{--                                        <p>Month/Year Unclosing </p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item has-treeview">--}}
{{--                            <a href="#" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>--}}
{{--                                    General Ledger--}}
{{--                                    <i class="right fas fa-angle-left"></i>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                            <ul class="nav nav-treeview">--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#" class="nav-link">--}}
{{--                                        <i class="far fa-dot-circle nav-icon"></i>--}}
{{--                                        <p>Journal List</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#" class="nav-link">--}}
{{--                                        <i class="far fa-dot-circle nav-icon"></i>--}}
{{--                                        <p>General Ledger</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#" class="nav-link">--}}
{{--                                        <i class="far fa-dot-circle nav-icon"></i>--}}
{{--                                        <p>Trial Balance </p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#" class="nav-link">--}}
{{--                                        <i class="far fa-dot-circle nav-icon"></i>--}}
{{--                                        <p>Profit/Lost</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#" class="nav-link">--}}
{{--                                        <i class="far fa-dot-circle nav-icon"></i>--}}
{{--                                        <p>GOP</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="nav-item has-treeview">--}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-copy"></i>--}}
{{--                        <p>--}}
{{--                            Report--}}
{{--                            <i class="fas fa-angle-left right"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('report.rptutility')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Report Utility</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('report.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Report Invoice</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('report.rptpayment')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Payment </p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('report.rptaging')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Aging</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('report.histpayment')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>History Payment</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--            </ul>--}}
{{--        </nav>--}}
{{--        <!-- /.sidebar-menu -->--}}
{{--    </div>--}}
    <!-- /.sidebar -->
</aside>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('assets/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
{{--<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>--}}
<script src="{{ asset('datatable/datatables.min.js') }}"></script>
<script src="{{ asset('datatable/DataTables-1.10.20/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('datatable/pdfmake-0.1.36/pdfmake.min.js') }}"></script>
<script src="{{ asset('datatable/pdfmake-0.1.36/vfs_fonts.js') }}"></script>
{{--<script src="{{ asset('assets/AdminLTE/plugins/datatables/jquery.dataTables.js') }}"></script>--}}
 {{--<script src="{{ asset('assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>--}}
<!-- Bootstrap -->
<script src="{{ asset('assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('assets/AdminLTE/plugins/datepicker/datepicker.js') }}"></script>
<!-- SELECT JS -->
<script src="{{ asset('assets/AdminLTE/plugins/select2/js/select2.full.js') }}"></script>
{{--<script src="{{ asset('assets/AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>--}}
<!-- SweetAlert2 -->
<script src="{{ asset('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('assets/AdminLTE/plugins/toastr/toastr.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('assets/AdminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('assets/AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/AdminLTE/dist/js/adminlte.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>



<!-- PAGE SCRIPTS
<script src="{{ asset('assets/AdminLTE/dist/js/pages/dashboard2.js') }}"></script>-->

<script>
    $(document).ready(function () {
        $('#project').select2();
        {{--function approvedocpermit()--}}
        {{--{--}}
        {{--    var url = '{{ route("permitprocess.save") }}';--}}
        {{--    $("#change_proj").attr('action', url);--}}
        {{--    // url = url.replace(':id', id);--}}
        {{--}--}}
        $('#chbutton').on('click', function(){
            // alert('test');
            $('#change_proj').submit();
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        function fresh_ajax(){
            $.ajax({
                type:"POST",
                url:"{{ route('checkValidSession') }}",
                data: {
                    id: "{{ Session::get('checker') }}",
                    _token: "{{ csrf_token() }}"
                },
                success: function( data ) {
                    console.log(data['msg']);
                    if(data['msg'] == '1'){
                        window.location.replace("{{ route('home') }}");
                    }
                }
            });
        }
        window.setInterval(function(){
            fresh_ajax();
        }, 7000);

    });
</script>
