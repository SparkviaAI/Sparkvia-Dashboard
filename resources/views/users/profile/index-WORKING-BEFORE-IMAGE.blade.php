@extends('layouts.users.app')
@section('content')
<style>
    .swal2-styled.swal2-confirm {
        background-color: red !important;
    }
</style>
<section class="dasboard-all pages pt-4 pb-4 height100vh">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="content-top">
                    <h1 class="content-hed">User Profile</h1>
                    <p class="content-pra">Manage your account details and security</p>
                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-lg12">
                <div class="chat-section">
                    <div>
                       
                    </div>

                    <hr class="lineCls">

                    <form id="updateAccount" method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        <input type="hidden" name="userId" value="{{ $getUserDetails->id }}">
                        <div class="otherChat"> 
                            <div class="col-lg-5">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" required class="form-control" id="name" name="name" value="{{ $getUserDetails->name }}">
                            </div>
                            <div class="col-lg-5">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{ $getUserDetails->email }}">
                            </div>
                        </div>
                        <div class="col-lg-12 giveSpaceCls endDisCls">
                            <button class="btn btn-success" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg12">
                <div class="chat-section otherChat">
                    <div>    
                        <h3 class="chat-hed pb-3">Delete your account? </h3>
                        <p class="chat-hed">You will loose all your assets and it won't be recovered</p>
                    </div>
                    <form id="deleteAccount">
                        <input type="hidden" name="userId" value="{{ $getUserDetails->id }}">
                        <div class="centCls">
                            <button class="btn btn-danger deleteAccount">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

<script>


    $("#deleteAccount").on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Delete Account?',
            text: 'You will lose all your assets and it won’t be recovered',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete Account',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'swal2-confirm',
                cancelButton: 'swal2-cancel'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    url: "{{ route('profile.delete') }}",
                    datatype: 'json',
                    method: 'post',
                    data: $('#deleteAccount').serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire("Done!", "Account deleted successfully!", "success").then(() => {
                                window.location.href = response.redirect_url; // Redirect to the provided URL
                            });
                        } else {
                            Swal.fire("Error deleting account!", "Please try again", "error");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire("Error deleting account!", "Please try again", "error");
                    }
                });
            }
        })
    });


    // $("#deleteAccount").on('click', function(e) {
    //     e.preventDefault();
    //     Swal.fire({
    //         title: 'Delete Account?',
    //         text: 'You will lose all your assets and it won’t be recovered',
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonText: 'Delete Account',
    //         cancelButtonText: 'Cancel',
    //         customClass: {
    //             confirmButton: 'swal2-confirm',
    //             cancelButton: 'swal2-cancel'
    //         }
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajaxSetup({
    //                 headers: {
    //                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //                 }
    //             });
    //             $.ajax({
    //                 url: "{{ route('profile.delete') }}",
    //                 datatype: 'json',
    //                 method: 'post',
    //                 data: $('#deleteAccount').serialize(),
    //                 success: function() {
    //                     Swal.fire("Done!", "Account deleted succesfully!", "success");
    //                 },
    //                 error: function(xhr, ajaxOptions, thrownError) {
    //                     Swal.fire("Error deleting account!", "Please try again", "error");
    //                 }
    //             });

    //         }
    //     })
    // })



</script>
@endsection('content')