<?php

require_once('db5.php');
$query = "select * from chat";
$result = mysqli_query($conn,$query);

?>
<?php

require_once('db6.php');
$query = "select * from achat";
$result1 = mysqli_query($conn,$query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Admin-Doubts Session</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    body, html {
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f4f4f9;
    }

    .chat-container {
      width: 1000px;
      height: 90vh;
      background-color: #ffffff;
      display: flex;
      flex-direction: column;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      margin-left:150px;
    }

    .chat-header {
      padding: 20px;
      background-color: rgb(223, 140, 44);
      color: #ffffff;
      font-size: 18px;
      text-align: center;
    }

    
    .chat-messages {
      flex: 1;
      padding: 15px;
      overflow-y: auto;
      background-color: #f9f9f9;
    }

    .message {
  max-width: 75%;
  padding: 15px;
  border-radius: 10px;
  margin-bottom: 15px;
  word-wrap: break-word;
  font-size: 16px;
  line-height: 1.4;
 
}

.message.received {
  background-color: #d1e7dd;
  align-self: flex-start;
  text-align: left;
}

.message.sent {
  background-color: rgb(223, 140, 44);
  color: white;
  align-self: flex-end;
  text-align: right;
  margin-left: auto; /* Push to the right */
}

    .chat-input {
      display: flex;
      align-items: center;
      padding: 15px;
      background-color: #ffffff;
      border-top: 1px solid #ddd;
    }

    .chat-input input {
      flex: 1;
      padding: 10px 15px;
      border: 1px solid #ddd;
      border-radius: 25px;
      font-size: 16px;
      outline: none;
      margin-right: 10px;
    }

    .chat-input button {
      background-color: rgb(223, 140, 44);
      color: white;
      border: none;
      border-radius: 50%;
      width: 45px;
      height: 45px;
      cursor: pointer;
      font-size: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .chat-input button:hover {
      background-color: #4e4e63;
    }
    @import url("https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap");

/* =============== Globals ============== */
* {
  font-family: "Ubuntu", sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

:root {
  --orange: rgb(223, 140, 44);
  --white: #fff;
  --gray: #f5f5f5;
  --black1: #222;
  --black2: #999;
}

body {
  min-height: 100vh;
  overflow-x: hidden;
}

.container {
  position: relative;
  width: 100%;
}

/* =============== Navigation ================ */
.navigation {
  position: fixed;
  width: 300px;
  height: 100%;
  left:0;
  top: 0;
  background: var(--orange);
  border-left: 10px solid var(--orange);
  transition: 0.5s;
  overflow: hidden;
}
.navigation.active {
  width: 80px;
}
.navigation ul {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
}

.navigation ul li {
  position: relative;
  width: 100%;
  list-style: none;
  border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
}

.navigation ul li:hover,
.navigation ul li.hovered {
  background-color: var(--white);
}

.navigation ul li:nth-child(1) {
  margin-bottom: 40px;
  pointer-events: none;
}

.navigation ul li a {
  position: relative;
  display: block;
  width: 100%;
  display: flex;
  text-decoration: none;
  color: var(--white);
}
.navigation ul li:hover a,
.navigation ul li.hovered a {
  color: var(--orange);
}

.navigation ul li a .icon {
  position: relative;
  display: block;
  min-width: 60px;
  height: 60px;
  line-height: 75px;
  text-align: center;
}
.navigation ul li a .icon ion-icon {
  font-size: 1.75rem;
}

.navigation ul li a .title {
  position: relative;
  display: block;
  padding: 0 10px;
  height: 60px;
  line-height: 60px;
  text-align: start;
  white-space: nowrap;
}

/* --------- curve outside ---------- */
.navigation ul li:hover a::before,
.navigation ul li.hovered a::before {
  content: "";
  position: absolute;
  right: 0;
  top: -50px;
  width: 50px;
  height: 50px;
  background-color: transparent;
  border-radius: 50%;
  box-shadow: 35px 35px 0 10px var(--white);
  pointer-events: none;
}
.navigation ul li:hover a::after,
.navigation ul li.hovered a::after {
  content: "";
  position: absolute;
  right: 0;
  bottom: -50px;
  width: 50px;
  height: 50px;
  background-color: transparent;
  border-radius: 50%;
  box-shadow: 35px -35px 0 10px var(--white);
  pointer-events: none;
}


  </style>
</head>
<body>
<div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                         
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="attend.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Attendance</span>
                    </a>
                </li>

                <li>
                    <a href="adminnotification.php">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Notices</span>
                    </a>
                </li>

                <li>
                    <a href="adchat.php">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Doubts</span>
                    </a>
                </li>

                <li>
                    <a href="admin_result.php">
                        <span class="icon">
                            <ion-icon name="clipboard-outline"></ion-icon>
                        </span>
                        <span class="title">Result</span>
                    </a>
                </li>

                <li>
                    <a href="admincalender.html">
                        <span class="icon">
                            <ion-icon name="calendar-outline"></ion-icon>
                        </span>
                        <span class="title">TimeTable</span>
                    </a>
                </li>

                <li>
                    <a href="mainadmin.html">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

  <div class="chat-container">
    <div class="chat-header">
      CLASS-SYNC(STUDENT-TEACHER CONNECT)
    </div>

    <div class="chat-messages" id="chat-messages">
      <!-- Messages will be added here by JavaScript -->
    </div>
    <form method="post" action="achat.php"> 
    <div style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; ">
    <div class="chat-messages" id="chat-messages">
  <?php
    // Render student (received) messages
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='message received'><strong>Student:</strong> " . htmlspecialchars($row['msg']) . "</div>";
    }

    // Render teacher (sent) messages
    while ($row = mysqli_fetch_assoc($result1)) {
        echo "<div class='message sent'><strong>Teacher:</strong> " . htmlspecialchars($row['msg1']) . "</div>";
    }
  ?>
</div>


</div>

         <div class="chat-input">
        <input type="text" id="messageInput" placeholder="Enter your message" name="msg1" required>
        <button id="sendButton" value="submit">➤</button>
      </div>
    </div>
  </form>

  <script>
    const chatMessages = document.getElementById("chat-messages");
    const messageInput = document.getElementById("messageInput");
    const sendButton = document.getElementById("sendButton");

    // Function to add a message to the chat
    function addMessage(text, type) {
      const messageElement = document.createElement("div");
      messageElement.classList.add("message", type);
      messageElement.textContent = text;
      chatMessages.appendChild(messageElement);
      chatMessages.scrollTop = chatMessages.scrollHeight; // Auto-scroll to the bottom
    }

    // Event listener for the Send button
    sendButton.addEventListener("click", () => {
      const text = messageInput.value.trim();
      if (text) {
        addMessage(text, "sent");
        messageInput.value = "";

      //   // Simulate received message after a delay
      //   setTimeout(() => {
      //     addMessage("Response: " + text, "received");
      //   }, 1000);
      // }
    });

    // Allow pressing "Enter" to send the message
    messageInput.addEventListener("keypress", (e) => {
      if (e.key === "Enter") {
        sendButton.click();
      }
    });
  </script>
</body>
</html>