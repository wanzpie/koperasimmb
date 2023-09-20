@extends('layouts.app')
@section('content')
@if($user->exists)
<script type="text/javascript">
$( document ).ready(function() {
    var str = document.getElementById('menus').value;
    var menu = str.split(',');
    for(var i=0; i< menu.length; i++){
        console.log(menu[i]);
        var tes = '#cek' + menu[i];
        $(tes).prop( "checked", true );
    }
});
</script>
@endif
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h4>{!! $user->exists ? 'Edit User' : 'Form User' !!}</h4>
                </div>
                <div class="card-body">
                 <div class="col-md-2"></div>
                 <div class="col-md-10">
               <section class="content">

    &nbsp;
    {!! Form::model('user', [
        'method' => $user->exists ? 'put' : 'post',
        'route' => $user->exists ? ['users.update', $user->id] : ['users.store'],
    ]) !!}
    <input type="hidden" name="ip" id="ip" >
    @if($user->exists)<input type="hidden" name="menus" id="menus" value="{{ $user->menu }}" />@endif
    <div class="form-group row">
        <label for="name" class="col-sm-6 col-form-label">Name</label>
        <input class="form-control col-sm-6" type="text" name="name" id="name" value="{{ $user->name }}" />
    </div>
    <div class="form-group row">
        <label for="username" class="col-sm-6 col-form-label">Username</label>
        <input class="form-control col-sm-6" type="text" name="username" id="username" value="{{ $user->username }}" />
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-6 col-form-label">Email</label>
        <input class="form-control col-sm-6" type="text" name="email" id="email" value="{{ $user->email }}" />
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-6 col-form-label">Password</label>
        <input class="form-control col-sm-6" type="password" name="password" id="password" />
    </div>
    <div class="form-group row">
        <label for="password_confirmation" class="col-sm-6 col-form-label">Password Confirmation</label>
        <input class="form-control col-sm-6" type="password" name="password_confirmation" id="password_confirmation" />
    </div>
                   {{-- <div class="form-group row ">
                       <label for="inputEmail3" class="col-sm-6 col-form-label">Project</label>
                       <div class="col-sm-6">
                           <select class="form-control " id="project_no_char" style="width: 100%;" name="project_no_char">
                               <option value="">-- Pilih Project</option>
                               @foreach($projects as $data)
                               <option value="{{ $data->project_no_char }}" @if($data->project_no_char == $user->project_no_char) selected @endif>{{ $data->project_name }}</option>
                               @endforeach
                           </select>
                       </div>
                   </div> --}}

    <div class="form-group row">
        <label for="level" class="col-sm-6 col-form-label">Level Access</label>
        <select class="form-control col-sm-6" id="level" name="perms_name">
            <option value="NULL">-=Pilih=-</option>
            <option value="Administrator" @if($user->level == 'Administrator') selected @endif>Administrator</option>
            <option value="Manager" @if($user->level == 'manager') selected @endif>Manager</option>
            <option value="Supervisor" @if($user->level == 'Supervisor') selected @endif>Supervisor</option>
            <option value="Staff" @if($user->level == 'Staff') selected @endif>Staff</option>

        </select>
    </div>
    @if($menu_parents)
    <div class="form-group col-lg-12">
    @foreach($menu_parents as $row)
    <div class="col-md-4">
        @if($row->is_parent == TRUE)
        <legend>{!! $row->title !!}</legend>
        @endif
        <ul class="checkbox">
        @foreach($menu_childs as $child)
            @if($row->id == $child->parent_id)
            <li>
                <input type="checkbox" name="menu_perms[]" id='cek{!! $child->id !!}' value="{!! $child->id !!}" />
                <label for="cek{!! $child->id !!}">{!! $child->title !!}</label>
            </li>
            @endif
        @endforeach
        </ul>
    </div>
    @endforeach
    </div>
    @endif
    <div class="form-group col-lg-12">
        <input type="submit" value="Save" class="btn btn-primary" />
        <a class="btn btn-danger" href="{{ route('users.index') }}">Back</a>
    </div>
    {!! Form::close() !!}
      </section>
    </div>
                </div>
                <div class="card-footer">
                </div>

        </div>
    </div>
</div>
@endsection
