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
            "name_np": "News",
            "position": 1,
            "image": null,
            "created_at": "2020-04-14 15:00"
        }
    ],
    "message": "Categories data fetched successfully",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "User not found",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Categories not found",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}
```

### HTTP Request
`GET api/category/user`


<!-- END_33861d0c40ad6fc3c83572667744074b -->

<!-- START_db20564ba266cd451caac114b3eac8ab -->
## Categories
Active Categories

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
            "name_np": "News",
            "position": 1,
            "image": null,
            "created_at": "2020-04-14 15:00"
        },
        {
            "id": 3,
            "name": "Entertainment",
            "description": null,
            "image": null,
            "created_at": "2020-04-14 15:10"
        }
    ],
    "message": "Categories data fetched successfully",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Categories not found",
    "code": 200
}
```

### HTTP Request
`GET api/category`


<!-- END_db20564ba266cd451caac114b3eac8ab -->

#Horoscope Api


<!-- START_0ba251bf4f25186bc122282db6cf38a4 -->
## List Horoscope

> Example request:

```bash
curl -X GET \
    -G "http://localhost/srbn-news/public/api/list/horoscope?%3Flang%3D=error" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/list/horoscope"
);

let params = {
    "?lang=": "error",
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
    "data": [
        {
            "id": 2,
            "created_at": "2020-06-06T14:20:08.000000Z",
            "updated_at": "2020-06-06T14:25:47.000000Z",
            "is_selected": false,
            "total_users": 0,
            "name": "Ariesw",
            "info": "english info",
            "image": "http:\/\/127.0.0.1:8000\/storage\/horoscopes\/a53fb48246b0b5d36c5e4400b3e17d73cc3a042f.png",
            "users": []
        }
    ],
    "message": "Horoscopes fetched successfully",
    "code": 200
}
```

### HTTP Request
`GET api/list/horoscope`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `?lang=` |  optional  | language parameter en for english ne for nepali

<!-- END_0ba251bf4f25186bc122282db6cf38a4 -->

<!-- START_22ec8148905988e4fc99e059fb05214f -->
## Select Unselect Horoscope
Header: X-Authorization: Bearer {token}

> Example request:

```bash
curl -X GET \
    -G "http://localhost/srbn-news/public/api/horoscope/inventore?%3Flang%3D=dignissimos" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/horoscope/inventore"
);

let params = {
    "?lang=": "dignissimos",
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
        "id": 2,
        "created_at": "2020-06-06T14:20:08.000000Z",
        "updated_at": "2020-06-06T14:25:47.000000Z",
        "users_count": 1,
        "is_selected": true,
        "name": "Meshw",
        "info": "nepali info",
        "image": "http:\/\/127.0.0.1:8000\/storage\/horoscopes\/619c82bbd8e7fd5798b1137f5150a13f4346f4a8.jpg"
    },
    "message": "Request successfull",
    "code": 200
}
```

### HTTP Request
`GET api/horoscope/{horoscope}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `horoscope` |  required  | horoscope id
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `?lang=` |  optional  | preferred language en for english, ne for nepali

<!-- END_22ec8148905988e4fc99e059fb05214f -->

<!-- START_b2d127b0f6748250200649965db067b2 -->
## Fetch Prediction
Header: X-Authorization: Bearer {token}

> Example request:

```bash
curl -X GET \
    -G "http://localhost/srbn-news/public/api/predict/horoscope/?timeline=dolor&id=sint&lang%3Den=et" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/predict/horoscope/"
);

let params = {
    "timeline": "dolor",
    "id": "sint",
    "lang=en": "et",
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
        "id": 2,
        "horoscope_id": 2,
        "type": "daily",
        "rating": 3.2,
        "text": "sdjfkj"
    },
    "message": "data fetched successfully",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Nothing to show",
    "code": 200
}
```

### HTTP Request
`GET api/predict/horoscope/{id?}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `timeline` |  required  | timeline period to show daily, tomorrow, weekly, monthly, yearly
    `id` |  required  | timeline horoscope id
    `lang=en` |  optional  | language of the user en for english, ne for nepali

<!-- END_b2d127b0f6748250200649965db067b2 -->

#Life Hack & Meme


<!-- START_6c9a429a2ededa75193277eaf9290987 -->
## Like Unlike Memes
Header: X-Authorization: Bearer {token},

> Example request:

```bash
curl -X GET \
    -G "http://localhost/srbn-news/public/api/memes/like/distinctio" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/memes/like/distinctio"
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
        "id": 4,
        "image": "http:\/\/127.0.0.1:8000\/storage\/memes\/cd67f39562fc5dd7a693d5390a7785d9fc52dc4f.png",
        "created_at": "2020-06-06T10:31:16.000000Z",
        "updated_at": "2020-06-06T10:31:16.000000Z",
        "likes_count": 0,
        "is_liked": false
    },
    "message": "request successful",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Meme not found",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}
```

### HTTP Request
`GET api/memes/like/{meme}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `meme` |  required  | meme id

<!-- END_6c9a429a2ededa75193277eaf9290987 -->

<!-- START_58ef53c1134d3fd57e2d1b0531fb1ab1 -->
## Like Unlike Life Hack
Header: X-Authorization: Bearer {token}

> Example request:

```bash
curl -X GET \
    -G "http://localhost/srbn-news/public/api/life-hacks/like/rerum" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/life-hacks/like/rerum"
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
        "id": 4,
        "content": "content in english",
        "image": "http:\/\/127.0.0.1:8000\/storage\/memes\/cd67f39562fc5dd7a693d5390a7785d9fc52dc4f.png",
        "created_at": "2020-06-06T10:31:16.000000Z",
        "updated_at": "2020-06-06T10:31:16.000000Z",
        "likes_count": 0,
        "is_liked": false,
        "translation": {
            "content": "content in nepali"
        }
    },
    "message": "request successful",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Life hack not found",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}
```

### HTTP Request
`GET api/life-hacks/like/{lifehack}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `lifehack` |  required  | life hack id

<!-- END_58ef53c1134d3fd57e2d1b0531fb1ab1 -->

<!-- START_587189636942669637216c31b27fd1f6 -->
## Life Hacks List
Active Life Hacs

> Example request:

```bash
curl -X GET \
    -G "http://localhost/srbn-news/public/api/life-hacks?lang%3Den=aut&%3Fpage%3D=2" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/life-hacks"
);

let params = {
    "lang=en": "aut",
    "?page=": "2",
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
                "id": 1,
                "image": "image url",
                "content": "Content in english",
                "translation": {
                    "content": "Content in nepali"
                },
                "likes_count": 10,
                "is_liked": true,
                "created_at": "2020-04-14 15:00",
                "updated_at": "2020-04-14 15:00"
            }
        ],
        "first_page_url": "URL\/\/api\/life-hacks?page=2",
        "from": 16,
        "last_page": 4,
        "last_page_url": "URL\/\/api\/life-hacks?page=4",
        "next_page_url": "URL\/\/api\/life-hacks?page=3",
        "path": "URL\/api\/life-hacks",
        "per_page": 15,
        "prev_page_url": "URL\/\/api\/life-hacks?page=1",
        "to": 30,
        "total": 55
    },
    "message": "Life Hacks data fetched successfully",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Life Hacks not found",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}
```

### HTTP Request
`GET api/life-hacks`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `lang=en` |  optional  | preferred language en for english, ne for nepali
    `?page=` |  optional  | next page - pagination

<!-- END_587189636942669637216c31b27fd1f6 -->

<!-- START_9414204451cd021c827fee1a810d6ee7 -->
## Memes List
Active Memes

> Example request:

```bash
curl -X GET \
    -G "http://localhost/srbn-news/public/api/memes?%3Fpage%3D=9" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/memes"
);

let params = {
    "?page=": "9",
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
                "id": 1,
                "image": "image url",
                "likes_count": 10,
                "is_liked": true,
                "created_at": "2020-04-14 15:00",
                "updated_at": "2020-04-14 15:00"
            }
        ],
        "first_page_url": "URL\/\/api\/memes?page=2",
        "from": 16,
        "last_page": 4,
        "last_page_url": "URL\/\/api\/memes?page=4",
        "next_page_url": "URL\/\/api\/memes?page=3",
        "path": "URL\/api\/memes",
        "per_page": 15,
        "prev_page_url": "URL\/\/api\/memes?page=1",
        "to": 30,
        "total": 55
    },
    "message": "Memes data fetched successfully",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Memes not found",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}
```

### HTTP Request
`GET api/memes`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `?page=` |  optional  | next page - pagination

<!-- END_9414204451cd021c827fee1a810d6ee7 -->

#Poll


<!-- START_c910dbeb0d7a4446d17f71c415b165b1 -->
## Submit Poll
Header: X-Authorization: Bearer {token}

> Example request:

```bash
curl -X POST \
    "http://localhost/srbn-news/public/api/polls" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"optionId":7}'

```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/polls"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "optionId": 7
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
    "data": [
        {
            "id": 1,
            "value": "yes",
            "total": "33.3%"
        },
        {
            "id": 2,
            "value": "no",
            "total": "66.7%"
        }
    ],
    "message": "Done successfully",
    "code": 201
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "User not found",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "The options id field is required.",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}
```

### HTTP Request
`POST api/polls`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `optionId` | integer |  required  | option id.
    
<!-- END_c910dbeb0d7a4446d17f71c415b165b1 -->

<!-- START_5e2212a596ef344fd25bb3e585f8d725 -->
## Polls List
All polls list

> Example request:

```bash
curl -X GET \
    -G "http://localhost/srbn-news/public/api/polls?%3Fpage%3D=6&%3Flang%3Den=saepe" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/polls"
);

let params = {
    "?page=": "6",
    "?lang=en": "saepe",
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
                "id": 1,
                "title": "News Title",
                "description": "News Long Description",
                "type": "Image|Video",
                "content": "Image URL|Video URL",
                "is_full_width": 0,
                "note": "News notes",
                "source": "News Source",
                "source_url2": null,
                "source_url3": null,
                "source_url": "Source URL",
                "audio_url": "URL|null",
                "lang": "en",
                "total_views": 1,
                "created_at": "2020-04-14 15:00",
                "categories": [
                    {
                        "id": 2,
                        "name": "News",
                        "name_np": "News",
                        "position": 1,
                        "image": null,
                        "created_at": "2020-04-14 15:00"
                    }
                ],
                "poll": {
                    "id": 2,
                    "question": "What do you think?",
                    "post_id": 1,
                    "options": [
                        {
                            "id": 3,
                            "value": "Good",
                            "total": 0
                        },
                        {
                            "id": 4,
                            "value": "Bad",
                            "total": 0
                        }
                    ]
                }
            }
        ],
        "first_page_url": "URL\/api\/polls?page=1",
        "from": 16,
        "last_page": 4,
        "last_page_url": "URL\/api\/polls?page=4",
        "next_page_url": "URL\/api\/polls?page=3",
        "path": "URL\/api\/polls",
        "per_page": 15,
        "prev_page_url": "URL\/api\/polls?page=1",
        "to": 30,
        "total": 55
    },
    "message": "Poll data fetched successfully",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "No Polls found",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}
```

### HTTP Request
`GET api/polls`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `/categoryId` |  optional  | specific category Posts
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `?page=` |  optional  | next page - pagination
    `?lang=en` |  optional  | user preffered language en for english and ne for nepali

<!-- END_5e2212a596ef344fd25bb3e585f8d725 -->

#Post


<!-- START_60b18e7fe5d2ed6da6e8c38e34450dab -->
## User&#039;s Posts List
Header for User&#039;s Category Posts: X-Authorization: Bearer {token}

> Example request:

```bash
curl -X GET \
    -G "http://localhost/srbn-news/public/api/posts/user?%3Fpage%3D=11" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/posts/user"
);

let params = {
    "?page=": "11",
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
                "id": 1,
                "title": "News Title",
                "description": "News Long Description",
                "type": "Image|Video",
                "content": "Image URL|Video URL",
                "is_full_width": 0,
                "note": "News notes",
                "source": "News Source",
                "source_url": "Source URL",
                "source_url2": null,
                "source_url3": null,
                "audio_url": "URL|null",
                "is_poll": "true\/false",
                "total_views": 1,
                "lang": "en",
                "created_at": "2020-04-14 15:00",
                "categories": [
                    {
                        "id": 2,
                        "name": "News",
                        "name_np": "News",
                        "position": 1,
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
> Example response (200):

```json
{
    "status": false,
    "message": "User not found",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "No Posts found",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 200
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
    -G "http://localhost/srbn-news/public/api/posts/?%3Fpage%3D=13&%3Flang%3Den=rem" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/posts/"
);

let params = {
    "?page=": "13",
    "?lang=en": "rem",
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
                "id": 1,
                "title": "News Title",
                "description": "News Long Description",
                "type": "Image|Video",
                "content": "Image URL|Video URL",
                "is_full_width": 0,
                "note": "News notes",
                "source": "News Source",
                "source_url": "Source URL",
                "source_url2": null,
                "source_url3": null,
                "audio_url": "URL|null",
                "is_poll": "true\/false",
                "total_views": 1,
                "lang": "en",
                "created_at": "2020-04-14 15:00",
                "categories": [
                    {
                        "id": 2,
                        "name": "News",
                        "name_np": "News",
                        "position": 1,
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
> Example response (200):

```json
{
    "status": false,
    "message": "No Posts found",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 200
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
    `?lang=en` |  optional  | user preffered language en for english and ne for nepali

<!-- END_fd1746447c684f78c26acc72a048bdab -->

<!-- START_e28169d65ef543ab05722bf43378edac -->
## Post Views Increment

> Example request:

```bash
curl -X POST \
    "http://localhost/srbn-news/public/api/posts/total-views" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"postId":4}'

```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/posts/total-views"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "postId": 4
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
    "data": [],
    "message": "Done successfully",
    "code": 201
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "The post id field is required.",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}
```

### HTTP Request
`POST api/posts/total-views`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `postId` | integer |  required  | option id.
    
<!-- END_e28169d65ef543ab05722bf43378edac -->

#Quotes


<!-- START_26a1da690bab0a9919b2b75870728658 -->
## Like Quote
Header: X-Authorization: Bearer {token}

> Example request:

```bash
curl -X POST \
    "http://localhost/srbn-news/public/api/quotes" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"quote":18}'

```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/quotes"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "quote": 18
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
    "data": [],
    "message": "Quote Liked successfully",
    "code": 201
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "User not found",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "The quote field is required.",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}
```

### HTTP Request
`POST api/quotes`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `quote` | integer |  required  | quote ID.
    
<!-- END_26a1da690bab0a9919b2b75870728658 -->

<!-- START_56ba292f581ed455975d8ec6af1d8f08 -->
## Quote Lists
Active Quotes

> Example request:

```bash
curl -X GET \
    -G "http://localhost/srbn-news/public/api/quotes?%3Fpage%3D=8" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/quotes"
);

let params = {
    "?page=": "8",
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
                "id": 1,
                "quote": "quote goes here",
                "author": "quote author",
                "totalLikes": 5,
                "translation": {
                    "quote": "quote in nepali",
                    "author": "author in nepali"
                },
                "isLiked": true,
                "created_at": "2020-04-14 15:00"
            }
        ],
        "first_page_url": "URL\/api\/quotes?page=1",
        "from": 16,
        "last_page": 4,
        "last_page_url": "URL\/api\/quotes?page=4",
        "next_page_url": "URL\/api\/quotes?page=3",
        "path": "URL\/api\/quotes",
        "per_page": 15,
        "prev_page_url": "URL\/api\/quotes?page=1",
        "to": 30,
        "total": 55
    },
    "message": "Quotes data fetched successfully",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Quotes not found",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "User not found",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}
```

### HTTP Request
`GET api/quotes`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `?page=` |  optional  | next page - pagination

<!-- END_56ba292f581ed455975d8ec6af1d8f08 -->

#RSS Feed


<!-- START_fcf551e160e07d87b23798910a604cd4 -->
## RSS Feed Lists
Active RSS Feeds

> Example request:

```bash
curl -X GET \
    -G "http://localhost/srbn-news/public/api/rss-feed" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/rss-feed"
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
            "id": 1,
            "name": "Feed Name",
            "tagline": "Feed Tagline",
            "logo": "Feed Logo URL"
        }
    ],
    "message": "RSS Feed data fetched successfully",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "RSS Feed data not found",
    "code": 200
}
```

### HTTP Request
`GET api/rss-feed`


<!-- END_fcf551e160e07d87b23798910a604cd4 -->

<!-- START_200ebe8db6fa4be3916ab207ffc073e5 -->
## Pull RSS Feed

> Example request:

```bash
curl -X GET \
    -G "http://localhost/srbn-news/public/api/rss-feed/1" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/rss-feed/1"
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
            "title": "News Title",
            "description": "News Long Description",
            "image_url": "Image URL|null",
            "source": "News Source",
            "source_url": "Source URL",
            "author": "author name|null",
            "date": "2020-04-14 15:00"
        },
        {
            "title": "News Title",
            "description": "News Long Description",
            "image_url": "Image URL|null",
            "source": "News Source",
            "source_url": "Source URL",
            "author": "author name|null",
            "date": "2020-04-14 15:10"
        }
    ],
    "message": "RSS Feed data fetched successfully",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "RSS Feed data not found",
    "code": 200
}
```

### HTTP Request
`GET api/rss-feed/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `/id` |  required  | rss feed id

<!-- END_200ebe8db6fa4be3916ab207ffc073e5 -->

#User


<!-- START_444008ca6541ddc5d3dae8434120a6d1 -->
## Social Login APIs
Social User Login
APIs for Social User Login

> Example request:

```bash
curl -X POST \
    "http://localhost/srbn-news/public/api/social/login" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"name":"explicabo","email":"deserunt","image":"impedit","social_id":"quia","provider":"dolorum"}'

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
    "name": "explicabo",
    "email": "deserunt",
    "image": "impedit",
    "social_id": "quia",
    "provider": "dolorum"
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
    "code": 201
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "The social id field is required.",
    "code": 200
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

<!-- START_87f75baa498d3fb7f48056d02874ea0c -->
## Phone Login APIs
Phone User Login
APIs for Phone User Login

> Example request:

```bash
curl -X POST \
    "http://localhost/srbn-news/public/api/phone/login" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"phone":9}'

```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/phone/login"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "phone": 9
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
        "phone": 98788499012,
        "created_at": "2020-04-14 15:00",
        "token": "JWT Token"
    },
    "message": "Logged in successfully",
    "code": 201
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Phone not registered yet.",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "The phone field is required.",
    "code": 200
}
```

### HTTP Request
`POST api/phone/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `phone` | integer |  required  | phone of user.
    
<!-- END_87f75baa498d3fb7f48056d02874ea0c -->

<!-- START_d7b7952e7fdddc07c978c9bdaf757acf -->
## Registration APIs
User Registration

> Example request:

```bash
curl -X POST \
    "http://localhost/srbn-news/public/api/register" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"name":"dolores","email":"fugiat","address":"dignissimos","phone":13,"image":"autem"}'

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
    "name": "dolores",
    "email": "fugiat",
    "address": "dignissimos",
    "phone": 13,
    "image": "autem"
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
> Example response (200):

```json
{
    "status": false,
    "message": "The Full Name field is required.",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "The email has already been taken.",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "The Image failed to upload.",
    "code": 200
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
        `phone` | integer |  optional  | min 10 in length.
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
> Example response (200):

```json
{
    "status": false,
    "message": "User not found",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 200
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


> Example response (201):

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
                "name_np": "News",
                "position": 1,
                "image": null,
                "created_at": "2020-04-14 15:00"
            }
        ],
        "created_at": "2020-04-14 15:00"
    },
    "message": "User Categories Added successfully",
    "code": 201
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "User not found",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "The categories field is required.",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}
```

### HTTP Request
`POST api/user/set-category`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `categories` | array |  required  | [categories ID].
    
<!-- END_a5dd4caeeb907ed5b6629da5f3330bb9 -->

<!-- START_68d3124411929696f2a51941c0d41a57 -->
## Profile APIs
User Profile Image

> Example request:

```bash
curl -X POST \
    "http://localhost/srbn-news/public/api/user/profile/update" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"image":"molestiae"}'

```

```javascript
const url = new URL(
    "http://localhost/srbn-news/public/api/user/profile/update"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "image": "molestiae"
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
null
```
> Example response (200):

```json
{
    "status": false,
    "message": "The Full Name field is required.",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "The email has already been taken.",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "The password must be at least 6 characters.",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "The Image failed to upload.",
    "code": 200
}
```
> Example response (200):

```json
{
    "status": false,
    "message": "Login error",
    "code": 200
}
```

### HTTP Request
`POST api/user/profile/update`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `image` | file |  optional  | accepts: jpeg,png,gif, filesize upto 2MB.
    
<!-- END_68d3124411929696f2a51941c0d41a57 -->


