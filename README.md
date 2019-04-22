# What is RESTful API?


<p>A RESTful API is a method of allowing communication between a web-based client and server that employs representational state transfer (REST) constraints.</p>


<h2>Allowed HTTPs requests:</h2>
<ul>
  <li>PUT     : To create resource </li>
  <li>POST    : Update resource</li>
  <li>GET     : Get a resource or list of resources</li>
  <li>DELETE  : To delete resource</li>
 </ul>

<h2>Description Of Usual Server Responses:</h2>
<ul>
  <li>200 OK - the request was successful.
  <li>201 <code>Created</code> - the request was successful and a resource was created.</li>
  <li>204 <code>No Content</code> - the request was successful but there is no representation to return (i.e. the response is empty).</li>
  <li>400 <code>Bad Request</code> - the request could not be understood or was missing required parameters.</li>
  <li>401 <code>Unauthorized</code> - authentication failed or user doesn't have permissions for requested operation.</li>
  <li>403 <code>Forbidden</code> - access denied.404 Not Found - resource was not found.</li>
  <li>405 <code>Method Not Allowed</code> - requested method is not supported for resource.</li>
  <li>504 <code>Server error</code> - Server is under maintenance or no internet connection</li>
</ul>

<h4>API Endpoint: </h4> <code>http://127.0.0.1/rest/api/posts</code>

<h5>Resources</h5>
<ul>
  <li><code>posts</code> - send a GET request to get the list of all posts.</li>
  <li><code>posts</code> - send a POST request to add new post.</li>
  <li><code>posts/{id}</code> -  send a GET request to get details of post with id {id}.</li>
  <li><code>posts/{id}</code> -  send a PUT request to update the content of a post with id {id}.</li>
  <li><code>posts/{id}</code> -  send a DELETE request to delete a post with id {id}.</li>
</ul>
