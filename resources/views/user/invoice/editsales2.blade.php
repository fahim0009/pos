@extends('user.layouts.master')
@section('content')


<div class="inner ">
    <div class="content w-90 mx-auto">
        <div class="row gx-2">

            <div id="ermsg" class="ermsg"></div>


            <div class="col-lg-6 ">
                <div class="box">
                    <form action="">
                        <div class="row">
                            <p class="poppins-bold txt-primary">Sales</p>
                            <div class="row">
                                <div class="col-lg-6 ">

                                    <div class="form-group mb-3 mx-1 flex-fill">
                                        <label for="">Barcode</label>
                                        <input type="text" class="form-control ">
                                    </div>
                                    <div class="form-group mb-3 mx-1 flex-fill">
                                        <label for="">Product</label>
                                        <select name="product" id="product" class="form-control selectproduct">
                                            <option value="">Please select</option>
                                            @foreach (\App\Models\Product::select('id','productname','part_no')->get() as $product)
                                            <option value="{{$product->id}}">{{$product->productname}}-{{$product->part_no}}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>

                                    
                                    <div class="form-group mb-3 mx-1 flex-fill">
                                        <label for="">Product Name: <span id="proname" class="btn btn-theme"></span> </label>
                                        <input type="hidden" class="form-control " name="order_id" id="order_id" value="{{$invoices->id}}">
                                    </div>

                                    <div class="form-group mb-3 mx-1 flex-fill">
                                        <label for=""> Barcode: </label>
                                    </div>
                                    <div class="form-group mb-3 mx-1 flex-fill">
                                        <label for="">Stock Availibility: <span id="availablestock" class="btn btn-theme"></span></label>
                                    </div>
                                </div>
                                <div class="col-lg-6 ">

                                    <div class="form-group mb-3 mx-1 flex-fill">
                                        <label for="">Date</label>
                                        <input type="date" id="orderdate" name="orderdate" value="{{ $invoices->orderdate }}" class="form-control ">
                                    </div>
                                    
                                    <div class="form-group mx-1 flex-fill">
                                        <label for="">Customer </label>
                                        <select name="customers" id="customers" class="form-control selectcustomer">
                                            {{-- <option value="">Please select</option>
                                            @foreach (\App\Models\Customer::where('status','=','1')->get(); as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name}}-{{$customer->phone}}</option>
                                            @endforeach --}}
                                        </select>
                                        <a href="#" class="btn btn-sm btn-theme ms-1" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">+</a>
    
                                    </div>
    
                                    <div class="form-group mb-3 mx-1 flex-fill">
                                        <label for="">Name: </label>
                                        <input type="text" id="showcustomername" class="form-control " value="{{ $invoices->customer->name }}">
                                        <input type="hidden" id="customer_id"  name="customer_id" value="{{ $invoices->customer->id }}">
                                    </div>
    
                                    <div class="form-group mb-3 mx-1 flex-fill">
                                        <label for="">Address</label>
                                        <input type="text" id="showcustomeraddress" class="form-control " value="{{ $invoices->customer->address }}">
                                    </div>
                                    <div class="form-group mb-3 mx-1 flex-fill">
                                        <label for="">Vehicle no</label>
                                        <input type="text" id="showcustomervehicleno" class="form-control " value="{{ $invoices->customer->vehicleno }}">
                                    </div>
                                    <div class="form-group mb-3 mx-1 flex-fill">
                                        <label for="">Reference</label>
                                        <input type="text" id="ref" class="form-control " value="{{$invoices->ref }}">
                                    </div>

                                </div> 
                                
                                <div class="col-lg-12" id="chkbranchstocktable">
                                    <div class="stockreqermsg"></div>
                                    <table class="table table-striped table-hover stocktable">
                                        <thead>
                                            <tr>
                                                <td>Branch</td>
                                                <td>Quantity</td>
                                                <td class="text-center">Action</td>
                                            </tr>
                                        </thead>                                   
                                        <tbody>
                                             
                                        </tbody>
                                    </table>
                                </div> 
                            </div>
                        </div>
                </div>
                </form>
            </div>



            <div class="col-lg-3 ">
                <form action="">
                    <div class="box">
                        <div class="row">
                            <p class="poppins-bold txt-primary">Calculation</p>
                            <div class="col-lg-12">
                                <div class="form-group mb-3 mx-1 flex-fill">
                                    <label for="">Grand Total</label>
                                    <input type="number" id="grand_total" name="grand_total" class="form-control" value="{{$invoices->grand_total }}" readonly>
                                </div>

                                <div class="form-group mb-3 mx-1 flex-fill">
                                    <label for="">Total Vat</label>
                                    <input type="number" id="vat_total" name="vat_total" class="form-control " readonly>
                                </div>

                                <div class="form-group mb-3 mx-1 flex-fill">
                                    <label for="">Discount Type</label>
                                    <select name="discounttype" id="discounttype" class="form-control ">
                                        <option value="">Select</option>
                                        <option value="percent">Percent</option>
                                        <option value="amount">Amount</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 mx-1 flex-fill" id="dpercent">
                                    <label for="">Discount Percent</label>
                                    <input type="number" id="discount_percent" maxlength="2" name="discount_percent" class="form-control ">
                                </div>

                                <div class="form-group mb-3 mx-1 flex-fill" id="damount">
                                    <label for="">Discount Amount</label>
                                    <input type="number" id="discount_amount" name="discount_amount" class="form-control ">
                                </div>
                                <div class="form-group mb-3 mx-1 flex-fill">
                                    <label for="">Total Vat Amount</label>
                                    <input type="number" id="net_vat_amount" name="net_vat_amount" class="form-control" readonly>
                                </div>
                                <div class="form-group mb-3 mx-1 flex-fill">
                                    <label for="">Net Amount</label>
                                    <input type="number" id="net_total" name="net_total" class="form-control" value="{{$invoices->net_total }}" readonly>
                                </div>

                                <div class="form-group mb-3 mx-1 flex-fill">
                                    <label for="">Customer Paying</label>
                                    <input type="number" id="customer_paid" name="customer_paid" class="form-control" value="{{$invoices->customer_paid }}">
                                </div>
                                <div class="form-group mb-3 mx-1 flex-fill">
                                    <label for="">Due</label>
                                    <input type="number" id="due" name="due" min="0" class="form-control" value="{{$invoices->due }}" readonly>
                                </div>
                                <div class="form-group mb-3 mx-1 flex-fill">
                                    <label for="">Return Amount</label>
                                    <input type="number" id="return_amount" name="return_amount" class="form-control"  value="{{$invoices->return_amount }}"readonly>
                                </div>



                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-3 ">
                <form action="">
                    <div class="box">
                        <div class="row">
                            <p class="poppins-bold txt-primary">Payments</p>
                            <div class="col-lg-12">
                                <div class="form-group mx-1 flex-fill">
                                    <select name="" id="" class="form-control">
                                        <option value="">Please select</option>
                                        @foreach (\App\Models\PaymentMethod::where('status','=','1')->get(); as $method)
                                        <option value="{{$method->id}}">{{$method->name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" id="payment_amount" name="payment_amount" class="form-control ms-1">
                                <a class="btn btn-sm btn-theme ms-1 add-payment-row" id="addpaymentrow">+</a>
                                </div>
                                <div id="paymentinner">

                                </div>
                            </div>
                            <div class="col-lg-12">
                                    <button class="btn btn-theme mt-2" id="updateOrderBtn" type="button">Update</button>
                                </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <div class="row mx-auto"> 
            <div class="box">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td>Product</td>
                            <td>Code</td>
                            <td>Location</td>
                            <td>Vat%</td>
                            <td>Vat Amount</td>
                            <td>Quantity</td>
                            <td>Unit Price</td>
                            <td>Total</td> 
                            <td>Action</td>
                        </tr>
                    </thead>                                   
                    <tbody id="inner">
                        @foreach ($invoices->orderdetails  as $salesdetail)
                            
                        <tr>
                            <td style="display:inline-flex;">
                                <input name="productname[]" type="text" value="{{$salesdetail->product->productname}}" class="form-control" readonly>
                            </td>
                            <td>
                                <input name="part_no[]" type="text" value="{{$salesdetail->product->part_no}}" class="form-control" readonly>
                            </td>
                            <td>
                                <input name="location[]" type="text" value="{{$salesdetail->product->location}}" class="form-control" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="vat_percent[]" value="{{$salesdetail->product->vat_percent}}" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control uvatamount" name="vat_amount[]" value="{{$salesdetail->product->vat_amount}}" readonly>
                                <input type="hidden" class="form-control vatamount" name="net_vat_amount[]" value="{{$salesdetail->total_vat}}" readonly>
                            </td>
                            <td>
                                <input type="number" class="form-control quantity" name="quantity[]" min="1" value="{{$salesdetail->quantity}}" placeholder="Type quantity">
                            </td>
                            <td>
                                <input name="sellingprice[]" type="text" value="{{$salesdetail->sellingprice}}" class="form-control uamount" readonly>
                                <input type="hidden" name="product_id[]" value="{{$salesdetail->product_id}}">
                            </td>
                            <td>
                                <input name="total[]" type="text" value="{{$salesdetail->total_amount}}" class="form-control total" readonly>
                            </td>
                            <td width="50px"><div style="color: white;  user-select:none;  padding: 5px;    background: red;    width: 45px;    display: flex;    align-items: center; margin-right:5px;   justify-content: center;    border-radius: 4px;   left: 4px;    top: 81px;" onclick="removeRow(event)" >X</div>
                            </td>



                        </tr>
                        @endforeach
                         
                    </tbody>
                </table>
            </div> 
    </div>
    </div>

</div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Customer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-custom" id="customer-form">
                        {{csrf_field()}}
                        <div class="form-group">
                        <label for="member_id" class="col-sm-3 control-label">Member ID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="member_id" name="member_id" placeholder="Unique member ID"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" id="name"
                                   placeholder="ex. John Doe" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" name="email" class="form-control " id="email"
                                   placeholder="ex. test@gmail.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-3 control-label">Phone</label>
                        <div class="col-sm-9">
                            <input type="text" name="phone" class="form-control " id="phone"
                                   placeholder="ex. 0123456789">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Address</label>
                        <div class="col-sm-9">
                                <textarea class="form-control" id="address" rows="3" placeholder="1355 Market Street, Suite 900 San Francisco, CA 94103 P: (123) 456-7890" name="address"></textarea>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Vehicle No</label>
                        <div class="col-sm-9">
                            <input type="text" name="vehicleno" class="form-control" id="vehicleno"
                                   placeholder="ex. 012586" required>
                        </div>
                    </div> 
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-btn">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- stock request modal  --}}

    <div class="modal fade" id="reqStockModal" tabindex="-1" aria-labelledby="reqStockModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="reqStockModalLabel">Product stock request</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-custom" id="stockReqForm">
                        {{csrf_field()}}
                    <div class="form-group">
                        <label for="quantity" class="col-sm-3 control-label">Quantity</label>
                        <div class="col-sm-9">
                            <input type="number" name="quantity" class="form-control" id="quantity" required>
                            <input type="hidden" name="productid" class="form-control" id="productid">
                            <input type="hidden" name="stockid" class="form-control" id="stockid">
                            <input type="hidden" name="reqtobranchid" class="form-control" id="reqtobranchid">
                        </div>
                    </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary req-save-btn">Request</button>
                </div>
            </div>
        </div>
    </div>

@endsection
    
@section('script')

<script>
    $(document).ready(function() {
        // Select2 Multiple
        $('.selectproduct').select2({
            placeholder: "Select",
            allowClear: true
        });

        $('.selectcustomer').select2({
            placeholder: "Select",
            allowClear: true
        });

    });

</script>

<script type="text/javascript">

        function removePaymentRow(event) {
            event.target.parentElement.parentElement.remove();
        }

        $("#addpaymentrow").click(function() {
                var pmarkup = '<tr><td><div class="form-group mx-1 flex-fill"><select name="" id="" class="form-control"><option value="">Please select</option><option value="">Cash</option><option value="">Bank</option><option value="">Card</option></select><input type="number" id="payment_amount" name="payment_amount" class="form-control ms-1"><a class="btn btn-sm btn-theme ms-1" onclick="removePaymentRow(event)">-</a></div></td></tr>';
                $("div #paymentinner ").append(pmarkup);
            });
 
            $("#damount").hide();
            $("#dpercent").hide();
            $("#discounttype").change(function(){
                $(this).find("option:selected").each(function(){
                    var val = $(this).val();
                    if( val == "amount" ){
                        $('#discount_percent').val("0");
                        $('#discount_amount').val("0");
                        $("#damount").show();
                        $("#dpercent").hide();
                    }else if(val == "percent"){
                        $('#discount_percent').val("0");
                        $('#discount_amount').val("0");
                        $("#dpercent").show();
                        $("#damount").hide();
                    }else{          
                        $('#discount_percent').val("0");
                        $('#discount_amount').val("0");
                        $("#damount").hide();
                        $("#dpercent").hide();
                    }
                });
            }).change();

            


        function removeRow(event) {
            event.target.parentElement.parentElement.remove();
            net_total();
            net_total_vat();   
            }
        function net_total(){
                    var grand_total=0;
                    $('.total').each(function(){
                        grand_total += ($(this).val()-0);
                    })
                    $('#grand_total').val(grand_total.toFixed(2));
                }
        function net_total_vat(){
            var vat_total=0;
            $('.vatamount').each(function(){
                vat_total += ($(this).val()-0);
            })
            $('#net_vat_amount').val(vat_total.toFixed(2));
        }

        
        $("#chkbranchstocktable").hide();

    $(document).ready(function() {
        // header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        // 

        var urlbr = "{{URL::to('/user/getproduct')}}";
            $("#product").change(function(){
		            event.preventDefault();
                    var product = $(this).val();
                    $.ajax({
                    url: urlbr,
                    method: "POST",
                    data: {product:product},

                    success: function (d) {
                        if (d.status == 303) {

                        }else if(d.status == 300){
                            // console.log(d);
                            
                            if (d.chkstock == 0) {
                                $("#chkbranchstocktable").show();
                                var stocktable = $(".stocktable tbody");
                                stocktable.empty();
                                $.each(d.stocks, function (a, b) {
                                    stocktable.append("<tr><td class='text-left'>" + b.branchname + "</td>" +
                                        "<td class='text-success text-left'>" + b.quantity + "</td>" +
                                        "<td class='text-center'><a href='#' id='transferBtn' pid='" + d.product_id + "'  class='btn btn-sm btn-theme ms-1' branchid='" + b.branch_id + "' stockid='" + b.id + "' data-bs-toggle='modal' data-bs-target='#reqStockModal' >Request to transfer</a></td>" +
                                        "</tr>");
                                });
                                

                            } else {

                                $("#chkbranchstocktable").hide();
                                var markup = '<tr class="item-row pdetails" style="position:realative;"><td style="display:inline-flex;"><input name="productname[]" type="text" value="'+d.productname+'" class="form-control" readonly></td><td><input type="text" class="form-control" name="part_no[]" value="'+d.part_no+'" readonly></td><td><input type="text" class="form-control" name="location[]" value="'+d.location+'" readonly></td><td><input type="text" class="form-control" name="vat_percent[]" value="'+d.vat_percent+'" readonly></td><td><input type="text" class="form-control uvatamount" name="vat_amount[]" value="'+d.vat_amount+'" readonly><input type="hidden" class="form-control vatamount" name="net_vat_amount[]" value="'+d.vat_amount+'" readonly></td><td><input type="number" class="form-control quantity" name="quantity[]" min="1" value="1" placeholder="Type quantity"></td><td><input name="sellingprice[]" type="text" value="'+d.selling_price_with_vat+'" class="form-control uamount"><input type="hidden" name="product_id[]" value="'+d.product_id+'"></td><td><input name="total[]" type="text" value="'+d.selling_price_with_vat+'" class="form-control total"></td><td width="50px"><div style="color: white;  user-select:none;  padding: 5px;    background: red;    width: 45px;    display: flex;    align-items: center; margin-right:5px;   justify-content: center;    border-radius: 4px;   left: 4px;    top: 81px;" onclick="removeRow(event)" >X</div></td></tr>';
                                $("table #inner ").append(markup);
                                net_total();
                                net_total_vat();
                                
                            }
                            // alternatives
                            $("#chkalternativetable").show();
                            var altertable = $(".altertable tbody");
                            altertable.empty();
                            $.each(d.alternatives, function (a, b) {
                                altertable.append("<tr><td class='text-left'>" + b.productname + "</td>" +
                                    "<td class='text-success text-left'>" + b.part_no + "</td>" +
                                    "<td class='text-success text-left'>" + b.selling_price + "</td>" +
                                    "</tr>");
                            });
                            // alternatives end

                            // replacements
                            $("#chkreplacementtable").show();
                            var replacetable = $(".replacetable tbody");
                            replacetable.empty();
                            $.each(d.replacements, function (a, b) {
                                replacetable.append("<tr><td class='text-left'>" + b.replacementid + "</td>" +
                                    "</tr>");
                            });
                            // replacements end

                        $("#proname").html(d.productname);   
                        $("#availablestock").html(d.chkstock);   
                        }
                    },
                    error: function (d) {
                        console.log(d);
                    }
                });

                });
        
        // stock request modal show start
        
        $("#chkbranchstocktable").on('click','#transferBtn', function(){
            
                productid = $(this).attr('pid');
                stockid = $(this).attr('stockid');
                branchid = $(this).attr('branchid');
                // console.log(branchid, productid, stockid);
                $('#reqStockModal').find('.modal-body #productid').val(productid);
                $('#reqStockModal').find('.modal-body #stockid').val(stockid);
                $('#reqStockModal').find('.modal-body #reqtobranchid').val(branchid);
                
            });
        // end

        




        // change quantity start  
        $("body").delegate(".quantity","change",function(event){
            event.preventDefault();
            var row = $(this).parent().parent();
            var price = row.find('.uamount').val();
            var vatamount = row.find('.uvatamount').val();
            // var update_id = row.find('.price').attr("update_id");
            var qty = row.find('.quantity').val();
                if (isNaN(qty)) {
                    qty = 1;
                }
                if (qty < 1) {
                    qty = 1;
                }
            var total = price * qty;
            var totalvat = vatamount * qty;
            row.find('.total').val(total.toFixed(2));

            var grand_total=0;
            var vat_total=0;
            $('.total').each(function(){
                grand_total += ($(this).val()-0);
            })
            $('.vatamount').each(function(){
                vat_total += ($(this).val()-0);
            })
            $('#net_vat_amount').val(vat_total.toFixed(2));
            $('#grand_total').val(grand_total.toFixed(2));
            $('#net_total').val(grand_total.toFixed(2));
            // $('#ttm').html("<input type='hidden' class='ttm' name='ttm' value="+grand_total+">"); 
            net_total();       
            net_total_vat();       
        })
        //Change Quantity end here    

       var orderurl = "{{URL::to('/user/order-update')}}";

        // $("#addvoucher").click(function(){

            $("body").delegate("#updateOrderBtn","click",function(event){
                event.preventDefault();

                

              var order_id = $("#order_id").val();
              var orderdate = $("#orderdate").val();
                var customer_id = $("#customer_id").val();
                var customername = $("#showcustomername").val();
                var customeraddress = $("#showcustomeraddress").val();
                var customervehicleno = $("#showcustomervehicleno").val();
                var ref = $("#ref").val();
                var grand_total = $("#grand_total").val();
                var net_total = $("#net_total").val();

                var discounttype = $("#discounttype").val();
                var discount_percent = $("#discount_percent").val();
                var discount_amount = $("#discount_amount").val();
                var vat_total = $("#vat_total").val();
                var customer_paid = $("#customer_paid").val();
                var due = $("#due").val();
                var return_amount = $("#return_amount").val();

            var product_id = $("input[name='product_id[]']")
              .map(function(){return $(this).val();}).get();

            var vat_percent = $("input[name='vat_percent[]']")
            .map(function(){return $(this).val();}).get();

            var vat_amount = $("input[name='vat_amount[]']")
            .map(function(){return $(this).val();}).get();

            var sellingprice = $("input[name='sellingprice[]']")
            .map(function(){return $(this).val();}).get();

            var quantity = $("input[name='quantity[]']")
              .map(function(){return $(this).val();}).get();

            var total = $("input[name='total[]']")
              .map(function(){return $(this).val();}).get();


                $.ajax({
                    url: orderurl,
                    method: "POST",
                    data: {order_id,product_id,vat_percent,vat_amount,sellingprice,quantity,total,net_total,orderdate,customer_id,grand_total,customername,customeraddress,customervehicleno,ref,discounttype,discount_percent,discount_amount,vat_total,customer_paid,due,return_amount},

                    success: function (d) {
                        if (d.status == 303) {
                            $(".ermsg").html(d.message);
                            pagetop();
                        }else if(d.status == 300){
                            $(".ermsg").html(d.message);
                            pagetop();
                            window.setTimeout(function(){location.reload()},2000)
                            
                        }
                    },
                    error: function (d) {
                        console.log(d);
                    }
                });

        });


        function net_total(){
                    var grand_total=0;
                    $('.total').each(function(){
                        grand_total += ($(this).val()-0);
                    })
                    $('#grand_total').val(grand_total.toFixed(2));
                    $('#net_total').val(grand_total.toFixed(2));
                }

        function net_total_vat(){
            var vat_total=0;
            $('.vatamount').each(function(){
                vat_total += ($(this).val()-0);
            })
            $('#net_vat_amount').val(vat_total.toFixed(2));
        }


                // customer destails 

        var urlcustomer = "{{URL::to('/user/getcustomer')}}";
            $("#customers").change(function(){
		            event.preventDefault();
                    var customer_id = $(this).val();
                    $.ajax({
                    url: urlcustomer,
                    method: "POST",
                    data: {customer_id:customer_id},

                    success: function (d) {
                        if (d.status == 303) {

                        }else if(d.status == 300){
                            $("#customer_id").val(d.customer_id);
                            $("#showcustomername").val(d.customername);
                            $("#showcustomeraddress").val(d.address);
                            $("#showcustomervehicleno").val(d.vehicleno);
                           
                        }
                    },
                    error: function (d) {
                        console.log(d);
                    }
                });

            });

            // calculation start 
			$("#discount_amount").keyup(function(){
				var dInput = this.value;
				var grand_total = $("#grand_total").val();
				var net_total = grand_total - dInput;

				$('#net_total').val(net_total.toFixed(2));
            });

            $("#discount_percent").keyup(function(){
				var dInput = this.value;
				var grand_total = $("#grand_total").val();
				var disAmount = grand_total * (dInput/100);
				var net_total = grand_total - disAmount;

				$('#net_total').val(net_total.toFixed(2));
            });

            $("#customer_paid").keyup(function(){
				var paidAmount = this.value;
				var net_total = $("#net_total").val();
				var due = net_total - paidAmount;
                if (due < 0) {
                    $('#due').val("0");
                    $('#return_amount').val(due.toFixed(2));
                } else {
                    $('#due').val(due.toFixed(2));
                    $('#return_amount').val("0");
                }
				
            });

           
            //calculation end



            

            // customer load

            var urlcustomerload = "{{URL::to('/user/customer/active')}}";
            customer_load();
            function customer_load() {
                $.ajax({
                    url: urlcustomerload,
                    type: 'GET',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (response) {
                        $('#customers').empty();
                        $('#customers').append('<option selected value="" disabled>Select a Customer</option>');
                        $.each(response, function (i, customer) {
                            let namePhone = customer.name;
                            if (customer.phone) {
                                namePhone += ` (${customer.phone})`;
                            }
                            $('#customers').append($('<option>', {
                                value: customer.id,
                                text: namePhone
                            }));
                        });
                    },
                    error: function (err) {
                        console.log(err.responseText);
                        alert("Something Went wrong, Please check & Try again...");
                    }

                });
            }



            var customerurl = "{{URL::to('/user/customers')}}";
            
            $(document).on('click', '.save-btn', function () {
                let formData = $('#customer-form').serialize();
                
                $.ajax({
                    url: customerurl,
                    type: 'POST',
                    data: formData,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (response) {
                        // console.log(response);
                        $('#exampleModal').modal('toggle');
                        $("#customers").val("").trigger('change');
                        $("#customer_id").val(response.id);
                        $("#showcustomername").val(response.name);
                        $("#showcustomeraddress").val(response.address);
                        $("#showcustomervehicleno").val(response.vehicleno);
                    },
                    error: function (err) {
                        console.log(err);
                        alert("Something Went Wrong, Please check again");
                    }
                });
            });


            var stockrequrl = "{{URL::to('/user/stock-request')}}";
            
            $(document).on('click', '.req-save-btn', function () {
                let formData = $('#stockReqForm').serialize();
                
                $.ajax({
                    url: stockrequrl,
                    type: 'POST',
                    data: formData,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (response) {
                        console.log(response);
                        $('#reqStockModal').modal('toggle');
                        $(".stockreqermsg").html(response.message);
                        // $("#customers").val("").trigger('change');
                        // $("#customer_id").val(response.id);
                    },
                    error: function (err) {
                        console.log(err);
                        alert("Something Went Wrong, Please check again");
                    }
                });
            });


            
        

});
</script>
@endsection