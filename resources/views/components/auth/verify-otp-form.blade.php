<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card shadow">
                <div class="card-body">
                    <h4>Enter OTP code</h4>
                    <br/>
                    <label >4 digit code here</label>
                    <input id="otp" class="form-control" placeholder="code" type="text">
                    <br/>
                    <button onclick="VerifyOtp()" class="btn w-100 float-end btn-primary">Next</button>
                </div>
            </div>

        </div>
    </div>
</div>


<script>
   async function VerifyOtp(){
    let OTP = document.getElementById('otp').value;
    if(OTP.length!==4){
        errorToast("Invalid otp")
    }
    else {
        let res = await axios.post('/verify-otp',{
           otp:OTP,
           email:sessionStorage.getItem('email')
        })
        if(res.status===200 && res.data['status']==='success'){
          successToast(res.data['message']);
          sessionStorage.clear();
          setTimeout(() => {
            window.location.href="/resetPassword"
          }, 1000);

        } else{
            errorToast(res.data['message']);

        }
        
    }
   
    }
</script>
