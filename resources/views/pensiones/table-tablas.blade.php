<table id="table-cuantia-basica" style="display: table;width: 100%" class="table">
    <thead>
        <tr>
            <td style="width:25%;text-align:center;font-weight: bold;">De</td>
            <td style="width:25%;text-align:center;font-weight: bold;">A</td>
            <td style="width:25%;text-align:center;font-weight: bold;">Cuantía básica</td>
            <td style="width:25%;text-align:center;font-weight: bold;">Incremento anual</td>
        </tr>
    </thead>
    <tbody id="body-cuantia-basica">
        @foreach ($tablas as $tabla )
        <tr>
           <td style="width:25%;text-align:center">{{ $tabla->de }}</td>
           <td style="width:25%;text-align:center">{{ $tabla->a }}</td>
           <td style="width:25%;text-align:center">{{ $tabla->cuantia_basica }}</td>
           <td style="width:25%;text-align:center">{{ $tabla->incremento_anual }}</td>
        </tr>
        @endforeach

    </tbody>
</table>