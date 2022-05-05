<?php
// call the startconn function in 'db-connect.php'
include 'db-connect.php';

// This is the file main function engine
function start() {
    // if GET method is identified do the below
    if (isset($_GET['id'])) {
        // Call the function from 'db-connect.php'
        $conn = startconn();
	    
		$id = $_GET['id'];
	    
		// ------- NORMAL/ NO protect ---------
	
		$sql = "SELECT o.id, o.full_name,o.country_code,i.code,i.continent_name 
								FROM users o 
								INNER JOIN country i 
								ON o.country_code = i.code
								WHERE id LIKE $id";
		$result = $conn->query($sql) or die($conn->error);
		
		// ------- Stripslashes & real escape string --------
		
      		/*
		$id = stripslashes($id);
        	$id = $conn->real_escape_string($id);
		$sql = "SELECT o.id, o.full_name,o.country_code,i.code,i.continent_name 
								FROM users o 
								INNER JOIN country i 
								ON o.country_code = i.code
								WHERE id LIKE $id";
		$result = $conn->query($sql) or die($conn->error);
		*/
		
		
		// ------- Prepare Statement --------
		
		/*
		$stmt =$conn->prepare("SELECT o.id, o.full_name,o.country_code,i.code,i.continent_name 
								FROM users o 
								INNER JOIN country i 
								ON o.country_code = i.code
								WHERE id LIKE ?");
		$stmt->bind_param('s',$id);
		$stmt->execute();
		$result = $stmt->get_result();
		*/
		
        // Below this is all part of the output printed on the screen
        $num = $result->num_rows;
        $cnt = 0;

        // if $num is higher than 0 run the code below
        if ($num > $cnt) {
            // For every item run the code below, +1 to $cnt variable
            for ($cnt; $cnt < $num; $cnt++) {
                // Retrieve the data, this is an array
                $data = $result->fetch_assoc();
                // print the values
				echo "ID: ";
                echo print_r($data["id"], true) . "<br>";
                echo "Name: ";
                echo print_r($data["full_name"], true) . "<br>";
				echo "Continent: ";
                echo print_r($data["continent_name"], true) . "<br>";
            }
            //return option
            echo "<a href='http://localhost/esqiuelai/index.html'>back</a>";
        }
        // Redirect if the id doesn't exist
        else {
            header("Location: http://localhost/esqiuelai/index.html", true, 301);
            exit();
        }
    }
}
// run the function
start();
