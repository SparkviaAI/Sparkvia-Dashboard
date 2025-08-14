{{--
<!-- @extends('layouts.users.app')
@section('content')
<style>
    .swal2-styled.swal2-confirm {
        background-color: red !important;
    }
    .profile-picture {
        width: 150px !important;
        height: 150px !important;
        border-radius: 50% !important;
        object-fit: cover !important;
        cursor: pointer !important;
    }

    @media (max-width:991px) {
        .otherChat {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        
        }
        .content-top {
            margin: 40px 0px 20px 0;
        }

        .chat-section {
            margin: 50px 0;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
        }
        .stGpCls{
            gap: 15px;
        }
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
            <div class="col-lg-12">
                <div class="chat-section">
                    <div>
                        <div class="d-flex align-items-center stGpCls" style="flex-wrap: wrap;">
                            <img src="{{ $getUserDetails->profile_image ? asset('f_user/'.$getUserDetails->profile_image) : asset('users-images/defaultimage.jpg') }}" alt="Profile picture" class="profile-picture" id="profile-picture">
                            <div class="" style="margin-left: 3%;">
                                <h4 class="shapeHCls">Profile Picture</h4>
                                <p>Ensure the picture is clear and shows the face of the user</p>
                                <button class="generate-button" id="replace-image-btn">
                                    {{ $getUserDetails->profile_image ? "Replace Image" : "Upload Image" }}
                                </button>
                            </div>
                        </div>
                        <input type="file" id="profile-picture-input" style="display: none;">
                    </div>

                    <hr class="lineCls">

                    <form id="updateAccount" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="userId" id="userId" value="{{ $getUserDetails->id }}">
                        <div class="otherChat"> 
                            <div class="col-lg-5 col-sm-12">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" required class="form-control" id="name" name="name" value="{{ $getUserDetails->name }}">
                            </div>
                            <div class="col-lg-5 col-sm-12">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" readonly class="form-control" id="email" name="email" placeholder="Enter your email" value="{{ $getUserDetails->email }}">
                            </div>
                        </div>
                        <div class="col-lg-12 giveSpaceCls">
                            <button class="btn btn-success" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="chat-section otherChat">
                    <div>    
                        <h3 class="chat-hed pb-3">Delete your account? </h3>
                        <p class="chat-hed">You will lose all your assets and it won't be recovered</p>
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




    document.getElementById('profile-picture').addEventListener('click', function() {
        document.getElementById('profile-picture-input').click();
    });

    document.getElementById('profile-picture-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-picture').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('replace-image-btn').addEventListener('click', function() {
        $('.loader-overlay').css('display', 'flex');
        const fileInput = document.getElementById('profile-picture-input');
        const userId = $('#userId').val();
        if (fileInput.files.length > 0) {
            const formData = new FormData();
            formData.append('profile_picture', fileInput.files[0]);
            formData.append('userId', userId);
            formData.append('_token', '{{ csrf_token() }}');

            fetch('{{ route('profile.upload') }}', {
                method: 'POST',
                body: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
            .then(response => response.json())
            .then(data => {
                $('.loader-overlay').fadeOut('slow', function() {
                    $(this).css('display', 'none');
                });
                if (data.status === 'success') {
                    Swal.fire("Done!", "Profile picture updated successfully!", "success");
                    setTimeout(function() {
                        location.reload(true);
                    }, 3000);
                } else {
                    Swal.fire("Error updating profile picture!", data.message, "error");
                }
            })
            .catch(error => {
                $('.loader-overlay').fadeOut('slow', function() {
                    $(this).css('display', 'none');
                });
                Swal.fire("Error updating profile picture!", "Please try again", "error");
            });
        } else {
            $('.loader-overlay').fadeOut('slow', function() {
                $(this).css('display', 'none');
            });
            Swal.fire("Error!", "Please select an image", "error");
        }
    });



    // document.getElementById('profile-picture').addEventListener('click', function() {
    //     document.getElementById('profile-picture-input').click();
    // });

    // document.getElementById('profile-picture-input').addEventListener('change', function(event) {
    //     const file = event.target.files[0];
    //     if (file) {
    //         const reader = new FileReader();
    //         reader.onload = function(e) {
    //             document.getElementById('profile-picture').src = e.target.result;
    //         }
    //         reader.readAsDataURL(file);
    //     }
    // });

    // document.getElementById('replace-image-btn').addEventListener('click', function() {
    //     $('.loader-overlay').css('display', 'flex');
    //     const fileInput = document.getElementById('profile-picture-input');
    //     const userId = $('#userId').val();
    //     if (fileInput.files.length > 0) {
    //         const formData = new FormData();
    //         formData.append('profile_picture', fileInput.files[0]);
    //         formData.append('userId', userId);
    //         formData.append('_token', '{{ csrf_token() }}');

    //         fetch('{{ route('profile.upload') }}', {
    //             method: 'POST',
    //             body: formData,
    //         })
    //         .then(response => response.json())
    //         .then(data => {
    //             $('.loader-overlay').fadeOut('slow', function() {
    //                 $(this).css('display', 'none');
    //             });
    //             if (data.status === 'success') {
    //                 Swal.fire("Done!", "Profile picture updated successfully!", "success");
    //                 $(function() {
    //                     setTimeout(function() {
    //                         location.reload(true);
    //                     }, 3000);
    //                 });
    //             } else {
    //                 Swal.fire("Error updating profile picture!", "Please try again", "error");
    //             }
    //         })
    //         .catch(error => {
    //             $('.loader-overlay').fadeOut('slow', function() {
    //                 $(this).css('display', 'none');
    //             });
    //             Swal.fire("Error updating profile picture!", "Please try again", "error");
    //         });
    //     }else{
    //         $('.loader-overlay').fadeOut('slow', function() {
    //             $(this).css('display', 'none');
    //         });
    //         Swal.fire("Error!", "Please select image", "error");
    //     }
    // });

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
</script>
@endsection('content') -->
--}}



@extends('layouts.users.app')
@section('content')
<style>
    .swal2-styled.swal2-confirm {
        background-color: red !important;
    }
    .profile-picture {
        width: 150px !important;
        height: 150px !important;
        border-radius: 50% !important;
        object-fit: cover !important;
        cursor: pointer !important;
    }

    @media (max-width:991px) {
        .otherChat {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }
        .content-top {
            margin: 40px 0px 20px 0;
        }
        .chat-section {
            margin: 50px 0;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
        }
        .stGpCls{
            gap: 15px;
        }
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
            <div class="col-lg-12">
                <div class="chat-section">
                    <div>
                        <div class="d-flex align-items-center stGpCls" style="flex-wrap: wrap;">
                            <img src="{{ $getUserDetails->profile_image ? asset('f_user/'.$getUserDetails->profile_image) : asset('users-images/defaultimage.jpg') }}" alt="Profile picture" class="profile-picture" id="profile-picture">
                            <div class="" style="margin-left: 3%;">
                                <h4 class="shapeHCls">Profile Picture</h4>
                                <p>Ensure the picture is clear and shows the face of the user</p>
                                <!-- Modified button with file input inside -->
                                <label for="profile-picture-input" class="generate-button" style="cursor: pointer;">
                                    {{ $getUserDetails->profile_image ? "Replace Image" : "Upload Image" }}
                                </label>
                                <input type="file" id="profile-picture-input" style="display: none;" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <hr class="lineCls">

                    <form id="updateAccount" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="userId" id="userId" value="{{ $getUserDetails->id }}">
                        <div class="otherChat"> 
                            <div class="col-lg-5 col-sm-12">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" required class="form-control" id="name" name="name" value="{{ $getUserDetails->name }}">
                            </div>
                            <div class="col-lg-5 col-sm-12">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" readonly  tabindex="-1" onfocus="this.blur()" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{ $getUserDetails->email }}">
                            </div>
                        </div>
                        <div class="col-lg-12 giveSpaceCls">
                            <button class="btn btn-success" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="chat-section otherChat">
                    <div>    
                        <h3 class="chat-hed pb-3">Delete your account? </h3>
                        <p class="chat-hed">You will lose all your assets and it won't be recovered</p>
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
    // Preview image when selected
    document.getElementById('profile-picture-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            // Validate file type and size
            const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
            // const maxSize = 2 * 1024 * 1024; // 2MB
            
            if (!validTypes.includes(file.type)) {
                Swal.fire("Error!", "Only JPG, PNG, and GIF images are allowed", "error");
                return;
            }
            
            // if (file.size > maxSize) {
            //     Swal.fire("Error!", "Image size should be less than 2MB", "error");
            //     return;
            // }
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-picture').src = e.target.result;
                
                // Auto-upload after preview
                uploadProfilePicture(file);
            }
            reader.readAsDataURL(file);
        }
    });

    // Click on image to trigger file input
    document.getElementById('profile-picture').addEventListener('click', function() {
        document.getElementById('profile-picture-input').click();
    });

    // Function to handle the upload
    function uploadProfilePicture(file) {
        $('.loader-overlay').css('display', 'flex');
        const userId = $('#userId').val();
        const formData = new FormData();
        formData.append('profile_picture', file);
        formData.append('userId', userId);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route('profile.upload') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        })
        .then(response => response.json())
        .then(data => {
            $('.loader-overlay').fadeOut('slow', function() {
                $(this).css('display', 'none');
            });
            if (data.status === 'success') {
                Swal.fire("Done!", "Profile picture updated successfully!", "success");
                // Optional: Update the button text if this was the first upload
                const uploadBtn = document.querySelector('label[for="profile-picture-input"]');
                if (uploadBtn.textContent.trim() === "Upload Image") {
                    uploadBtn.textContent = "Replace Image";
                }
            } else {
                Swal.fire("Error updating profile picture!", data.message, "error");
                // Reset the input to allow re-selection
                document.getElementById('profile-picture-input').value = '';
            }
        })
        .catch(error => {
            $('.loader-overlay').fadeOut('slow', function() {
                $(this).css('display', 'none');
            });
            Swal.fire("Error updating profile picture!", "Please try again", "error");
            // Reset the input to allow re-selection
            document.getElementById('profile-picture-input').value = '';
        });
    }

    // Rest of your existing JavaScript (delete account, etc.)
    $("#deleteAccount").on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Delete Account?',
            text: 'You will lose all your assets and it wont be recovered',
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
                                window.location.href = response.redirect_url;
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
</script>
@endsection('content')
