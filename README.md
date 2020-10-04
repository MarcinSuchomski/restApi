## REST API
Simple REST API no frameworks 

## Instalation 
### DB 
##### DB file located in DB folder in the root 
```
DB/dump.sql
```

### API 
```

Project develped with php 7.3.9 , mysql 8.0

navigate to root folder and run docker compse
docker-compose up 

```


```
# How does it work

We have 4 methods of access the API:

1. subscribers
1. fields
1. fieldsTypes
1. states

### subscribers

Subscribers method contains 4 actions 

1. create
1. get
1. update
1. get

## subscribers/create

 request url:
 ```
 http://0.0.0.0:8080/restApi/api/subscribers/create
````
 request body:
 ```
{
    "name": "ms",
    "email_address": "wp.pl@wp.pl",
    "states_id": "2"

}
```

 request response:
 ```
{
    "success": true,
    "message": "sucessfully created subscriber",
    "status_code_header": "200"
}
```
## subscribers/get

 request url:
 ```
 http://0.0.0.0:8080/restApi/api/subscribers/get
````

request response:

######returns all subscribers
 ```
{
        "subscribers_id": "3",
        "name": "MArcin",
        "email_address": "mail@gmail.com",
        "created_date": "2020-09-03 19:33:37",
        "changed_date": "2020-09-06 10:26:11",
        "states_id": "2",
        "state_name": "unsubscribed"
    },
    {
        "subscribers_id": "4",
        "name": "OlaKucab",
        "email_address": "mail@gmail.com",
        "created_date": "2020-09-03 19:33:37",
        "changed_date": "2020-09-03 14:26:56",
        "states_id": "1",
        "state_name": "active"
    },

```


request url:

```
 http://0.0.0.0:8080/restApi/api/subscribers/get/id/{subscribers_id}
````
returns by id
 ```
[
    {
        "subscribers_id": "3",
        "name": "MArcin",
        "email_address": "suchomski.marcin@gmail.com",
        "created_date": "2020-09-03 19:33:37",
        "changed_date": "2020-09-06 10:26:11",
        "states_id": "2"
    }
]

```
## subscribers/update

 request url:
 ```
 http://0.0.0.0:8080/restApi/api/subscribers/update/{subscribers_id}
````
 request body:
 ```
{
    "name": "ms",
    "states_id": "2"

}
```
 request response:
 ```
{
    "success": true,
    "message": "successfully updated",
    "status_code_header": 204
}

```
### subscribers/delete

request url:
 ```
 http://0.0.0.0:8080/restApi/api/subscribers/delete/{subscribers_id}
````

request response:

returns all subscribers
 ```
{
    "success": true,
    "message": "successfully deleted",
    "status_code_header": 202
}
```

## Fields methods follow same principle

### Fields required fields 

to create 

```
"name": "",
"value":"",
"fields_types_id":"",
"subscribers_id":""
```

to update 

```
"name": "",
"value":"",
"fields_types_id":"",
```
## FieldsTypes and States have only get action
to select all

```http://0.0.0.0:8080/restApi/api/states/get```

to celect by id

```http://0.0.0.0:8080/restApi/api/states/get/id/3```

to select all

```http://0.0.0.0:8080/restApi/api/fieldstypes/get```

to celect by id

```http://0.0.0.0:8080/restApi/api/fieldstypes/get/id/3```


