<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create category</h5>
            </div>
            <div class="modal-body">
               <form id="save-form">
                 <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label" > Category name</label>
                            <input class="form-control" type="text" id="categoryName">
                        </div>
                    </div>
                 </div>
               </form>
            </div>
            <div class="modal-footer">
             <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
             <button  id="save-btn" class="btn btn-sm btn-success">Save</button>
            </div>

        </div>
    </div>
</div>

<script>

// async function Save() {

// let categoryName = document.getElementById('categoryName').value;

// if (categoryName.length === 0) {
//     errorToast("Category Required !")
// }
// else {

//     document.getElementById('modal-close').click();

//     showLoader();
//     let res = await axios.post("/create-category",{name:categoryName})
//     hideLoader();

//     if(res.status===201){

//         successToast('Request completed');

//         document.getElementById("save-form").reset();

//         await getList();
//     }
//     else{
//         errorToast("Request fail !")
//     }
// }
// }

document.getElementById('save-btn').addEventListener('click',async function () {
  
let categoryName=document.getElementById("categoryName").value
        if(categoryName.length===0){
            errorToast("category creation failed")
        } else {
            document.getElementById('modal-close').click()
            let res = await axios.post("/create-category",{name:categoryName})
            if(res.status===201){
                successToast(`${categoryName} is created successfully`)
                document.getElementById("save-form").reset()
                await getList()
            } else {
                errorToast("category failed")
            }
        }
  
})
</script>
