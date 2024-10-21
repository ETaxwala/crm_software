@include('ui.header')
<style>
.stamp_img{
    /* height: 200px !important; */
    max-width: 30% !important;
    
}
</style>
<main class="app-content">
    <div class="row d-print-none mt-2">
        <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:void(0);"
                onclick="printInvoice();"><i class="fa fa-print"></i> Print</a></div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <section class="invoice">
                    <div class="row mb-4">
                        <div class="col-6">
                            <h6 class="page-header">
                                <img width="200" height="170" src="{{ url('public/assets/img/logo_black_quotation.png') }}"
                                    alt="ETaxwala">
                            </h6>
                        </div>
                        <div class="col-6">
                            <h5 class="text-right">Quotation</h5>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-4">From
                            <address><b>ETaxwala Business Solutions Pvt
                                    Ltd</b><br>150, Jalna Road <br>
                                Beside Bhagwati Traders, Ambad,<br>Maharashtra 431204
                                <br><b>Email:</b> support@etaxwala.com <br>
                                <b>Phone:</b> +91 70710 70707/94206 73568 <br>
                                <b>Website:</b> <a href="https://etaxwala.com/">www.etaxwala.com</a>
                            </address>
                        </div>
                        <div class="col-4">To
                            <address>
                                <b>{{ $invoice->lead->name }}</b><br>{{ $invoice->lead->city }},
                                {{ $invoice->lead->state }}<br><b>Phone:</b>
                                {{ $invoice->lead->contact }}<br><b>Email:</b> {{ $invoice->lead->email }}
                            </address>
                        </div>
                        <div class="col-4"><b>Quotation #{{ 0 + $invoice->id }}</b><br><br><b>Date:</b>
                            {{ $invoice->created_at->format('d-M-Y') }}</div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table w-100 table-bordered  data-table">
                                <thead>
                                    <tr>
                                        <th>Service</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div style="display: none">
                                        {{ $total = 0 }}
                                    </div>
                                    @foreach ($sales as $sale)
                                        @php
                                            $items = explode(',', $sale->description);

                                        @endphp
                                        <tr>
                                            <td><b>{{ $sale->service_name }}</b>
                                                <br>
                                                @for ($i = 0; $i < count($items); $i++)
                                                    {{ $items[$i] }}
                                                    <br>
                                                @endfor
                                            </td>
                                            <td>{{ $sale->price }}</td>
                                            <td>{{ $sale->dis }}%</td>
                                            <td>{{ $sale->amount }}</td>
                                            <div style="display: none">
                                                {{ $total += $sale->amount }}
                                            </div>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><b>Total</b></td>
                                        <td><b class="total">{{ $total }}</b></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2" colspan="3">
                                            <b>Customer Seal & Signature</b>
                                        </td>

                                        <td rowspan="2" colspan="1" class="text-center">
                                            <b>Company Seal & Signature</b>
                                        </td>
                                    </tr>
                                    <tr>


                                    </tr>
                                    <tr style="height: 70px !important;">
                                        <td colspan="3"></td>
                                        <td colspan="1" class="text-center">
                                            <img class="stamp_img" src="{{ url('public/assets/img/stamp.png')}}" alt="stamp">
                                        </td>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-6 "><b>Payment Terms & Conditions</b>
                            <br><br>
                            <ol style="text-align: justify; font-size: 13px">
                                <li>This quotation is valid for 30 days from the date it is issued.</li>
                                <li>Prices and terms may change after 30 days without notice.</li>

                                <li>A 50% deposit of the total amount is required to confirm your order.</li>
                                
                                <li>Late payments will incur a fee of 1.5% per month on the outstanding balance.</li>
                                <li>If payment is not received within Due Dates, your account will be suspended, and no
                                    more services or products will be delivered until payment is made.</li>

                                <li>All quoted prices do not include taxes, duties, and other government charges unless
                                    specified.</li>
                                
                                <li>By accepting this quotation, you agree to these terms and conditions.</li>

                            </ol>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-4"><b>Account Details</b>
                            <br><br>
                            <ul>
                                <li>
                                    <b>Bank: </b>ICICI Bank
                                </li>
                                <li>
                                    <b>Account No: </b>200805008777
                                </li>
                                <li>
                                    <b>Account Holder Name: </b>ETaxwala Business Solutions Pvt Ltd
                                </li>
                                <li>
                                    <b>IFSC Code: </b>ICIC0002008
                                </li>
                                <li>
                                    <b>Branch: </b>Ambad
                                </li>
                                <li>
                                    <b>UPI ID: </b>etaxwala@icici
                                </li>
                            </ul>

                            <div>
                                <img width="200" height="170" src="{{ url('public/assets/img/qr_code.png') }}"
                                    alt="ETaxwala QR Code">
                            </div>
                        </div>

                    </div>
                    <!--<div class="row d-print-none mt-2">-->
                    <!--    <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:void(0);"-->
                    <!--            onclick="printInvoice();"><i class="fa fa-print"></i> Print</a></div>-->
                    <!--</div>-->
                </section>
            </div>
        </div>
    </div>
</main>
@include('ui.footer')

<script>
    function printInvoice() {
        window.print();
    }
</script>
