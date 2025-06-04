<?php

require_once('db6.php');
$query = "select * from achat";
$result = mysqli_query($conn,$query);

?>
<?php

require_once('db5.php');
$query = "select * from chat";
$result1 = mysqli_query($conn,$query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student-Doubts Session</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
    }

    .chat-header {
      padding: 20px;
      background-color: #74a6dc;
      color: #ffffff;
      font-size: 18px;
      text-align: center;
    }

    .chat-messages {
      flex: 1;
      padding: 20px;
      overflow-y: auto;
      background-color: #f9f9f9;
    }

    .message {
      max-width: 75%;
      margin-bottom: 15px;
      padding: 15px;
      border-radius: 10px;
      font-size: 16px;
      line-height: 1.4;
      word-wrap: break-word;
    }

    .sent {
      background-color: blue;
      align-self: flex-end;
    }

    .received {
      background-color: orange;
      align-self: flex-start;
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
      background-color: #74a6dc;
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
    body{
    height: 100%;
    margin: 0;
    background-color: aliceblue !important;
}
a{
    text-decoration: none;
}
.navbar {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    display: flex;
    justify-content: space-between;
    background-color: white;
    padding: 10px;
    height: 60px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.navbar a {
    margin: 0 15px;
    text-decoration: none;
    color: #333;
    font-size: 16px;
}

.navbar a:hover {
    color: #007bff;
}

/* Add padding to the body to avoid overlap with the fixed navbar */
body {
    padding-top: 70px; /* Adjust this value based on the navbar height */
}

  </style>
</head>
<body>
<head>
        <nav class="navbar">
            <a href="student.php"><i class="fa-solid fa-house"></i>&nbsp;&nbsp;&nbsp;Home</a>
            <a href="studentattendence.php"><i class="fa-solid fa-calendar-day"></i>&nbsp;&nbsp;&nbsp;Time Table</a>
            <a href="student_result.php"><i class="fa-solid fa-print"></i>&nbsp;&nbsp;&nbsp;Examination</a>
            <a href="student_announcements.php"><i class="fa-solid fa-microphone"></i>&nbsp;&nbsp;&nbsp;Announcements</a>
            <a href="chat.php">
                <span class="icon">
                    <ion-icon name="help-outline"></ion-icon>
                </span>
                <span class="title">Doubts</span>
            </a>
            <a href="try.php"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;&nbsp;Logout</a>
        </nav>
    </head>
    <br><br>
  <div class="chat-container">
    <div class="chat-header">
      CLASS-SYNC(STUDENT-TEACHER CONNECT)
    </div>

    <div class="chat-messages" id="chat-messages">
      <!-- Messages will be added here by JavaScript -->
    </div>
    <form method="post" action="ch.php"> 
    <div style="width: 100%; padding: 10px; background-color: #f1f1f1; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px;">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
      // Sender's message box (aligned right)
      echo "<div style='width: 65%; margin-right: auto; padding: 20px; background-color:  rgb(223, 140, 44);color:white; border: 1px solid #badbcc; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: left;'>";
      echo "<strong>Teacher:</strong> " . htmlspecialchars($row['msg1']);
      echo "</div>";
  }
    while ($row = mysqli_fetch_assoc($result1)) {
      // Receiver's message box (aligned left)
      echo "<div style='width: 65%; margin-left: auto; padding: 20px; background-color:#d1e7dd; border: 1px solid #f5c2c7; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: left;'>";
      echo "<strong>Student:</strong> " . htmlspecialchars($row['msg']);
      echo "</div>";
  }
?>


</div>

         <div class="chat-input">
        <input type="text" id="messageInput" placeholder="Enter your message" name="msg" required>
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
