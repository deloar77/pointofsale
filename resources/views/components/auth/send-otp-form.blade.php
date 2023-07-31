<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card shadow">
                <div class="card-body">
                    <h4>Email Address</h4>
                    <br/>
                    <label >Your email address</label>
                    <input id="email" class="form-control" placeholder="Enter your email" type="email">
                    <br/>
                    <button onclick="VerifyEmail()" class="btn w-100 float-end btn-primary">Next</button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    async function VerifyEmail() {
        let Email = document.getElementById('email').value;
        if(Email.length===0){
            errorToast('please enter your email address')
        } else {
            let res = await axios.post('/send-otp',{email:Email})
            if(res.status===200 && res.data['status']==='success'){
                successToast(res.data['message']);
                sessionStorage.setItem('email',Email)
                setTimeout(() => {
                    window.location.href="/verifyOtp"
                    
                }, 2000);

            } else {
                errorToast(res.data['message'])
            }
        }

        
    }
</script>