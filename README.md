# 🚀 PHPChat
(Under construction, updated code will be added soon.)
A web chat application in PHP for communication between multiple clients and a single admin. Can be used for customer support or feedback. The code can be easily modified to convert this into a full featured chat app.

## ✨ Features
- Uses a SQL database to store messages and Ajax to retrieve them.
- Loads only the latest 24 messages at a time (with reverse infinite scroll) for speed and efficiency.
- Long polling is used to fetch new messages

## To Do
- [ ] Switch to Socket.io instead of long polling
- [ ] Upgrade to full featured chat
- [ ] Allow image uploads
- [ ] Link recognition and highlighting

## 🗒 Usage
- This app is designed to be integrated inside an existing website, so it does not handle authentication.
- Authentication has to be done by the user and session variables have to be set. The app will use those session variables to determine the user.
- $_SESSION["admin6"] should be true to access admin chat panel and $_SESSION["id"] should be set to the client's id.

## :framed_picture: Screenshots
- Client side
- Admin side
