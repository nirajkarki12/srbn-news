---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.

<!-- END_INFO -->

#Category


<!-- START_33861d0c40ad6fc3c83572667744074b -->
## User&#039;s Categories
Header: X-Authorization: Bearer {token}

> Example request:

```bash
curl -X GET \
    -G "http://localhost/srbn-news/public/api/category/user" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/category/user"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": true,
    "data": [
        {
            "id": 2,
            "name": "News",
            "description": null,
            "image": null,
            "created_at": "2020-04-14 15:00"
        }
    ],
    "message": "Categories data fetched successfully",
    "code": 200
}
```
> Example response (401):

```json
{
    "status": false,
    "message": "User not found",
    "code": 401
}
```
> Example response (404):

```json
{
    "status": false,
    "message": "Categories not found",
    "code": 404
}
```
> Example response (400):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 400
}
```

### HTTP Request
`GET api/category/user`


<!-- END_33861d0c40ad6fc3c83572667744074b -->

<!-- START_db20564ba266cd451caac114b3eac8ab -->
## All Categories
All Active Categories

> Example request:

```bash
curl -X GET \
    -G "http://localhost/srbn-news/public/api/category" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/category"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": true,
    "data": [
        {
            "id": 2,
            "name": "News",
            "description": null,
            "image": null,
            "created_at": "2020-04-14 15:00",
            "children": [
                {
                    "id": 3,
                    "name": "News Children",
                    "description": null,
                    "image": null,
                    "created_at": "2020-04-14 15:00",
                    "children": [
                        {
                            "id": 4,
                            "name": "Sub News Children",
                            "description": null,
                            "image": null,
                            "created_at": "2020-04-14 15:00"
                        }
                    ]
                }
            ]
        }
    ],
    "message": "Categories data fetched successfully",
    "code": 200
}
```
> Example response (404):

```json
{
    "status": false,
    "message": "Categories not found",
    "code": 404
}
```

### HTTP Request
`GET api/category`


<!-- END_db20564ba266cd451caac114b3eac8ab -->

#Post


<!-- START_60b18e7fe5d2ed6da6e8c38e34450dab -->
## User&#039;s Posts List
Header for User&#039;s Category Posts: X-Authorization: Bearer {token}

> Example request:

```bash
curl -X GET \
    -G "http://localhost/srbn-news/public/api/posts/user?%3Fpage%3D=12" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/posts/user"
);

let params = {
    "?page=": "12",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": true,
    "data": {
        "current_page": 2,
        "data": [
            {
                "id": 2,
                "title": "News Title",
                "description": "News Long Description",
                "source": "News Source",
                "source_url": "Source URL",
                "audio_url": null,
                "image": "Feature Image",
                "created_at": "2020-04-14 15:00",
                "categories": [
                    {
                        "id": 2,
                        "name": "News",
                        "description": null,
                        "image": null,
                        "created_at": "2020-04-14 15:00"
                    }
                ]
            }
        ],
        "first_page_url": "URL\/api\/posts\/user?page=1",
        "from": 16,
        "last_page": 4,
        "last_page_url": "URL\/api\/posts\/user?page=4",
        "next_page_url": "URL\/api\/posts\/user?page=3",
        "path": "URL\/api\/posts\/user",
        "per_page": 15,
        "prev_page_url": "URL\/api\/posts\/user?page=1",
        "to": 30,
        "total": 55
    },
    "message": "Post data fetched successfully",
    "code": 200
}
```
> Example response (401):

```json
{
    "status": false,
    "message": "User not found",
    "code": 401
}
```
> Example response (404):

```json
{
    "status": false,
    "message": "No Posts found",
    "code": 404
}
```
> Example response (400):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 400
}
```

### HTTP Request
`GET api/posts/user`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `?page=` |  optional  | next page - pagination

<!-- END_60b18e7fe5d2ed6da6e8c38e34450dab -->

<!-- START_fd1746447c684f78c26acc72a048bdab -->
## Posts List
All posts list

> Example request:

```bash
curl -X GET \
    -G "http://localhost/srbn-news/public/api/posts/?%3Fpage%3D=12" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/posts/"
);

let params = {
    "?page=": "12",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": true,
    "data": {
        "current_page": 2,
        "data": [
            {
                "id": 2,
                "title": "News Title",
                "description": "News Long Description",
                "source": "News Source",
                "source_url": "Source URL",
                "audio_url": null,
                "image": "Feature Image",
                "created_at": "2020-04-14 15:00",
                "categories": [
                    {
                        "id": 2,
                        "name": "News",
                        "description": null,
                        "image": null,
                        "created_at": "2020-04-14 15:00"
                    }
                ]
            }
        ],
        "first_page_url": "URL\/api\/posts?page=1",
        "from": 16,
        "last_page": 4,
        "last_page_url": "URL\/api\/posts?page=4",
        "next_page_url": "URL\/api\/posts?page=3",
        "path": "URL\/api\/posts",
        "per_page": 15,
        "prev_page_url": "URL\/api\/posts?page=1",
        "to": 30,
        "total": 55
    },
    "message": "Post data fetched successfully",
    "code": 200
}
```
> Example response (404):

```json
{
    "status": false,
    "message": "No Posts found",
    "code": 404
}
```
> Example response (400):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 400
}
```

### HTTP Request
`GET api/posts/{categoryId?}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `/categoryId` |  optional  | specific category Posts
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `?page=` |  optional  | next page - pagination

<!-- END_fd1746447c684f78c26acc72a048bdab -->

#User

APIs for User Login
<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## Login APIs
User Login

> Example request:

```bash
curl -X POST \
    "http://localhost/srbn-news/public/api/login" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"email":"exercitationem","password":"officiis"}'

```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/login"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "email": "exercitationem",
    "password": "officiis"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": true,
    "data": {
        "name": "Name Example",
        "email": "example@gmail.com",
        "address": "Somewhere",
        "image": null,
        "created_at": "2020-04-14 15:00",
        "token": "JWT Token"
    },
    "message": "Logged in successfully",
    "code": 200
}
```
> Example response (401):

```json
{
    "status": false,
    "message": "Username\/Password Mismatched",
    "code": 401
}
```

### HTTP Request
`POST api/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | valid email address.
        `password` | string |  required  | min 6 in length.
    
<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->

<!-- START_444008ca6541ddc5d3dae8434120a6d1 -->
## Social Login APIs
Social User Login

> Example request:

```bash
curl -X POST \
    "http://localhost/srbn-news/public/api/social/login" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"name":"molestiae","email":"necessitatibus","image":"perspiciatis","social_id":"voluptates","provider":"et"}'

```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/social/login"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "name": "molestiae",
    "email": "necessitatibus",
    "image": "perspiciatis",
    "social_id": "voluptates",
    "provider": "et"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": true,
    "data": {
        "name": "Name Example",
        "email": "example@gmail.com",
        "address": "Somewhere",
        "image": null,
        "created_at": "2020-04-14 15:00",
        "token": "JWT Token"
    },
    "message": "Logged in successfully",
    "code": 200
}
```
> Example response (406):

```json
{
    "status": false,
    "message": "The social id field is required.",
    "code": 406
}
```

### HTTP Request
`POST api/social/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  optional  | optional name of user.
        `email` | string |  optional  | optional valid email address.
        `image` | string |  optional  | optional image link of user.
        `social_id` | string |  required  | social id of user.
        `provider` | string |  required  | social provider eg.facebook.
    
<!-- END_444008ca6541ddc5d3dae8434120a6d1 -->

<!-- START_d7b7952e7fdddc07c978c9bdaf757acf -->
## Registration APIs
User Registration

> Example request:

```bash
curl -X POST \
    "http://localhost/srbn-news/public/api/register" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"name":"aut","email":"sunt","address":"rerum","password":"aut","image":"cumque"}'

```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/register"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "name": "aut",
    "email": "sunt",
    "address": "rerum",
    "password": "aut",
    "image": "cumque"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (201):

```json
{
    "status": true,
    "data": {
        "name": "Name Example",
        "email": "example@gmail.com",
        "address": "Somewhere",
        "image": null,
        "created_at": "2020-04-14 15:00",
        "token": "JWT Token"
    },
    "message": "Registered successfully",
    "code": 201
}
```
> Example response (406):

```json
{
    "status": false,
    "message": "The Full Name field is required.",
    "code": 406
}
```
> Example response (406):

```json
{
    "status": false,
    "message": "The email has already been taken.",
    "code": 406
}
```
> Example response (406):

```json
{
    "status": false,
    "message": "The password must be at least 6 characters.",
    "code": 406
}
```
> Example response (406):

```json
{
    "status": false,
    "message": "The Image failed to upload.",
    "code": 406
}
```

### HTTP Request
`POST api/register`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | max 100 in length.
        `email` | string |  required  | valid email address.
        `address` | string |  optional  | max 100 in length.
        `password` | string |  required  | min 6 in length.
        `image` | file |  optional  | accepts: jpeg,png,gif, filesize upto 2MB.
    
<!-- END_d7b7952e7fdddc07c978c9bdaf757acf -->

<!-- START_1f1c64179c56c967b085735d4e407bb5 -->
## Authenticated User
Header: X-Authorization: Bearer {token}

> Example request:

```bash
curl -X GET \
    -G "http://localhost/srbn-news/public/api/auth-user" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/auth-user"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": true,
    "data": {
        "name": "Name Example",
        "email": "example@gmail.com",
        "address": "Somewhere",
        "image": null,
        "categories": [
            {
                "id": 2,
                "name": "News",
                "description": null,
                "image": null,
                "created_at": "2020-04-14 15:00"
            }
        ],
        "created_at": "2020-04-14 15:00"
    },
    "message": "User info fetched successfully",
    "code": 200
}
```
> Example response (401):

```json
{
    "status": false,
    "message": "User not found",
    "code": 401
}
```
> Example response (400):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 400
}
```

### HTTP Request
`GET api/auth-user`


<!-- END_1f1c64179c56c967b085735d4e407bb5 -->

<!-- START_a5dd4caeeb907ed5b6629da5f3330bb9 -->
## Set Category APIs
Header: X-Authorization: Bearer {token}

> Example request:

```bash
curl -X POST \
    "http://localhost/srbn-news/public/api/user/set-category" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"categories":[]}'

```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/user/set-category"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "categories": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": true,
    "data": {
        "name": "Name Example",
        "email": "example@gmail.com",
        "address": "Somewhere",
        "image": null,
        "categories": [
            {
                "id": 2,
                "name": "News",
                "description": null,
                "image": null,
                "created_at": "2020-04-14 15:00"
            }
        ],
        "created_at": "2020-04-14 15:00"
    },
    "message": "User Categories Added successfully",
    "code": 200
}
```
> Example response (401):

```json
{
    "status": false,
    "message": "User not found",
    "code": 401
}
```
> Example response (406):

```json
{
    "status": false,
    "message": "The categories field is required.",
    "code": 406
}
```
> Example response (400):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 400
}
```

### HTTP Request
`POST api/user/set-category`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `categories` | array |  required  | [categories ID].
    
<!-- END_a5dd4caeeb907ed5b6629da5f3330bb9 -->


