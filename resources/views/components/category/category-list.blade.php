<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row flex justify-content-between">
                    <div class="align-items-center col">
                        <h4>Category</h4>
                    </div>
                    <div class="align-items-center">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 btn-sm bg-gradient-primary" >Create</button>
                    </div>
                </div>
                <hr class="bg-dark"/>
                <table class="table" id="tableData">
                    <thead>
                        <tr class="bg-light">
                            <th>No</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableList">

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
    getList()
    async function getList() {
        let res = await axios.get("/list-category")

        let tableList = $('#tableList')
        let tableData = $('#tableData')

       tableData.DataTable().destroy()
       tableList.empty()


        res.data.forEach(function(item,index){
             let row = `<tr>
                         <td>${index+1}</td>
                         <td>${item['name']}</td>
                         <td>
                            <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success" >Edit</button>
                            <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger" >Delete</button>
                         </td>
                       </tr>`
             tableList.append(row)
        })

        // tableData.DataTable({
        //     order:[[0,'asc']],
        //     lengthMenu:[5,10,15]
        // })


        //default usage
  // let table = new DataTable('#tableData')



//document.getElementsByClassName('editBtn')
//document.getElementsByClassName('deleteBtn')
   $('.editBtn').on('click',function(){
    let id = $(this).data('id')
    $('#updateID').val(id)
   $('#update-modal').modal('show')
   })

   $('.deleteBtn').on('click',function(){
    let id = $(this).data('id')
   // alert(id)
   $('#delete-modal').modal('show')
   $('#deleteID').val(id)
   })

  let table = new DataTable('#tableData',{
            order:[[0,'asc']],
            lengthMenu:[5,10,15]
  })




    }
</script>