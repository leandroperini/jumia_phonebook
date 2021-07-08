# A phonebook to showcase development skills

### How to setup the project

First the sqlite database file containing the customer table, must be placed at:

```
database/database.sqlite
```

To run the environment the docker must be started, to do that, run the following makefile command:

```
make start
```

The last step is to put in the S.O. hosts file the entry bellow:

```
127.0.0.1   jumia_phonebook.local
```

After all the steps above the phonebook is available at:

```
http://jumia_phonebook.local:8080
```

But no data should be available, to show some data an importing processes should be started, to do that access the endpoint:

```http request
GET http://jumia_phonebook.local:8080/api/phoneData/import
```

If executed with success, the endpoint will return 201 No Content
