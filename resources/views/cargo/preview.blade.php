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
            background: #702fe9;
            border-bottom: 1px solid #702fe9;

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
                     

                     
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="information"  style="box-sizing: border-box;padding: 0;margin: 0;text-align: center">
            <td colspan="4"  style="padding: 0;margin: 0;" >
                <h1  style="padding: 0 ;margin: 0;padding-left: 10px;color:#702fe9; text-align: center;font-size: 3.5rem; ">Borker Cargo</h1>
            </td>
        </tr>
     


    

   
 


    </table>
</div>
</body>
</html>
