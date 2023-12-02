<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $order->oid }}</title>

    <!-- Invoice styling -->
    <style>
        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        .invoice-box {
            margin-top: 100px;
            max-width: 800px;
            margin: auto;
            padding: 30px;
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
            border-radius: 1rem;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr td:nth-child(3) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 32px;
            line-height: 32px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
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
    </style>
</head>

<body>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td>Reklamni materijal</td>
                <td colspan="3">
                    <table>
                        <tr>
                            <td class="title">

                            </td>
                            <td>
                                {{ __('Invoice') }} #: {{ $order->oid }} <br />
                                {{ __('Created') }}: {{ $order->created_at }} <br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                {{ $order->company }}<br />
                                {{ $order->company_address }}<br />
                                PIB: {{ $order->PIB }}
                            </td>

                            <td>
                                {{ $order->first_name }} {{ $order->last_name }}<br />
                                {{ $order->phone }}<br />
                                {{ $order->email }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Sifra</td>
                <td style="text-align: center">{{ __('Name') }}</td>
                <td style="text-align: center">Kol</td>
                <td style="text-align: right">{{ __('Price') }}</td>
            </tr>

            @foreach ($order->orderProducts as $product)
                <tr class="item">
                    <td>{{ $product->meta_external_id }} </td>
                    <td style="text-align: center">
                        {{ $product->product->name }}
                        ({{ $product->product->categories[0]->name }})
                        -
                        @foreach (json_decode($product->meta_data) as $member)
                            @if ($member->value == 'Clik')
                                Bezbojna
                            @else
                                {{ $member->value }}
                            @endif
                        @endforeach
                    </td>
                    <td style="text-align: center">{{ $product->quantity }}</td>
                    <td style="text-align: right"> @priceFormat($product->product->price){{ $currency }} x
                        {{ $product->quantity }} = <b>@priceFormat($product->product->price * $product->quantity){{ $currency }}</b>
                        <br>
                        @if ($product->product->categories[0]->slug == 'olovke' || $product->product->categories[0]->slug == 'upaljaci')
                            <small> Cena štampe
                                <b>{{ $product->quantity * 0.1 }}{{ $currency }}</b>
                                ({{ $product->quantity }} x 0.1{{ $currency }})
                            </small>
                        @endif
                        @if (
                            $product->product->categories[0]->slug == 'rokovnici-i-notesi' ||
                                $product->product->categories[1]->slug == 'papirne-kese' ||
                                $product->product->categories[1]->slug == 'biorazgradive-kese')
                            <small> Cena štampe
                                <b>{{ $product->quantity * 0.5 }}{{ $currency }}</b>
                                ({{ $product->quantity }} x 0.5{{ $currency }})
                            </small>
                        @endif
                    </td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td>Medjuzbir</td>
                <td style="text-align: right; font-weight:bold">{{ $order->subtotalFormated() }}{{ $currency }}
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>{{ __('Discount') }} 5%</td>
                <td style="text-align: right; font-weight:bold">
                    {{ $order->total - $order->subtotal }}{{ $currency }}
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>{{ __('Shipping') }}</td>
                <td style="text-align: right; font-weight:bold">
                    {{ $order->shippingPriceFormated() }}{{ $currency }}
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>{{ __('Total') }} </td>
                <td style="text-align: right; font-weight:bold;font-size:20px">
                    {{ $order->totalFormated() }}{{ $currency }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
