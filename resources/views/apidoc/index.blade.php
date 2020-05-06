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
    -G "http://localhost/srbn-news/public/api/category/user" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
<!-- START_16d14ae050e1d02cfec8e9d382eec891 -->
<h2>Root Categories</h2>
<p>Active Root Categories</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/srbn-news/public/api/category/" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/srbn-news/public/api/category/"
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
<p><code>GET api/category/{parentId?}</code></p>
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
<td><code>/parentId</code></td>
<td>optional</td>
<td>category childs</td>
</tr>
</tbody>
</table>
<!-- END_16d14ae050e1d02cfec8e9d382eec891 -->
<!-- START_2ccc924521835169507dcad9b468f840 -->
<h2>Categories Tree</h2>
<p>Active Categories Tree Structure</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/srbn-news/public/api/category-tree" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/srbn-news/public/api/category-tree"
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
<p><code>GET api/category-tree</code></p>
<!-- END_2ccc924521835169507dcad9b468f840 -->
<h1>Post</h1>
<!-- START_60b18e7fe5d2ed6da6e8c38e34450dab -->
<h2>User&#039;s Posts List</h2>
<p>Header for User&#039;s Category Posts: X-Authorization: Bearer {token}</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/srbn-news/public/api/posts/user?%3Fpage%3D=17" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/srbn-news/public/api/posts/user"
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
                "type": "Image|Video|Advertisement",
                "content": "Image URL|Video URL|Advertisement URL",
                "note": "News notes",
                "source": "News Source",
                "source_url": "Source URL",
                "audio_url": "URL|null",
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
    -G "http://localhost/srbn-news/public/api/posts/?%3Fpage%3D=17" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/srbn-news/public/api/posts/"
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
                "type": "Image|Video|Advertisement",
                "content": "Image URL|Video URL|Advertisement URL",
                "note": "News notes",
                "source": "News Source",
                "source_url": "Source URL",
                "audio_url": "URL|null",
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
<h1>User</h1>
<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
<h2>Login APIs</h2>
<p>User Login
APIs for User Login</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/srbn-news/public/api/login" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"email":"repellat","password":"repellendus"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/srbn-news/public/api/login"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "email": "repellat",
    "password": "repellendus"
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
    "http://localhost/srbn-news/public/api/social/login" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"name":"enim","email":"consequatur","image":"quos","social_id":"culpa","provider":"tenetur"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/srbn-news/public/api/social/login"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "name": "enim",
    "email": "consequatur",
    "image": "quos",
    "social_id": "culpa",
    "provider": "tenetur"
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
<!-- START_d7b7952e7fdddc07c978c9bdaf757acf -->
<h2>Registration APIs</h2>
<p>User Registration</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/srbn-news/public/api/register" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"name":"ex","email":"est","address":"fugit","password":"et","image":"atque"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/srbn-news/public/api/register"
);

let headers = {
    "Content-Type": "application/json",
    "X-Authorization": "Bearer {token}",
    "Accept": "application/json",
};

let body = {
    "name": "ex",
    "email": "est",
    "address": "fugit",
    "password": "et",
    "image": "atque"
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
    -G "http://localhost/srbn-news/public/api/auth-user" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    "http://localhost/srbn-news/public/api/user/set-category" \
    -H "Content-Type: application/json" \
    -H "X-Authorization: Bearer {token}" \
    -d '{"categories":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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