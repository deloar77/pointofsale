<div class="modal" id="create-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Customer</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label">Customer Name</label>
                                <input id="customerName" class="form-control"  type="text">
                                <label class="form-label">Customer Email </label>
                                <input id="customerEmail" class="form-control" type="text">
                                <label class="form-label">Customer Mobile *</label>
                                <input type="text" class="form-control" id="customerMobile">
                            </div>

                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
                <button onclick="Save()" id="save-btn" class="btn btn-sm btn-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function Save() {
        let customerName = document.getElementById('customerName').value
        let customerEmail = document.getElementById('customerEmail').value
        let customerMobile= document.getElementById('customerMobile').value

        if(customerName.length===0){
            errorToast('customer name is required')
        } else if (customerEmail.length===0){
            errorToast('customer email is required')
        } else if (customerMobile.length===0){
            errorToast('customer mobile is required')
        } else {
            document.getElementById('modal-close').click()
            let res = await axios.post('/create-customer',{name:customerName,email:customerEmail,mobile:customerMobile})
         if(res.status===201){
            successToast(`${customerName} has been created`)
            document.getElementById('save-form').reset()
            await getList()
         } else {
            errorToast('customer creation failed')
         }


        }

        
    }
</script>