<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Broker-Cargo-{{  now()->format('F-Y') }}</title>
    <link rel="shortcut icon" href="#" />

    <style>
        *{
            text-transform: uppercase;

        }
        html,body{
            padding: 0;
            margin: 0;
        }
        .invoice-box {

            margin: auto;
            padding: 30px;
            /*box-shadow: 0 0 10px rgba(219, 163, 177, 0.76);*/
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: left;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #e65f88;
            border-bottom: 1px solid #e65f88;

            color:#fff;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{

        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {

            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: left;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="4">
                <table>
                    <tr>
                        <td class="title" style="padding-top: 25px;">

                            @if ($information->user_image ==='/storage/images/users/default/default.png')
                                <h6> {{$information->name_user}}</h6>
                            @else
                                <img style="width:200px;height: 200px" src="{{asset($information->user_image)}}">
                            @endif
                        </td>

                        <td style="text-align: left;">
                            @if ($information->user_image ==='/storage/images/users/default/default.png')
                                <h2></h2>
                            @else
                                <h2> {{$information->name_user}}</h2>
                            @endif
                            <span style ="font-weight: bold;font-size: 16px">{{isset($information->street1_user)?$information->street1_user   . ',':''}} {{$information->street2_user}}</span><br>
                            <span style ="font-weight: bold;font-size: 16px">{{isset( $information->city_user )?$information->city_user . ',':''}} {{$information->country_user}} </span><br>
                            <span style ="font-weight: bold;font-size: 16px"> {{$information->country_user}} </span><br>
                            <span style ="font-weight: bold;font-size: 16px"> {{$information->email_user}}</span> <br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="information"  style="box-sizing: border-box;padding: 0;margin: 0;text-align: center">
            <td colspan="4"  style="padding: 0;margin: 0;" >
                <h1  style="padding: 0 ;margin: 0;padding-left: 10px;color:#e65f88; text-align: center;font-size: 3.5rem; ">INVOICE</h1>
            </td>
        </tr>
        <tr class="information">
            <td colspan="4">
                <table>
                    <tr>
                        <td>
                            <h3>BILL TO</h3>
                            <b  style="font-size: 16px; "><b>Matched Target</b></b><br>
                            <b  style="font-size: 16px; ">{{$information->street1_matched}},{{$information->street2_matched}} </b><br>
                            <b  style="font-size: 16px; ">{{$information->city_matched}} {{$information->country_matched}} </b> <br>
                            <b  style="font-size: 16px; ">{{$information->email_matched}}</b> <br>
                        </td>
                        <td style="padding-top: 7%; font-size: 16px">
                            <span style="display: block;font-size: 16px;"><b>INVOICE NUMBER:</b> {{$inv->number}}</span>
                            <span style="display: block;font-size: 16px;"><b>DATE:</b> {{$inv->created_at->format('Y-m-d')}}</span>
                            <span style="display: block;font-size: 16px;"><b>DUE DATE:</b> {{$inv->due_to}}</span>
                            <span style="display: block;font-size: 16px;"><b>TERMS:</b> NET 30</span>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>


        <tr class="heading" style="width: 100%" >
            <td style="border: 1px solid #e65f88;" > ACTIVITY</td>
            <td style="border: 1px solid #e65f88;" >DESCRIPTION</td>

            {{--            <td>--}}
            {{--                MATCHED REQUEST--}}
            {{--            </td>--}}
            <td style="border: 1px solid #e65f88;" colspan="2">AMOUNT</td>
        </tr>

        <tr class="details"   style="width: 100%">

            <td  style="border: 1px solid #e65f88;" >DISPLAY ADS</td>
            <td  style="border: 1px solid #e65f88;">STANDARD ADX ADS</td>

            {{--            <td>--}}
            {{--                <b>$</b>{{' '. number_format(0,2,".",",")}}--}}
            {{--            </td>--}}

            <td colspan="2"  style="border: 1px solid #e65f88;"   >
                    <b>$</b> {{' '.number_format($inv->revenue_after_cut,2,'.',',')}}
                </td>
        </tr>

        <tr class="total">
            <td></td>
            <td></td>
            <td>
                <span > SUBTOTAL  </span>
            </td>
            <td><span >
                        <b>$</b> {{' '.number_format($inv->revenue_after_cut,2,'.',',')}}
                    </span></td>
        </tr>
        <tr class="total">
            <td></td>
            <td></td>
            <td>
                <span > TAX  </span>
            </td>
            <td>
                <span ><b>$</b> {{' '.number_format(0,2,'.',',')}}</span>
            </td>
        </tr>

        <tr class="total">
            <td></td>
            <td></td>
            <td>
                <span > TOTAL  </span>

            </td>
            <td><span >
                        <b>$</b> {{' '.number_format($inv->revenue_after_cut,2,'.',',')}}
                 </span></td>
        </tr>

        <tr class="total">
            <td></td>
            <td></td>
            <td>
                <span > BALANCE DUE  </span>

            </td>
            <td>
                        <b> $</b> {{' '.number_format($inv->revenue_after_cut,2,'.',',')}}

                </td>
        </tr>
        @if (isset($information))
            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>

                                @if ($information->payment_type === 'bank')
                                    <b style="text-transform: uppercase;font-size: 16px; font-weight: bold"><span >PAYMENT ISSUED VIA </span> Bank Transfer</b><br>

                                    <span><b>bank name:  </b>{{$information->bank_name}}  </span> <br>
                                    <span><b>beneficiary name:  </b>{{$information->beneficiary_name}}  </span> <br>
                                    <span style="text-transform: uppercase;font-size: 16px; font-weight: bold"><b>account number/Iban:  </b>{{$information->account_number}}  </span> <br>


                                    {{--                                    <span style="text-transform: uppercase;font-size: 16px; font-weight: bold"><b>bank branch:  </b>{{$information->bank_branch}}  </span> <br>--}}
                                    {{--                                    <span style="text-transform: uppercase;font-size: 16px; font-weight: bold"><b>beneficiary address:  </b>{{$information->beneficiary_address}}  </span> <br>--}}

{{--                                    <span style="text-transform: uppercase;font-size: 16px; font-weight: bold"><b>iban:  </b>{{$information->iban}}  </span> <br>--}}
                                    <span style="text-transform: uppercase;font-size: 16px; font-weight: bold"><b>swift bic code:  </b>{{$information->swift_bic_code}}  </span> <br>

                                    {{--                                    <span style="text-transform: uppercase;font-size: 16px; font-weight: bold"><b>country:  </b>{{$information->country}}  </span> <br>--}}
                                @endif
                                @if ($information->payment_type === 'vodafone')
                                    <b style="text-transform: uppercase;font-size: 16px; font-weight: bold"><span >PAYMENT ISSUED VIA </span> Vodafone</b><br>
                                    <span style="text-transform: uppercase;font-size: 16px; font-weight: bold"><b>Number:  </b> +20-{{$information->number_vodafone}}  </span> <br>
                                @endif
                                @if ($information->payment_type === 'paypal')
                                    <b style="text-transform: uppercase;font-size: 16px; font-weight: bold"><span>PAYMENT ISSUED VIA </span> Paypal</b><br>
                                    <span style="text-transform: uppercase;font-size: 16px; font-weight: bold"><b>Email:  </b><span class="text-lowercase">{{$information->email_paypal}} </span> </span> <br>
                                @endif
                                @if ($information->payment_type === 'ethereum')
                                    <b style="text-transform: uppercase;font-size: 16px; font-weight: bold"><span>PAYMENT ISSUED VIA </span>Ethereum</b><br>
                                    <span style="text-transform: uppercase;font-size: 16px; font-weight: bold"><b>Address:  </b> {{$information->adrees}}  </span> <br>
                                @endif

                            </td>

                        </tr>
                    </table>
                </td>
            </tr>
        @endif


    </table>
</div>
</body>
</html>
