@extends('layouts.auth_app')

@section('content')
    <div class="p-2 mt-5">
        <form class="form-horizontal" action="https://themesdesign.in/nazox/layouts/vertical/index.html">

            <div class="form-group auth-form-group-custom mb-4">
                <i class="ri-mail-line auti-custom-input-icon"></i>
                <label for="useremail">Email</label>
                <input type="email" class="form-control" id="useremail" placeholder="Enter email">
            </div>

            <div class="form-group auth-form-group-custom mb-4">
                <i class="ri-user-2-line auti-custom-input-icon"></i>
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username">
            </div>

            <div class="form-group auth-form-group-custom mb-4">
                <i class="ri-lock-2-line auti-custom-input-icon"></i>
                <label for="userpassword">Password</label>
                <input type="password" class="form-control" id="userpassword" placeholder="Enter password">
            </div>


            <div class="text-center">
                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
            </div>

            <div class="mt-4 text-center">
                <p class="mb-0">By registering you agree to the Nazox <a href="#" class="text-primary">Terms of Use</a></p>
            </div>
        </form>
    </div>

    <div class="mt-5 text-center">
        <p>Already have an account ? <a href="auth-login.html" class="font-weight-medium text-primary"> Login</a> </p>
        <p>© 2020 Nazox. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign</p>
    </div>
@endsection