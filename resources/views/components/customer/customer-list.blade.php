<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card">

                <div class="row justify-content-between">
                    <div class="align-items-center col">
                     <h4>Create Customer</h4>
                    </div>
                    <div class="align-items-center col">
                       <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn btn-sm m-0 bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-dark"/>
                <table class="table" id="tableData">
                    <thead>
                        <tr class="bg-light" >
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
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
    async function  getList() {
        let res = await axios.get('/list-customer')
        console.log(res)
        let tableData=$('#tableData')
        let tableList = $('#tableList')
        tableData.DataTable().destroy()
        tableList.empty()

        res.data.forEach(function(item,index){
            let row = `<tr>
                           <td>${index+1}</td>
                           <td>${item['name']}</td>
                           <td>${item['email']}</td>
                           <td>${item['mobile']}</td>
                           <td>
                            <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                            <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger ">Delete</button>
                           </td>

                      
                        </tr>`

                        tableList.append(row)
        })

       $('.deleteBtn').on('click',async function(){
           let id= $(this).data('id')

           $('#delete-modal').modal('show')
           $('#deleteID').val(id)
       })

       $('.editBtn').on('click',async function () {
        let id = $(this).data('id')
        //alert(id)
         $('#updateID').val(id)
        $('#update-modal').modal('show')
       // await FillUpUpdateForm(id)
       
          })

          let table = new DataTable('#tableData',{
            order:[[0,'asc']],
            lengthMenu:[5,10,15]
  })



        
    }
</script>