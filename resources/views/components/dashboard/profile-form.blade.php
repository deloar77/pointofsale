<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn shadow">
                <div class="card-body">
                    <h4>Profile Page</h4>
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
                                <input readonly id="email" class="form-control" placeholder="Enter your email" type="email">
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
                                <button onclick="onUpdate()" class="btn btn-primary mt-3 w-100">Update</button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
 getProfile()
    async function getProfile() {
        let res = await axios.get('/user-profile')
        console.log(res)
        if(res.status===200 && res.data['status']==='success'){
            let data = res.data['data']
            console.log(data)
            document.getElementById('email').value=data['email']
            document.getElementById('firstName').value=data['firstName']
            document.getElementById('lastName').value=data['lastName']
            document.getElementById('mobile').value=data['mobile'];
            document.getElementById('password').value=data['password']

        } else {
            errorToast(res.data['message'])
        }
        
    }

  async  function onUpdate(){
        let FirstName= document.getElementById('firstName').value;
        let LastName= document.getElementById('lastName').value;
    
        let Mobile= document.getElementById('mobile').value;
        let Password= document.getElementById('password').value;
        if(FirstName.length===0){
            errorToast('firstname is required');
        } else if(LastName.length===0){
            errorToast('lastname is required')
        } else if(Mobile.length===0){
            errorToast('mobile is required');
        } else if(Password.length===0){
            errorToast('password is required')
        } else {
            let res = await axios.post("/user-update",{
                firstName:FirstName,
                lastName:LastName,
                mobile:Mobile,
                password:Password
            });
            if(res.status===200 && res.data['status']==='success'){
                successToast(res.data['message']);
                await getProfile();
            } else {
                errorToast(res.data['status'])
            }

        }

    }
</script>