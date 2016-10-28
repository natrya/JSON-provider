define({ "api": [
  {
    "type": "post",
    "url": "/router.php",
    "title": "Buat kontak",
    "name": "createRecord",
    "group": "Kontak",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "action",
            "description": "<p>QueryKontak</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "method",
            "description": "<p>createRecord</p>"
          },
          {
            "group": "Parameter",
            "type": "Object",
            "optional": false,
            "field": "data",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "data.nama",
            "description": "<p>nama</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "data.email",
            "description": "<p>email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "data.notelp",
            "description": "<p>No Telp/HP</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "data.alamat",
            "description": "<p>Alamat</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "data.foto",
            "description": "<p>foto</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n \"action\":\"QueryKontak\",\n \"method\":\"createRecord\",\n \"data\":[{\n     \"nama\":\"Ryan Fabella\",\n     \"email\":\"ryanthe@gmail.com\",\n     \"notelp\":\"0817309405\",\n     \"alamat\":\"rungkut surabaya\",\n     \"foto\":\"ryan.jpg\"\n }]\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>1</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "idkontak",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n \"action\":\"QueryKontak\",\n \"method\":\"createRecord\",\n \"result\":{\n     \"nama\":\"Ryan Fabella\",\n     \"email\":\"ryanthe@gmail.com\",\n     \"notelp\":\"0817309405\",\n     \"alamat\":\"rungkut surabaya\",\n     \"foto\":\"ryan.jpg\",\n     \"idkontak\":0,\n     \"success\":1\n }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/QueryKontak.php",
    "groupTitle": "Kontak"
  },
  {
    "type": "post",
    "url": "/router.php",
    "title": "delete kontak",
    "name": "deleteRecord",
    "group": "Kontak",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "action",
            "description": "<p>QueryKontak</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "method",
            "description": "<p>deleteRecord</p>"
          },
          {
            "group": "Parameter",
            "type": "Object",
            "optional": false,
            "field": "data",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "data.idkontak",
            "description": "<p>id</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n \"action\":\"QueryKontak\",\n \"method\":\"deleteRecord\",\n \"data\":[{\n     \"idkontak\":\"1\"\n }]\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>1</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n \"action\":\"QueryExperience\",\n \"method\":\"deleteRecord\",\n \"result\":{\n     \"idkontak\":\"1\",\n     \"success\":1\n }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/QueryKontak.php",
    "groupTitle": "Kontak"
  },
  {
    "type": "post",
    "url": "/router.php",
    "title": "Ambil kontak",
    "name": "getResults",
    "group": "Kontak",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "action",
            "description": "<p>QueryKontak</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "method",
            "description": "<p>getResults</p>"
          },
          {
            "group": "Parameter",
            "type": "Object",
            "optional": false,
            "field": "data",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "data.start",
            "description": "<p>mulai dari 0</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "data.limit",
            "description": "<p>limit jumlah record</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n \"action\":\"QueryKontak\",\n \"method\":\"getResults\",\n \"data\":[{\n     \"start\":\"0\",\n     \"limit\":\"10\"\n }]\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>1</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n \"action\":\"QueryKontak\",\n \"method\":\"getResults\",\n \"result\":{\n     \"success\":1,\n     \"totalCount\":\"1\",\n     \"hasil\":[{\n         \"idkontak\":1,\n         \"nama\":\"Ryan Fabella\",\n         \"email\":\"ryanthe@gmail.com\",\n         \"notelp\":\"0817309405\",\n         \"alamat\":\"rungkut surabaya\",\n         \"foto\":\"http://127.0.0.1/training/foto/ryan.jpg\"\n     }]\n }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/QueryKontak.php",
    "groupTitle": "Kontak"
  },
  {
    "type": "post",
    "url": "/router.php",
    "title": "update kontak",
    "name": "updateRecord",
    "group": "Kontak",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "action",
            "description": "<p>QueryKontak</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "method",
            "description": "<p>updateRecord</p>"
          },
          {
            "group": "Parameter",
            "type": "Object",
            "optional": false,
            "field": "data",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "data.idkontak",
            "description": "<p>id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "data.nama",
            "description": "<p>nama</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "data.email",
            "description": "<p>email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "data.notelp",
            "description": "<p>No Telp/HP</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "data.alamat",
            "description": "<p>Alamat</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "data.foto",
            "description": "<p>foto</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n \"action\":\"QueryKontak\",\n \"method\":\"updateRecord\",\n \"data\":[{\n     \"idkontak\":\"1\",\n     \"nama\":\"Ryan Fabella\",\n     \"email\":\"ryanthe@gmail.com\",\n     \"notelp\":\"081357966316\",\n     \"alamat\":\"surabaya\",\n     \"foto\":\"ryan.jpg\"\n }]\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>1</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n \"action\":\"QueryKontak\",\n \"method\":\"updateRecord\",\n \"result\":{\n     \"idkontak\":\"1\",\n     \"nama\":\"Ryan Fabella\",\n     \"email\":\"ryanthe@gmail.com\",\n     \"notelp\":\"081357966316\",\n     \"alamat\":\"surabaya\",\n     \"foto\":\"ryan.jpg\",\n     \"success\":1\n }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/QueryKontak.php",
    "groupTitle": "Kontak"
  }
] });
