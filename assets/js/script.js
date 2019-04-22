// DOM
const app = document.querySelector('#root');
app.setAttribute('style', 'margin-top: 50px;');
const logo = document.createElement('img');
logo.src = './assets/img/logo.png';
const row = document.createElement('div');
row.setAttribute('class', 'row');
logo.setAttribute('style', 'width: 60px;');
// placing the new elements in the root div
app.appendChild(logo);
app.appendChild(row);
// connecting to the api
// XMLHttpRequest objects are used to open connection to the API
// obtain the api endpoint
// endpoint = http://www.server.io/api/rest1/api/posts
// Retrieving the data with an HTTP request

var url = 'http://127.0.0.1/rest/api/posts';
// Create a request variable and assign a new XMLHttpRequest object to it.
var request = new XMLHttpRequest();

// Open a new connection, using the GET request on the URL endpoint
request.open('GET', url, true);
request.onload = function () {
	// Begin accessing JSON data here
	// convert JSON into JS object
	var data = JSON.parse(this.response);
	// check if the response is good
	var status = request.status;
	if (status >= 200 && status < 400) {
		// accessing all post title
		data.forEach(post => {
			const col = document.createElement('div');
			col.setAttribute('class', 'col s12 l4 m5');
			const card = document.createElement('div');
			card.setAttribute('class', 'card-panel blue lighten-1');
			
			const heading = document.createElement('h5');
			const body = document.createElement('p');
			const time = document.createElement('small');
			heading.setAttribute('class', 'yellow-text');
			body.setAttribute('class', 'flow-text truncate');
			time.setAttribute('class', 'right light');
			heading.textContent = post.title;
			body.textContent = post.body;
			time.textContent = post.created_at;
			
			row.appendChild(col);
			col.appendChild(card);
			card.appendChild(heading);
			card.appendChild(body);
			card.appendChild(time);
			// Log each post's title
	  		console.log(post.title);
		});
	}
	else{
		const errorMessage = createElement('marquee');
		errorMessage.textContent = "It's not working!";
		app.appendChild(errorMessage);
		console.log('error');
	}
		
}

// Send request
request.send();
