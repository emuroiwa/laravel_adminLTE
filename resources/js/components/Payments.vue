<template>
    <div class="container">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Payments</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">New Payment <i class="fas fa-plus fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>Receipt Number</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Transaction Type</th>
                        <th>Amount</th>
                       
                  </tr>


                  <!-- <tr v-for="user in users.data" :key="user.id">

                    <td>{{user.id}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.type | upText}}</td>
                    <td>{{user.created_at | myDate}}</td>

                    <td>
                        <a href="#" @click="editModal(user)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteUser(user.id)">
                            <i class="fa fa-trash red"></i>
                        </a>

                    </td>
                  </tr> -->
                </tbody></table>
              </div>
               <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"  id="addNewLabel">Make New Payment</h5>
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="createPayment">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input v-model="form.amount" type="number" step="any" name="amount"
                                        placeholder="Amount"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('amount') }">
                                    <has-error :form="form" field="amount"></has-error>
                                </div>
                                <div class="form-group">
                                    <input v-model="form.currency" type="currency" step="any" name="currency"
                                        placeholder="currency"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('currency') }">
                                    <has-error :form="form" field="currency"></has-error>
                                </div>
                                <div class="form-group">
                                    <textarea v-model="form.description" type="description" step="any" name="description"
                                        placeholder="description"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
                                    </textarea>
                                    <has-error :form="form" field="currency"></has-error>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Pay</button>
                    
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="users" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                form: new Form({
                    amount :'',
                    currency:'',
                    description:''
                })
            }
        },
        methods:{
             newModal(){
                this.form.reset();
                $('#addNew').modal('show');
            },
            createPayment(){
                // Submit the form via a POST request
                this.form.post('api/payment')
                    .then(({ data }) => { console.log(data) })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
