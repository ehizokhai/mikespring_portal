            
@extends('layouts.master')

     @section('content')        
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-lg-12">
                        <div id="invoice" class="effect2">
                            <div id="invoice-top">
                                <div class="invoice-logo"></div>
                                <div class="invoice-info">
                                    <h2>john doe</h2>
                                    <p> hello@Zebramin.com <br> +8801629599859
                                    </p>
                                </div>
                                <!--End Info-->
                                <div class="title">
                                    <h4>Invoice #1069</h4>
                                    <p>Issued: February 15, 2018<br> Payment Due: February 27, 2018
                                    </p>
                                </div>
                                <!--End Title-->
                            </div>
                            <!--End InvoiceTop-->
                            <div id="invoice-mid">

                                <div class="clientlogo"></div>
                                <div class="invoice-info">
                                    <h2>Client Name</h2>
                                    <p>mariam@gmail.com<br> 555-555-5555
                                        <br>
                                </div>

                                <div id="project">
                                    <h2>Project Description</h2>
                                    <p>Proin cursus, dui non tincidunt elementum, tortor ex feugiat enim, at elementum enim quam vel purus. Curabitur semper malesuada urna ut suscipit.</p>
                                </div>

                            </div>
                            <!--End Invoice Mid-->

                            <div id="invoice-bot">

                                <div id="invoice-table">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr class="tabletitle">
                                                <td class="table-item">
                                                    <h2>Classroom</h2>
                                                </td>
                                                <td class="Hours">
                                                    <h2>Session</h2>
                                                </td>
                                                <td class="Rate">
                                                    <h2>Term</h2>
                                                </td>
                                                <td class="subtotal">
                                                    <h2>Released</h2>
                                                </td>
                                                <td class="subtotal">
                                                    <h2>Action</h2>
                                                </td>
                                            </tr>
                                         @foreach($getCummulative as $cummulative)
                                            <tr class="service">
                                                <td class="tableitem">
                                                    <p class="itemtext">{{$cummulative->classroom->name}}</p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">{{$cummulative->session->name}}</p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">{{$cummulative->term->name}}</p>
                                                </td>
                                                <td class="subtotal">
                                                 @if($cummulative->released == 'false')
                                                    <p style="color:red">Not yet released</p>
                                                 @else 
                                                  <p style="color:green">Released</p>
                                                 @endif   
                                                </td>
                                                <td class="tableitem">
                                                @if($cummulative->released == 'true' && $cummulative->checked == 'false')
                                                    <button class="btn btn-primary" >Enter pin <button>
                                                @elseif($cummulative->released == 'true' && $cummulative->checked == 'true')
                                                <button class="btn btn-success" >Enter pin <button>
                                                @endif
                                                </td>
                                            </tr>
                                          @endforeach
                                            <tr class="service">
                                                <td class="tableitem">
                                                    <p class="itemtext">Asset Gathering</p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">3</p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">$75</p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">$225.00</p>
                                                </td>
                                            </tr>

                                            <tr class="service">
                                                <td class="tableitem">
                                                    <p class="itemtext">Design Development</p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">5</p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">$75</p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">$375.00</p>
                                                </td>
                                            </tr>

                                            <tr class="service">
                                                <td class="tableitem">
                                                    <p class="itemtext">Animation</p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">20</p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">$75</p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">$1,500.00</p>
                                                </td>
                                            </tr>

                                            <tr class="service">
                                                <td class="tableitem">
                                                    <p class="itemtext">Animation Revisions</p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">10</p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">$75</p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">$750.00</p>
                                                </td>
                                            </tr>

                                            <tr class="service">
                                                <td class="tableitem">
                                                    <p class="itemtext"></p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">HST</p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">13%</p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">$419.25</p>
                                                </td>
                                            </tr>


                                            <tr class="tabletitle">
                                                <td></td>
                                                <td></td>
                                                <td class="Rate">
                                                    <h2>Total</h2>
                                                </td>
                                                <td class="payment">
                                                    <h2>$3,644.25</h2>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!--End Table-->

                                <form action="#" method="post" target="_top" class="m-t-15">
                                    <input type="image" src="images/paypal.png" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                </form>


                                <div id="legalcopy">
                                    <p class="legal"><strong>Thank you for your business!</strong> Payment is expected within 31 days; please process this invoice within that time. There will be a 5% interest charge per month on late invoices.
                                    </p>
                                </div>

                            </div>
                            <!--End InvoiceBot-->
                        </div>
                        <!--End Invoice-->
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
         @endsection   
            <!-- End Container fluid  -->