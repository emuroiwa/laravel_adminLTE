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


                   <tr v-for="payment in payments" :key="payment.id">

                    <td>{{payment.id}}</td>
                    <td>{{payment.description}}</td>
                    <td>{{payment.currency}}</td>
                    <td>{{payment.payment_type }}</td>
                    <td>{{payment.amount}}</td>

                    <td>
                        <a href="#" @click="editModal(payment)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteUser(payment.id)">
                            <i class="fa fa-trash red"></i>
                        </a>

                    </td>
                  </tr> 
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
              <!-- /.card-body
              <div class="card-footer">
                  <pagination :data="payments" @pagination-change-page="getResults"></pagination>
              </div> -->
            </div>
            <!-- /.card -->
          </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                payments:{},
                form: new Form({
                    amount :'',
                    currency:'',
                    description:''
                })
            }
        },
        methods:{
            loadPayments(){
                axios.get("api/payment").then(({ data }) => (this.payments = data));
            },
             newModal(){
                this.form.reset();
                $('#addNew').modal('show');
            },
             closeModal(){
                this.form.reset();
                $('#addNew').modal('hide');
            },
            createPayment(){
                // Submit the form via a POST request
                this.$Progress.start()
                this.form.post('api/payment')
                    .then(({ data }) => {  })
                this.loadPayments();
                this.$Progress.finish()
                swal("Good job!", "Payment Processed", "success");
                this.closeModal();
            }
        },
        mounted() {
            this.loadPayments();
            console.log('Component mounted.')
        }
    }
</script>
