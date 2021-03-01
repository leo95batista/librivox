## About

## Installation

## API

### Stats

*Request:*

```
http://www.example.com/api/stats
```

*Output:*

```
{
  "data":{
    "total":{
      "authors":5181,
      "books":15744,
      "genres":132,
      "languages":46,
      "sections":339897
    },
    "version":"1.0.0"
  }
}
```

### Authors

*Request:*

```
http://www.example.com/api/authors
```

*Output:*

```
{
  "data":[{
    "id":1,
    "dob":"1802",
    "dod":"1870",
    "first_name":"Alexandre",
    "last_name":"Dumas"
  },{
    "id":2,
    "dob":"1799",
    "dod":"1850",
    "first_name":"Honoré de",
    "last_name":"Balzac"
  },{
    ...
  },
  links":{
    "first":"http://www.example.com/api/authors?page=1",
    "last":null,
    "prev":null,
    "next":"http://www.example.com/api/authors?page=2"
  },
  "meta":{
    "current_page":1,
    "from":1,
    "path":"http://www.example.com/api/authors",
    "per_page":15,
    "to":15
  }
}
```

*Request:*

```
http://www.example.com/api/authors/{id}
```

*Output:*

```
{
  "data":{
    "id":1,
    "dob":"1802",
    "dod":"1870",
    "first_name":"Alexandre",
    "last_name":"Dumas"
  }
}
```
