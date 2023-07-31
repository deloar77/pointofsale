<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn shadow">
                <div class="card-body">
                    <h4>SIGN UP</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">

                        <div class="row m-0 p-0 ">
                            <div class="col-md-4 p-2">
                                 <label >First Name</label>
                                 <input id="firstName" class="form-control" placeholder="first name" type="text">
                            </div>
                            <div class="col-md-4 p-2">
                                <label > Last Name</label>
                                <input id="lastName" class="form-control" placeholder="last name" type="text">
                           </div>
                           <div class="col-md-4 p-2">
                                <label Email Address></label>
                                <input id="email" class="form-control" placeholder="Enter your email" type="email">
                           </div>
                           
                           <div class="col-md-4 p-2">
                              <label >Mobile number</label>
                              <input id="mobile" class="form-control" placeholder="Enter your mobile" type="mobile">
                           </div>
                           <div class="col-md-4 p-2">
                              <label >Password</label>
                              <input id="password" class="form-control" placeholder="Enter your password" type="password">
                          </div>
                          
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <button onclick="onRegistration()" class="btn btn-primary mt-3 w-100">signup</button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
  async  function onRegistration(){
        let FirstName= document.getElementById('firstName').value;
        let LastName= document.getElementById('lastName').value;
        let Email= document.getElementById('email').value;
        let Mobile= document.getElementById('mobile').value;
        let Password= document.getElementById('password').value;
        if(FirstName.length===0){
            errorToast('firstname is required');
        } else if(LastName.length===0){
            errorToast('lastname is required')
        } else if(Email.length===0){
            errorToast('email is required')
        } else if(Mobile.length===0){
            errorToast('mobile is required');
        } else if(Password.length===0){
            errorToast('password is required')
        } else {
            let res = await axios.post("/user-registration",{
                firstName:FirstName,
                lastName:LastName,
                email:Email,
                mobile:Mobile,
                password:Password
            });
            if(res.status===200 && res.data['status']==='success'){
                successToast(res.data['message']);
                setTimeout(() => {
                    window.location.href="/userLogin"
                }, 2000);
            } else {
                errorToast(res.data['status'])
            }

        }

    }
</script>