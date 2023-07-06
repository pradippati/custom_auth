<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Registration Form</h2>
                @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('wrror'))
    <div class="alert alert-danger">
        {{ session('success') }}
    </div>
@endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}" >
                        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
                    </div>

                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email"value="{{old('email')}}" class="form-control" >
                        @error('email')
        <span class="text-danger">{{ $message }}</span>
        @enderror
                    </div>

                   
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control" >
                           
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" id="togglePassword"></i>
                                </span>
                            </div>
                        </div>
                        @error('password')
        <span class="text-danger">{{ $message }}</span>
        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" >
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" id="toggleConfirmPassword"></i>
                                </span>
                            </div>
                        </div>
                        @error('password_confirmation')
        <span class="text-danger">{{ $message }}</span>
        @enderror
                    </div>

                   
                    <button type="submit" class="btn btn-primary btn-block">Register</button>

                    <a href="{{route('login')}}" class="btn btn-success btn-block">Login</a>

                </form>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });

        // Toggle confirm password visibility
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            var confirmPasswordInput = document.getElementById('password_confirmation');
            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
            } else {
                confirmPasswordInput.type = 'password';
            }
        });
    </script>
</body>
</html>
