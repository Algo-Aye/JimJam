<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/chatbox.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link
      rel="Tab icon"
      href="images/sparrow favicon.png"
      type="image/png"
    />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
      rel="stylesheet"
    />
    <script src="js/main.js"></script>
    <script src="js/chat.js"></script>

    <title>Maxeon</title>
  </head>
  <body>
   

    <!-- homepage title and banner-->
    

    <!-- Popup chat window -->

    <!-- chat open -->
    <div class="chat-bar-open" id="chat-open">
      <button
        id="chat-open-button"
        type="button"
        class="collapsible close"
        onclick="chatOpen()"
      >
        <img src="images/chat/brain.png" alt="Sparrow Bird image" />
      </button>
    </div>

    <!-- chat close -->
    <div class="chat-bar-close" id="chat-close">
      <button
        id="chat-close-button"
        type="button"
        class="collapsible close"
        onclick="chatClose()"
      >
        <i class="material-icons-outlined"> close </i>
      </button>
    </div>

    <!-- chat-window 1 -->
    <div class="chat-window" id="chat-window1">
      <div class="hi-there">
        <p class="p1">Hi There, This is JimJam</p>
        <br />
        <p class="p2">Your Neighborhood Eaterly Advisor..<br />Let's Talk</p>
      </div>
      <div class="start-conversation">
        <h1>Start a Conversation with JimJam bot</h1>
        <br />
        <p>Puzzled about what to eat, don't worry, i got you.</p>
        <button
          class="new-conversation"
          type="button"
          onclick="openConversation()"
        >
          <span>Spark A Convo</span
          ><i class="material-icons-outlined"> send </i>
        </button>
      </div>
    </div>

    <!-- chat chat-window 2 -->
    <div class="chat-window2" id="chat-window2">
      <div class="message-box" id="messageBox">
        <div class="hi-there">
          <p class="p1">Hi There</p>
          <br />
          <p class="p2">All Ears For You.</p>
        </div>
        <div class="first-chat">
          <p>Ask me anything?</p>
          <div class="arrow"></div>
        </div>
        <div class="second-chat">
          <div class="circle"></div>
          <p>okay</p>
          <div class="arrow"></div>
        </div>
      </div>
      <div class="input-box">
        <div class="surveysparrow">
          <img src="images/b1.jpg" />
          <p>we run on surveysparrow</p>
        </div>
        <div class="write-reply">
          <input
            class="input-responsive"
            type="text"
            id="textInput"
            placeholder="Write a reply..."
          />

        </div>
        <div class="send-button">
          <button
            type="submit"
            class="send-message"
            id="send"
            onclick="userResponse()"
          >
            <i class="material-icons-outlined"> send </i>
          </button>
        </div>
      </div>
    </div>
  </body>
</html>