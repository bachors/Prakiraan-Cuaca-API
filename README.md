# Prakiraan-Cuaca-API
cURL website BMKG and return JSON
<h3>Install:</h3>
<pre>&lt;?php

    // include cuaca.php
    require("cuaca.php");
    
    // call function cuaca
    $cuaca = cuaca(); // return array print_r($cuaca);
    
    // convert array to JSON
    echo json_encode($cuaca);
    
?&gt;</pre>
<h3>Return JSON:</h3>
cURL sukses
<pre>{
    "status": "online",
    "data": [
        {
            "kota": "Banda Aceh",
            "maps": {
                "latitude": 5.5482904,
                "longitude": 95.3237559
            },
            "prakiraan": {
                "sekarang": {
                    "tgl": "26 March 2016",
                    "cuaca": "Cerah Berawan",
                    "suhu": {
                        "min": "23",
                        "max": "34"
                    },
                    "kelembaban": {
                        "min": "58",
                        "max": "95"
                    }
                },
                "besok": {
                    "tgl": "27 March 2016",
                    "cuaca": "Cerah Berawan",
                    "suhu": {
                        "min": "23",
                        "max": "34"
                    },
                    "kelembaban": {
                        "min": "58",
                        "max": "95"
                    }
                }
            }
        },
        {
            "kota": "Medan",
            "maps": {
                "latitude": 3.5951956,
                "longitude": 98.6722227
            },
            "prakiraan": {
                "sekarang": {
                    "tgl": "26 March 2016",
                    "cuaca": "Hujan Ringan",
                    "suhu": {
                        "min": "23",
                        "max": "34"
                    },
                    "kelembaban": {
                        "min": "63",
                        "max": "92"
                    }
                },
                "besok": {
                    "tgl": "27 March 2016",
                    "cuaca": "Hujan Ringan",
                    "suhu": {
                        "min": "23",
                        "max": "34"
                    },
                    "kelembaban": {
                        "min": "63",
                        "max": "92"
                    }
                }
            }
        },
        ...
    ]
}</pre>
cURL error
<pre>{
  "status": "offline"
}</pre>

<a href="http://ibacor.com/api/prakiraan-cuaca" target="_BLANK"><h2>DEMO</h2></a>
