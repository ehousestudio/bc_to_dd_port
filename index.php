<?

// basecamp credentials
$bc_username = 'basecamp_username';
$bc_password = 'basecamp_password';

//done done credentials
$domain = "donedonedomain"; /* e.g. wearemammoth */
$token = "donedonetoken";
$username = "donedoneusername";
$password = "donedonepassword";

// Basecamp todo list url - appended with .json
$url = "https://basecamp.com/1758460/projects/project-name/todolists/todo-list-name.json";

// curl to basecamp to get todo list json data
$curl = curl_init($url); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_USERPWD, $bc_username . ':' . $bc_password);
curl_setopt($curl, CURLOPT_USERAGENT, 'Myapp (http://basecampport.domain.com/dd/)');
$todo_list = curl_exec($curl);
curl_close($curl);

// TODO: change this to pull from people / projects / priorities API
$project_id = 16438;
$fixer = 12345;
$resolver = 67890;
$medium = 2;

$todos = json_decode($todo_list);
$list_name = $todos->name;
$todos = $todos->todos->remaining;
foreach ($todos as $key => $todo):

	$data = array(
		'title' => $todo->content,
		'tags' => $list_name,
		'description' => ' ',
		'priority_level_id' => $medium,
		'resolver_id' => $fixer,
		'tester_id' => $resolver
	);

	$url = "https://".$domain.".mydonedone.com/IssueTracker/API/Issue/".$project_id;

	// cURL to DoneDone
  $curl = curl_init($url); 
  curl_setopt($curl, CURLOPT_HEADER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($curl, CURLOPT_USERPWD, $username . ':' . $token);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
  $result = curl_exec($curl);
  curl_close($curl);

endforeach;

?>