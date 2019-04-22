<?php
	
	// if the request method is GET
	if ($method === 'GET') {
		if ($id) {
			$data = $db->query("SELECT * FROM $table_name WHERE id = '{$id}'");

			if ($data !== null) {
				http_response_code(200);
				echo json_encode($data);
			}
			else{
				http_response_code(404);
				echo json_encode(['message' => 'No post available for the specified id value!']);
			}
		}
		else{
			$data = $db->selectAll("SELECT * FROM $table_name");
			// print_r($data);
			http_response_code(200);
			echo json_encode($data);
		}
	}
	else if ($method === 'POST') {
		if ($_POST !== null && !$id) {
			// extracting $_POST data
			extract($_POST);
			// print_r($title);
			// print_r($body);
			// print_r($author);
			// insert the data into database
			$insert = $db->insert("INSERT INTO $table_name (title, body, author) VALUES ('$title', '$body', '$author')");
			if ($insert) {
				// send the data back to the user
				$data = $db->query("SELECT * FROM $table_name ORDER BY id DESC LIMIT 1");
				http_response_code(200);
				echo json_encode([
					'message' => 'Post added successfully!',
					'success' => true,
					'post' => $data
				]);
			}
			else{
				http_response_code(500);
				echo json_encode(['message' => 'Post not sent!']);
			}
			
		}
		else{
			http_response_code(404);
			echo json_encode([
				'message' => 'Please provide neccessary resources!',
				'success' => false
			]);
		}
	}
	// Deleting a post by id
	else if($id){
		// check if the post exist
		$post = $db->query("SELECT * FROM $table_name WHERE id = '{$id}' LIMIT 1");
		if ($post !== null) {
			if ($method === 'PUT') {
				// get neccessary json data and convert it to assoc array and extract it
				extract(json_decode(file_get_contents('php://input'), true));
				// print_r($title);
				// update the resource
				$db->query("UPDATE $table_name SET title = '{$title}', body = '{$body}', author = '{$author}' WHERE id = '{$id}'");
				$data = $db->query("SELECT * FROM $table_name WHERE id = '{$id}' LIMIT 1");
				http_response_code(200);
				echo json_encode([
					'message' => 'Post updated successfully!',
					'success' => true,
					'post' => $data
				]);
			} else if ($method === 'DELETE') {
				$db->query("DELETE FROM $table_name WHERE id = '{$id}'");
				http_response_code(200);
				echo json_encode([
					'message' => 'Post deleted successfully!',
					'success' => true
				]);
			}
			
		}
		else{
			http_response_code(404);
			echo json_encode([
				'message' => 'Post not found!',
				'success' => false
			]);
		}
	}

?>