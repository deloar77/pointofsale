<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7 fadeIn col-lg-6 center-screen">
            <div class="card w-90 p-4 shadow">
                <div class="card-body">
                    <h1>SIGN IN</h1>
                    <br/>
                    <input id="email" placeholder="User Email" class="form-control" type="email">
                    <br/>
                    <input id="password" placeholder="Enter yout password"  class="form-control" type="password">
                    <br/>
                    <button onclick="submitLogin()" class="btn btn-primary w-100">Next</button>
                    <div class="float-end mt-3">
                        <span>
                            <a class="text-center ms-3 h6" href="{{url('/userRegistration')}}">Sign Up</a>
                            <span class="ms-1">|</span>
                            <a class="text-center ms-3 h6" href="{{url('/sendOtp')}}/">Forgot password</a>
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
 async   function submitLogin(){
        let email= document.getElementById('email').value;
        let password=document.getElementById('password').value
        if(email.length===0){
            errorToast("email is required");
        } else if(password.length===0) {
          errorToast("password is required")
        } else {
            let res =await axios.post('/user-login',{email:email,password:password})
             if(res.status===200 && res.data['status']==='success'){
                successToast(res.data['message'])
                window.location.href="/dashboard";
                
             } else {
                errorToast(res.data['message']);
             }
        }
    }
</script>
