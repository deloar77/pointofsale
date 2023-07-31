<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Name *</label>
                                <input type="text" class="form-control" id="customerNameUpdate">
                                <label class="form-label">Customer Email *</label>
                                <input type="text" class="form-control" id="customerEmailUpdate">
                                <label class="form-label">Customer Mobile *</label>
                                <input type="text" class="form-control" id="customerMobileUpdate">
                                <input type="text" class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn btn-sm  btn-success" >Update</button>
            </div>
        </div>
    </div>
</div>

<script>

    FillUpUpdateForm()
    async function FillUpUpdateForm() {
          let id = document.getElementById('updateID').value
        let res = await axios.post('/customer-by-id',{id:id})
        document.getElementById('customerNameUpdate').value=res.data['name']
        document.getElementById('customerEmailUpdate').value=res.data['email']
        document.getElementById('customerMobileUpdate').value=res.data['mobile']
        
    }

    // async function FillUpUpdateForm(id){
    //     document.getElementById('updateID').value=id;
    //     showLoader();
    //     let res=await axios.post("/customer-by-id",{id:id})
    //     hideLoader();
    //     document.getElementById('customerNameUpdate').value=res.data['name'];
    //     document.getElementById('customerEmailUpdate').value=res.data['email'];
    //     document.getElementById('customerMobileUpdate').value=res.data['mobile'];
    // }


    async function Update() {
        let name = document.getElementById('customerNameUpdate').value
        let email = document.getElementById('customerEmailUpdate').value
        let mobile = document.getElementById('customerMobileUpdate').value
        let id = document.getElementById('updateID').value
       
        if(name.length===0){
            errorToast('customer name is required')
        } else if (email.length===0){
            errorToast('customer email is required')
        } else if (mobile.length===0){
            errorToast('mobile is required')
        } else {
            document.getElementById('update-modal-close').click()
            let res = await axios.post('/update-customer',{name:name,email:email,mobile:mobile,id:id})
            if(res.status===200 && res.data===1){
                successToast(`${name} is updated`)
                document.getElementById('update-form').reset()
                await getList()
            } else {
                errorToast('customer update failed')
            }
        }
    }
</script>

