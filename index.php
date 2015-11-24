<?php
if (!$_GET['access_token']){
    echo "<script type='text/javascript'>window.location = 'https://oauth.groupme.com/oauth/authorize?client_id=NkuhJN7TVOnFFMar9YbaHe8OCGezw8TuPh5vxodpl1sQNz7M'</script>";
}
else {
$token = $_GET['access_token'];
//Structure
echo '
<!DOCTYPE HTML>
<head>
    <title>GroupMe KickOut</title>
    
    <style type="text/css" media="all">
        #app {
            background-color: #E0E0E0;
            position: absolute;
	    padding: 10px;
            left: 20%;
            top: 10%;
            border: 1px solid #000;
            width: 60%;
            height: 300px;
        }
    </style>
</head>
<body>
    <div id="app">
<h1>KickOut for GroupMe</h1>
        <form id="main" name="select">
        <label>Select Relevant Group:</label>
            <select id="groupSelector">
                <option value=""> </option>
            </select>
		<input type="button" value="Select Group" onclick="chooseGroup()">
	</br>
	</br>
		<label>Messages:</label>
            <select id="personSelector" onchange="paste()">
                <option value=""> </option>
            </select>
	</br>
	</br>
	<label>Name you wish to remove:</label>
	<input type="text" style="width: 200px;" id="removeId">
	</br>
	</br>
	<input type="button" value="Remove this person." style="width:175px; height:50px;" onclick="start()">
        </form>
	</br></br>
	</br></br>
	</br></br>

<h2>What is KickOut for GroupMe</h2>
</p>
<p>Does someone keep joining your group, posting something irrelevant, and then leave so you can\'t kick them? Kickout for GroupMe works by scanning a 

specific group for the system message that announces when a new user joins. As soon as this message is detected and the name in it matches the one you set 

to remove, we kick the user for you!</p>
<h2>How to use KickOut for Groupme</h2>
<ol type="1">
<li>Start by selecting the group you want to remove the offending person from. Up to 100 of your groups will be displayed. Click "Select Group" to 

continue.</li>
<li>Once you make a selection, a list of system mesages will be displayed pertaining to the chosen group. The system messages are generated whenever 

somebody enters, leaves, or otherwise makes changes to the group that are not messages. These show up with a grey background in the GroupMe app. <i>While 

these messages are provided for convenience, they are not the only names you can choose to remove. The list provided contains only some of the system 

messages from the group (out of the last 100 messages total in the group, per GroupMe\'s limits) and may not contain a name you want. See the next step for 

details.</i></li>
<li>The text you selected in the above step will be populated in the text field. <b>Remember, this is only a suggestion. Clicking the remove button at this 

point will not remove the user!</b> Make sure to correctly format the name you wish to remove. You can also enter any other name you wish to remove 

regardless of whether it was provided in the last step.</li>
<li>Click the "Remove Now" button. We\'ll scan the chat you selected and remove the user as soon as they try to re-join. Remember, we can only scan for a 

maximum of 30 minutes before you have to come back and repeat the steps. If you want to increase the scan time, <b>please donate below</b></li>
    </div>
    <p id="token"></p>
    <p id="response"></p>
    <script type="text/javascript" charset="utf-8">
    var token = "'.$token.'";
    document.getElementById("token").innerHTML = "Your token is: (hidden for security)";

	var groupX = new XMLHttpRequest();
    	var newIds = ["|"];
 		groupX.onreadystatechange = function() {
 		var groups = groupX.responseText;
		var fr = JSON.parse(groups);
		
		for (i=0;i<100;i++) {
		var x = document.getElementById("groupSelector");
    		var y = document.createElement("option");
		y.text = fr.response[i].name;
		x.add(y);
		newIds.push(fr.response[i].id);
		}
	}

 	groupX.open("GET", "https://api.groupme.com/v3/groups?token=" + token + "&per_page=100");
 	groupX.send();


		function chooseGroup() {
			var e = document.getElementById("groupSelector").selectedIndex;
			document.getElementById("response").innerHTML = "Selected Group (refresh page before changing selection):" + e;

			var groupZ = new XMLHttpRequest();
			groupZ.onreadystatechange = function() {
 		    	var gre = groupZ.responseText;
			var gr = JSON.parse(gre);
			
			for (i=0;i<100;i++){
			var t = document.getElementById("personSelector");
    			var u = document.createElement("option");
			var senderType = gr.response.messages[i].sender_type;
			
			if (senderType == \'system\') {
			u.text = gr.response.messages[i].text;
			t.add(u);
			}
			else {;}
		    }
		}
		var gid = newIds[e];
		groupZ.open("GET", "https://api.groupme.com/v3/groups/" + gid + "/messages?token=" + token + "&limit=100");
 		groupZ.send();

		}
	function paste() {
		var prepid = document.getElementById("personSelector").selectedIndex;
		var pid = document.getElementById("personSelector").options[prepid].text;
		document.getElementById("removeId").value = pid;
	}

	function start() {
		
	}
    </script>
</body>
</html>';
}
?>