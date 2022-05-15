<p align="center">
    <a href="#" target="_blank">
        <img src="https://codemau5.com/img/LogoCompleto.png" width="400">
    </a>
</p>

## Acerca de postalcodes
* los datos fueron obtenidos de: <a href="https://www.correosdemexico.gob.mx/SSLServicios/ConsultaCP/CodigoPostal_Exportar.aspx" target="_blank">https://www.correosdemexico.gob.mx/SSLServicios/ConsultaCP/CodigoPostal_Exportar.aspx</a>

* Se convierten de xml a csv usando la herramienta: <a href="https://codebeautify.org/xml-to-csv-converter">https://codebeautify.org/xml-to-csv-converter</a>

* se exportan a la base de datos usando la herramienta de exportacion de MySQL Workbench.

* en el archivo api se obtiene el codigo postal '/zip-codes/{zipcode}' mediante el metodo GET

* se busca la informacion y se contruye el json en base a lo solicitado

## GET api/zip-codes/01000
200 OK 
Response:
{"zip_code":"01000","locality":"CIUDAD DE MéXICO","federal_entity":{"key":9,"name":"CIUDAD DE MéXICO","code":null},"settlements":[{"key":1,"name":"SAN ÁNGEL","zone_type":"URBANO","settlement_type":{"name":"Colonia"}}],"municipality":{"key":10,"name":"ÁLVARO OBREGóN"}}
