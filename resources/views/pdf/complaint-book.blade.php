<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alser - Reclamo N° 000001</title>
    <style>
        html {
            margin: 0 2rem;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
        }

        span {
            font-weight: 600;
            padding-top: 0;
            font-size: .875rem;
            line-height: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .5rem .25rem;
        }

        td {
            width: 100%;
        }

        td>p {
            border: 1px solid #ccc;
            height: 2rem;
            padding: .5rem 1rem 0 1rem;
            margin: 0;
            font-size: 1rem;
            line-height: 1.5rem;
            border-radius: .5rem;
            background-color: #f0f0f0;
        }

        textarea {
            border: 1px solid #ccc;
            padding: .5rem 1rem;
            font-size: .75rem;
            line-height: 1.25rem;
            border-radius: .5rem;
            width: calc(100% - 2.5rem);
            height: 12rem;
            text-wrap: pretty;
            background-color: #f0f0f0;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center">Reclamo N° {{ $form['id'] }}</h1>
    <table>
        <tr>
            <td>
                <span>Número de documento</span>
                <p>{{ $form['document_type_name'] }}</p>
            </td>
            <td>
                <span>Tipo de documento</span>
                <p>{{ $form['document_number'] }}</p>
            </td>
        </tr>
        <tr>
            @if ($form['document_type_name'] != 'RUC')
                <td>
                    <table>
                        <tr>
                            <td>
                                <span>Apellido Paterno</span>
                                <p>{{ $form['last_name_father'] }}</p>
                            </td>
                            <td>
                                <span>Apellido Materno</span>
                                <p>{{ $form['last_name_mother'] }}</p>
                            </td>
                        </tr>
                    </table>
                </td>
            @endif
            <td @if ($form['document_type_name'] == 'RUC') colspan="2" @endif>
                @if ($form['document_type_name'] == 'RUC')
                    <span>Razón Social</span>
                @else
                    <span>Nombres</span>
                @endif
                <p>{{ $form['name'] }}</p>
            </td>
        </tr>
        @if ($form['representative'])
            <tr>
                <td colspan="2">
                    <span>Datos del Apoderado</span>
                    <p>{{ $form['representative'] }}</p>
                </td>
            </tr>
        @endif
    </table>
    <table>
        <tr>
            <td>
                <span">Departamento</span>
                    <p>{{ $form['location_department_name'] }}</p>
            </td>
            <td>
                <span>Provincia</span>
                <p>{{ $form['location_province_name'] }}</p>
            </td>
            <td>
                <span>Distrito</span>
                <p>{{ $form['location_district_name'] }}</p>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <span>Dirección</span>
                <p>{{ $form['street'] }}</p>
            </td>
            <td>
                <table>
                    <tr>
                        <td>
                            <span>Nro/Mz</span>
                            <p>{{ $form['street_number'] }}</p>
                        </td>
                        <td>
                            <span>Lote</span>
                            <p>{{ $form['street_lot'] }}</p>
                        </td>
                        <td>
                            <span>Dpto</span>
                            <p>{{ $form['street_dpto'] }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span>Urbanización</span>
                <p>{{ $form['urbanization'] }}</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span>Referencia</span>
                <p>{{ $form['reference'] }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td>
                            <span>Telefono</span>
                            <p>{{ $form['telephone'] }}</p>
                        </td>
                        <td>
                            <span>Celular</span>
                            <p>{{ $form['celphone'] }}</p>
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <span>Correo Electrónico</span>
                <p>{{ $form['email'] }}</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span>Medio de respuesta</span>
                <p>{{ $form['response_medium_name'] }}</p>
            </td>
        </tr>
    </table>
    @if (!$claim)
        <div>
            <span>Descripción de la @if ($form['is_complaint'])
                    Queja
                @else
                    Reclamo
                @endif
            </span>
            <textarea>{{ $form['reason_description'] }}</textarea>
        </div>
    @else
        <h2 style="text-align: center;padding-top:2rem; padding-bottom: 1rem;">
            Servicio contratado:
            <span style="font-weight: 500">Cambio de dólares online</span>
        </h2>
        <table>
            <tr>
                <td>
                    <span>Tipo de moneda</span>
                    <p>{{ $claim['currency_type_name'] }}</p>
                </td>
                <td>
                    <span>Código de operación</span>
                    <p>ALS-{{ $claim['operation_code'] }}</p>
                </td>
                <td>
                    <span>Monto a reclamar</span>
                    <p>{{ $claim['amount_str'] }}</p>
                </td>
            </tr>
        </table>
    @endif
</body>

</html>
