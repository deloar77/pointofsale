<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card shadow">
                <div class="card-body">
                    <h4>Set new password</h4>
                    <br/>
                    <label >New password</label>
                    <input id="password" class="form-control" placeholder="code" type="password">
                    <br/>
                    <label >Confirm password</label>
                    <input id="cpassword" class="form-control" placeholder="code" type="password">
                    <br/>
                    <button onclick="ResetPassword()" class="btn w-100 float-end btn-primary">Next</button>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    async function ResetPassword() {
        let password=document.getElementById('password').value;
        let cpassword=document.getElementById('cpassword').value;

        if(password.length===0){
            errorToast('password is required');
        } else if (cpassword.length===0){
            errorToast('confirm password is required');
        } else if(password!==cpassword){
            errorToast("password and cpassword should be the same")
        } else {
            let res = await axios.post("/reset-password",{password:password})

            if(res.status===200 && res.data['status']==='success'){
                successToast(res.data['message']);

                setTimeout(() => {
                    window.location.href="/userLogin"
                }, 1000);

            } else {
                errorToast(res.data['message']);
            }
        }
        
    }
</script>

