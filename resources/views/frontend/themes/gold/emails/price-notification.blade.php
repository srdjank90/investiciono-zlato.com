<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promene cena proizvoda</title>
    <style>
        /* Styles for responsive table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Responsive styles */
        @media screen and (max-width: 767px) {

            table,
            tr,
            td {
                display: block;
            }

            td {
                border: none;
                position: relative;
                padding-left: 40%;
            }

            td:before {
                position: absolute;
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
            }

            /* Label columns */
            td:nth-of-type(1):before {
                content: "Naziv:";
            }

            td:nth-of-type(2):before {
                content: "Kompanija:";
            }

            td:nth-of-type(3):before {
                content: "Stara Cena:";
            }

            td:nth-of-type(4):before {
                content: "Nova Cena:";
            }

            td:nth-of-type(5):before {
                content: "Promena:";
            }
        }
    </style>
</head>

<body>

    <h4>Vreme zapažene promene: {{ $changes[0]->checked_at }}</h4>

    <table>
        <thead>
            <tr>
                <th>Naziv</th>
                <th>Kompanija</th>
                <th>Stara Cena</th>
                <th>Nova Cena</th>
                <th>Promena</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($changes as $change)
                <tr>
                    <td>{{ $change->product->name }}</td>
                    <td>{{ $change->product->company->name }}</td>
                    <td><b>@priceFormat($change->old_price) din</b></td>
                    <td><b>@priceFormat($change->new_price) din</b></td>
                    <td><b>{{ $change->percentage_change }}%</b></td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
