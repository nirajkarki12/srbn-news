<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>API Reference</title>

    <link rel="stylesheet" href="{{ asset('/docs/css/style.css') }}" />
    <script src="{{ asset('/docs/js/all.js') }}"></script>


          <script>
        $(function() {
            setupLanguages(["bash","javascript"]);
        });
      </script>
      </head>

  <body class="">
    <a href="#" id="nav-button">
      <span>
        NAV
        <img src="/docs/images/navbar.png" />
      </span>
    </a>
    <div class="tocify-wrapper">
        <img src="/docs/images/logo.png" />
                    <div class="lang-selector">
                                  <a href="#" data-language-name="bash">bash</a>
                                  <a href="#" data-language-name="javascript">javascript</a>
                            </div>
                            <div class="search">
              <input type="text" class="search" id="input-search" placeholder="Search">
            </div>
            <ul class="search-results"></ul>
              <div id="toc">
      </div>
                    <ul class="toc-footer">
                                  <li><a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a></li>
                            </ul>
            </div>
    <div class="page-wrapper">
      <div class="dark-box"></div>
      <div class="content">
          <!-- START_INFO -->
<h1>Info</h1>
<p>Welcome to the generated API reference.</p>
<!-- END_INFO -->
<h1>Category</h1>
<!-- START_33861d0c40ad6fc3c83572667744074b -->
<h2>User&#039;s Categories</h2>
<p>Header: X-Authorization: Bearer {token}</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost:8000/api/category/user" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/category/user"
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "User not found",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Categories not found",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/category/user</code></p>
<!-- END_33861d0c40ad6fc3c83572667744074b -->
<!-- START_db20564ba266cd451caac114b3eac8ab -->
<h2>Categories</h2>
<p>Active Categories</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost:8000/api/category" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/category"
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": true,
    "data": [
        {
            "id": 2,
            "name": "News",
            "description": null,
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Categories not found",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/category</code></p>
<!-- END_db20564ba266cd451caac114b3eac8ab -->
<h1>Horoscope Api</h1>
<!-- START_0ba251bf4f25186bc122282db6cf38a4 -->
<h2>List Horoscope</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost:8000/api/list/horoscope?%3Flang%3D=itaque" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/list/horoscope"
);

let params = {
    "?lang=": "itaque",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/list/horoscope</code></p>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>?lang=</code></td>
<td>optional</td>
<td>language parameter en for english ne for nepali</td>
</tr>
</tbody>
</table>
<!-- END_0ba251bf4f25186bc122282db6cf38a4 -->
<!-- START_22ec8148905988e4fc99e059fb05214f -->
<h2>Select Unselect Horoscope</h2>
<p>Header: X-Authorization: Bearer {token}</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost:8000/api/horoscope/dolore?%3Flang%3D=ipsum" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/horoscope/dolore"
);

let params = {
    "?lang=": "ipsum",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/horoscope/{horoscope}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>horoscope</code></td>
<td>required</td>
<td>horoscope id</td>
</tr>
</tbody>
</table>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>?lang=</code></td>
<td>optional</td>
<td>preferred language en for english, ne for nepali</td>
</tr>
</tbody>
</table>
<!-- END_22ec8148905988e4fc99e059fb05214f -->
<!-- START_384b2c2967f97c1e51e10b0feedf1a1c -->
<h2>Fetch Prediction</h2>
<p>Header: X-Authorization: Bearer {token}</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost:8000/api/predict/horoscope?timeline=et&amp;lang%3Den=aliquam" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/predict/horoscope"
);

let params = {
    "timeline": "et",
    "lang=en": "aliquam",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Nothing to show",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/predict/horoscope</code></p>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>timeline</code></td>
<td>required</td>
<td>timeline period to show daily, tomorrow, weekly, monthly, yearly</td>
</tr>
<tr>
<td><code>lang=en</code></td>
<td>optional</td>
<td>language of the user en for english, ne for nepali</td>
</tr>
</tbody>
</table>
<!-- END_384b2c2967f97c1e51e10b0feedf1a1c -->
<h1>Life Hack &amp; Meme</h1>
<!-- START_6c9a429a2ededa75193277eaf9290987 -->
<h2>Like Unlike Memes</h2>
<p>Header: X-Authorization: Bearer {token},</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost:8000/api/memes/like/ducimus" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/memes/like/ducimus"
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Meme not found",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/memes/like/{meme}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>meme</code></td>
<td>required</td>
<td>meme id</td>
</tr>
</tbody>
</table>
<!-- END_6c9a429a2ededa75193277eaf9290987 -->
<!-- START_58ef53c1134d3fd57e2d1b0531fb1ab1 -->
<h2>Like Unlike Life Hack</h2>
<p>Header: X-Authorization: Bearer {token}</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost:8000/api/life-hacks/like/eos" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/life-hacks/like/eos"
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Life hack not found",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/life-hacks/like/{lifehack}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>lifehack</code></td>
<td>required</td>
<td>life hack id</td>
</tr>
</tbody>
</table>
<!-- END_58ef53c1134d3fd57e2d1b0531fb1ab1 -->
<!-- START_587189636942669637216c31b27fd1f6 -->
<h2>Life Hacks List</h2>
<p>Active Life Hacs</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost:8000/api/life-hacks?lang%3Den=quisquam&amp;%3Fpage%3D=19" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/life-hacks"
);

let params = {
    "lang=en": "quisquam",
    "?page=": "19",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Life Hacks not found",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/life-hacks</code></p>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>lang=en</code></td>
<td>optional</td>
<td>preferred language en for english, ne for nepali</td>
</tr>
<tr>
<td><code>?page=</code></td>
<td>optional</td>
<td>next page - pagination</td>
</tr>
</tbody>
</table>
<!-- END_587189636942669637216c31b27fd1f6 -->
<!-- START_9414204451cd021c827fee1a810d6ee7 -->
<h2>Memes List</h2>
<p>Active Memes</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost:8000/api/memes?%3Fpage%3D=20" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/memes"
);

let params = {
    "?page=": "20",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Memes not found",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/memes</code></p>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>?page=</code></td>
<td>optional</td>
<td>next page - pagination</td>
</tr>
</tbody>
</table>
<!-- END_9414204451cd021c827fee1a810d6ee7 -->
<h1>Poll</h1>
<!-- START_c910dbeb0d7a4446d17f71c415b165b1 -->
<h2>Submit Poll</h2>
<p>Header: X-Authorization: Bearer {token}</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost:8000/api/polls" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"optionId":18}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/polls"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "optionId": 18
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (201):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "User not found",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "The options id field is required.",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/polls</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>optionId</code></td>
<td>integer</td>
<td>required</td>
<td>option id.</td>
</tr>
</tbody>
</table>
<!-- END_c910dbeb0d7a4446d17f71c415b165b1 -->
<!-- START_5e2212a596ef344fd25bb3e585f8d725 -->
<h2>Polls List</h2>
<p>All Polls list</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost:8000/api/polls?%3Fpage%3D=17" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/polls"
);

let params = {
    "?page=": "17",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": true,
    "data": {
        "current_page": 2,
        "data": [
            {
                "id": 1,
                "title": "News Title",
                "description": "News Long Description",
                "question": "Poll question",
                "type": "Image|Video",
                "content": "Image URL|Video URL",
                "audio_url": "URL|null",
                "created_at": "2020-04-14 15:00",
                "options": [
                    {
                        "id": 2,
                        "value": "Yes"
                    },
                    {
                        "id": 3,
                        "value": "No"
                    }
                ]
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "No Polls found",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/polls</code></p>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>?page=</code></td>
<td>optional</td>
<td>next page - pagination</td>
</tr>
</tbody>
</table>
<!-- END_5e2212a596ef344fd25bb3e585f8d725 -->
<h1>Post</h1>
<!-- START_60b18e7fe5d2ed6da6e8c38e34450dab -->
<h2>User&#039;s Posts List</h2>
<p>Header for User&#039;s Category Posts: X-Authorization: Bearer {token}</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost:8000/api/posts/user?%3Fpage%3D=13" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/posts/user"
);

let params = {
    "?page=": "13",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
                "note": "News notes",
                "source": "News Source",
                "source_url": "Source URL",
                "audio_url": "URL|null",
                "created_at": "2020-04-14 15:00",
                "translation": {
                    "title": "translation title",
                    "description": "translation description",
                    "note": "translation note",
                    "source": "translation source"
                },
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "User not found",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "No Posts found",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/posts/user</code></p>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>?page=</code></td>
<td>optional</td>
<td>next page - pagination</td>
</tr>
</tbody>
</table>
<!-- END_60b18e7fe5d2ed6da6e8c38e34450dab -->
<!-- START_fd1746447c684f78c26acc72a048bdab -->
<h2>Posts List</h2>
<p>All posts list</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost:8000/api/posts/?%3Fpage%3D=8" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/posts/"
);

let params = {
    "?page=": "8",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
                "note": "News notes",
                "source": "News Source",
                "source_url": "Source URL",
                "audio_url": "URL|null",
                "created_at": "2020-04-14 15:00",
                "translation": {
                    "title": "translation title",
                    "description": "translation description",
                    "note": "translation note",
                    "source": "translation source"
                },
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "No Posts found",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/posts/{categoryId?}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>/categoryId</code></td>
<td>optional</td>
<td>specific category Posts</td>
</tr>
</tbody>
</table>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>?page=</code></td>
<td>optional</td>
<td>next page - pagination</td>
</tr>
</tbody>
</table>
<!-- END_fd1746447c684f78c26acc72a048bdab -->
<h1>Quotes</h1>
<!-- START_26a1da690bab0a9919b2b75870728658 -->
<h2>Like Quote</h2>
<p>Header: X-Authorization: Bearer {token}</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost:8000/api/quotes" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"quote":15}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/quotes"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "quote": 15
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (201):</p>
</blockquote>
<pre><code class="language-json">{
    "status": true,
    "data": [],
    "message": "Quote Liked successfully",
    "code": 201
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "User not found",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "The quote field is required.",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/quotes</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>quote</code></td>
<td>integer</td>
<td>required</td>
<td>quote ID.</td>
</tr>
</tbody>
</table>
<!-- END_26a1da690bab0a9919b2b75870728658 -->
<!-- START_56ba292f581ed455975d8ec6af1d8f08 -->
<h2>Quote Lists</h2>
<p>Active Quotes</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost:8000/api/quotes?%3Fpage%3D=20" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/quotes"
);

let params = {
    "?page=": "20",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Quotes not found",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "User not found",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/quotes</code></p>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>?page=</code></td>
<td>optional</td>
<td>next page - pagination</td>
</tr>
</tbody>
</table>
<!-- END_56ba292f581ed455975d8ec6af1d8f08 -->
<h1>RSS Feed</h1>
<!-- START_fcf551e160e07d87b23798910a604cd4 -->
<h2>RSS Feed Lists</h2>
<p>Active RSS Feeds</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost:8000/api/rss-feed" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/rss-feed"
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "RSS Feed data not found",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/rss-feed</code></p>
<!-- END_fcf551e160e07d87b23798910a604cd4 -->
<!-- START_200ebe8db6fa4be3916ab207ffc073e5 -->
<h2>Pull RSS Feed</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost:8000/api/rss-feed/1" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/rss-feed/1"
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "RSS Feed data not found",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/rss-feed/{id}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>/id</code></td>
<td>required</td>
<td>rss feed id</td>
</tr>
</tbody>
</table>
<!-- END_200ebe8db6fa4be3916ab207ffc073e5 -->
<h1>User</h1>
<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
<h2>Login APIs</h2>
<p>User Login
APIs for User Login</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost:8000/api/login" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"email":"quia","password":"dolore"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/login"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "email": "quia",
    "password": "dolore"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Username\/Password Mismatched",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/login</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>email</code></td>
<td>string</td>
<td>required</td>
<td>valid email address.</td>
</tr>
<tr>
<td><code>password</code></td>
<td>string</td>
<td>required</td>
<td>min 6 in length.</td>
</tr>
</tbody>
</table>
<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->
<!-- START_444008ca6541ddc5d3dae8434120a6d1 -->
<h2>Social Login APIs</h2>
<p>Social User Login
APIs for Social User Login</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost:8000/api/social/login" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"name":"ipsum","email":"magnam","image":"illum","social_id":"inventore","provider":"modi"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/social/login"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "name": "ipsum",
    "email": "magnam",
    "image": "illum",
    "social_id": "inventore",
    "provider": "modi"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "The social id field is required.",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/social/login</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>optional</td>
<td>optional name of user.</td>
</tr>
<tr>
<td><code>email</code></td>
<td>string</td>
<td>optional</td>
<td>optional valid email address.</td>
</tr>
<tr>
<td><code>image</code></td>
<td>string</td>
<td>optional</td>
<td>optional image link of user.</td>
</tr>
<tr>
<td><code>social_id</code></td>
<td>string</td>
<td>required</td>
<td>social id of user.</td>
</tr>
<tr>
<td><code>provider</code></td>
<td>string</td>
<td>required</td>
<td>social provider eg.facebook.</td>
</tr>
</tbody>
</table>
<!-- END_444008ca6541ddc5d3dae8434120a6d1 -->
<!-- START_87f75baa498d3fb7f48056d02874ea0c -->
<h2>Phone Login APIs</h2>
<p>Phone User Login
APIs for Phone User Login</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost:8000/api/phone/login" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"phone":20,"password":"vitae"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/phone/login"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "phone": 20,
    "password": "vitae"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (201):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "The phone field is required.",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/phone/login</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>phone</code></td>
<td>integer</td>
<td>required</td>
<td>phone of user.</td>
</tr>
<tr>
<td><code>password</code></td>
<td>string</td>
<td>required</td>
<td>password of user.</td>
</tr>
</tbody>
</table>
<!-- END_87f75baa498d3fb7f48056d02874ea0c -->
<!-- START_d7b7952e7fdddc07c978c9bdaf757acf -->
<h2>Registration APIs</h2>
<p>User Registration</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost:8000/api/register" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"name":"velit","email":"qui","address":"quos","password":"et","phone":16,"image":"doloremque"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/register"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "name": "velit",
    "email": "qui",
    "address": "quos",
    "password": "et",
    "phone": 16,
    "image": "doloremque"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (201):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "The Full Name field is required.",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "The email has already been taken.",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "The password must be at least 6 characters.",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "The Image failed to upload.",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Login error",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/register</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
<td>max 100 in length.</td>
</tr>
<tr>
<td><code>email</code></td>
<td>string</td>
<td>required</td>
<td>valid email address.</td>
</tr>
<tr>
<td><code>address</code></td>
<td>string</td>
<td>optional</td>
<td>max 100 in length.</td>
</tr>
<tr>
<td><code>password</code></td>
<td>string</td>
<td>required</td>
<td>min 6 in length.</td>
</tr>
<tr>
<td><code>phone</code></td>
<td>integer</td>
<td>optional</td>
<td>min 10 in length.</td>
</tr>
<tr>
<td><code>image</code></td>
<td>file</td>
<td>optional</td>
<td>accepts: jpeg,png,gif, filesize upto 2MB.</td>
</tr>
</tbody>
</table>
<!-- END_d7b7952e7fdddc07c978c9bdaf757acf -->
<!-- START_1f1c64179c56c967b085735d4e407bb5 -->
<h2>Authenticated User</h2>
<p>Header: X-Authorization: Bearer {token}</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost:8000/api/auth-user" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/auth-user"
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "User not found",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/auth-user</code></p>
<!-- END_1f1c64179c56c967b085735d4e407bb5 -->
<!-- START_a5dd4caeeb907ed5b6629da5f3330bb9 -->
<h2>Set Category APIs</h2>
<p>Header: X-Authorization: Bearer {token}</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost:8000/api/user/set-category" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"categories":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/set-category"
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (201):</p>
</blockquote>
<pre><code class="language-json">{
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
    "code": 201
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "User not found",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "The categories field is required.",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Invalid Request",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/user/set-category</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>categories</code></td>
<td>array</td>
<td>required</td>
<td>[categories ID].</td>
</tr>
</tbody>
</table>
<!-- END_a5dd4caeeb907ed5b6629da5f3330bb9 -->
<!-- START_68d3124411929696f2a51941c0d41a57 -->
<h2>Profile APIs</h2>
<p>User Profile Image</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost:8000/api/user/profile/update" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"image":"omnis"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/profile/update"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "image": "omnis"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (201):</p>
</blockquote>
<pre><code class="language-json">null</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "The Full Name field is required.",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "The email has already been taken.",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "The password must be at least 6 characters.",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "The Image failed to upload.",
    "code": 200
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": false,
    "message": "Login error",
    "code": 200
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/user/profile/update</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>image</code></td>
<td>file</td>
<td>optional</td>
<td>accepts: jpeg,png,gif, filesize upto 2MB.</td>
</tr>
</tbody>
</table>
<!-- END_68d3124411929696f2a51941c0d41a57 -->
      </div>
      <div class="dark-box">
                        <div class="lang-selector">
                                    <a href="#" data-language-name="bash">bash</a>
                                    <a href="#" data-language-name="javascript">javascript</a>
                              </div>
                </div>
    </div>
  </body>
</html>