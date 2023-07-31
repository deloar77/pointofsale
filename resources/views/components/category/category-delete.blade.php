<div class="modal" id="delete-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body ">
                <h3 class="mt-3 text-warning">Do you want to Delete!</h3>
                <p class="mb-3">Once deleted,you cannot get it back</p>
                <input  id="deleteID">
            </div>
            <div class="modal-footer">
                <div>
                    <button type="button" id="delete-modal-close" class="btn shadow-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="itemDelete()" type="button" id="confirmDelete" class="btn shadow-sm btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function itemDelete() {
        let id = document.getElementById('deleteID').value;
        document.getElementById('delete-modal-close').click()
        let res = await axios.post('/delete-category',{id:id})
        if(res.data===1){
            successToast('category is deleted')
            await getList()
        } else {
          errorToast('delete attempt failed')
        }


        
    }
</script>