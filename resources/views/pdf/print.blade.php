<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>طباعة</title>
    <style>
        body {
            background: rgb(204, 204, 204);
        }

        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        }

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
        }

        page[size="A4"][layout="landscape"] {
            width: 29.7cm;
            height: 21cm;
        }

        page[size="A3"] {
            width: 29.7cm;
            height: 42cm;
        }

        page[size="A3"][layout="landscape"] {
            width: 42cm;
            height: 29.7cm;
        }

        page[size="A5"] {
            width: 14.8cm;
            height: 21cm;
        }

        page[size="A5"][layout="landscape"] {
            width: 21cm;
            height: 14.8cm;
        }

        @media print {

            body,
            page {
                margin: 0;
                box-shadow: 0;
            }
        }
    </style>
</head>

<body>
    <page size="A4">
        <center>


        <table border="2px" style="">
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <tbody>
                <tr><td>12</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td></tr>
                <tr><td>12</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td></tr>
                <tr><td>12</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td></tr>
                <tr><td>12</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td></tr>
                <tr><td>12</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td></tr>
            </tbody>
        </table>
    </center>
    </page>
    <page size="A4"></page>
    <page size="A4" layout="landscape"></page>
    <page size="A5"></page>
    <page size="A5" layout="landscape"></page>
    <page size="A3"></page>
    <page size="A3" layout="landscape"></page>
</body>

</html>
